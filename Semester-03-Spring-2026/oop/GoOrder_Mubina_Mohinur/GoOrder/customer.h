#ifndef CUSTOMER_H
#define CUSTOMER_H

#include "user.h"

class Customer : public User {
private:
    double balance;
    string address;

public: 
    Customer();

    Customer(string username, string password, string phoneNumber, string email, double balance, string address);

    void setBalance(double balance);
    void setAddress(string address);

    double getBalance() const;
    string getAddress() const;

    // const means: this function will not change the object’s data.

    void addBalance(double amount);
    bool pay(double amount);

    void displayDashboard();
};

#endif