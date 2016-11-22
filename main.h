/**
 * Copyright (c) 2016, niansong <Hugh.Nian@163.com>
 * All rights reserved.
 *
 * niansong's [memory cache & message queue] project for nju's paper
 *
 * this project successfully compiled in ubuntu14.4, gcc4.8.4
 *
 */

#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <fcntl.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <sys/epoll.h>
#include <errno.h>
#include <sys/time.h>

#include "nmalloc.h"
#include "hash.h"
#include "minheap.h"
#include "skiplist.h"
#include "cJSON.h"

#define SERVER_PORT 21666
#define EPOLL_EVENTS_NUMS 500
#define EPOLL_WAIT_NUMS 30
#define CLIENT_ARRAY_SIZE 1000
#define LISTEN_Q 1024
#define DEFAULT_DATA_SIZE 512
#define TIMEOUT_SECONDS 300

struct _storage_data {
	Hash_Table *cacheData;
	Hash_Table *queueData;
} storage_data;

typedef struct {
    char *val;
    int type;
    int len;
} command_arr;

struct _client {
	int cfd;

	int readOk;
	char *rbuf;
	int rsize;
	int rlimit;
	int rnum;
	int writeOk;
	char *wbuf;
	int wsize;
	int wnum;

	int carrs_num;
	command_arr carrs[10];

	int re_read;

	int data_size;

	char *response;

	time_t cost_time;

	struct epoll_event ev;

	struct _client *prev;
	struct _client *next;
} client;

typedef void (*command_func)(struct _client *client);

typedef struct {
    char *cmd;
    command_func command_handler;
    int is_re_read;
} command_opts;

struct _server {
	int sfd;
	int flag;
	struct sockaddr_in serveraddr;

	struct _client *clientHead;
	struct _client *clientTail;

    int epfd;
    struct epoll_event *events;
    struct epoll_event ev;
} server;
