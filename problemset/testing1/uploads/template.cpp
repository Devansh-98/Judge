
/*    It's harder to read code than to write it.       
                                     - Joel Spolsky   
                                                    
     --Shubh                                                                     
*/
#include <bits/stdc++.h>

//setbase - cout << setbase (16); cout << 100 << endl; Prints 64
//setfill -   cout << setfill ('x') << setw (5); cout << 77 << endl; prints xxx77
//setprecision - cout << setprecision (14) << f << endl; Prints x.xxxx
//cout.precision(x)  cout<<fixed<<val;  // prints x digits after decimal in val

using namespace std;
 
#define IOS ios::sync_with_stdio(0);cin.tie(0);cout.tie(0)

#define f(i,a,b) for(i=a;i<b;i++)
#define rep(i,n) f(i,0,n)
#define fd(i,a,b) for(i=a;i>=b;i--)
#define pb push_back
#define mp make_pair
#define vi vector< ll >
#define ss second
#define ff first
#define ll long long
#define ld long double
#define pii pair< ll,ll >
#define sz(a) a.size()
#define inf (1000*1000*1000+5)
#define all(a) a.begin(),a.end()
#define vii vector<pii>
#define mod (1000*1000*1000+7)
#define pqueue priority_queue< ll >
#define pdqueue priority_queue< ll,vi ,greater< ll > >
#define pi 3.14159265359
#define endl '\n'

//=================================================================================

ll i,j;
int main()
{    
    IOS;
    
    ll n,q;
    cin>>n>>q;
    string a[n];
    //cout<<"Sfdhgf"<<endl;
    rep(i,n)
    {
        cin>>a[i];
    }
    //std::vector<pair<pair<ll,ll>,string> > query;

    string temp = a[i];

    ll ss=temp.length();
    std::vector<ll> zero[ss],one[ss];



    rep(i,n)
    {
        rep(j,(ll)sz(temp))
        {
            if(a[i][j]=='0')
            {
                zero[j].pb(i);
            }else
            {
                one[j].pb(i);
            }
        }
    }



    rep(i,q)
    {
        ll l,r;
        string x;
        cin>>l>>r>>x;
       // query.pb(mp(mp(l,r),x));
        vi set1,set2;
        l--;
        r--;
        ll ans=0;
        ll flag=0;
        rep(i,(ll)sz(x))
        {            
            if(x[i]=='1')
            {
                rep(j,(ll)sz(zero[i]))
                {
                    if(zero[i][j]>=l&&zero[i][j]<=r)
                    {
                        set1.pb(zero[i][j]);   
                    }
                }
                    
                
            }else
            {
                rep(j,(ll)sz(one[i]))
                {
                    if(one[i][j]>=l&&one[i][j]<=r)
                    {
                        set1.pb(one[i][j]);   
                    }
                }

            }
            if((ll)sz(set1)==1)
            {
                ans = set1[0]+1;
                break;
            }else if((ll)sz(set1)>1)
            {
                flag = i;
                break;
            }
        }

        if((ll)sz(set1)==1)
        {
            ans = set1[0]+1;
            cout<<ans<<endl;
            continue;
        }else if((ll)sz(set1)==0)
        {
            cout<<l<<endl;
            continue;
        }else
        {
            ll ff=0;
            for(ll i=flag+1;i<(ll)sz(x);i++)
            {
                ff =0;
                if(x[i]=='0')
                {
                    rep(j,(ll)sz(set1))
                    {
                        if(std::find(one[i].begin(), one[i].end(), set1[j]) != one[i].end())
                        {
                            set2.pb(set1[j]);
                           
                        }   

                    }
    
                
                }else
                {
                    rep(j,(ll)sz(set1))
                    {
                        if(std::find(zero[i].begin(), zero[i].end(), set1[j]) != zero[i].end())
                        {
                            set2.pb(set1[j]);
                          
                        }   

                    }

                }
                if((ll)sz(set2)==1)
                {
                    ans = set2[0]+1;
                    break;
                }else if((ll)sz(set2)>1)
                {
                    set1.clear();
                    ll xx = (ll)sz(set2);
                    set1 = set2;
                    //copy(set2,set2+xx,set1);
                    set2.clear();
                    ff=1;
                }

            }

            if((ll)sz(set2)==1)
            {
                cout<<ans<<endl;
                continue;
            }else
            {
                ans = set1[0]+1;
                cout<<ans<<endl;
                continue;
            }




        }


    }




    return 0;
}

