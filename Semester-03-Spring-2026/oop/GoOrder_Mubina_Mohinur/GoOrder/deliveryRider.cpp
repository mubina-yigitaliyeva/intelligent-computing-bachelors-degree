#include "deliveryRider.h"

DeliveryRider::DeliveryRider() : User() {
    available = true;
    completedDeliveries = 0;
    earnings = 0.0;
}

DeliveryRider::DeliveryRider(string username, string password, string phoneNumber, string email,
                             bool available, int completedDeliveries, double earnings)
    : User(username, password, phoneNumber, email) {
    this->available = available;
    this->completedDeliveries = completedDeliveries;
    this->earnings = earnings;
}

void DeliveryRider::setAvailable(bool available) {
    this->available = available;
}

bool DeliveryRider::getAvailable() const {
    return available;
}

int DeliveryRider::getCompletedDeliveries() const {
    return completedDeliveries;
}

double DeliveryRider::getEarnings() const {
    return earnings;
}

void DeliveryRider::acceptOrder() {
    if (available) {
        available = false;
        cout << "Order accepted by delivery rider." << endl;
    } else {
        cout << "Delivery rider is currently not available." << endl;
    }
}

void DeliveryRider::completeDelivery(double deliveryFee) {
    available = true;
    completedDeliveries++;
    earnings += deliveryFee;

    cout << "Delivery completed successfully." << endl;
}

void DeliveryRider::displayDashboard() {
    cout << "\n===== Delivery Rider Dashboard =====" << endl;
    cout << "Welcome, " << username << "!" << endl;
    cout << "Phone: " << phoneNumber << endl;
    cout << "Email: " << email << endl;
    cout << "Completed Deliveries: " << completedDeliveries << endl;
    cout << "Earnings: " << earnings << " won" << endl;

    if (available) {
        cout << "Status: Available" << endl;
    } else {
        cout << "Status: Busy" << endl;
    }
}