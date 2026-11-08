#include <iostream>
using namespace std;

class Movie
{
public:
    string genre;
    string title;
    int duration;
    double rating;

    Movie() : genre("UNKNOWN"), duration(0) {}
    Movie(string g, string t, int d, double r) : genre(g), title(t), duration(d), rating(r) {}
    Movie(string g) : genre(g) {}
};

int main()
{
    Movie movie1;
    Movie movie2("Roman", "She", 160, 4.4);
    Movie movie3("Cartoon");

    cout << movie1.genre << endl;
    cout << movie2.genre << endl;
    cout << movie3.genre << endl;
    return 0;
}