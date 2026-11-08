#include <iostream>

using namespace std;

class Person {
    string name;
    int age;
    string country;
public:
    void insert(string, int, string);
    void displayage();
};

void Person :: insert(string n, int a, string c) {
    name = n;
    age = a;
    country = c;
}

void Person :: displayage() {
    cout << "Age: " << age;
}

int main() {
    Person p;
    p.insert("Mubina", 19, "Uzbekistan");
    p.displayage();

    return 0;
}