#include <iostream>

using namespace std;

class Account {
public:
    string accountNumber;
    string accountName;
    double balance;
};

class CheckingAccount : public Account {
public:
    void showValues() {
        cout << accountNumber << accountName << balance << endl;
    }
};

class SavingAccount : public Account {

};