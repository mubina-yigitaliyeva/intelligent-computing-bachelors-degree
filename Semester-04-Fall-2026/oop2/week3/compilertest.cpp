#include <iostream>
using namespace std;

class Person
{
public:
    string name;
    int age;

    void displayPerson()
    {
        cout << "Name is: " << name << "\nAge is: " << age << endl;
    }
};

class Student {
    public:
        string name;
        int id;
        int age;
        double grade;

        void display() {
            cout << name << endl;
            cout << id << endl;
            cout << age << endl;
            cout << grade << endl;
        }
};

void findLargestSmallest(int arr[], int size)
{
    int largest = arr[0];
    int smallest = arr[0];

    for (int i = 0; i < size; i++)
    {
        if (largest <= arr[i])
        {
            largest = arr[i];
        }

        if (smallest >= arr[i])
        {
            smallest = arr[i];
        }
    }

    cout << "Largest: " << largest << endl;
    cout << "Smallest: " << smallest << endl;
}

// void coundEvenAndOdd

    int
    main()
{
    Person p1;
    p1.name = "Mubina";
    p1.age = 100;
    // p1.displayPerson();

    int x = 10;
    int *y = &x;
    // cout << y << endl;
    // cout << *y << endl;

    int arr[5] = {-15, -22, -34, -7, -18};
    int sum = 0;

    for (int i = 0; i < 6; i++)
    {
        sum += arr[i];
    }

    // cout << sum << endl;

    for (int i = 0; i < 5; i++)
    {
        // cout << *(arr + i) << endl; // printing each element in the array
    }

    // cout << arr << endl;  // pointer pointing to the first element of an array
    // cout << *arr << endl; // a value of the first element in the array

    int arrsize = sizeof(arr) / sizeof(arr[0]);

    // cout << arrsize << endl;

    findLargestSmallest(arr, arrsize);

    Student stud1;
    Student stud2;

    stud1.name = "Alex";
    stud1.age = 12;
    stud1.grade = 2;
    stud1.id = 1;

    stud2.name = "Alice";
    stud2.age = 22;
    stud2.grade = 3;
    stud2.id = 2;

    stud1.display();
    stud2.display();
}