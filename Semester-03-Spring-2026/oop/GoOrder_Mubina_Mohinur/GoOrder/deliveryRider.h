#ifndef DELIVERYRIDER_H
#define DELIVERYRIDER_H

#include "user.h"

class DeliveryRider : public User {
private:
    bool available;
    int completedDeliveries;
    double earnings;

public:
    DeliveryRider();

    DeliveryRider(string username, string password, string phoneNumber, string email,
                  bool available, int completedDeliveries, double earnings);

    void setAvailable(bool available);
    bool getAvailable() const;

    int getCompletedDeliveries() const;
    double getEarnings() const;

    void acceptOrder();
    void completeDelivery(double deliveryFee);

    void displayDashboard();
};

#endif