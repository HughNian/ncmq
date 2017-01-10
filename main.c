#include "main.h"

typedef struct _server S;
typedef struct _client C;

static S serv;
static int link_nums = 0;
static int client_free_nums = 0;
static C *client_array[CLIENT_ARRAY_SIZE];
static struct _storage_data STORAGE_DATA;
static sl *queue = NULL;
static Hash_Table *queue_time_key;
int s_port = SERVER_PORT;

void command_set_cache(C *client);
void command_get_cache(C *client);
void command_del_cache(C *client);
void command_enqueue(C *client);
void command_dequeue(C *client);
void command_monitor_cache(C *client);
void command_monitor_queue(C *client);
void command_get_c_keys(C *client);
void command_get_c_nodes(C *client);

command_opts copts[] = {
    {"set", command_set_cache, 1},
	{"get", command_get_cache, 0},
	{"del", command_del_cache, 0},
	{"enqueue", command_enqueue, 1},
	{"dequeue", command_dequeue, 0},
	{"mcache", command_monitor_cache, 0},
	{"mqueue", command_monitor_queue, 0},
	{"get_c_keys", command_get_c_keys, 0},
	{"get_c_nodes", command_get_c_nodes, 0}
};

static void
show_help(void)
{
	char *help = "************************* d^_^b **************************\n"
			     "* ncmq is a CACHE & MQ SERVER SYSTEM version " VERSION " *\n"
		         "* -h is show help                                        *\n"
			     "* -d to be daemon                                        *\n"
				 "* -p is port default is (21666)                          *\n"
				 "************************ hughnian ************************\n";

	fprintf(stderr, "%s", help);
}

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
    serv.serveraddr.sin_port = htons(s_port);

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

    nminit(100); //初始化内存管理器

    STORAGE_DATA.cacheData = hash_init(0);
    if(STORAGE_DATA.cacheData == NULL){
    	fprintf(stderr, "cache data init error\n");
    	epoll_ctl(serv.epfd, EPOLL_CTL_DEL, serv.sfd, &serv.ev);
    	close(serv.sfd);
    	return -1;
    }

    STORAGE_DATA.queueData = hash_init(0);
    if(STORAGE_DATA.queueData == NULL){
    	fprintf(stderr, "queue data init error\n");
    	epoll_ctl(serv.epfd, EPOLL_CTL_DEL, serv.sfd, &serv.ev);
    	close(serv.sfd);
    	return -1;
    }

    queue = init_skiplist(ORDER_BY_MIN);
    if(queue == NULL){
    	fprintf(stderr, "queue init error\n");
    	epoll_ctl(serv.epfd, EPOLL_CTL_DEL, serv.sfd, &serv.ev);
    	close(serv.sfd);
    	return -1;
    }

    queue_time_key = hash_init(0);
    if(queue_time_key == NULL){
		fprintf(stderr, "queue init error\n");
		epoll_ctl(serv.epfd, EPOLL_CTL_DEL, serv.sfd, &serv.ev);
		close(serv.sfd);
		return -1;
	}

    if(init_mheap() < 0 ){
    	fprintf(stderr, "lru init error\n");
    	epoll_ctl(serv.epfd, EPOLL_CTL_DEL, serv.sfd, &serv.ev);
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

		client->rbuf   = nmalloc(DEFAULT_DATA_SIZE);
		memset(client->rbuf, 0, DEFAULT_DATA_SIZE);
		client->rlimit = DEFAULT_DATA_SIZE;
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
		nfree(client->rbuf);
		free(client);
	} else {
		client_array[client_free_nums++] = client;
	}
}

int
read_client(C *client)
{
	char buf[DEFAULT_DATA_SIZE];
	memset(buf, 0, DEFAULT_DATA_SIZE);
	memset(client->rbuf, 0, client->rsize);
	client->rsize = 0;
    while(1){
    	client->rnum = read(client->cfd, buf, DEFAULT_DATA_SIZE);
    	switch(client->rnum){
    		case -1:
    			if(errno == EAGAIN || errno == EWOULDBLOCK){
    				continue;
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
    				client->rbuf = (char *)nrealloc(client->rbuf, client->rlimit);
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
	char header[32];
	int whsize,wsize,reslen;
	int read_body = 0;
	client->wsize = 0;
	client->wbuf  = NULL;
	client->wbuf  = client->response;
	sprintf(header, "%d\r\n", client->data_size);

	while(1){
		whsize = write(client->cfd, header, strlen(header));
		if (whsize == -1) {
			if(errno == EAGAIN || errno == EWOULDBLOCK){
				continue;
			} else {
				fprintf(stderr, "client write error msg1 (%s)\n", strerror(errno));
				goto failed;
				return -1;
			}
		} else if (whsize == 0) {
			goto failed;
			break;
		}

		if(whsize == strlen(header)){
			read_body = 1;
			break;
		}
	}

	if(read_body){
		while(!client->writeOk){
			wsize = client->return_size - client->wsize;
			if(wsize == 0) break;
			client->wnum = write(client->cfd, client->wbuf, wsize);
			switch(client->wnum){
				case -1:
					if(errno == EAGAIN || errno == EWOULDBLOCK){
						continue;
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
	}

    return 0;

failed:
	epoll_ctl(serv.epfd, EPOLL_CTL_DEL, client->cfd, &client->ev);
	close(client->cfd);
	unlink_client(client);
	free_client(client);
}

int
parse_command(C *client)
{
	int n=0;
	char *end;
	char *cptr = client->rbuf;
	command_arr carrs[10];

    char flag = ' ';
    char *cmd = strchr(client->rbuf, flag);

	while(cmd){
		*cmd = '\0';
		carrs[n].val = cptr;
		carrs[n].len = strlen(cptr);
		if((cptr[0] >= 65 && cptr[0] <= 90) || (cptr[0] >= 97 && cptr[0] <= 122)){
			carrs[n].type = 1;
		} else {
			carrs[n].type = 2;
		}
		cptr = ++cmd;
		cmd = strchr(cptr, flag);

		n++;
	}
	carrs[n].val = cptr;
	carrs[n].len = strlen(cptr);
	if((cptr[0] >= 65 && cptr[0] <= 90) || (cptr[0] >= 97 && cptr[0] <= 122)){
		carrs[n].type = 1;
	} else {
		carrs[n].type = 2;
	}

	end = strchr(carrs[n].val, '\r');
	while(end){
		*(end) = '\0';
		if(*(end+1) == '\n') *(end+1) = '\0';

		++end;
		end = strchr(end, '\r');
	}

	client->carrs_num = ++n;
	memcpy(client->carrs, carrs, sizeof(carrs));

	if(n > 3) return -1;
}

char *
json_encode4Hash(Hash_Table *hash_table)
{
    cJSON *jsonRoot = NULL;
    cJSON *subJson = NULL;
    int i, nkey;
    Hash_Node *node;
    char *ret, key[hash_table->hash_size];

    jsonRoot = cJSON_CreateObject();

    if(NULL == jsonRoot){
    	printf("create json failed\n");
    	return NULL;
    }

    for(i=0; i < hash_table->hash_size; i++){
        node = hash_table->hashs[i];

        int n = 0;
        while(node){
        	n++;
        	subJson = cJSON_CreateObject();
        	if(NULL == subJson){
				printf("create subjson failed\n");
				return NULL;
			}
        	sprintf(key, "%d%d", i, n);
        	cJSON_AddStringToObject(subJson, node->kv->key, (char *)node->kv->data);
        	nkey = n-1;
        	cJSON_AddNumberToObject(subJson, "nkey", nkey);
        	cJSON_AddNumberToObject(subJson, "add_time", node->add_time);
        	cJSON_AddNumberToObject(subJson, "up_time", node->up_time);
        	cJSON_AddItemToObject(jsonRoot, key, subJson);

			node = node->next;
        }
    }

    ret = cJSON_Print(jsonRoot);

    if(NULL == ret){
    	printf("json ret failed\n");
        cJSON_Delete(jsonRoot);
        return NULL;
    }

    cJSON_Delete(jsonRoot);

    return ret;
}

char *
json_encode4Node(Hash_Node *hash_node)
{
	cJSON *jsonRoot = NULL;
	int i;
	char *ret;

	jsonRoot = cJSON_CreateObject();

	if(NULL == jsonRoot){
		printf("create json failed\n");
		return NULL;
	}

	while(hash_node){
		cJSON_AddStringToObject(jsonRoot, hash_node->kv->key, (char *)hash_node->kv->data);

		hash_node = hash_node->next;
	}

	ret = cJSON_Print(jsonRoot);

	if(NULL == ret){
		printf("json ret failed\n");
		cJSON_Delete(jsonRoot);
		return NULL;
	}

	cJSON_Delete(jsonRoot);

	return ret;
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
	int i,num,finded = 0;
	command_func command_handler;
    C *client;
    client = (C *)ee.data.ptr;
    if(ee.events & EPOLLIN){
    	if(read_client(client) == -1) return;

    	if(parse_command(client) == -1) return;

    	char *cmd = client->carrs[0].val;
    	num = sizeof(copts)/sizeof(copts[0]);
		for(i = 0; i < num; i++){
			if(!strcmp(cmd, copts[i].cmd)){
				client->re_read = copts[i].is_re_read;
				command_handler = copts[i].command_handler;
				finded = 1;
				break;
			}
		}

		if(!finded) return;

		if(!strcmp(client->carrs[0].val, "set") && client->carrs_num == 2){
			client->carrs[++(client->carrs_num)].val = 0;
		}

		command_handler(client);

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
	int c;
	int todaemon = 0;
	while(-1 != (c = getopt(argc, argv, "h:d:p:"))) {
	    switch(c){
	    	case 'h':
	    		show_help();
	    		break;
	    	case 'd':
	    		todaemon = atoi(optarg);
	    		break;
	    	case 'p':
	    		s_port = atoi(optarg);
	    		break;
	    	default:
	    		show_help();
	    		return 0;
	    }
	}

	if(todaemon){
		if(daemon(0, 0) == -1){
			fprintf(stderr, "failed to be a daemon\n");
			exit(1);
		}
	}

	if(init_server() < 0){
		fprintf(stderr, "server failed!\n");
		return 0;
	}

	server_loop();

	return 0;
}

void
command_set_cache(C *client)
{
	int ret,keysize,overtime;
	char *key,overdue[128],*res;
    time_t t;
    t = time(NULL);
    overtime = time(&t);

    keysize = client->carrs[1].len+1;
    key = (char *)nmalloc(keysize);
    memset(key, 0, keysize);
    memcpy(key, client->carrs[1].val, client->carrs[1].len);

    memcpy(overdue, client->carrs[2].val, sizeof(client->carrs[2].val));

    if(client->re_read){
		if(read_client(client) == -1) return;
		client->re_read = 0;
	}

    char *data;
    if(client->rsize > 0){
    	data = (char *)nmalloc(client->rsize);
    	memset(data, 0, strlen(data));
    	client->data_size = client->rsize;
    	memcpy(data, client->rbuf, client->rsize);
    }

	if(hash_insert(STORAGE_DATA.cacheData, key, data) == -1){
		res = "cache hash insert failed\r\n";
		goto RESULT;
	}

    overtime += atoi(overdue);

    add_mheap(overtime, key, 1);

    res = "SET OK\r\n";

RESULT:
    free(client->response);
    client->return_size = strlen(res);
    client->response    = strdup(res);

    nfree(key);
    nfree(data);
}

void
command_get_cache(C *client)
{
	int ret;
	void *res;
	int keysize;
	char *key;

	keysize = client->carrs[1].len+1;
	key = (char *)nmalloc(keysize);
	memset(key, 0, keysize);
	memcpy(key, client->carrs[1].val, client->carrs[1].len);

	ret = hash_find_val(STORAGE_DATA.cacheData, key, &res);
	if(ret == -1){
		res = "NOT FOUND\r\n";
	}

	free(client->response);
	client->data_size   = strlen(res);
	client->return_size = strlen(res);
	client->response    = strdup(res);
}

void
command_del_cache(C *client)
{
	int ret, dnkey;
	void *res;
	int keysize, nkeysize;
	char *key, *nkey;

	keysize = client->carrs[1].len+1;
	key = (char *)nmalloc(keysize);
	memset(key, 0, keysize);
	memcpy(key, client->carrs[1].val, client->carrs[1].len);

	nkeysize = client->carrs[2].len+1;
	nkey = (char *)nmalloc(nkeysize);
	memset(nkey, 0, nkeysize);
	memcpy(nkey, client->carrs[2].val, client->carrs[2].len);
	dnkey = atoi(nkey);
	nfree(nkey);

	res = "DELETE SUCCESS\r\n";

	if(hash_delete(STORAGE_DATA.cacheData, key, dnkey) < 0){
		res = "DELETE FAILED\r\n";
	}

	free(client->response);
	client->data_size   = strlen(res);
	client->return_size = strlen(res);
	client->response    = strdup(res);
}

void
command_enqueue(C *client)
{
	int ret, keysize, queuekey;
	unsigned long int index, h;
	char *key, *res;
	void *find_ret;
	Hash_Node *find_queue;
	time_t t;
	t = time(NULL);
	queuekey = time(&t);

	keysize = client->carrs[1].len+1;
	key = (char *)nmalloc(keysize);
	memset(key, 0, keysize);
	memcpy(key, client->carrs[1].val, client->carrs[1].len);

	if(client->re_read){
		if(read_client(client) == -1) return;
		client->re_read = 0;
	}

	char *data;
	if(client->rsize > 0){
		data = (char *)nmalloc(client->rsize);
		memset(data, 0, client->rsize);
		client->data_size = client->rsize;
		memcpy(data, client->rbuf, client->rsize);
	}

	if(hash_insert(STORAGE_DATA.queueData, key, data) == -1){
		res = "queue hash insert failed\r\n";
		goto RESULT;
	}

	find_ret = hash_find_node(STORAGE_DATA.queueData, key);
	if(NULL == find_ret){
		res = "queue hash insert after find failed\r\n";
		goto RESULT;
	}
	find_queue = (Hash_Node *)find_ret;

	if(add_skiplist_node(queue, queuekey, find_queue) != 0){
		res = "enqueue queue failed\r\n";
		goto RESULT;
	}

    if(hash_insert(queue_time_key, key, &queuekey) == -1){
    	res = "queue time key hash insert failed\r\n";
    	goto RESULT;
    }

	res = "ENQUEUE OK\r\n";

RESULT:
	free(client->response);
	client->return_size = strlen(res);
	client->response    = strdup(res);

	nfree(key);
	nfree(data);
}

void
command_dequeue(C *client)
{
	int ret;
	void *res,*qkey;
	int keysize,queuekey;
	char *key;
	Hash_Node *dequeue;

	keysize = client->carrs[1].len+1;
	key = (char *)nmalloc(keysize);
	memset(key, 0, keysize);
	memcpy(key, client->carrs[1].val, client->carrs[1].len);

	ret = hash_find_val(queue_time_key, key, &qkey);
	if(ret == -1){
		res = "QUEUE NOT FOUND\r\n";
		goto RESULT;
	} else {
		queuekey = *((int *)qkey);

		if(find_skiplist_by_key(queue, queuekey, &dequeue) == -1){
			res = "QUEUE NOT FOUND\r\n";
			goto RESULT;
		}
		res = json_encode4Node(dequeue);
		d_hash_delete(STORAGE_DATA.queueData, key);
		d_hash_delete(queue_time_key, key);
		del_skiplist_node(queue, queuekey);
	}

RESULT:
	free(client->response);
	client->data_size   = strlen(res);
	client->return_size = strlen(res);
	client->response    = strdup(res);
}

void
command_monitor_cache(C *client)
{
    char *res;
    res = json_encode4Hash(STORAGE_DATA.cacheData);

    if(NULL == res){
    	res = "cache json failed\n";
    }

    free(client->response);
    client->data_size   = strlen(res);
    client->return_size = strlen(res);
    client->response    = strdup(res);
}

void
command_monitor_queue(C *client)
{
	char *res;
	res = json_encode4Hash(STORAGE_DATA.queueData);

	if(NULL == res){
		res = "queue json failed\n";
	}

	free(client->response);
	client->data_size   = strlen(res);
	client->return_size = strlen(res);
	client->response    = strdup(res);
}

void
command_get_c_keys(C *client)
{
	cJSON *jsonRoot = NULL;
	cJSON *subJson = NULL;
	int i;
	Hash_Node *node;
	char *ret, *res, key[STORAGE_DATA.cacheData->hash_size];

	jsonRoot = cJSON_CreateObject();

	if(NULL == jsonRoot){
		res = "create json failed\r\n";
		goto RESULT;
	}

	for(i=0; i < STORAGE_DATA.cacheData->hash_size; i++){
		node = STORAGE_DATA.cacheData->hashs[i];

		if(node){
			sprintf(key, "%d", i);
			cJSON_AddStringToObject(jsonRoot, key, node->kv->key);
		}
	}

	ret = cJSON_Print(jsonRoot);

	if(NULL == ret){
		res = "json ret failed\r\n";
		cJSON_Delete(jsonRoot);
		goto RESULT;
	}

	cJSON_Delete(jsonRoot);

	if(NULL == ret){
		res = "cache json failed\r\n";
		goto RESULT;
	} else {
		res = ret;
	}

RESULT:
	free(client->response);
	client->data_size   = strlen(res);
	client->return_size = strlen(res);
	client->response    = strdup(res);
}

void
command_get_c_nodes(C *client)
{
	int keysize,i=0;
	unsigned long int index, h;
	char *res,*key,nkey[256];
	Hash_Node *node;
	cJSON *jsonRoot = NULL;

	keysize = client->carrs[1].len+1;
	key = (char *)nmalloc(keysize);
	memset(key, 0, keysize);
	memcpy(key, client->carrs[1].val, client->carrs[1].len);

	h = get_hash(key, strlen(key));
	index = h % STORAGE_DATA.cacheData->hash_size;
	node = STORAGE_DATA.cacheData->hashs[index];

	if(!node){
		res = "NODE NOT FOUND\r\n";
		goto RESULT;
	} else {
		jsonRoot = cJSON_CreateObject();

		if(NULL == jsonRoot){
			res = "create json failed\r\n";
			goto RESULT;
		}

		while(node){
			sprintf(nkey, "%d", i);
			cJSON_AddStringToObject(jsonRoot, nkey, (char *)node->kv->data);
			node = node->next;
			i++;
		}

		res = cJSON_Print(jsonRoot);

		if(NULL == res){
			res = "json ret failed\r\n";
			cJSON_Delete(jsonRoot);
			goto RESULT;
		}

		cJSON_Delete(jsonRoot);
	}

RESULT:
	free(client->response);
	client->data_size   = strlen(res);
	client->return_size = strlen(res);
	client->response    = strdup(res);

	nfree(key);
}
