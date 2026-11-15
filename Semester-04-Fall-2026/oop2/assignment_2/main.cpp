#include <iostream>
#include <string>
#include <fstream>

using namespace std;

class User {
public:
    string username;
    string password;
    User(const string& u, const string& p)
        : username(u), password(p) {}

    string toLine() const {
        return username + "," + password;
    }
    static User fromLine(const string& line) {
        int pos = line.find(",");
        string name = line.substr(0, pos);
        string pwd = line.substr(pos + 1);

        return User(name, pwd);
    }
};

class AuthSystem {
private:
    string filename;
public:
    AuthSystem(const string& fname)
        : filename(fname) {}

    void signup(const User& user) {
        ofstream fout(filename, ios::app);
        if (fout.is_open()) {
            fout << user.toLine() + "\n";
            fout.close();
        }
    }

    bool login(const string& name, const string& pass) {
        ifstream fin(filename);
        string line;
        
        if (fin.is_open()) {
            while(getline(fin, line)) {
            User user = User::fromLine(line);

            if (user.username == name && user.password == pass) {
                return true;
            }
        }

        fin.close();
        }
        return false;  
    }
};  

int main() {
    AuthSystem auth("users.txt");

    while (true) {
        cout << "1. Signup  2. Login  3. Quit" << endl;
        cout << "Choose: ";
        int choice;
        cin >> choice;
        string username, password;
        if (choice == 1) {
            cout << "Enter username: ";
            cin >> username;
            cout << "Enter password: ";
            cin >> password;
            auth.signup(User(username, password));
            cout << "Signup successful!" << endl;
        }
        else if (choice == 2) {
            cout << "Enter username: ";
            cin >> username;
            cout << "Enter password: ";
            cin >> password;
            if (auth.login(username, password))
                cout << "Welcome, " << username << endl;
            else
                cout << "Login failed." << endl;
        }
        else if (choice == 3) {
            cout << "Goodbye!" << endl;
            break;
        }
    }
}