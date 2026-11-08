#ifndef MENUITEM_H
#define MENUITEM_H

#include <iostream>
#include <string>
using namespace std;

class MenuItem {
private:
    string itemName;
    double price;

public:
    MenuItem();
    
    MenuItem(string itemName, double price);

    void setItemName(string itemName);
    void setPrice(double price);

    string getItemName() const;
    double getPrice() const;

    void displayItem() const;
};

#endif