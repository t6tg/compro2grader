#include <iostream>
#include <string>
#include <stdlib.h> 
#include <stdio.h> 
#include <math.h>
#include <algorithm> 
using namespace std;

class node
{
	public:
    node *right;
    node *left; 
    int value;
    node()
    {
       value = -1;
       left = NULL;
       right = NULL;
    }
    node(int v)
    {
       value = v;
       left = NULL;
       right = NULL;
    }
};

class tree
{
	public:
	int height_max = 0;
    node *n; 
    int size = 0;
    
    tree()
    {
       n = new node();
    }
//------------------------------------------------------------    
	void add_node(int value)
    {
		if (value > 0 && n->value == -1)
		{
			n->value = value;
			return;
		}
		else if (value > 0)
		{
	        node *i = n;
	        while(true)
	        {
	            if( i->value > value && i->left != NULL )
	            {
	                i = i->left; 
	            }
	            else if( i->value <= value && i->right != NULL ) 
	            {
	                i = i->right;                
	            }
	            else if( i->value > value && i->left == NULL) 
	            {
	                i->left  = new node(value);
	                break;
	            }
	            else if( i->value <= value && i->right == NULL  ) 
	            {
	                i->right = new node(value);
	                break;                
	            }
	            else
	            {
	                break;                
	            }
	        } 
	    }
    }
//------------------------------------------------------------
	int max_height = 0;
	int min_height = 0;
	void height (node *m)
	{
		if( m != NULL )
		{
			min_height++;
			height(m->left); 
			if( min_height > max_height )
			{
				max_height = min_height;
			}
			height(m->right); 
			min_height--;
		}	
	}
    bool BFS(node *m, int level)
    {    
        if(level == 0)
        {
            cout<<m->value<<" ";
        }
        else
        {
            if( m->left != NULL ) {  BFS(m->left,level-1);   }
            if( m->right != NULL ){  BFS(m->right,level-1);  }     
        }
    }  
    void BFS()
    {
    	if(n->value != -1)
    	{
	    	max_height = 0;
	    	min_height = 0;
	    	height(n);
	    	for(int i=0 ; i < max_height ; i++)
	    	{
	        	BFS(n,i);
	        	cout<<"| ";
	    	} 
	    	cout<<endl;
	    }
	}	
//------------------------------------------------------------ 	
	bool search(int v)
    {
        node *i = n;
        while(true)
        {
            if( i->value > v && i->left != NULL ) 
            {
                i = i->left; 
            }
            else if( i->value < v && i->right != NULL ) 
            {
                i = i->right;                
            }
            else if( i->value == v ) 
            {
                return true;  
            }
            else
            {
               return false;              
            }
        } 
    }	
//------------------------------------------------------------  
	void delete_node(int v)
    {
    	if( !search(v) || v < 0)
    	{
			return;
		}
    	else
    	{
    		if( n->value != -1 )
	    	{	
			    node *parent = n;
			    node *current = n;   
			    
	            if( n->value == v ) 
	            {		    
	            	if( n->right == NULL && n->left == NULL  )
	            	{
	            		n = NULL;
	            		return;
					}
					if( n->right != NULL && n->left == NULL )
					{
						n = n->right;
						return;
					} 
					if( n->right == NULL && n->left != NULL )
					{
						n = n->left;
						return;
					}
				}
			    
			    while(true) 
			    {
			        parent = current;
			        //---------------------------------------------------------------------- Root Node
		            if( current->value == v ) 
		            {
		                if(current->left == NULL && current->right == NULL)
		                {
		                	n->value = -1;
		                    return;
		                }
		                else if(current->left != NULL)
		                {
		                   SwitchValueL(current);
		                }       
		                else if(current->right != NULL)
		                {
		                    SwitchValueR(current);                                     
		                }
		                return;               
		            }
		            //---------------------------------------------------------------------- Go Left
					else if(current->value > v) 
		      		{
		            	if( current->left != NULL )
		            	{
		            		current = current->left; 
						}
						else
						{
							return;
						}                 	
		                if(current->value == v) 
		                {
		                    if(current->left == NULL && current->right == NULL) 
		                    {                    
		                        parent->left = NULL; 
		                    }
		                    else if(current->left == NULL && current->right != NULL) 
		                    {
		                        parent->left = current->right;
		                    }
		                    else if(current->left != NULL && current->right == NULL) 
		                    {
		                        parent->left = current->left;
		                    }
		                    else if(current->left != NULL && current->right != NULL) 
		                    {
		                        SwitchValueL (current);
		                    }          
							return;
		                }                        
		            }
		            //---------------------------------------------------------------------- Go right
		            else if(current->value < v)
		            {
		            	if( current->right != NULL )
		            	{
		            		current = current->right; 
						}
						else
						{
							return;
						} 
		                if( current->value == v)
		                {
		                    if(current->left == NULL && current->right == NULL) 
		                    {
		                        parent->right = NULL; 
		                    }
		                    else if( current->left == NULL && current->right != NULL ) 
		                    {
		                        parent->right = current->right;
		                    }
		                    else if (current->left != NULL && current->right == NULL)  
		                    {
		                    	
		                        parent->right = current->left;
		                    }  
		                    else if( current->left != NULL && current->right != NULL )  
		                    {
		                        SwitchValueL (current);
		                    }                     
							return;
		                }                     
		            }
			    }        
			}
		}
    }    
//----------------------------------------------------------------------
	void SwitchValueL(node *current)
    {
        node *Pmin	= current->left;
        node *min 	= current->left;
    
    	if( min->right == NULL )
    	{
            current->value = min->value;
            current->left = min->left;
            return;	
		}    
    
        while(true) 
        {
            min = min->right; 
            if(min->right == NULL && min->left == NULL) 
            {
	            current->value = min->value;
	            Pmin->right = NULL;
	            return;
			}
            if(min->right == NULL && min->left != NULL)
            {
	            current->value = min->value;
	            Pmin->right = min->left;
	            return;
			}
            Pmin = min;
        }           
    }    
//----------------------------------------------------------------------
	void SwitchValueR(node *current)
    {
        node *Pmin	= current->right;
        node *min 	= current->right;
    
    	if( min->left == NULL )
    	{
            current->value = min->value;
            current->right = min->right;
            return;	
		}
			    
        while(true) 
        {
            min = min->left; 
            if(min->left == NULL && min->right == NULL) 
            {
	            current->value = min->value;
	            Pmin->left = NULL;
	            return;
			}
            if(min->left == NULL && min->right != NULL)
            {
	            current->value = min->value;
	            Pmin->left = min->right;
	            return;
			}
            Pmin = min;
        }        
    }
//----------------------------------------------------------------------
};

int main() 
{
	tree *t = new tree();
	string s;
	int num;
	while(true)
	{
		cin>>s;
		if(s=="i")
		{
			cin>>num;
			t->add_node(num);
		}
		else if(s=="d")
		{
			cin>>num;
			t->delete_node(num);    
		}
		else if(s=="p")
		{
			t->BFS();
		}		
		else if(s=="x")
		{
			break;
		}
	}
  	return 0;
}
