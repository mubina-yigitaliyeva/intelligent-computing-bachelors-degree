#include <iostream>

using namespace std;

struct nameType {
    string firstname;
    string lastname;
};

struct employeeType1 {
    nameType name;
};

struct employeeType {
    string firstname;
    string lastname;
    int personID;
    string deptID;
    double yearlySalary;
    double monthlySalary;
    double yearToDatePaid;
    double monthlyBonus;
};

const int ARRAY_SIZE = 1000;
struct listType {
    int listElem[ARRAY_SIZE];
    int listLength;
};

// student struct
struct studentType
{
    string firstname;
    string lastname;
    int ID;
    string department;
    int semester;
    float GPA;
};


int main() {
    studentType student1, student2;
    cout << "Enter your firstname: ";
    cin >> student1.firstname;
    cout << "Enter your lastname: ";
    cin >> student1.lastname;
    cout << "Enter your ID: ";
    cin >> student1.ID;
    cout << "Enter your department: ";
    cin >> student1.department;
    cout << "Enter your semester: ";
    cin >> student1.semester;
    cout << "Enter your GPA: ";
    cin >> student1.GPA;

    student2 = student1;

    if (student1.firstname == student2.firstname && student1.lastname == student2.lastname) {
        cout << student2.firstname << " " << student2.lastname <<
        " " << student2.ID <<
        " " << student2.department <<
        " " << student2.semester <<
        " " << student2.GPA << endl;
    }

    int size = 50;
    employeeType employees[50];

    for (int i = 0; i < size; i++) {
        cout << employees[i].monthlySalary << "\n" << employees[i].yearToDatePaid << "\n";
    }

    employeeType1 employee;
    employee.name.firstname = 'Mubina';
    employee.name.lastname = 'Yigitalieva';

    return 0;
}