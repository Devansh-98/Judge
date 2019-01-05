#include<stdio.h>
int mod(int a)
{
	int mod=0;
	mod=a%10;
	return mod;
}
int main()
{
	int x=0,temp;
		printf("enter a digit to be reversed\n");
	scanf("%d",&x);
	do
	{
		temp=mod(x);
		printf("%d",temp);
		x/=10;
	}while(x!=0);
	return 0;
}
