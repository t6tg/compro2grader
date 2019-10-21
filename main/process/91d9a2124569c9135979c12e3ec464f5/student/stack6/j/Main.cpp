#include <iostream>
#include <string>
#include <stdlib.h> 
#include <stdio.h> 
#include <math.h>
#include <vector> 
#include <algorithm> 
using namespace std;

class Stack
{
	public:
    vector<string> v;
    int size = 0;
//-------------------------------------------------------------
    void Push(string data)
    {
    	if( v.size() < size )
    	{
        	v.push_back(data);
        }
    }
//-------------------------------------------------------------
    void Pop() 
    {
    	string s = "";
    	if(!v.empty())
    	{
        	s = v.at(v.size()-1); 
        	cout<<s<<endl; 
         	v.pop_back();
        }
    }
//-------------------------------------------------------------
    void Print()
    {
		if(!v.empty())
    	{    	
			for (int i = 0; i < v.size(); i++)				
			{ 
	 			cout << v[i] << " ";
			}
			cout<<endl;
		}
    }
//-------------------------------------------------------------    
};
int main() 
{
	Stack s;
	string t;
	string t1;
	int size;
	cin>>size;
	s.size = size;
	while(true)
	{
		cin>>t;
		if(t=="e")
		{
			cin>>t1;
			s.Push(t1); 
		}
		else if(t=="d")
		{
			s.Pop();
		}
		else if(t=="p")
		{
			s.Print();
		}
		else if(t=="n")
		{
			cout<<s.v.size()<<endl;
		}				
		else if(t=="x")
		{
			break;
		}
	}
  	return 0;
}
