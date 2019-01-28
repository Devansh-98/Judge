#include<stdio.h>
int main()
{
	int t;
	long long int a[100000],n,k,i,j,count;
	scanf("%d",&t);
	while(t--)
	{
		scanf("%lld",&n);
		for(i=0;i<n;i++)
		scanf("%lld",&a[i]);
		for(i=0;i<n;i++)
		{
			k=0;count=0;
			for(j=i;j<n;j++)
			{
				if(a[j]<0)
				{
					if(count!=1)
					count=1;
					else if(count==1)
					count=2;
				}
				else if(a[j]>0)
				{
					if(count!=-1)
					count=-1;
					else if(count==-1)
					count=2;
				}
				if(count>1)
				break;
				k++;	
			}
			printf("%lld ",k);
			while(k>1)
			{
				printf("%lld ",--k);
				i++;
			}
		}
		printf("\n");
	}
	return 0;
}
