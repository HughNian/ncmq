#ifndef __SKIPLIST_H__
#define __SKIPLIST_H__

#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <errno.h>
#include <time.h>
#include "nmalloc.h"

#define MAX_LEVEL 8

typedef struct skiplist_node sl_node;
typedef struct skiplist sl;
typedef enum order_type o_type;
typedef int (*comp_function)(int a, int b);

enum order_type{
	ORDER_BY_MIN = 1,
	ORDER_BY_MAX
};

struct skiplist_node{
	int key;
	void *val;
	sl_node *forward[1];
};

struct skiplist{
	int level;
	int size;
	comp_function comp;
	sl_node *root;
};

int comp_min(int a, int b);
int comp_max(int a, int b);
int get_rand_level(void);
sl *init_skiplist();
int add_skiplist_node(sl *skiplist, int key, void *val);
int del_skiplist_node(sl *skiplist, int key);
void *get_top_val(sl *skiplist);
void print_skiplist(sl *skiplist);

#endif
