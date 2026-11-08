#include <iostream>
#include <cmath> 

using namespace std;

// printing the square root of the first 10 digits 

int main() {

    cout << "SQUARE ROOT" << endl;
    for (int i = 1; i <= 10; i++) {
        cout << i << " -->> ";
        cout << sqrt(i) << endl;
    }

    return 0;
}