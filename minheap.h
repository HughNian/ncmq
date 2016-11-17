#ifndef __MINHEAP_H__
#define __MINHEAP_H__

#include "nmalloc.h"

#define DEFAULT_HEAP_SIZE 1024

typedef struct _min_heap min_heap;
static min_heap mheap;
typedef struct dval dval;
typedef int (*function_comp)(void *ip, void *jp);

struct dval{
	int key;
    int size;
    int slen;
    char *val;
    int *num;
};

struct _min_heap{
	int size;
	int max_size;
	void **data;
	function_comp comp;
};

int init_mheap(void);
int add_mheap(int key, void *val, int tag);
int del_mheap(int key);
int resize_mheap(int new_size);
int find_mheap(void *value, int tag);

#endif
