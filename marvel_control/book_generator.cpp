// writing on a text file
#include <fstream>
using namespace std;

int main()
{
    ofstream examplefile("example.txt");
    if (examplefile.is_open())
    {
    	for (int i = 0; i < 1000; ++i)
    	{
        	examplefile << "bno" <<i+10<<",奇幻"<<",Harry Potter"<< i+1 <<",少年儿童出版社"<<",";
        	examplefile <<i+1850<<",J.K.Rolling"<<","<<30+i*0.01<<"," << i+2 <<","<< i+1 << endl ;
							// bno8,计算机,SQL Server 2008完全学习手册,清华出版社,2001,郭郑州,79.80,5,3
    	}
        examplefile.close();
    }
    return 0;
}