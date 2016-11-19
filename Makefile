all:
	gcc main.h main.c hash.h hash.c minheap.h minheap.c skiplist.h skiplist.c slabs.h slabs.c nmalloc.h nmalloc.c cJSON.h cJSON.c -o ncmq -g -lm