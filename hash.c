#include "hash.h"

static unsigned int
tableSize[] = {
    7,          13,         31,         61,         127,        251,
    509,        1021,       2039,       4093,       8191,       16381,
    32749,      65521,      131071,     262143,     524287,     1048575,
    2097151,    4194303,    8388607,    16777211,   33554431,   67108863,
    134217727,  268435455,  536870911,  1073741823, 2147483647, 0
};

Hash_Table *
hash_init(int skey)
{
    Hash_Table *hash_table;

    hash_table = (Hash_Table *)nmalloc(sizeof(Hash_Table));
    if(NULL == hash_table){
    	fprintf(stderr, "hash table malloc failed\n");
    	return NULL;
    }

    hash_table->skey = skey;
    hash_table->hash_size = tableSize[skey];
    hash_table->hash_nums = 0;
    hash_table->hashs = (Hash_Node **)nmalloc(sizeof(Hash_Node *) * hash_table->hash_size);
    if(NULL == hash_table->hashs){
    	fprintf(stderr, "hashs malloc failed\n");
    	return NULL;
    }

    return hash_table;
}

int
hash_resize(Hash_Table *hash_table)
{
	while(tableSize[hash_table->skey] && tableSize[hash_table->skey] <= hash_table->hash_size){
		hash_table->skey++;
	}

	int new_size = tableSize[hash_table->skey];

	if(0 == new_size){
		fprintf(stderr, "hash size error\n");
		return -1;
	}

    Hash_Node **tmp = hash_table->hashs;
    Hash_Node **new = (Hash_Node **)nmalloc(sizeof(Hash_Node *) * new_size);
    if(NULL == new){
        fprintf(stderr, "hash resize failed\n");
        return -1;
    }
    memset(new, 0, sizeof(Hash_Node *) * new_size);
    //memcpy(new, tmp, sizeof(Hash_Node *) * hash_table->hash_size); //这种复制也可以，只是index值仍然是旧的，后面更新了hash_size后find的时候index变了就查找不到了

    int i;
    char *key;
    unsigned long int old_index,new_index,h;

    for(i = 0; i < hash_table->hash_size; i++){
    	Hash_Node *old = hash_table->hashs[i];
    	Hash_Node *tmp;

    	while(old){
    		new_index = old->h % new_size;

    		tmp = old->next;

    		old->index = new_index;
    	    old->next  = new[new_index];
    	    new[new_index] = old;

    	    old = tmp;
    	}
    }
    nfree(hash_table->hashs);

    hash_table->hashs = new;
    hash_table->hash_size = new_size;

    return 0;
}

int
hash_insert(Hash_Table *hash_table, char *key, void *data)
{
	int key_size;
	unsigned long int index,h;
	time_t add_time;
	add_time = time(NULL);

	if(hash_table->hash_nums >= hash_table->hash_size){
		if(hash_resize(hash_table) == -1){
			return -1;
		}
	}

	h = get_hash(key, strlen(key));
	index = h % hash_table->hash_size;

	Hash_Node *hash_node;
    hash_node = (Hash_Node *)nmalloc(sizeof(Hash_Node));
    if(NULL == hash_node){
    	fprintf(stderr, "hash node malloc failed\n");
    	return -1;
    }
    memset(hash_node, 0, sizeof(Hash_Node));
    hash_node->index = index;
    hash_node->h  = h;
    hash_node->add_time = time(&add_time);
    hash_node->up_time = 0;
    hash_node->kv = (Key_Val *)nmalloc(sizeof(Key_Val)+KEY_SIZE);
    if(NULL == hash_node->kv){
    	nfree(hash_node);
    	fprintf(stderr, "hash node kv malloc failed\n");
    	return -1;
    }
    memset(hash_node->kv, 0, sizeof(Key_Val)+KEY_SIZE);
    key_size = strlen(key);
    if(key_size > KEY_SIZE){
    	nfree(hash_node->kv);
        nfree(hash_node);
        fprintf(stderr, "key size is too large");
        return -1;
    }

    hash_node->kv->dsize = strlen(data) + 1;
    hash_node->kv->data = (char *)nmalloc(hash_node->kv->dsize);
    memset(hash_node->kv->data, 0, hash_node->kv->dsize);
    memcpy(hash_node->kv->data, data, hash_node->kv->dsize);
    memcpy(hash_node->kv->key, key, key_size+1);
    hash_node->kv->key[key_size] = '\0';

    hash_node->next = hash_table->hashs[index];
    hash_table->hashs[index] = hash_node;

    hash_table->hash_nums++;

    return 0;
}

int
hash_find(Hash_Table *hash_table, char *key, void **val)
{
    unsigned long int index,h;
    h = get_hash(key, strlen(key));
    index = h % hash_table->hash_size;

    if(!hash_table->hashs[index]){
    	//fprintf(stderr, "this key not found val1!\n");
    	return -1;
    }

    Hash_Node *hash_node,*n;
    hash_node = hash_table->hashs[index];

    while(hash_node){
    	if(hash_node->index == index){
    		if(strcmp(hash_node->kv->key, key) == 0){
    			*val = hash_node->kv->data;
    			break;
    		} else {
    			*val = NULL;
    		}
    	} else {
    		//fprintf(stderr, "this key not found val2!\n");
    		return -1;
    	}
    	n = hash_node->next;
    	hash_node = n;
    }

    if(NULL == *val) return -1;

    return 0;
}

int
hash_delete(Hash_Table *hash_table, char *key, int nkey)
{
	int klen,nlen = 0,dNodeNum = 0;
    unsigned long int index,h;
    Hash_Node *node,*next,*prev = NULL;

    klen = strlen(key);
    h = get_hash(key, klen);
    index = h % hash_table->hash_size;

    if(!hash_table->hashs[index]){
    	return -1;
    }

    node = hash_table->hashs[index];
    //while(node && (strcmp(node->kv->key, key)) == 0))
    while(node){
    	if(nkey == -1){
    		if(strcmp(node->kv->key, key) != 0){
    			prev = node;
    			node = node->next;
    		}
    	}
    	if(nlen == nkey) break;
    	if(!node->next) break;

    	prev = node;
    	node = node->next;
    	nlen++;
    }

    if(!node) return -1;

    if(!prev){
    	hash_table->hashs[index] = node->next;
    } else {
    	prev->next = node->next;
    }

    nfree(node->kv->data);
    nfree(node->kv);
    nfree(node);

    hash_table->hash_nums--;

    if(nkey == -1){
    	if(hash_delete(hash_table, key, nkey) == -1); //递归彻底删除所有该key值的节点
    		return 0;
    }

    return 0;
}

int
hash_update(Hash_Table *hash_table, char *key, void *new)
{
    unsigned long int index,h;
    time_t up_time;
    up_time = time(NULL);

    h = get_hash(key, strlen(key));
    index = h % hash_table->hash_size;

    if(!hash_table->hashs[index]) return -1;

    Hash_Node *node;

    node = hash_table->hashs[index];
    while(node){
    	if(index == node->index && strncmp(node->kv->key, key, strlen(key)) == 0){
    		node->up_time  = time(&up_time);
    		node->kv->data = new;
    	}
    	node = node->next;
    }

    return 0;
}

void
hash_foreach(Hash_Table *hash_table, print_hash handler)
{
    int i;
    Hash_Node *node;

    for(i = 0; i < hash_table->hash_size; i++){
    	node = hash_table->hashs[i];

    	if(node){
    		handler(node, i);
    	}
    }
}

void
hash_destory(Hash_Table *hash_table)
{
    int i = 0;
    Hash_Node *node,*tmp;

    for(; i < hash_table->hash_size; i++){
    	node = hash_table->hashs[i];

    	while(node){
    		tmp = node;
    		nfree(node->kv);
    		nfree(node);
    		node = tmp->next;
    	}
    }

    nfree(hash_table->hashs);
    nfree(hash_table);
}

#define HASH_JEN_MIX(a,b,c)                                                      \
do {                                                                             \
  a -= b; a -= c; a ^= ( c >> 13 );                                              \
  b -= c; b -= a; b ^= ( a << 8 );                                               \
  c -= a; c -= b; c ^= ( b >> 13 );                                              \
  a -= b; a -= c; a ^= ( c >> 12 );                                              \
  b -= c; b -= a; b ^= ( a << 16 );                                              \
  c -= a; c -= b; c ^= ( b >> 5 );                                               \
  a -= b; a -= c; a ^= ( c >> 3 );                                               \
  b -= c; b -= a; b ^= ( a << 10 );                                              \
  c -= a; c -= b; c ^= ( b >> 15 );                                              \
} while (0)

inline uint64_t
get_hash(char *key, uint32_t keylen)
{
    uint64_t hashv;

    unsigned i, j, k;
    hashv = 0xfeedbeef;
    i = j = 0x9e3779b9;
    k = (unsigned) (keylen);

    while (k >= 12)
    {
        i += (key[0] + ((unsigned) key[1] << 8) + ((unsigned) key[2] << 16)
                + ((unsigned) key[3] << 24));
        j += (key[4] + ((unsigned) key[5] << 8) + ((unsigned) key[6] << 16)
                + ((unsigned) key[7] << 24));
        hashv += (key[8] + ((unsigned) key[9] << 8) + ((unsigned) key[10] << 16)
                + ((unsigned) key[11] << 24));

        HASH_JEN_MIX(i, j, hashv);

        key += 12;
        k -= 12;
    }
    hashv += keylen;
    switch (k)
    {
    case 11:
        hashv += ((unsigned) key[10] << 24);
    case 10:
        hashv += ((unsigned) key[9] << 16);
    case 9:
        hashv += ((unsigned) key[8] << 8);
    case 8:
        j += ((unsigned) key[7] << 24);
    case 7:
        j += ((unsigned) key[6] << 16);
    case 6:
        j += ((unsigned) key[5] << 8);
    case 5:
        j += key[4];
    case 4:
        i += ((unsigned) key[3] << 24);
    case 3:
        i += ((unsigned) key[2] << 16);
    case 2:
        i += ((unsigned) key[1] << 8);
    case 1:
        i += key[0];
    }
    HASH_JEN_MIX(i, j, hashv);
    return hashv;
}
