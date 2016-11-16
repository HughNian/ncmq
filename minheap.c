#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "minheap.h"

int
key_comp(void *ip, void *jp)
{
	dval *idval = (dval *)ip;
	dval *jdval = (dval *)jp;
	return idval->key < jdval->key ? 1 : 0;
}

//向上调整堆为最小堆
int
fliter_up()
{
	int start    = mheap.size;
    int parent_k = (start-1)/2;
    while(start > 0 && mheap.comp(mheap.data[start], mheap.data[parent_k])){ //子节点小于父节点需要交换
    	dval *tmp = mheap.data[start];
    	mheap.data[start] = mheap.data[parent_k];
    	mheap.data[parent_k] = tmp;

    	start    = parent_k;
    	parent_k = (parent_k-1)/2;
    }

    return 0;
}

//向下调整堆为最小堆
int
fliter_down(int top, int end)
{
	int k = top;
	while(k*2+1 <= end){
		int l = k*2+1;
		if(l < end && mheap.comp(mheap.data[l+1], mheap.data[l])) l++;
		if(mheap.comp(mheap.data[l], mheap.data[k])){
			dval *temp = mheap.data[l];
			mheap.data[l] = mheap.data[k];
			mheap.data[k] = temp;
		}
		k = l;
	}

	return 0;
}

int
init_mheap()
{
	mheap.data = (void **)nmalloc(sizeof(void *) * DEFAULT_DATA_SIZE);
	if(NULL == mheap.data) return -1;
	mheap.size = 0;
	mheap.max_size = DEFAULT_DATA_SIZE;
	mheap.comp = key_comp;

	return 0;
}

int
add_mheap(int key, void *val, int tag)
{
	dval *dv;
    dv = (dval *)nmalloc(sizeof(*dv));
    if(tag == 1){
    	dv->key   = key;
    	dv->size  = strlen(val)+1;
    	dv->slen  = strlen(val);
    	dv->val   = (char *)val;
    	dv->num   = NULL;
    } else {
    	dv->key   = *(int *)val;
    	dv->size  = 4;
    	dv->slen  = 0;
    	dv->val   = NULL;
    	dv->num   = (int *)val;
    }

    if(mheap.size >= mheap.max_size){
    	int new_size = mheap.max_size*2;
    	mheap.max_size = new_size;
    	resize_mheap(new_size);
    }

    mheap.data[mheap.size] = (void *)dv;
    fliter_up();
    (mheap.size)++;

    return 0;
}

int
del_mheap(int key)
{
	int i;
	for(i = 0; i < mheap.size; i++){
		dval *val = (dval *)mheap.data[i];
		if(val->key == key){
			nfree(val);
			break;
		}
	}

	dval *last_val = mheap.data[--(mheap.size)];
	mheap.data[i] = last_val;

	fliter_down(0, mheap.size);

	return 0;
}

int
find_mheap(void *value, int tag)
{
	int i;
	for(i = 0; i < mheap.size; i++){
		dval *val = (dval *)mheap.data[i];
		if(tag == 1){
			if(!strcmp(val->val, (char *)value)) return 0;
		} else {
			if(*(val->num) == *((int *)value)) return 0;
		}
	}

	return -1;
}

int
resize_mheap(int new_size)
{
    void **newData;
    newData = (void **)nmalloc(sizeof(void *) * new_size);
    if(NULL == newData) return -1;

    memcpy(newData, mheap.data, sizeof(void *) * ((mheap.size)));
    nfree(mheap.data);

    mheap.data = newData;

    return 0;
}
