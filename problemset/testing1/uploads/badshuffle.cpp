#include<bits/stdc++.h>
#define ll long long
#define mod 1000000007
#define rep(i,a,b) for(int i=a;i<b;i++)
using namespace std;
int main()
{
    ll n;
    cin>>n;
    switch (n)
    {
    case 1:
        cout<<1<<endl<<1<<endl;
        break;
    case 2:
        cout<<"1 2"<<endl<<"2 1"<<endl;
        break;
    case 3:
        cout<<"1 3 2"<<endl<<"3 1 2"<<endl;
        break;
    case 4:
        cout<<"2 1 4 3"<<endl<<"4 1 2 3"<<endl;
        break;
    case 5:
        cout<<"2 1 4 5 3"<<endl<<"5 1 2 3 4"<<endl;
        break;
    case 6:
        cout<<"2 3 1 5 6 4"<<endl<<"6 1 2 3 4 5"<<endl;
        break;
    case 7:
        cout<<"2 3 1 5 6 7 4"<<endl<<"7 1 2 3 4 5 6"<<endl;
        break;
    case 8:
        cout<<"2 3 4 1 6 7 8 5 "<<endl<<"8 1 2 3 4 5 6 7"<<endl;
        break;
    case 9:
        cout<<"2 3 4 1 6 7 8 9 5"<<endl<<"9 1 2 3 4 5 6 7 8"<<endl;
        break;
    case 10:
        cout<<"2 3 4 5 1 7 8 9 10 6"<<endl<<"10 1 2 3 4 5 6 7 8 9"<<endl;
        break;
    case 11:
        cout<<"2 3 4 5 1 7 8 9 10 11 6"<<endl<<"11 1 2 3 4 5 6 7 8 9 10"<<endl;
        break;
    case 12:
        cout<<"2 3 4 5 6 1 8 9 10 11 12 7"<<endl<<"12 1 2 3 4 5 6 7 8 9 10 11"<<endl;
        break;
    case 13:
        cout<<"2 3 4 5 6 1 8 9 10 11 12 13 7"<<endl<<"13 1 2 3 4 5 6 7 8 9 10 11 12"<<endl;
        break;
    case 14:
        cout<<"2 3 4 5 6 7 1 9 10 11 12 13 14 8"<<endl<<"14 1 2 3 4 5 6 7 8 9 10 11 12 13"<<endl;
        break;
    case 15:
        cout<<"2 3 4 5 6 7 1 9 10 11 12 13 14 15 8"<<endl<<"15 1 2 3 4 5 6 7 8 9 10 11 12 13 14"<<endl;
        break;
    case 16:
        cout<<"2 3 4 5 6 7 8 1 10 11 12 13 14 15 16 9"<<endl<<"16 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15"<<endl;
        break;
    case 17:
        cout<<"2 3 4 5 6 7 8 1 10 11 12 13 14 15 16 17 9"<<endl<<"17 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16"<<endl;
        break;

    default:
        /* code */
        break;
    }
    return 0;
}
