////**********************************************************
////    * Shows effects of multiplicative expresseions       *
////**********************************************************
//
//#include <iostream>
//using namespace std;
//
//int main()
//{
//    // Multiplication
//    cout << "Testing multiplication operator" << endl;
//    cout << "Value of 3 * 4 = " << 3 * 4 << endl;
//    cout << "Value of 2.4 * 4.1 = " << 2.4 * 4.1 << endl;
//    cout << "Value of -3 * 4 = " << -3 * 4 << endl;
//    // Division
//    cout << "Testing division operator " << endl;
//    cout << "Value of 30/5 = " << 30 / 5 << endl;
//    cout << "Value of 4/7 = " << 4/7<< endl;
//    // Remainder
//    cout << "Testing remainder operator" << endl;
//    cout << "Value of 30 % 5 = " << 30 % 5 << endl;
//
//
//}

//**********************************************************
//    * Testing implicit type conversion for types with no arithmetic *
//    * operations: bool, char, short, and float
//**********************************************************

#include <iostream>
#include <typeinfo>

using namespace std;

int main()
{
    // Declarations 
    //bool x = true;
    //char y = 'A';
    //short z = 14;
    //float t = 24.5;
    //// Type converseion from bool to int
    //cout << "Type of x + 100: " << typeid(x + 100).name() << endl;
    //cout << "Value of x + 100: " << x + 100 << endl;
    //// Type conversion from char to int
    //cout << "Type of y + 1000: " << typeid(y + 1000).name() << endl;

    cout << 3 + 7 * 4 / 22 - 8 << endl;

}


