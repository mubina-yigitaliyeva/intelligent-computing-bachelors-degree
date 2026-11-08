#include "paymentSystem.h"

PaymentSystem::PaymentSystem(double deliveryFee) {
    this->deliveryFee = deliveryFee;
}

void PaymentSystem::setDeliveryFee(double deliveryFee) {
    this->deliveryFee = deliveryFee;
}

double PaymentSystem::getDeliveryFee() const {
    return deliveryFee;
}

double PaymentSystem::calculateFinalAmount(double orderPrice) const {
    return orderPrice + deliveryFee;
}

bool PaymentSystem::processPayment(Customer &customer, double orderPrice) {
    double finalAmount = calculateFinalAmount(orderPrice);

    cout << "\n<<<<<PAYMENT INFORMATION>>>>>" << endl;
    cout << "Food Price: " << orderPrice << " won" << endl;
    cout << "Delivery Fee: " << deliveryFee << " won" << endl;
    cout << "Final Amount " << finalAmount << " won" << endl;

    if (customer.pay(finalAmount)) {
        cout << "Payment successful." << endl;
        cout << "Remaining Balance: " << customer.getBalance() << " won" << endl;
        return true;
    } else {
        cout << "Payment failed. Not enough balance." << endl;
        return false;
    }
}