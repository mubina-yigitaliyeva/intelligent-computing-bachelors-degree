#ifndef ORDER_H
#define ORDER_H

#include <iostream>
#include <string>
#include "menuItem.h"
using namespace std;

class Order {
private:
    int orderId;
    string customerName;
    string restaurantName;
    MenuItem orderedItems[5];
    int itemCount;
    double totalPrice;
    string status;
    string riderName;

public:
    Order();

    Order(int orderId, string customerName, string restaurantName);

    void addItem(MenuItem item);
    void calculateTotal();

    double getTotalPrice() const;
    string getStatus() const;
    int getOrderId() const;
    string getCustomerName() const;
    string getRestaurantName() const;
    string getRiderName() const;

    void setStatus(string status);

    void displayOrder() const;

    void assignRider(string riderName);
};

#endif