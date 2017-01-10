#include "skiplist.h"

int
comp_min(int a, int b)
{
	return a < b ? 1 : 0;
}

int
comp_max(int a, int b)
{
	return a > b ? 1 : 0;
}

int
get_rand_level(void)
{
	int new_level;

	for (new_level = 0;
	    rand() < (RAND_MAX / 2) && new_level < MAX_LEVEL;
	    new_level++);

	return new_level;
}

sl *
init_skiplist(o_type flag)
{
	int i;
	sl *skiplist;

	skiplist = nmalloc(sizeof(sl));
	if(skiplist == NULL){
		fprintf(stderr, "malloc skiplist failed msg(%s)\n", strerror(errno));
		return NULL;
	}
	memset(skiplist, 0, sizeof(sl));

	switch(flag){
		case ORDER_BY_MIN:
			skiplist->comp = comp_min;
			break;
		case ORDER_BY_MAX:
			skiplist->comp = comp_max;
			break;
		default:
			skiplist->comp = comp_min;
			break;
	}

	skiplist->level = 0;
	skiplist->size  = 0;
	if((skiplist->root  = (sl_node *)nmalloc(sizeof(sl_node) + MAX_LEVEL * sizeof(sl_node *))) == NULL){
		fprintf(stderr, "malloc node failed msg(%s)\n", strerror(errno));
		return NULL;
	}
	memset(skiplist->root, 0, sizeof(sl_node) + MAX_LEVEL * sizeof(sl_node *));

	for(i = 0; i < MAX_LEVEL; i++){
		skiplist->root->forward[i] = NULL;
	}

	return skiplist;
}

int
add_skiplist_node(sl *skiplist, int key, void *val)
{
    int i,l,new_level;
	sl_node *update[MAX_LEVEL];
    sl_node *x = skiplist->root;
    sl_node *new;

    x = skiplist->root;
    for (i = skiplist->level; i >= 0; i--) {
	   while (x->forward[i] && skiplist->comp(x->forward[i]->key, key))
		   x = x->forward[i];
	   update[i] = x;
    }

    new_level = get_rand_level();

    if(new_level > skiplist->level){
        for(l=skiplist->level+1; l <= new_level; l++){
        	update[l] = skiplist->root;
        }
        skiplist->level = new_level;
    }

    new = (sl_node *)nmalloc(sizeof(*new) + new_level * sizeof(sl_node *));
    if(NULL == new){
    	fprintf(stderr, "new node malloc failed msg(%s)\n", strerror(errno));
    	return -1;
    }
    memset(new, 0, sizeof(*new) + new_level * sizeof(sl_node *));
    new->key = key;
    new->val = val;
    for(i = 0; i <= new_level; i++){
    	new->forward[i] = update[i]->forward[i];
    	update[i]->forward[i] = new;
    }

    skiplist->size++;

    return 0;
}

int
del_skiplist_node(sl *skiplist, int key)
{
    int i;
    sl_node *update[MAX_LEVEL];
    sl_node *x,*del;

    x = skiplist->root;
    for(i = 0; i <= skiplist->level; i++){
    	while(x->forward[i] != NULL && skiplist->comp(x->forward[i]->key, key)){
    		x = x->forward[i];
    	}
    	update[i] = x;
    }

    del = x->forward[0];
    if(del == NULL || del->key != key){
    	return -1;
    }

    for(i = 0; i <= skiplist->level; i++){
    	update[i]->forward[i] = update[i]->forward[i]->forward[i];
    }

    nfree(del);

    if(skiplist->level > 0 && (skiplist->root->forward[skiplist->level] == NULL)){
    	skiplist->level--;
    }

    skiplist->size--;

    return 0;
}

void
print_skiplist(sl *skiplist)
{
    int i;
    sl_node *n;

	for(i = 0; i < skiplist->level; i++){
		n = skiplist->root->forward[i];
		printf("level is %d:", i);
		while(n){
			printf("%s -> ", (char *)n->val);
			n = n->forward[i];
		}
		printf("NULL\n");
	}
}

void *
get_top_val(sl *skiplist)
{
	if(skiplist->root->forward[0] == NULL)
		return NULL;

	return skiplist->root->forward[0]->val;
}

void
del_top_val(sl *skiplist)
{
	sl_node *node;
	int i, newLevel;

	if (skiplist->root->forward[0] == skiplist->root) return;

	node = skiplist->root->forward[0];
	for (i = 0; i <= skiplist->level; i++) {
		if (skiplist->root->forward[i] == node) {
			skiplist->root->forward[i] = node->forward[i];
		} else {
			break;
		}
	}

	while ((skiplist->level > 0) &&
		(skiplist->root->forward[skiplist->level] == skiplist->root))
	{
		skiplist->level--;
	}

	skiplist->size--;
	nfree(node);
}

int
find_skiplist_by_key(sl *skiplist, int key, void **rec)
{
    int i;
    sl_node *x = skiplist->root;

    for(i = skiplist->level; i >= 0; i--) {
        while (x->forward[i] != skiplist->root
          && skiplist->comp(x->forward[i]->key, key))
            x = x->forward[i];
    }

    x = x->forward[0];
    if (x != skiplist->root && (x->key == key)) {
        *rec = x->val;
        return 0;
    }

    return -1;
}

int
delete_by_key(sl *list, int key, void **rec)
{
    int i;
    sl_node *update[MAX_LEVEL+1], *x;

    x = list->root;
    for (i = list->level; i >= 0; i--) {
        while (x->forward[i] != list->root
                && list->comp(x->forward[i]->key, key))
            x = x->forward[i];
        update[i] = x;
    }

    x = x->forward[0];
    if (x == list->root || !(x->key == key))
        return -1;

    for (i = 0; i <= list->level; i++) {
        if (update[i]->forward[i] != x) break;
        update[i]->forward[i] = x->forward[i];
    }

    if(rec) *rec = x->val;

    nfree(x);

    while ((list->level > 0) &&
           (list->root->forward[list->level] == list->root))
    {
        list->level--;
    }

    list->size--;

    return 1;
}
