#include <iostream>

using namespace std;

class Account {
    protected:
        string owner;
        float balance;
    public:
        Account() {
            owner = "owner";
            balance = 0.0;
        }

        void deposit(float amount) {
            if (amount >= 0) {
                balance += amount;

                cout << "(Account) -> Amount added to the balanace." << endl;
                return;
            }

            cout << "(Account) -> Negative amount cannot be added." << endl;
        }

        void withdraw(float amount) {
            if (amount >= 0 && balance >= amount) {
                balance -= amount;

                cout << "(Account) -> Amount withdrawn from the balanace." << endl;
                return;
            }

            cout << "(Account) -> Withdrawal amount is negative or more than the current balance." << endl;
        }

        void show() {
            cout << "Owner: " << owner << endl;
            cout << "Balance: " << balance << endl;
        }
};

class SavingsAccount : public Account{
private:
    float interestRate;

public:
    SavingsAccount(string own, float rate) {
        owner = own;
        interestRate = rate;
    }

    void addInterest() {
        balance += balance * interestRate;
 
        cout << "(SavingsAccount) -> Interest added." << endl;
    }
};

class CheckingAccount : public Account {
private:
    float overdraftLimit;

public:
    CheckingAccount(string own, float limit) {
        owner = own;
        overdraftLimit = limit;
    }

    void withdraw(double amount) {
        if (amount <= 0) {
            cout << "(CheckingAccount) -> Amount cannot be negative." << endl;
            return;
        }

        if (balance - amount < -overdraftLimit) {
            cout << "(CheckingAccount) -> Amount is more than the balance." << endl;
            return;
        }

        balance -= amount;

        cout << "(CheckingAccount) -> Amount is withdrawn from balance." << endl;
    }

};

int main() {

    SavingsAccount s("Mina", 0.05);
    CheckingAccount c("Jin", 300);

    s.deposit(1000);
    s.addInterest();

    s.withdraw(2000);

    c.deposit(200);
    c.withdraw(400); /// overdraft allowed

    c.withdraw(200);

    s.show();
    c.show();


    return 0;
}