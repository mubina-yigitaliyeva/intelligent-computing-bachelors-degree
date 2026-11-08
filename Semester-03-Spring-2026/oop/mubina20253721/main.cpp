#include <iostream>

using namespace std;

// int main() {

//     int number, temp;
//     cout << "line1: Enter an integer: ";
//     cin >> number;
//     cout << endl;
//     temp = number;
//     if (number < 0)
//         number = number * (-1);
//     else
//         number = temp;
//     cout << "Line 7: The absolute value of" << temp << " is " << number << endl; 

//     return 0;
// }

// int main() {

//     int score;
//     // Input
//     cout << "Enter a score between 0 and 100: ";
//     cin >> score; 
    
//     // Decision
//     if (score >= 70)
//     {
//         cout << "Grade is pass" << endl;
//     }
//     else 
//     {
//         cout << "Fail." << endl;
//     }

//     return 0;
// }

// int main () {

//     // Declaration
//     int num1, num2;
//     int largest;

//     // Input
//     cout << "Enter the first number: ";
//     cin >> num1;
//     cout << "Enter the second number: ";
//     cin >> num2; 

//     // Decision
//     if (num1 > num2)
//     {
//         largest = num1;
//     }
//     else if (num1 < num2)
//     {
//         largest = num2;
//     }
//     else 
//     {
//         cout << "Both are equal" << endl;
//         return 0;

//     }
//     cout << "Largest number is " << largest << endl;

//     return 0;
// }

// int main() {

//     int day;
    
//     cout << "Enter a number between 0 and 6: ";
//     cin >> day;

//     switch (day)
//     {
//         case 0: cout << "Sunday";
//             break;
//         case 1: cout << "Monday";
//             break;
//         case 2: cout << "Tuesday";
//             break;
//         case 3: cout << "Wednesday";
//             break;
//         case 4: cout << "Thursday";
//             break;
//         case 5: cout << "Friday";
//             break;
//         case 6: cout << "Saturday";
//             break;
//         default: cout << "The number should be only between 0 and 6!!!";
//     }

//     return 0;
// }

// int main() {

//     int score;
//     char grade;
    
//     cout << "Enter a score between 0 and 100: ";
//     cin >> score;

//     int result = score / 10;
//     if (result > 100)
//     {
//         cout << "The score should be only between 0 and 100!!!";
//         return 0;
//     }

//     switch (result)
//     {
//         case 10: grade = 'A';
//         break;
//         case 9: grade = 'A';
//         break;
//         case 8: grade = 'B';
//         break;
//         case 7: grade = 'C';
//         break;
//         case 6: grade = 'D';
//         break;
//         default: grade = 'F';
//     }

//     cout << "Score: " << score << endl;
//     cout << "Grade: " << grade << endl;

//     return 0;
// }

// int main() {

//     if ('a' > 'b' || 66 > static_cast<int>('A'))
//     {
//         cout << "# * #" << endl;
//     }
//     return 0;
// }

