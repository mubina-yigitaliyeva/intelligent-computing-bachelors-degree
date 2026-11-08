#include <iostream>

using namespace std;

// int main() {
//     // Declaration
//     int score1, score2, score3, maxScore, minScore, score;

//     // Input
//     cout << "Enter the first score: ";
//     cin >> score1;
//     cout << "Enter the second score: ";
//     cin >> score2;
//     cout << "Enter the third score: ";
//     cin >> score3;

//     // Find maximum
//     if (score1 > score2 && score1 > score3)
//     {
//         maxScore = score1;
//     }
//     else if (score2 > score1 && score2 > score3)
//     {
//         maxScore = score2;
//     }
//     else 
//     {
//         maxScore = score3;
//     }

//     // Find minimum
//     if (score1 < score2 && score1 < score3) 
//     {
//         minScore = score1;
//     }
//     else if (score2 < score1 && score2 < score3) 
//     {
//         minScore = score2;
//     }
//     else 
//     {
//         minScore = score2;
//     }

//     // Find and round the student score 
//     int temp = maxScore + minScore;
//     if (temp % 2 == 1)
//     {
//         temp += 1;
//     }

//     score = temp / 2;

//     // Print the results
//     cout << "Scores: " << score1 << " " << score2 << " " << score3 << endl;
//     cout << "Minimum and maximum scores: " << endl;
//     cout << minScore << " " << maxScore << endl;
//     cout << "Student score: " << score << endl;

//     return 0;
// }

int main() {
    int year;
    cout << "Enter a year: ";
    cin >> year; 

    if (year % 400 == 0 || (year % 4 == 0 && !(year % 100 == 0)))
    {
        cout << "LEAP" << endl;
    }
    else 
    {
        cout << "NOT LEAP" << endl;
    }

    return 0;
}