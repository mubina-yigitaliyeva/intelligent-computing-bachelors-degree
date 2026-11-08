#include <iostream>
using namespace std;

class Book
{
private:
    string title;
    string author;
    int year;

public:
    Book() : title("UNKNOWN"), author("UNKNOWN"), year(1000) {}
    Book(string t) : title(t) {}
    Book(string t, string a) : title(t), author(a) {}
    Book(string t, string a, int y) : title(t), author(a), year(y) {}

    void display() const
    {
        cout << "Title: " << title << endl;
        cout << "Author: " << author << endl;
        cout << "Year: " << year << endl;
    }
};

int main()
{

    Book b1;
    Book b2("She");
    Book b3("Story", "Author1");
    Book b4("Success", "Author2", 1999);

    b1.display();
    b2.display();
    b3.display();
    b4.display();

    return 0;
}