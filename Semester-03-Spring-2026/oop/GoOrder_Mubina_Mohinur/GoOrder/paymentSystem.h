#ifndef PAYMENTSYSTEM_H
#define PAYMENTSYSTEM_H

#include <iostream>
#include "customer.h"

using namespace std;

class PaymentSystem {
private:
    double deliveryFee;

public:

    PaymentSystem(double deliveryFee);

    void setDeliveryFee(double deliveryFee);
    double getDeliveryFee() const;

    double calculateFinalAmount(double orderPrice) const;

    bool processPayment(Customer &customer, double orderPrice);
};

#endif