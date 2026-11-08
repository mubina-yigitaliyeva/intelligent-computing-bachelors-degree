#include "customer.h"

Customer::Customer() : User() {
    balance = 0.0;
    address = "";
}

Customer::Customer(string username, string password, string phoneNumber, string email, double balance, string address) : User(username, password, phoneNumber, email) {
    this->balance = balance;
    this->address = address;
}

void Customer::setBalance(double balance) {
    this->balance=balance;
}

void Customer::setAddress(string address) {
    this->address = address;
}

double Customer::getBalance() const {
    return balance;
}

string Customer::getAddress() const {
    return address;
}

void Customer::addBalance(double amount) {
    balance += amount;
}

bool Customer::pay(double amount) {
    if (balance >= amount) {
        balance -= amount;
        return true;
    }

    return false;
}

void Customer::displayDashboard() {
    cout << "\n<<<< CUSTOMER DASHBOARD >>>>>" << endl;
    cout << "Welcome, " << email << endl;
    cout << "Email: " << email << endl;
    cout << "Phome: " << phoneNumber << endl;
    cout << "Address: " << address << endl;
    cout << "Balance: " << balance << " won" << endl;
}

