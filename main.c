#include "main.h"

typedef struct _server S;
typedef struct _client C;

static S serv;
static int link_nums = 0;
static int client_free_nums = 0;
static C *client_array[CLIENT_ARRAY_SIZE];
static struct _storage_data STORAGE_DATA;

int
set_nonblocking(int sock)
{
	int flag;
	flag = fcntl(sock, F_GETFL);
	if(flag < 0){
		fprintf(stderr, "fcntl error msg(%s)\n", strerror(errno));
		return -1;
	}

	if(fcntl(sock, F_SETFL, flag | O_NONBLOCK) < 0){
		fprintf(stderr, "fcntl error msg(%s)\n", strerror(errno));
		return -1;
	}

	return 0;
}

void
link_client(C *c)
{
    c->prev = NULL;
    c->next = serv.clientHead;
    if(serv.clientHead){
    	serv.clientHead->prev = c;
    }
    if(!serv.clientTail){
    	serv.clientTail = c;
    }
    serv.clientHead = c;

    ++link_nums;
}

void
unlink_client(C *client)
{
    if(client->prev){
    	client->prev->next = client->next;
    } else {
    	serv.clientHead = client->next;
    }

    if(client->next){
    	client->next->prev = client->prev;
    } else {
    	serv.clientTail = client->prev;
    }
}

int
init_server()
{
    serv.sfd = socket(AF_INET, SOCK_STREAM, 0);
    if(serv.sfd == -1){
    	fprintf(stderr, "socket failed msg (%s)\n", strerror(errno));
    	return -1;
    }

    if(set_nonblocking(serv.sfd) < 0){
    	fprintf(stderr, "server set nonblocking failed\n");
    	return -1;
    }

    serv.flag = 1;
    struct linger ling = {0,0};
    setsockopt(serv.sfd, SOL_SOCKET, SO_REUSEADDR, &(serv.flag), sizeof(serv.flag));
    setsockopt(serv.sfd, SOL_SOCKET, SO_KEEPALIVE, &(serv.flag), sizeof(serv.flag));
    setsockopt(serv.sfd, SOL_SOCKET, SO_LINGER, &ling, sizeof(ling));

    memset(&(serv.serveraddr), 0, sizeof(serv.serveraddr));
    serv.serveraddr.sin_family = AF_INET;
    serv.serveraddr.sin_addr.s_addr = htonl(INADDR_ANY);
    serv.serveraddr.sin_port = htons(SERVER_PORT);

    if(bind(serv.sfd, (struct sockaddr *)&(serv.serveraddr), sizeof(serv.serveraddr)) < 0){
    	fprintf(stderr, "bind failed msg (%s)\n", strerror(errno));
    	close(serv.sfd);
    	return -1;
    }

    if(listen(serv.sfd, LISTEN_Q) < 0){
    	fprintf(stderr, "listen failed msg (%s)\n", strerror(errno));
    	close(serv.sfd);
    	return -1;
    }

    serv.clientHead = serv.clientTail = NULL;

    serv.epfd    = epoll_create1(0);
    serv.events  = (struct epoll_event *)malloc(sizeof(struct epoll_event) * EPOLL_EVENTS_NUMS);
    serv.ev.data.fd = serv.sfd;
    serv.ev.events  = EPOLLIN | EPOLLET;
    epoll_ctl(serv.epfd, EPOLL_CTL_ADD, serv.sfd, &serv.ev);

    STORAGE_DATA.cache = hash_init(0);
    if(STORAGE_DATA.cache == NULL){
    	fprintf(stderr, "data malloc error\n");
    	close(serv.sfd);
    	return -1;
    }

    STORAGE_DATA.queue = init_skiplist(ORDER_BY_MIN);
    if(STORAGE_DATA.queue == NULL){
    	fprintf(stderr, "data malloc error\n");
    	close(serv.sfd);
    	return -1;
    }

    if(init_mheap() < 0 ){
    	fprintf(stderr, "data malloc error\n");
    	close(serv.sfd);
    	return -1;
    }

    return 0;
}

int
init_client(int cfd)
{
	C *client;
	if(client_free_nums > 0){
		client = client_array[--client_free_nums];
	} else {
		client = (C *)malloc(sizeof(*client));
		if(NULL == client){
			fprintf(stderr, "client malloc failed\n");
			return -1;
		}

		client->rbuf   = malloc(DEFAULT_DATA_SIZE);
		client->rlimit = DEFAULT_DATA_SIZE;

		//todo client->sendList
	}

	client->cfd       = cfd;
	client->readOk    = 0;
	client->rsize     = 0;
	client->rnum      = 0;
	client->wbuf      = NULL;
	client->wsize     = 0;
	client->wnum      = 0;
	client->writeOk   = 0;
	client->re_read   = 0;
	client->cost_time = time(NULL);

	link_client(client);

	client->ev.data.fd  = client->cfd;
	client->ev.data.ptr = client;
	client->ev.events = EPOLLIN | EPOLLET | EPOLLONESHOT;
	epoll_ctl(serv.epfd, EPOLL_CTL_ADD, client->cfd, &client->ev);

	return 0;
}

void
free_client(C *client)
{
	if(client_free_nums > CLIENT_ARRAY_SIZE){
		free(client->rbuf);
		free(client);
	} else {
		client_array[client_free_nums++] = client;
	}
}

int
read_client(C *client)
{
	char buf[DEFAULT_DATA_SIZE];
	memset(client->rbuf, 0, client->rsize);
	client->rsize = 0;
    while(1){
    	client->rnum = read(client->cfd, buf, DEFAULT_DATA_SIZE);
    	switch(client->rnum){
    		case -1:
    			if(errno == EAGAIN || errno == EWOULDBLOCK){
    				client->readOk = 1;
    				break;
    			} else {
    				fprintf(stderr, "client read error msg1 (%s)\n", strerror(errno));
    				goto failed;
    				return -1;
    			}
    		case 0:
    			fprintf(stderr, "client read error msg2 (%s)\n", strerror(errno));
    			goto failed;
    			return -1;
    		default:
    			if(client->rsize >= client->rlimit){
    				client->rlimit *= 2;
    				client->rbuf = (char *)realloc(client->rbuf, client->rlimit);
    			}
    			memcpy(client->rbuf+client->rsize, buf, client->rnum);
    			client->rsize += client->rnum;
    			break;
    	}

    	if(client->rnum == DEFAULT_DATA_SIZE){
    		continue;
    	} else {
    		client->readOk = 1;
    	}

    	if(client->readOk == 1) break;
    }

    return 0;

failed:
	epoll_ctl(serv.epfd, EPOLL_CTL_DEL, client->cfd, &client->ev);
	close(client->cfd);
	unlink_client(client);
	free_client(client);
}

int
write_client(C *client)
{
	int wsize;
	client->wsize = 0;
	client->wbuf  = NULL;
	client->wbuf  = client->rbuf;
    while(!client->writeOk){
    	wsize = client->rsize - client->wsize;
    	if(wsize == 0) break;
    	client->wnum = write(client->cfd, client->wbuf, wsize);
    	switch(client->wnum){
    		case -1:
    			if(errno == EAGAIN || errno == EWOULDBLOCK){
    				client->writeOk = 1;
    				break;
    			}
    			fprintf(stderr, "client write error msg (%s)\n", strerror(errno));
    			goto failed;
    			break;
    		case 0:
    			fprintf(stderr, "client write error msg (%s)\n", strerror(errno));
    			goto failed;
    			break;
    		default:
    			client->wbuf  += client->wnum;
    			client->wsize += client->wnum;
    			break;
    	}
    }

    return 0;

failed:
	epoll_ctl(serv.epfd, EPOLL_CTL_DEL, client->cfd, &client->ev);
	close(client->cfd);
	unlink_client(client);
	free_client(client);
}

void
client_timeout()
{
	C *c,*n;
	time_t now = time(NULL);
	c = serv.clientHead;
	while(c){
		n = c->next;
		if(now - c->cost_time > TIMEOUT_SECONDS){
			epoll_ctl(serv.epfd, EPOLL_CTL_DEL, c->cfd, &c->ev);
			close(c->cfd);
			unlink_client(c);
			free_client(c);
		}
		c = n;
	}
}

int
get_time()
{
	int t = -1;
	if(serv.clientTail){
		time_t now = time(NULL);
		C *tail = serv.clientTail;
		t = (int) now - tail->cost_time;
		t = t >= 0 ? t : 0;
		t = t >= 600 ? 0 : t;
	}

	return t;
}

void
server_do(struct epoll_event ee)
{
    C *client;
    client = (C *)ee.data.ptr;
    if(ee.events & EPOLLIN){
    	if(read_client(client) == -1) return;

    	client->ev.data.ptr = client;
    	client->ev.events = EPOLLOUT | EPOLLET | EPOLLONESHOT;
    	epoll_ctl(serv.epfd, EPOLL_CTL_MOD, client->cfd, &client->ev);
    }else if(ee.events & EPOLLOUT){
    	if(write_client(client) == -1) return;

    	client->ev.data.ptr = client;
    	client->ev.events = EPOLLIN | EPOLLET | EPOLLONESHOT;
    	epoll_ctl(serv.epfd, EPOLL_CTL_MOD, client->cfd, &client->ev);
    }

    return;
}

void
server_loop()
{
	int sfd,cfd,i;
	int fd_nums = 0;
	struct sockaddr_in clientaddr;
	socklen_t caddr_len = sizeof(clientaddr);

    for(;;){
    	int t = get_time();
    	client_timeout();
    	fd_nums = epoll_wait(serv.epfd, serv.events, EPOLL_WAIT_NUMS, t);
    	for(i = 0; i < fd_nums; i++){
    		sfd = serv.events[i].data.fd;
    		if(serv.sfd == sfd){
    			cfd = accept(serv.sfd, (struct sockaddr *)&clientaddr, &caddr_len);
    			if(cfd < 0){
    				if(errno == EAGAIN || errno == EWOULDBLOCK){
    					break;
    				} else {
    					fprintf(stderr, "client accept failed msg (%s)\n", strerror(errno));
    					break;
    				}
    			}

    			if(set_nonblocking(cfd) < 0){
    				fprintf(stderr, "client set nonblocking failed\n");
    				close(cfd);
    				break;
    			}

    			if(init_client(cfd) < 0){
    				fprintf(stderr, "init client failed\n");
    				close(cfd);
    				break;
    			}
    		} else {
    			server_do(serv.events[i]);
    		}
    	}
    }
}

int
main(int argc, char **argv)
{
	if(init_server() < 0){
		fprintf(stderr, "server failed!\n");
		return 0;
	}

	server_loop();

	return 0;
}
