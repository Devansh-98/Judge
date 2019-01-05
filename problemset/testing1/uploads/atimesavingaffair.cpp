#include<bits/stdc++.h>
#define ll long long
using namespace std;
ll k = 4;
# define INF 0x3f3f3f3f
class Graph
{
    int V;
    list< pair<int, int> > *adj;

public:
    Graph(int V);
    void addEdge(int u, int v, int w);
    void shortestPath(int s);
};
Graph::Graph(int V)
{
    this->V = V;
    adj = new list< pair<int, int> >[V];
}

void Graph::addEdge(int u, int v, int w)
{
    adj[u].push_back(make_pair(v, w));
    adj[v].push_back(make_pair(u, w));
}
void Graph::shortestPath(int src)
{
    // Create a set to store vertices that are being
    // prerocessed
    set< pair<int, int> > setds;

    // Create a vector for distances and initialize all
    // distances as infinite (INF)
    vector<int> dist(V, INF);

    // Insert source itself in Set and initialize its
    // distance as 0.
    setds.insert(make_pair(0, src));
    dist[src] = 0;

    /* Looping till all shortest distance are finalized
       then setds will become empty */
    while (!setds.empty())
    {
        // The first vertex in Set is the minimum distance
        // vertex, extract it from set.
        pair<int, int> tmp = *(setds.begin());
        setds.erase(setds.begin());

        // vertex label is stored in second of pair (it
        // has to be done this way to keep the vertices
        // sorted distance (distance must be first item
        // in pair)
        int u = tmp.second;

        // 'i' is used to get all adjacent vertices of a vertex
        list< pair<int, int> >::iterator i;
        for (i = adj[u].begin(); i != adj[u].end(); ++i)
        {
            // Get vertex label and weight of current adjacent
            // of u.
            int v = (*i).first;
            int weight = (*i).second;

            //  If there is shorter path to v through u.
            ll dis;
            if((dist[u]/k)%2==1)
            dis = ((dist[u]/k)+1)*k+weight;
            else
            dis = dist[u] + weight;
            if (dist[v] > dis)
            {
                /*  If distance of v is not INF then it must be in
                    our set, so removing it and inserting again
                    with updated less distance.
                    Note : We extract only those vertices from Set
                    for which distance is finalized. So for them,
                    we would never reach here.  */
                if (dist[v] != INF)
                    setds.erase(setds.find(make_pair(dist[v], v)));

                // Updating distance of v
                dist[v] = dis;
                setds.insert(make_pair(dist[v], v));
            }
        }
    }
    cout<<dist[V-1]<<endl;
}

// Driver program to test methods of graph class
int main()
{
    // create the graph given in above fugure
    int V ,m;
    cin>>V>>k>>m;
    Graph g(V);
    int first,second,weight;
    for(int i=0;i<m;i++)
    {
        cin>>first>>second>>weight;
        g.addEdge(first-1,second-1,weight);
    }
    g.shortestPath(0);
    return 0;
}
