#include "restaurant.h"

Restaurant::Restaurant() {
    restaurantName = "";
    location = "";
    menuSize = 0;
    ownerUsername = "";
    ownerPassword = "";
}

Restaurant::Restaurant(string restaurantName, string location, string ownerUsername, string ownerPassword) {
    this->restaurantName = restaurantName;
    this->location = location;
    this->ownerUsername = ownerUsername;
    this->ownerPassword = ownerPassword;
    menuSize = 0;
}

void Restaurant::setRestaurantName(string restaurantName) {
    this->restaurantName = restaurantName;
}

void Restaurant::setLocation(string location) {
    this->location = location;
}

string Restaurant::getRestaurantName() const {
    return restaurantName;
}

string Restaurant::getLocation() const {
    return location;
}

void Restaurant::addMenuItem(MenuItem item) {
    if (menuSize < 5) {
        menu[menuSize] = item;
        menuSize++;
    } else {
        cout << "Menu is full. Cannot add more items." << endl;
    }
}

void Restaurant::displayRestaurant() const {
    cout << restaurantName << " - " << location << endl;
}

void Restaurant::displayMenu() const {
    cout << "\n<<<=====>>> " << restaurantName << " Menu <<<=====>>>" << endl;

    for (int i = 0; i < menuSize; i++) {
        cout << i + 1 << ". ";
        menu[i].displayItem();
    }
}

MenuItem Restaurant::getMenuItem(int index) const {
    if (index >= 0 && index < menuSize) {
        return menu[index];
    }

    return MenuItem();
}

int Restaurant::getMenuSize() const {
    return menuSize;
}

bool Restaurant::login(string username, string password) const {
    return ownerUsername == username && ownerPassword == password;
}