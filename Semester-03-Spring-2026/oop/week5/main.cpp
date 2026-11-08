#include <iostream>
#include <math.h>

using namespace std;

// int larger(int first, int second) 
// {
//     int temp;
//     if (first > second)
//     {
//         temp = first;
//     }
//     else 
//     {
//         temp = second;
//     }

//     return temp;
// }


// int main() {

//     int largest_number = larger(10, 15);

//     cout << largest_number << endl;
    
//     return 0;
// }

// void quadratic(int a, int b, int c)
// {
//     int d = pow(b, 2) - 4 * a * c;
//     if (d < 0) {
//         cout << "There is no root" << endl;
//     }
//     else if (d == 0) {
//         double x = -b / (2.0 * a);
//         cout << "x1 = x2 = " << x << endl;
//     }
//     else {
//         double x1 = (-b + sqrt(d)) / (2.0 * a);
//         double x2 = (-b + sqrt(d)) / (2.0 * a);

//         cout << "x1 = " << x1 << endl;
//         cout << "x2 = " << x2 << endl;
//     }
// } 

// int main() {

//     int a, b, c, result;
//     cout << "Enter A: ";
//     cin >> a;
//     cout << "Enter B: ";
//     cin >> b;
//     cout << "Enter C: ";
//     cin >> c;

//     quadratic(a, b, c);
    
//     return 0;
// }

// void printStars(int n) 
// {
//     for (int i = 0; i < n; i++) {
//         cout << string(n, '*') << endl;
//     }
// }


// int main() {

//     int n;
//     cout << "Enter a number: ";
//     cin >> n;

//     printStars(n);

//     return 0;
// }


// void findPositiveMax(int a, int b) 
// {
//     if (a >= 0 && b >= 0) 
//     {
//         if (a > b) 
//         {
//             cout << "The largest number is " << a << endl;
//         }
//         else if (a < b)
//         {
//             cout << "The largest number is " << b << endl;
//         }
//         else 
//         {
//             cout << "They are equal.";
//         }
//     }
//     else 
//     {
//         cout << "Enter only positive numbers!" << endl;
//     }
// }

// int main() {
//     int a, b¸;
//     cout << "Enter the first number: ";
//     cin >> a;
//     cout << "Enter the second number: ";
//     cin >> b;

//     findPositiveMax(a, b);
// }

// void findMax(int a, int b, int c) 
// {
//     if (a >= b && a >= c) 
//     {
//         cout << "The largest number is " << a << endl;
//     }
//     else if (b >= a && b >= c) 
//     {
//         cout << "The largest number is " << b << endl;
//     }
//     else
//     {
//         cout << "The largest number is " << c << endl;
//     }
// }

// int main() {

//     int a, b, c;
//     cout << "Enter the first number: ";
//     cin >> a;
//     cout << "Enter the second number: ";
//     cin >> b;
//     cout << "Enter the third number: ";
//     cin >> c;

//     findMax(a, b, c);

//     return 0;
// }

int findMax(int a, int b) 
{
    if (a >= b) 
    {
        return a;
    }
    return b;
}

int main() {
    int n1, n2, n3, n4, n5, n6, n7, n8, n9, n10;
    
    cout << "Enter 10 numbers: ";
    cin >> n1 >> n2 >> n3 >> n4 >> n5 >> n6 >> n7 >> n8 >> n9 >> n10;

    int numbers[10] = {n1, n2, n3, n4, n5, n6, n7, n8, n9, n10};
    
    // int largest_n = findMax(findMax(findMax(n1, n2), findMax(n10, n3)), 
    //                         findMax(findMax(n4, n5), findMax(findMax(n6, n8), findMax(n7, n9))));

    // cout << largest_n << endl;

    int arr_size = sizeof(numbers) / sizeof(numbers[0]);

    int max_number = n1; 
    for (int i = 0; i < arr_size; i++) {
        if (numbers[i] >= max_number) 
        {
            max_number = numbers[i];
        }
    }

    cout << max_number << endl;

    return 0;
}