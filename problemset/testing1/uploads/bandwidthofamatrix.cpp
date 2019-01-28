#include<stdio.h>
int main()
{
	int t,n,temp,i,j,ans;
	long int count;
	scanf("%d",&t);
	while(t--)
	{
		ans=n-1;
		count=0;
		int a[1000]={0};
		scanf("%d",&n);
		for(i=0;i<n;i++)
		{
			for(j=0;j<n;j++)
			{
				scanf("%d",&temp);
				if(temp)
				count++;
			}
		}
		if(count>n)
		{
			count-=n;
			for(i=n-1;i>0;i--)
			{
				if(count>2*i)
				count-=2*i;
				else
				{
					ans=n-(i);
					break;
				}
			}	
			printf("%d\n",ans);
		}
		else 
		printf("0\n");
		ans=0;
	}
	return 0;
}
