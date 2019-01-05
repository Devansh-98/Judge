#include<stdio.h>
int main()
{
  double a[3][2]={0},area;
  int t,i,j;
  scanf("%d",&t);
  while(t--)
  {
    for(i=0;i<3;i++)
    {
      for(j=0;j<2;j++)
      {
        scanf("%lf",&a[i][j]);
      }
    }
    area=a[0][0]*a[1][1]+a[1][0]*a[2][1]+a[2][0]*a[0][1]-a[1][0]*a[0][1]-a[2][0]*a[1][1]-a[0][0]*a[2][1];
    area*=(0.5);
    if(area<0)
    area*=-1;
    printf("%lf\n",area);
  }
  return 0;
}
