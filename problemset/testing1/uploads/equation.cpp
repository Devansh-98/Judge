#include<bits/stdc++.h>
#define ll long long
#define mod 1000000007
#define rep(i,a) for(int i=0;i<b;i++)
#define repa(i,a,b) for(int i=a;i<b;i++)
#define vi vector<ll>
#define vii std::vector<pair<ll,ll> >
#define pb(a) push_back(a)
#define clear(a) memset(a,0,sizeof(a))
using namespace std;
int main()
{
    ios_base::sync_with_stdio(false);
    cin.tie(NULL);
    ll t,i,j,n,m,k,q,temp;
    // cin>>t;
    // while(t--)
    {
        ll count=0;
        bool flag=0;
        // ll a[100050]={0};
        string s;
        double a,b,c;
        cout << std::setprecision(9);
        cin>>a>>b>>c;
        double d=b*b-4*a*c;
        if(a==0&&b==0&&c==0)
        {
            cout<<-1<<endl;
            return 0;
        }
        else if(c==0&&a!=0&&b!=0)
        {
            cout<<2<<endl;
            cout<<0<<endl<<-b/a<<endl;
            return 0;
        }
        else if(c==0)
        {
            cout<<1<<endl;
            cout<<0<<endl;
            return 0;
        }
        else if(a==0)
        {
            if(b!=0)
            {
                cout<<1<<endl;
                cout<<-c/b<<endl;
                return 0;
            }
            else
            {
                cout<<-1<<endl;
            }
        }
        else
        {
            if(d<0)
            {
                cout<<0<<endl;
            }
            else if(d==0)
            {
                cout<<1<<endl;
                cout<<-b/(2*a)<<endl;
            }
            else
            {
                cout<<2<<endl;
                cout<<std::fixed<<std::setprecision(9)<<min((-b-sqrt(d))/(2*a),(-b+sqrt(d))/(2*a))<<endl<<max((-b-sqrt(d))/(2*a),(-b+sqrt(d))/(2*a))<<endl;
                return 0;
            }
        }
    }
    return 0;
}
