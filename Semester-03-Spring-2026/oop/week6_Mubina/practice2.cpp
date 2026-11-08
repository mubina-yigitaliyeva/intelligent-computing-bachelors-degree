#include <iostream>
#include <cmath>

using namespace std;

class Circle {
    double radius;
public:
    void insert(double);
    void area();
    void perimeter();
};

void Circle :: insert(double r) {
    radius = r;
}

void Circle :: area() {
    double a = M_PI * pow(radius, 2);
    cout << "Area of a circle: " << a << endl;
}

void Circle :: perimeter() {
    double per = 2 * M_PI * radius;
    cout << "Perimeter of a circle: " << per << endl;
}

int main() {
    Circle c;
    c.insert(9);
    c.area();
    c.perimeter();
    
    return 0;
}