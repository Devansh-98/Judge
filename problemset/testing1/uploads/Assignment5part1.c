#include<stdio.h>
void stringrevarsal(char a[])
{
	int i=-1,j;
	char *b[10000];
	while(a[++i]!='\0')
	b[i]=&a[i];
	for(j=i-1;j>=0;j--)
	printf("%c",*b[j]);
	printf("\n");
}
void duplicateremoval(char a[])
{
	int k=0,l=0,i=-1,j;
	char *b[10000];
	while(a[++i]!='\0')
	{
		for(j=0;j<i;j++)
		{
			if(a[j]==a[i])
			k=1;
		}
		if(k==0)
		{
			b[l]=&a[i];
			l++;
		}
		k=0;
	}
	for(j=0;j<l;j++)
	printf("%c",*b[j]);
	printf("\n");
}
void stringremoval(char a[],char b[])
{
	int i=-1,j=0,k=0,l=0,count=0;
	char *c[10000];
	while(a[++i]!='\0')
	{
		while(a[i+j]==b[j]&&k==0)
		j++;
		if(b[j]=='\0')
		{
			k=1;
			i+=j;
			i--;
			count++;
		}
		j=0;
		if(k==0)
		{
			c[l]=&a[i];
			l++;
		}
		else
		k=0;
	}
	if(count!=0)
	printf("no occurence\n");
	for(j=0;j<l;j++)
	printf("%c",*c[j]);
	printf("\n");
}
void stringconcatenation(char a[],char b[])
{
	int i=-1,j=-1;
	char *c[10000];
	while(a[++i]!='\0')
	c[i]=&a[i];
	i--;
	while(b[++j]!='\0')
	c[i++]=&b[j];
	for(j=0;j<i;j++)
	printf("%c",*c[j]);
	printf("\n");
}
void stringencrypt(char a[])
{
	char *b[10000],temp;
	int i=-1,j=0;
	while(a[++i]!='\0')
	{
		if(a[i+1]!='\0')
		{
			b[j]=&a[i+1];
			b[++j]=&a[i];
			i++;
			j++;
		}
		else
		b[j++]=&a[i];
	}
	for(i=0;i<j;i++)
	printf("%c",*b[i]);
}
int main()
{
	int choice;
	printf("Enter choice\n1-String reversal\n2-Duplicate removal\n3-String removal\n4-Substring concatenation\n5-Encrypt\n6-Decrypt \n7-Exit\n");
	scanf("%d",&choice);
	do
	{
		char a[10000]={'\0'},b[10000]={'\0'};
		switch(choice)	
		{
			case 1: printf("Enter the string\n");
					scanf("%s",a);
			   	    stringrevarsal(a);
				    break;
			case 2: printf("Enter the string\n");
					scanf("%s",a);
				    duplicateremoval(a);
				   	break;
			case 3: printf("Enter the string\n");
					scanf("%s",a);
					printf("Enter the string to be removed\n");
					scanf("%s",b);
					stringremoval(a,b);
					break;
			case 4: printf("Enter the first string\n");
					scanf("%s",a);
					printf("Enter the second string\n");
					scanf("%s",b);
					stringconcatenation(a,b);
					break;
			case 5:	printf("Enter the first string\n");
					scanf("%s",a);
					stringencrypt(a);
					break;
			case 6:printf("Enter the first string\n");
					scanf("%s",a);
					stringencrypt(a);
					break;
			case 7:return 0;
			default:printf("Wrong Choices\n");
		}
		printf("Enter choice");
		printf("1-String reversal\n2- Duplicate removal\n 3-String concatenation\n 4-Substring removal\n 5-Encrypt\n 6-Decrypt \n 7-Exit\n");
		scanf("%d",&choice);
	}while(choice!=7);
}
