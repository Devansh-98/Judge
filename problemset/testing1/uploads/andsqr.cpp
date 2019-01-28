#include<bits/stdc++.h>
#define ll long long
using namespace std;
bool perfectsquare(ll x)
{
    ll y = sqrt(x);
    // if(y*y==x)
    // {
    //     cout<<y<<" "<<x<<endl;
    // }
    return (y*y==x);
}
int main()
{
    ll T,n,q,count,i,j,k,l,r;
    cin>>T;
    while(T--)
    {
        cin>>n>>q;
        ll a[100010];
        for(int i=1;i<=n;i++)
        {
            cin>>a[i];
        }
        while(q--)
        {
            cin>>l>>r;
            count=0;
            for(i=l;i<=r;i++)
            {
                for(j=i;j<=r;j++)
                {
                    ll num = 0xffffffff;
                    // cout<<i<<" x    "<<j<<endl;
                    for(k=i;k<=j;k++)
                    {
                        num=num&a[k];
                    }
                    count+=perfectsquare(num);
                }
            }
            cout<<count<<endl;
        }
    }
    return 0;
}
