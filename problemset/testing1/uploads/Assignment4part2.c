#include<stdio.h>
#include<string.h>
int sizeo(int a[])
{
	int i,k=0;
	for(i=999;a[i]==0&&i>=0;i--)
	{
		k++;
	}
	if(k!=1000)
	return 1000-k;
	else 
	return 1;
}

int compare(int a[],int b[])
{
	int i;
	if(sizeo(a)>sizeo(b))
	return 1;
	else if(sizeo(a)<sizeo(b))
	return 0;
	else
	{
		for(i=sizeo(a)-1;i>=0;i--)
		{
			if(a[i]>b[i])
			return 1;
			else if(b[i]>a[i])
			return 0;
		}
		return 1;
	}
}
void convert(char a[],int res[])
{
	int i,len,j;
	len=strlen(a);
	j=0;
	for(i=len-1;i>=0;i--)
	{
		res[j]=a[i]-'0';
		j++;
	}
}
void addition(int i1[],int i2[],int res[])
{
	int i,l;
	l=sizeo(i1)>sizeo(i2)?sizeo(i1):sizeo(i2);
	for(i=0;i<l;i++)
	res[i]=i1[i]+i2[i];
	for(i=0;i<l;i++)
	{
		res[i+1]+=res[i]/10;
		res[i]=res[i]%10;
	}
		
} 
void multiplication(int i1[],int i2[],int res[])
{
	
	int i,j,l=0,d[1000]={0};
	for(i=0;i<sizeo(i1);i++)
	{
		for(j=0;j<sizeo(i2);j++)
		d[j]=i1[i]*i2[j];
		addition(res+i,d,res+i);
	
	}
}
void substraction(int i1[],int i2[],int res[])
{
	int i,l,k;
	k=compare(i1,i2);
	l=sizeo(i1)>sizeo(i2)?sizeo(i1):sizeo(i2);
	if(k==1)
	{
		for(i=0;i<l;i++)
		res[i]=i1[i]-i2[i];
	
		
	}
	else if(k==0)
	{
		for(i=0;i<l;i++)
		res[i]=i2[i]-i1[i];
	}
	for(i=0;i<l;i++)
	{
		if(res[i]<0)
		{
			res[i]+=10;
			res[i+1]--;
		}
	}
	if(k==0)
	res[l-1]=0-res[l-1];
}
void division(int i1[],int i2[],int res[])
{
	int quo[1000]={0},l=1,k,unit,j,i;
	l=sizeo(i1);
	while(l>0)
	{
		int temp[2000]={0};
		for(j=0;j<=10;j++)
		{
			for(i=0;i<sizeo(i2);i++)
			temp[i]=i2[i]*j;
			for(i=0;i<sizeo(i2);i++)
			{
				temp[i+1]+=temp[i]/10;
				temp[i]=temp[i]%10;
			}
			k=compare(i1+l-1,temp);
			for(i=0;i<1500;i++)
			temp[i]=0;
			if(k==0)
			break;
			
		}
		j--;
		for(i=0;i<sizeo(i2);i++)
		temp[i]=i2[i]*j;
		for(i=0;i<sizeo(i2);i++)
		{
			temp[i+1]+=temp[i]/10;
			temp[i]=temp[i]%10;
		}
		substraction(i1+l-1,temp,i1+l-1);
		res[l-1]=j;
		l--;
	}
}

int main()
{
	char in1[1000],in2[1000];
	int size=0,k=0;
	int choice,i;
	printf("1-Add\n2-Multiply\n3-Divide\n4-Substract\n5-Exit\n");
	scanf("%d",&choice);
	while(choice!=5)
	{
		int i1[5000]={0},i2[5000]={0},o[1000]={0};
		switch(choice)
		{
			case 1:printf("Enter the first Number");
				   scanf("%s",in1);
				   convert(in1,i1);
				   printf("Enter the second number");
				   scanf("%s",in2);
				   convert(in2,i2);
				   addition(i1,i2,o);
				   size=sizeo(o);
				   for(i=size-1;i>=0;i--)
				   printf("%d",o[i]);
				   printf("\n");
				   break;
			case 2:printf("Enter the first Number");
				   scanf("%s",in1);
				   convert(in1,i1);
				   printf("Enter the second number");
				   scanf("%s",in2);
				   convert(in2,i2);
				   multiplication(i1,i2,o);
				   size=sizeo(o);
				   for(i=size-1;i>=0;i--)
				   printf("%d",o[i]);
				   printf("\n");
				   break;	   
			case 3:printf("Enter the first Number dividend");
				   scanf("%s",in1);
				   convert(in1,i1);
				   printf("Enter the second number divisor");
				   scanf("%s",in2);
				   for(i=0;i<strlen(in2);i++)
				   {
				   	if(in2[i]!='0')
				   	k++;
				   }
				   if(k==0)
				   printf("Divisor can never be zero\n");
				   else
				   {
						convert(in2,i2);
				   		division(i1,i2,o);
				   		size=sizeo(o);
				   		for(i=size-1;i>=0;i--)
				   		printf("%d",o[i]);
						printf("\n");
				   }
				   break;	   
			case 4:printf("Enter the first Number");
				   scanf("%s",in1);
				   convert(in1,i1);
				   printf("Enter the second number");
				   scanf("%s",in2);
				   convert(in2,i2);
				   substraction(i1,i2,o);
				   size=sizeo(o);
				   for(i=size-1;i>=0;i--)
				   printf("%d",o[i]);
				   printf("\n");
				   break;
			case 5:return 0;
			default:printf("wrong choice\n");
					break;
		}
		k=0;
		printf("1-Add\n2-Multiply\n3-Divide\n4-Substract\n5-Exit\n");
		scanf("%d",&choice);
	}
}
