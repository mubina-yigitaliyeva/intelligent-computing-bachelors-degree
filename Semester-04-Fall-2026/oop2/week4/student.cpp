#include <iostream>
using namespace std;

class Student
{
    string name;
    int id;

public:
    Student(string n, int i) : name(n), id(i)
    {
        cout << "created " << name << endl;
    }
    Student(const Student &other) : name(other.name), id(other.id)
    {
        cout << "copied " << other.name << endl;
    }

    // ~Student() {
    //     cout << "Class dying..." << endl;
    // }
};

int main()
{
    Student a("Kim", 7); // parameterised
    Student b = a;       // copy
    Student c(a);        // copy
    return 0;
}