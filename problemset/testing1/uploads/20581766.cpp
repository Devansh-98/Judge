#include<bits/stdc++.h>
#define ll long long
#define mod 1000000007
#define rep(i,a,b) for(int i=a;i<b;i++)
#define vi vector<ll>
using namespace std;
vi hello;
void construct_lucus()
{
    hello.push_back(2);
    hello.push_back(1);
    for(int i=0;i<100050;i++)
    {
        hello.push_back(hello[i]+hello[i+1]);
    }
}
int main()
{
    ios_base::sync_with_stdio(false);
    cin.tie(NULL);
    ll t,i,j,n,m,k,q;
    cin>>t;
    construct_lucus();
    while(t--)
    {
        string s;
        ll count=0,flag=0,freq=0;
        ll a[26]={0};
        bool b[100050];
        cin>>s;
        memset(a,0,sizeof(a));
        memset(b,0,sizeof(b));
        for(i=0;i<s.length();i++)
        {
            if(a[s[i]-'a']==0)
            freq++;
            a[s[i]-'a']++;
        }
        for(i=0;i<26;i++)
        {
            b[a[i]]=1;
        }
        for(i=0;i<100050;i++)
        {
            if(!b[hello[i]])
            break;
            count++;
        }
        if(count!=freq)
        {
            cout<<"UNFIT"<<endl;
        }
        else
        {
            cout<<"FIT"<<endl;
        }
    }
    return 0;
}
