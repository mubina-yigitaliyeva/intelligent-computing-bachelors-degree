#include <iostream>
#include <cmath>

using namespace std;

// class student
// class Student {
// public:
//     int id;
//     string name;
//     int age;

//     // member functions
//     void Display() {
//         cout << "Student information:" << "\n";
//         cout << "ID: " << id << "\n";
//         cout << "Name: " << name << "\n";
//         cout << "Age: " << age << "endl";
//     }
  
//     // constructor
//     Student(int i, string n, int a) {
//         id = i;
//         name = n;
//         age = a;
//     };

//     // descructor 
//     ~Student();
// };

// class circle
// class Circle {
// public:
//     double radius;

//     // member functions
//     void Display() {
//         cout << "Radius: " << radius << endl;
//     };

//     // constructor;
//     Circle(double r) {radius = r;};

//     // calculating the area of a circle
//     void Area() {
//         double area = M_PI * pow(radius, 2);
//         cout << "Area of a circle: " << area << endl;
//     };
// };

// // descructor 
// Circle :: ~Circle() {

// };

// OOP concept 1: Inheritance 
// class Shape {
//     int x, y;
// public:
//     void SetX(int xval) {
//         x = xval;
//     }

//     void SetY(int yval) {
//         y = yval;
//     }

//     void Display() {
//         cout << "x: " << x << "\n";   
//         cout << "y: " << y << endl;   
//     }
// };

// class Rectangle : public Shape {
//     int width, height;
// public:
//     void SetWidth(int w) {
//         width = w;
//     }

//     void SetHeight(int h) {
//         height = h;
//     }

//     int getArea() {
//         return (width * height);
//     }
// };

class Animal {
public:
    int age;
    string name;
    void showage() {
        cout << "age: " << age << endl;
    }
    void showname() {
        cout << "name: " << name << endl;
    }
};

class Dog : public Animal{
public:
    void bark() {
        cout << "barking..." << endl;
    }
};

class Cat : public Animal{
public:
    void meow() {
        cout << "meowing..." << endl;
    }
};


int main() {

    // Student sd1 = Student(1, "Mubina", 19);
    // Student sd2(1, "Mubina", 19);

    // sd1.Display();
    // sd2.Display();

    // Circle circle(10.0);
    // circle.Display();
    // circle.Area();

    // Rectangle r;

    // r.SetWidth(5);
    // r.SetHeight(6);

    // cout << "Area of a rectangle: " << r.getArea() << endl;

    Dog dog;
    dog.age = 2;
    dog.name = "Rex";
    cout << "Dog: " << "\n";
    dog.showage();
    dog.showname();

    Cat cat;
    cat.age = 2;
    cat.name = "Alice";
    cout << "Cat: " << "\n";
    cat.showage();
    cat.showname();

    return 0;
}