// Mubina20253721.cpp : This file contains the 'main' function. Program execution begins and ends there.
//

#include <iostream>
#include <string>
using namespace std;

int main()
{
    string first_name, last_name;
    int age;
    float weight;

    cout << "Enter your first name, last name, age and weight seperated by spaces: ";
    cin >> first_name >> last_name >> age >> weight;

    cout << "Name: " << first_name + " " + last_name << endl;
    cout << "Age: " << age << endl;
    cout << "Weight: " << weight << endl;

    //string s1 = "Good";
    //string s2 = "Bad";
    //bool b = (s1 == s2);
    //cout << b << endl;

    ////string s1 = "Apple";
    ////string s2;

    ////s2 = s1 + " " + to_string(10) + " numbers";
    ////cout << s2 << endl;
    ////bool b;
    ////b = true; 
    ////cout << b << endl;
    return 0;

}

