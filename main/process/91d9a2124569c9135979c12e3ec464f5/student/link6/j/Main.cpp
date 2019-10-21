#include <iostream>
#include <string>
#include <stdlib.h> 
#include <stdio.h> 
#include <math.h>
#include <algorithm> 
using namespace std;

class Node
{
	public:
	Node 	*next;
	int		id;
	Node()
	{
		id 		= 0;	
		next 	= NULL;	
	}
	Node(int a)
	{
		id 		= a;	
		next 	= NULL;
	}
};

class List_Link
{
	public:
	Node *head;
//--------------------------------------------------------------------------------------
	List_Link()
	{
		head = NULL;
	}
//--------------------------------------------------------------------------------------
	void PrintList()
	{
		if(head != NULL)
		{
			for( Node *h = head ; h != NULL ; h = h->next )
			{
				cout<<h->id<<" ";
			}
			cout<<endl;
		}
	}	
//--------------------------------------------------------------------------------------
	bool Search(int a)
	{
		for( Node *h = head ; h != NULL ; h = h->next )
		{
			if( h->id == a )
			{
				return true;
			}
		}
		return false;	
	}		
//--------------------------------------------------------------------------------------	
	void InsertNode(int a,int insert_id) 
	{
		Node *hh;
		if( !Search(a) )
		{
			bool can_insert = false;
			for( Node *h = head ; h != NULL ; h = h->next )
			{
				//Header
				if( h->id == insert_id && h == head ) 
				{
					Node *n 	= new Node(a);
					n->next 	= head;
					head 		= n;
					can_insert 	= true;
					break;
				}
				//Normal
				else if( h->next != NULL && h->next->id == insert_id )
				{
					Node *n 	= new Node(a);
					n->next 	= h->next;
					h->next 	= n;		
					can_insert 	= true;
					break;
				}
				hh = h; 
			}
			//Rear 
			if( !can_insert )
			{	
				if( head == NULL  )
				{
					head 			= new Node(a);
					can_insert 		= true;		
				}
				else
				{
					hh->next 		= new Node(a);
					hh->next->next 	= NULL;
					can_insert 		= true;	
				}
			}
		}
	}
//--------------------------------------------------------------------------------------
	void RemoveNode(int index)
	{		
		if( head != NULL && head->next == NULL && index == 0 )
		{
			head = NULL;
			return;
		}		
		else if (head != NULL)
		{
			int my_index = 1;																			
			for( Node *h = head ; h != NULL && h->next != NULL ; h = h->next )
			{
				if(index == 0)	
				{
					head = head->next;	
					break;
				}
				else if( my_index == index && h->next->next == NULL)												
				{																								
					h->next = NULL;																
					break;																				
				}
				else if( index == my_index )																
				{
					h->next = h->next->next;														
					break;
				}
				my_index++;
			}
		}
	}	
//--------------------------------------------------------------------------------------	
};
//--------------------------------------------------------------------------------------
int 	a;
int 	insert_id;
string	chioce = "";
int 	main() 
{
	List_Link *l = new List_Link();	
	while(true)
	{
		cin>>chioce;
		if(chioce == "a")
		{
			cin>>a>>insert_id;
			l->InsertNode(a,insert_id);		
		}
		else if(chioce == "r")
		{
			cin>>a;
			l->RemoveNode(a);			
		}
		else if(chioce == "p")
		{
			l->PrintList();	
		}		
		else
		{
			break;
		}
	}
   	return 0;
}
