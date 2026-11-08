#include <iostream>
#include <cmath>

using namespace std;

// finding the triangle and circle areas

#define _USE_MATH_DEFINES

double findTriangleArea(double base, double height) {
    return 0.5 * base * height;
}

double findCircleArea(double r) {
    return M_PI * pow(r, 2);
}

int main() {
    bool exit = true;
    
    while (exit) {
        int n;
        cout << "1. Find Triangle Area\n";
        cout << "2. Find Circle Area\n";
        cout << "3. Exit\n";
        cout << "Choose 1-3: ";
        cin >> n;
        if (n == 1) {
            double base, height;
            cout << "Enter the base: ";
            cin >> base;
            cout << "Enter the height: ";
            cin >> height;
            double area = findTriangleArea(base, height);
            cout << "The area of a triangle: " << area << "\n" << endl;
        } else if (n == 2) {
            double r;
            cout << "Enter the radius: ";
            cin >> r;
            double area = findCircleArea(r);
            cout << "The area of a circle: " << area << "\n" << endl;
        } else if (n == 3) {
            exit = false;
        } else {
            cout << "Choose only 1-3!" << "\n" << endl;
        }

    }
    return 0;
}