//CS16B1011 
#include<stdio.h>
int main()
{int marks=102,count=0;
	scanf("%d",&marks);
	if(marks>=96&&marks<=100)
	{
		printf("A+\n");
		count++;
	}
	if(marks>=91&&marks<=95)
	{
		printf("A\n");
		count++;
	}
	
	if(marks>=81&&marks<=90)
	{
		printf("A-\n");
		count++;
	}
	
	if(marks>=76&&marks<=80)
	{
		printf("B\n");
		count++;
	}
	
	if(marks>=71&&marks<=75)
	{
		printf("B-\n");
		count++;
	}
	if(marks>=61&&marks<=70)
	{
		printf("C\n");
		count++;
	}
	
	if(marks>=51&&marks<=60)
	{
		printf("C-\n");
		count++;
	}
	if(marks>=41&&marks<=50)
	{
		printf("D\n");
		count++;
	}
	
	if(marks>=31&&marks<=40)
	{
		printf("FS\n");
		count++;
	}
	if(marks>=0&&marks<=30)
	{
		printf("FR\n");
		count++;
	}
	if(count==0)
	{
		printf("Please enter the correct marks\n");
		count++;
	}
	printf("%d",count);
	return 0;
}
