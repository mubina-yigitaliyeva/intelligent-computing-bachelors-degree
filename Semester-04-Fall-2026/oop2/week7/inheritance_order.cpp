#include <iostream>

using namespace std;

class Person {
    public:
        Person() {
            cout << "Person constructor called\n";
        }
        ~Person() {
            cout << "Person destructor called\n";
        }
};

class Student : public Person {
    public:
        Student() {
            cout << "Student constructor called\n";
        }
        ~Student() {
            cout << "Student destructor called\n";
        }
};

int main() {

    Student s;
    
    cout << "Object is in use...\n";

    return 0;
}