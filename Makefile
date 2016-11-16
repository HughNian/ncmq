all:
	gcc mian.h mian.c hash.h hash.c minheap.h minheap.c skiplist.h skiplist.c slabs.h slabs.c nmalloc.h nmalloc.c -o ncmq -g -lm