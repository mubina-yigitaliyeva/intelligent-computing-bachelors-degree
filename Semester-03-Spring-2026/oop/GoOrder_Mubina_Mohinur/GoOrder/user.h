#ifndef USER_H
#define USER_H

#include <iostream>
#include <string>

using namespace std;

// Base class for all users
class User {
protected:
    string username;
    string password;
    string phoneNumber;
    string email;

public:
    // Default constructor
    User();

    // Constructor with parameters
    User(string username, string password, string phoneNumber, string email);

    // Setters
    void setUsername(string username);
    void setPassword(string password);
    void setPhoneNumber(string phoneNumber);
    void setEmail(string email);

    // Getters
    string getUsername() const;
    string getPassword() const;
    string getPhoneNumber() const;
    string getEmail() const;

    // Login check
    bool login(string inputUsername, string inputPassword) const;

    // Virtual function for polymorphism
    virtual void displayDashboard() = 0;
    // Every child class must create its own version of displayDashboard().
    // = 0 -> I am forcing child classes to create this function. (Parent Class - User, Child Class - Customer, DeliveryRider)
};

#endif