#include "user.h"

// Default constructor
User::User() {
    username = "";
    password = "";
    phoneNumber = "";
    email = "";
}

// Constructor with parameters
User::User(string username, string password, string phoneNumber, string email) {
    this->username = username;
    this->password = password;
    this->phoneNumber = phoneNumber;
    this->email = email;
}

// Setters
void User::setUsername(string username) {
    this->username = username;
}

void User::setPassword(string password) {
    this->password = password;
}

void User::setPhoneNumber(string phoneNumber) {
    this->phoneNumber = phoneNumber;
}

void User::setEmail(string email) {
    this->email = email;
}

// Getters
string User::getUsername() const {
    return username;
}

string User::getPassword() const {
    return password;
}

string User::getPhoneNumber() const {
    return phoneNumber;
}

string User::getEmail() const {
    return email;
}

// Login function
bool User::login(string inputUsername, string inputPassword) const {
    return username == inputUsername && password == inputPassword;
}