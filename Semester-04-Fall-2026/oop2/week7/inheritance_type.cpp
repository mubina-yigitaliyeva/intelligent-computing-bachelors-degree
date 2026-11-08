#include <iostream>

using namespace std;

// multilevel inheritance

class Vehicle {
public:
    Vehicle() {
        cout << "This is Vehicle." << endl;
    }
};

class FourWheeler : public Vehicle {
public:
    FourWheeler() {
        cout << "This is FourWheeler." << endl;
    }
};

class Car : public FourWheeler {
public:
    Car() {
        cout << "This is Car." << endl;
    } 
};

int main() {
    
    Car c;

    return 0;
}