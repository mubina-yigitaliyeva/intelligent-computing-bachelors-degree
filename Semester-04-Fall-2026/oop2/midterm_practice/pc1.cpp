#include <iostream>

using namespace std;

int biggest(int a, int b) {
    return (a > b) ? a : b;
}

int biggest(int a, int b, int c) {
    int biggest = a;
    if (b >= a && b >= c) {
        biggest = b;
    } else if (c >= a && c >= b) {
        biggest = c;
    }
    return biggest;
}

double biggest(double a, double b) {
    return (a > b) ? a : b;
}

int main() {

    cout << biggest(3, 9) << endl;
    cout << biggest(4, 11, 7) << endl;
    cout << biggest(2.5, 1.5) << endl;
    return 0;
}