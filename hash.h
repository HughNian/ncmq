#ifndef __HASH_H__
#define __HASH_H__

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdint.h>
#include <time.h>
#include "nmalloc.h"

typedef unsigned long int ub4;
typedef unsigned char ub1;

#define d_hash_delete(hash_table, key) hash_delete(hash_table, key, -2)
#define d_hash_find_val(hash_table, key, val) hash_find_val(hash_table, key, val, 1)
#define d_hash_find_node(hash_table, key) hash_find_node(hash_table, key, 1)
#define KEY_SIZE 32

typedef struct {
    int dsize;
    void *data;
    char key[1];
} Key_Val;

typedef struct Hash_Node {
    unsigned long int index;
    unsigned long int h;
    int add_time;
    int up_time;
    Key_Val *kv;
    struct Hash_Node *next;
    struct list_head *nlist;
} Hash_Node;

typedef struct {
	int skey;
	int hash_size;
	int hash_nums;
    Hash_Node **hashs;
} Hash_Table;

typedef void (*print_hash)(Hash_Node *node, int index);

Hash_Table *hash_init(int skey);
int hash_insert(Hash_Table *hash_table, char *key, void *data);
int hash_find_val(Hash_Table *hash_table, char *key, void **val, int flag);
void *hash_find_node(Hash_Table *hash_table, char *key, int flag);
int hash_delete(Hash_Table *hash_table, char *key, int nkey);
int hash_update(Hash_Table *hash_table, char *key, void *new);
void hash_foreach(Hash_Table *hash_table, print_hash handler);
void hash_destory(Hash_Table *hash_table);
inline uint64_t get_hash(char *key, uint32_t keylen);

#endif
