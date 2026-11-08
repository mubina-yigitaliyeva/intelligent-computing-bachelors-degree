#include <iostream>

using namespace std;

class User {
public:
    void login() {
        cout << "Logged in." << endl;
    }
};

class Student : public User {
public:
    void registerCourse() {
        cout << "Course registered." << endl;
    }
};

class Admin : public User {
public:
    void addCourse() {
        cout << "Course added." << endl;
    }
};

int main() {

    Student s;
    s.login();
    s.registerCourse();
    
    Admin a;
    a.login();
    a.addCourse();

    return 0;
}