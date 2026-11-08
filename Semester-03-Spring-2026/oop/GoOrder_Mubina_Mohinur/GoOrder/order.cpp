#include "order.h"

Order::Order() {
    orderId = 0;
    customerName = "";
    restaurantName = "";
    itemCount = 0;
    totalPrice = 0.0;
    status = "Pending";
    riderName = "";
}

Order::Order(int orderId, string customerName, string restaurantName) {
    this->orderId = orderId;
    this->customerName = customerName;
    this->restaurantName = restaurantName;
    itemCount = 0;
    totalPrice = 0.0;
    status = "Pending";
    riderName = "";
}

void Order::addItem(MenuItem item) {
    if (itemCount < 5) {
        orderedItems[itemCount] = item;
        itemCount++;
        calculateTotal();
    } else {
        cout << "Order item limit reached." << endl;
    }
}

void Order::calculateTotal() {
    totalPrice = 0.0;
     
    for (int i = 0; i < itemCount; i++) {
        totalPrice += orderedItems[i].getPrice();
    }
}

double Order::getTotalPrice() const {
    return totalPrice;
}

string Order::getStatus() const {
    return status;
}

int Order::getOrderId() const {
    return orderId;
}

string Order::getCustomerName() const {
    return customerName;
}

string Order::getRestaurantName() const {
    return restaurantName;
}

string Order::getRiderName() const {
    return riderName;
}

void Order::assignRider(string riderName) {
    this->riderName = riderName;
}

void Order::setStatus(string status) {
    this->status = status;
}

void Order::displayOrder() const {
    cout << "\n<<<<< ORDER DETAILS >>>>>" << endl;
    cout << "Order ID: " << orderId << endl;
    cout << "Customer: " << customerName << endl;
    cout << "Restaurant: " << restaurantName << endl;

    cout << "Items: " << endl;
    for (int i = 0; i < itemCount; i++) {
        cout << "- ";
        orderedItems[i].displayItem();
    }

    cout << "Total Price: " << totalPrice << " won" << endl;
    cout << "Status: " << status << endl;
    if (riderName == "") {
        cout << "Rider: Not assigned yet." << endl;
    } else {
        cout << "Rider: " << riderName << endl;
    }
} 