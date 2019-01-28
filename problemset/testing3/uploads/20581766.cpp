#include<bits/stdc++.h>
#define ll long long int
#define ld long double
#define mod 1000000007
#define nl cout<<'\n';
#define de(x) cout<<x<<'\n';
using namespace std;
int main()
{
    ios_base::sync_with_stdio(0);
    cin.tie(0);cout.tie(0);
    ll t;
    cin>>t;
    while(t--){
        ll x,i,j,n,m,r,d,ans;
        cin>>n>>r>>d;
        ll l=(r*n)/(100+r),rt=n;
        m=1;
        l++;
        while(rt>=l){
            ll n1=n;
            ll cnt=0;
            x=l+rt;
            x/=2;
            while(n1>0){
                n1-=x;
                n1+=(n1*r)/100ll;
                cnt++;
            }
            //cout<<x<<" "<<cnt;nl;
            if(cnt>d){
                l=x+1;
            }
            else if(cnt<=d){
                rt=x-1;
                m=x;
            }
        }
        cout<<m;nl;
    }
}
