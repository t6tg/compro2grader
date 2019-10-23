#include<iostream>
#include<string>
#include<stdlib.h> 
#include<stdio.h> 
#include<math.h>
#include<vector> 
#include<algorithm> 
using namespace std;

int main() 
{	
	vector<int> v;
	string s;
	while(true)
	{
		cin>>s;
		if(s == "e")
		{
		    for (int i = 0 ; i < v.size() ; i++)
		    {
    	   		int t = i;
		        for (int j = i ; j < v.size()  ; j++)
		        {       
		            if( v[t] > v[j])
		            {
		               t = j;
		            } 
		        }
		        int tt 	= v[i];
		        v[i] 	= v[t];
		        v[t] 	= tt;        
				for(int k = 0 ; k < v.size() ; k++) 
				{
					cout<<v[k]<<" ";
				}	    
				cout<<endl;
			}
			break;
		}	
		else 
		{
			const char * c = s.c_str();
			int t = atoi(c);
			v.push_back(t);
		}
	}
  	return 0;
}
