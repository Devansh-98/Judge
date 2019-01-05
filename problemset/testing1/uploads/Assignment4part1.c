#include<stdio.h>

int extractNumber(char a[],int *p)//function to get a number from a string
{
	int result=0;
	while (a[*p]>='0'&&a[*p]<='9')
	{
		result=result*10+a[*p]-'0';
		*p+=1;
	}
	return result;
}

int check(char *a)//function to check validity of expression
{
	int count=0,k=0;
	while(a[k]!='\0')
	{
		if(a[k]>='0'&&a[k]<='9')
		{
			k++;
			continue;
		}
		else if(a[k]!='('&&a[k]!=')'&&a[k]!='+'&&a[k]!='-'&&a[k]!='*'&&a[k]!= '/')
			return 0;
		else if(k>0&&(a[k-1]<'0'||a[k-1]>'9'))
		{
			if((a[k]=='+'||a[k]=='-'||a[k]=='*'||a[k]=='/')&&a[k-1]!= ')')
				return 0;
			else if(a[k]=='('&&a[k-1]==')')
				return 0;
			else if(a[k]==')'&&a[k-1]!=')')
				return 0;
		}
		else if(k==0&&a[k]!='(')
			return 0;
		if(a[k]=='(')
		{
			if(k>0&&a[k-1]>='0'&&a[k-1]<='9')
				return 0;
			count++;
		}
		else if(a[k]==')')
			count--;
		if(count<0)
			return 0;
		k++;
	}
	if(a[k-1]=='+'||a[k-1]=='-'||a[k-1]=='*'||a[k-1]=='/')
		return 0;
	return(count==0);
}

long long int evaluate(char *a,int *k,char optr)//function to evaluate expression
{
	long long int result=0;
	*k+=1;
	while(a[*k]!='\0')
	{
		if(a[*k]>='0'&&a[*k]<='9')
		{
			result=extractNumber(a,k);
			continue;
		}
		else if(a[*k]=='(')
			result=evaluate(a,k,'(');
		else if(a[*k]==')')
			return result;
		else if(a[*k]=='+')
		{
			if(optr=='*'||optr=='/'||optr=='-')
			{
				*k-=1;
				return result;
			}
			result+=evaluate(a,k,'+');
		}
		else if(a[*k]=='-')
		{
			if(optr=='*'||optr=='/')
			{
				*k-=1;
				return result;
			}
			result-=evaluate(a,k,'-');
		}
		else if(a[*k]=='/')
		{
			if(optr=='*'||optr=='/')
			{
				*k-=1;
				return result;
			}
			result/=evaluate(a,k,'/');
		}
		else if(a[*k]=='*')
		{
			if(optr=='*'||optr=='/')
			{
				*k-=1;
				return result;
			}
			result*=evaluate(a,k,'*');
		}
		if(a[*k]==')'&&optr!='(')
			return result;
		*k+=1;
	}
	return result;
}

int main()
{
	int initial=-1;
	char a[10000];//a is the string having expressoion
	scanf("%s",a);
	if(check(a)==1)
	{
		long long int result=evaluate(a,&initial,'(');
		printf("%lld\n",result);
	}
	else
		printf("Invalid expression\n");
	return 0;
}
