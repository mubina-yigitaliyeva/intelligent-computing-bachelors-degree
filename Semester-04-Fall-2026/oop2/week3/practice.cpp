#include <iostream>

using namespace std;

// class Person
// {
// private:
//     int age;
//     string name;

// public:
//     string getName() { return name; };
//     void setName(string value) { name = value; };

//     int getAge() { return age; };
//     void setAge(int value)
//     {
//         if (value > 0 && value <= 100)
//         {
//             age = value;
//         }
//         else
//         {
//             cout << "Age should be between 0 and 100";
//         }
//     };
// };

class BankAccount
{
private:
    double balance = 0;

public:
    void deposit(double value)
    {
        if (value >= 0)
        {
            balance += value;
            cout << value << " was deposited" << endl;
        }
        else
        {
            cout << "The value should be greater than 0." << endl;
        }
    };

    void withdraw(double value)
    {
        if (0 <= value && value <= balance)
        {
            balance -= value;
            cout << value << " was withdrawn" << endl;
        }
        else
        {
            cout << "Withdrawal amount is greater than balance or negative." << endl;
        }
    };

    double getBalance()
    {
        return balance;
    }
};

class Car
{
public:
    void startCar()
    {
        cout << "Starting a car..." << endl;
    };

    void stopCar()
    {
        cout << "Stopping the car..." << endl;
    };
};

class BMW : public Car
{
public:
    void brand()
    {
        cout << "This is BMW" << endl;
    };
};

class Tesla : public Car
{
public:
    void selfDrive()
    {
        cout << "Self is driving ...hehe" << endl;
    }
};

class Person
{
public:
    string name;
    int age;
    void sayHello()
    {
        cout << "Person is saying hello" << endl;
    }
};

class Student : public Person
{
public:
    int id;
    void showInfo()
    {
        cout << id << endl;
        cout << name << endl;
        cout << age << endl;
    }
};

class Teacher : public Person
{
public:
    int id;
    string subject;
    void showInfo()
    {
        cout << id << endl;
        cout << name << endl;
        cout << age << endl;
        cout << subject << endl;
    }
};

class Shape
{
public:
    virtual void area() = 0;
    virtual ~Shape() {}
};

class Circle : public Shape
{
    double radius;

public:
    Circle(double r) : radius(r) {}
    void area() override
    {
        cout << "Circle Shape is some value" << endl;
    };
};

class Rectangle : public Shape
{
    double length;
    double width;

public:
    Rectangle(double l, double w) : length(l), width(w) {}
    void area() override
    {
        cout << "Rectangle Shape is some value" << endl;
    };
};

main()
{
    // Encapsulation - hiding the data.
    // Person p1;
    // p1.setName("Alex");
    // cout << "Name is " << p1.getName() << endl;

    // p1.setAge(-100);
    // p1.setAge(100);

    // cout << "\nAge is " << p1.getAge() << endl;

    // BankAccount ba;
    // cout << "Balance is " << ba.getBalance() << endl;
    // ba.deposit(100);
    // cout << "Balance is " << ba.getBalance() << endl;
    // ba.withdraw(57);
    // cout << "Balance is " << ba.getBalance() << endl;
    // ba.withdraw(67);
    // cout << "Balance is " << ba.getBalance() << endl;

    // BMW bmw1;
    // bmw1.brand();

    // Tesla t1;
    // t1.selfDrive();

    // Person p1;
    // Student s1;
    // Teacher t1;

    // p1.name = "Person name";
    // p1.age = 20;

    // s1.id = 1;
    // s1.name = "Student name";
    // s1.age = 15;

    // t1.id = 2;
    // t1.name = "Teacher name";
    // t1.age = 30;
    // t1.subject = "Data Structures";

    // p1.sayHello();
    // s1.showInfo();
    // t1.showInfo();

    Shape *sh[2];
    sh[0] = new Circle(2);
    sh[1] = new Rectangle(5, 7);

    for (int i = 0; i < 2; i++)
    {
        sh[i]->area();
    }
    return 0;
}