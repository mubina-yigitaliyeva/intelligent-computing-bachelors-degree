#include <iostream>

using namespace std;

class complex {
private:
    double real;
    double imag;

public:
    void read() {
        cout << "Enter real part: ";
        cin >> real;

        cout << "Enter imaginary part: ";
        cin >> imag;
    }

    void print() {
        if (imag >= 0) 
            cout << real << " + " << imag << "i" << endl;
        else
            cout << real << " - " << -imag << "i" << endl;
            
    }
};

int main() {
    complex c1, c2;
    
    cout << "Enter the first complex number:\n";
    c1.read();

    cout << "Enter the second complex number:\n";
    c2.read();

    cout << "\nFirst complex number: ";
    c1.print();

    cout << "Second complex number: ";
    c2.print();

    return 0;
}