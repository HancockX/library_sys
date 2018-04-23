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
        	examplefile << "This is a line.\n";
    	}
        examplefile.close();
    }
    return 0;
}