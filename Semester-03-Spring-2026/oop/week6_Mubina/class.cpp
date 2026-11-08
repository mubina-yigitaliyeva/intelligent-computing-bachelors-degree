#include <iostream>

using namespace std; 

class Rectangle {
private:
    float length;
    float width;
public:
    void setdata(float l, float w);
    void putdata();
    float area();
    float perimeter();
};

void Rectangle :: setdata(float l, float w) {
    length = l;
    width = w;
}

void Rectangle :: putdata() {
    cout << "Length of rectangle: " << length << endl;
    cout << "Width of rectangle: " << width << endl;
}

float Rectangle :: area() {
    return length * width;
}

float Rectangle :: perimeter() {
    return (length * width) * 2;
}

int main() {
    Rectangle rect;
    rect.setdata(5.25, 4.5);
    rect.putdata();
    cout << "Area: " << rect.area() << "\n";
    cout << "Perimeter: " << rect.perimeter() << endl;

    return 0;   
}