#ifndef RESTAURANT_H
#define RESTAURANT_H

#include <iostream>
#include <string>
#include "menuItem.h"
using namespace std;

class Restaurant {
private:
    string restaurantName;
    string location;
    string ownerUsername;
    string ownerPassword;
    MenuItem menu[5];
    int menuSize;

public:
    Restaurant();

    Restaurant(string restaurantName, string location, string ownerUsername, string ownerPassword);

    void setRestaurantName(string restaurantName);
    void setLocation(string location);

    string getRestaurantName() const;
    string getLocation() const;

    void addMenuItem(MenuItem item);
    void displayRestaurant() const;
    void displayMenu() const;

    MenuItem getMenuItem(int index) const;
    int getMenuSize() const;

    bool login(string username, string password) const;
};

#endif