#include <iostream>

using namespace std;

class Rectangle {
    int width;
    int height;
public:
    Rectangle() : width(1), height(1) {};
    Rectangle(int s) : width(s), height(s) {};
    Rectangle(int w, int h) : width(w), height(h) {};

    int area() {
        return width * height;
    }
};

int main() {
    Rectangle a;
    Rectangle b(4);
    Rectangle c(3, 5);

    cout << a.area() << endl;
    cout << b.area() << endl;
    cout << c.area() << endl;
    return 0;
}