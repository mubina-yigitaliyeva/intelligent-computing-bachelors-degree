#include "menuItem.h"

MenuItem::MenuItem() {
    itemName = "";
    price = 0.0;
}

MenuItem::MenuItem(string itemName, double price) {
    this->itemName = itemName;
    this->price = price;
}

void MenuItem::setItemName(string itemName) {
    this->itemName = itemName;
}

void MenuItem::setPrice(double price) {
    this->price = price;
}

string MenuItem::getItemName() const {
    return itemName;
}

double MenuItem::getPrice() const {
    return price;
}

void MenuItem::displayItem() const {
    cout << itemName << " - " << price << " won" << endl;
}