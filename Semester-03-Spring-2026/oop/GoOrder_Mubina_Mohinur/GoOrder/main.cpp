#include <iostream>
#include "customer.h"
#include "deliveryRider.h"
#include "restaurant.h"
#include "menuItem.h"
#include "order.h"
#include "paymentSystem.h"

using namespace std;

// Status 
const string STATUS_PENDING = "Pending";
const string STATUS_ACCEPTED = "Accepted";
const string STATUS_PREPARING = "Preparing Food";
const string STATUS_READY = "Ready for Pickup";
const string STATUS_DELIVERING = "Out for Delivery";
const string STATUS_DELIVERED = "Delivered";
const string STATUS_CANCELLED = "Cancelled";

// Login Credentials
const string RIDER_USERNAME = "rider1";
const string RIDER_PASSWORD = "1111";
const string ADMIN_PASSWORD = "1111";
const int DELIVERY_FEE = 3000;

// update order status function for restaurant owners
void updateOrderStatus(Order orders[], int orderCount, string resName) {
    if (orderCount == 0) {
        cout << "No orders available." << endl;
        return;
    }

    int orderId, statusChoice;
    cout << "\n<<<=====>>> Update Order Status <<<=====>>>" << endl;

    int index = -1;


    for (int i = 0; i < orderCount; i++) {
        if (orders[i].getRestaurantName() == resName) {
            orders[i].displayOrder();
            index = i;
        }
    }

    if (index == -1) {
        cout << "Order not found." << endl;
        return;
    }

    cout << "\nEnter Order ID: ";
    cin >> orderId;

    for (int i = 0; i < orderCount; i++) {
        if (orders[i].getOrderId() == orderId) {
            index = i;
            break;
        }
    }

    if (index == -1) {
        cout << "Order not found." << endl;
        return;
    }

    cout << "\nChoose new status:" << endl;
    cout << "1. Pending" << endl;
    cout << "2. Accepted" << endl;
    cout << "3. Preparing Food" << endl;
    cout << "4. Ready for Pickup" << endl;
    cout << "5. Cancelled" << endl;
    cout << "Choice: ";
    cin >> statusChoice;

    switch (statusChoice) {
        case 1: orders[index].setStatus(STATUS_PENDING); break;
        case 2: orders[index].setStatus(STATUS_ACCEPTED); break;
        case 3: orders[index].setStatus(STATUS_PREPARING); break;
        case 4: orders[index].setStatus(STATUS_READY); break;
        case 5: orders[index].setStatus(STATUS_CANCELLED); break;
        default:
            cout << "Invalid choice." << endl;
            return;
    }

    cout << "Order status updated successfully!" << endl;
}

// update order status function for riders
void riderUpdateOrderStatus(Order orders[], int orderCount, string riderName) {
    if (orderCount == 0) {
        cout << "No orders available." << endl;
        return;
    }

    int orderId, statusChoice;
    int index = -1;

    cout << "\n===== My Accepted Orders =====" << endl;

    for (int i = 0; i < orderCount; i++) {
        if (orders[i].getRiderName() == riderName) {
            orders[i].displayOrder();
        }
    }

    cout << "\nEnter Order ID to update: ";
    cin >> orderId;

    for (int i = 0; i < orderCount; i++) {
        if (orders[i].getOrderId() == orderId &&
            orders[i].getRiderName() == riderName) {
            index = i;
            break;
        }
    }

    if (index == -1) {
        cout << "You can update only your accepted orders." << endl;
        return;
    }

    cout << "\nChoose new status:" << endl;
    cout << "1. Out for Delivery" << endl;
    cout << "2. Delivered" << endl;
    cout << "Choice: ";
    cin >> statusChoice;

    switch (statusChoice) {
        case 1:
            orders[index].setStatus(STATUS_DELIVERING);
            break;
        case 2:
            orders[index].setStatus(STATUS_DELIVERED);
            break;
        default:
            cout << "Invalid choice." << endl;
            return;
    }

    cout << "Order status updated successfully!" << endl;
}

int main() {
    Customer customers[10];
    int customerCount = 0;

    DeliveryRider riders[5] = {
        DeliveryRider(RIDER_USERNAME, RIDER_PASSWORD, "010-1111-2222", "rider1@gmail.com", true, 0, 0)};
    int riderCount = 1;

    Restaurant restaurants[3] = {
        Restaurant("Busan Chicken", "Seomyeon", "chicken", "1111"),
        Restaurant("Pizza House", "Nampo", "pizza", "1111"),
        Restaurant("Kimbap Heaven", "Hadan", "kimbap", "1111")
    };

    restaurants[0].addMenuItem(MenuItem("Fried Chicken", 18000));
    restaurants[0].addMenuItem(MenuItem("Tteokbokki", 7000));
    restaurants[0].addMenuItem(MenuItem("Cola", 2000));

    restaurants[1].addMenuItem(MenuItem("Pepperoni Pizza", 22000));
    restaurants[1].addMenuItem(MenuItem("Cheese Pizza", 19000));
    restaurants[1].addMenuItem(MenuItem("Garlic Bread", 5000));

    restaurants[2].addMenuItem(MenuItem("Kimbap", 4000));
    restaurants[2].addMenuItem(MenuItem("Ramyeon", 5000));
    restaurants[2].addMenuItem(MenuItem("Bibimbap", 8000));

    Order orders[30];
    int orderCount = 0;
    int nextOrderId = 1;

    int mainChoice;

    do {
        cout << "\n<<<=====>>> GoOrder Main Menu <<<=====>>>" << endl;
        cout << "1. Register as Customer" << endl;
        cout << "2. Login as Customer" << endl;
        cout << "3. Login as Restaurant" << endl;
        cout << "4. Login as Delivery Rider" << endl;
        cout << "5. Login as Admin" << endl;
        cout << "0. Exit" << endl;
        cout << "Choice: ";
        cin >> mainChoice;

        if (mainChoice == 1) {
            string username, password, phone, email, address;
            double balance;

            cout << "\n<<<=====>>> Customer Registration <<<=====>>>" << endl;
            cout << "Username: ";
            cin >> username;
            cout << "Password: ";
            cin >> password;
            cout << "Phone number: ";
            cin >> phone;
            cout << "Email: ";
            cin >> email;
            cout << "Address: ";
            cin >> address;
            cout << "Card balance: ";
            cin >> balance;

            customers[customerCount] = Customer(username, password, phone, email, balance, address);
            customerCount++;

            cout << "Registration successful!" << endl;
        }

        else if (mainChoice == 2) {
            string username, password;
            cout << "\n===== Customer Login ======" << endl;
            cout << "Username: ";
            cin >> username;
            cout << "Password: ";
            cin >> password;

            int customerIndex = -1;

            for (int i = 0; i < customerCount; i++) {
                if (customers[i].login(username, password)) {
                    customerIndex = i;
                    break;
                }
            }

            if (customerIndex == -1) {
                cout << "Login failed." << endl;
                continue;
            }

            int customerChoice;
            do {
                cout << "\n<<<=====>>> Customer Menu <<<=====>>>" << endl;
                cout << "1. View Profile" << endl;
                cout << "2. View Restaurants" << endl;
                cout << "3. Order Food" << endl;
                cout << "4. View My Orders" << endl;
                cout << "5. Check Balance" << endl;
                cout << "0. Logout" << endl;
                cout << "Choice: ";
                cin >> customerChoice;

                if (customerChoice == 1) {
                    customers[customerIndex].displayDashboard();
                } 
                else if (customerChoice == 2) {
                    cout << "\n<<<=====>>> Restaurants <<<=====>>>" << endl;
                    for (int i = 0; i < 3; i++) {
                        cout << i + 1 << ". ";
                        restaurants[i].displayRestaurant();
                    }
                }
                else if (customerChoice == 3) {
                    int restaurantChoice;

                    cout << "\n<<<=====>>> Choose Restaurant <<<=====>>>" << endl;
                    for (int i = 0; i < 3; i++) {
                        cout << i + 1 << ". ";
                        restaurants[i].displayRestaurant();
                    }

                    cout << "Choice: ";
                    cin >> restaurantChoice;

                    if (restaurantChoice < 1 || restaurantChoice > 3) {
                        cout << "Invalid restaurant." << endl;
                        continue;
                    }

                    Restaurant selectedRestaurant = restaurants[restaurantChoice - 1];
                    selectedRestaurant.displayMenu();

                    Order newOrder(nextOrderId, customers[customerIndex].getUsername(), selectedRestaurant.getRestaurantName());

                    int foodChoice;

                    do {
                        cout << "\nChoose food item number, 0 to finish: ";
                        cin >> foodChoice;

                        if (foodChoice == 0) {
                            break;
                        }

                        if (foodChoice >= 1 && foodChoice <= selectedRestaurant.getMenuSize()) {
                            newOrder.addItem(selectedRestaurant.getMenuItem(foodChoice - 1));
                            cout << "Item added." << endl;
                        } else {
                            cout << "Invalid item." << endl;
                        }

                    } while (foodChoice != 0);

                    if (newOrder.getTotalPrice() == 0) {
                        cout << "No item selected. Order cancelled." << endl;
                        continue;
                    }

                    PaymentSystem paymentsystem(DELIVERY_FEE);

                    if (paymentsystem.processPayment(customers[customerIndex], newOrder.getTotalPrice())) {
                        newOrder.setStatus("Pending");
                        orders[orderCount] = newOrder;
                        orderCount++;
                        nextOrderId++;
                        
                        cout << "Order placed successfully!" << endl;
                    } else {
                        cout << "Order cancelled because payment failed." << endl;
                    }
                }

                else if (customerChoice == 4) {
                    cout << "\n<<<=====>>> My Orders <<<=====>>>" << endl;
                    bool found = false;

                    for (int i = 0; i < orderCount; i++) {
                        if (orders[i].getCustomerName() == customers[customerIndex].getUsername()){
                            orders[i].displayOrder();
                            found = true;
                        }
                    }

                    if (!found) {
                        cout << "You have no orders yet." << endl;
                    }
                }

                else if (customerChoice == 5) {
                    cout << "Current Balance: "
                         << customers[customerIndex].getBalance()
                         << " won" << endl;
                }
            } while (customerChoice != 0);
        }

        else if (mainChoice == 3) {
                
            cout << "\n===== Restaurant Login =====" << endl;
            string username, password;

            cout << "Username: ";
            cin >> username;
            cout << "Password: ";
            cin >> password;

            int restaurantIndex = -1;
            string resName = "";

            for (int i = 0; i < 3; i++) {
                if (restaurants[i].login(username, password)) {
                    restaurantIndex = i;
                    resName = restaurants[restaurantIndex].getRestaurantName();
                    break;
                }
            }

            if (restaurantIndex == -1) {
                cout << "Restaurant login failed." << endl;
                continue;
            }

            int restaurantChoice;

            do {
                cout << "\n<<<=====>>> Restaurant Menu <<<=====>>>" << endl;
                cout << "1. View All Orders" << endl;
                cout << "2. Update Order Status" << endl;
                cout << "3. View Restaurant Menus" << endl;
                cout << "0. Logout" << endl;
                cout << "Choice: ";
                cin >> restaurantChoice;

                if (restaurantChoice == 1) {
                    bool found = false;

                    for (int i = 0; i < orderCount; i++) {
                        if (orders[i].getRestaurantName() == restaurants[restaurantIndex].getRestaurantName()) {
                            orders[i].displayOrder();
                            found = true;
                        }
                    }

                    if (!found) {
                        cout << "No orders for your restaurant yet." << endl;
                    }
                }
                
                else if (restaurantChoice == 2) {
                    updateOrderStatus(orders, orderCount, resName);
                }

                else if (restaurantChoice == 3) {
                    restaurants[restaurantIndex].displayRestaurant();
                    restaurants[restaurantIndex].displayMenu();
                }
            } while (restaurantChoice != 0);
        }

        else if (mainChoice == 4) {
            string username, password;

            cout << "\n<<<=====>>> Rider Login <<<=====>>>" << endl;
            cout << "Username: ";
            cin >> username;
            cout << "Password: ";
            cin >> password;

            int riderIndex = -1;

            for (int i = 0; i < riderCount; i++) {
                if (riders[i].login(username, password)) {
                    riderIndex = i;
                    break;
                }
            }

            if (riderIndex == -1) {
                cout << "Rider login failed." << endl;
                continue;
            }

            int riderChoice;

            do {
                cout << "\n<<<=====>>> Rider Menu <<<=====>>>" << endl;
                cout << "1. View Rider Profile" << endl;
                cout << "2. View Available Orders" << endl;
                cout << "3. Accept Order" << endl;
                cout << "4. View My Accepted Orders" << endl;
                cout << "5. Update My Order Status" << endl;
                cout << "6. Complete Delivery and Earn Fee" << endl;
                cout << "0. Logout" << endl;
                cout << "Choice: ";
                cin >> riderChoice;

                if (riderChoice == 1) {
                    riders[riderIndex].displayDashboard();
                }

                else if (riderChoice == 2) {
                    cout << "\n===== Available Orders =====" << endl;
                    bool found = false;

                    for (int i = 0; i < orderCount; i++) {
                        if (orders[i].getRiderName() == "" &&
                            orders[i].getStatus() != STATUS_DELIVERED &&
                            orders[i].getStatus() != STATUS_CANCELLED) {
                            orders[i].displayOrder();
                            found = true;
                        }
                    }

                    if (!found) {
                        cout << "No available orders." << endl;
                    }
                }

                else if (riderChoice == 3) {

                    if (!riders[riderIndex].getAvailable()) {
                        cout << "You already have an active order. Complete it first." << endl;
                        continue;
                    }

                    int orderId;
                    cout << "Enter Order ID to accept: ";
                    cin >> orderId;

                    bool found = false;

                    for (int i = 0; i < orderCount; i++) {
                        if (orders[i].getOrderId() == orderId &&
                            orders[i].getRiderName() == "") {

                            orders[i].assignRider(riders[riderIndex].getUsername());
                            orders[i].setStatus(STATUS_ACCEPTED);
                            riders[riderIndex].acceptOrder();

                            cout << "Order accepted successfully!" << endl;
                            found = true;
                            break;
                        }
                    }

                    if (!found) {
                        cout << "Order not found or already accepted by another rider." << endl;
                    }
                }

                else if (riderChoice == 4) {
                    cout << "\n<<<<< My Accepted Orders >>>>>" << endl;
                    bool found = false;

                    for (int i = 0; i < orderCount; i++) {
                        if (orders[i].getRiderName() == riders[riderIndex].getUsername()) {
                            orders[i].displayOrder();
                            found = true;
                        }
                    }

                    if (!found) {
                        cout << "You have no accepted orders." << endl;
                    }
                }

                else if (riderChoice == 5) {
                    riderUpdateOrderStatus(orders, orderCount, riders[riderIndex].getUsername());
                }

                else if (riderChoice == 6) {
                    int orderId;
                    cout << "Enter delivered Order ID: ";
                    cin >> orderId;

                    bool found = false;

                    for (int i = 0; i < orderCount; i++) {
                        if (orders[i].getOrderId() == orderId &&
                            orders[i].getRiderName() == riders[riderIndex].getUsername()) {

                            orders[i].setStatus(STATUS_DELIVERED);
                            riders[riderIndex].completeDelivery(DELIVERY_FEE);
                            found = true;
                            break;
                        }
                    }

                    if (!found) {
                        cout << "Order not found or this order is not assigned to you." << endl;
                    }
                }
        } while (riderChoice != 0);
    }

        else if (mainChoice == 5) {
        string password;

        cout << "\n<<<=====>>> Admin Login <<<=====>>>" << endl;
        cout << "Enter admin password: ";
        cin >> password;

        if (password != ADMIN_PASSWORD) {
            cout << "Wrong password." << endl;
            continue;
        }

        int adminChoice;

        do {
                cout << "\n<<<=====>>> Admin Menu <<<=====>>>" << endl;
                cout << "1. View All Customers" << endl;
                cout << "2. View All Orders" << endl;
                cout << "3. View All Restaurants" << endl;
                cout << "0. Logout" << endl;
                cout << "Choice: ";
                cin >> adminChoice;

                if (adminChoice == 1) {
                    if (customerCount == 0) {
                        cout << "No customers registered." << endl;
                    } else {
                        for (int i = 0; i < customerCount; i++) {
                            customers[i].displayDashboard();
                        }
                    }
                }

                else if (adminChoice == 2) {
                    if (orderCount == 0) {
                        cout << "No orders available." << endl;
                    } else {
                        for (int i = 0; i < orderCount; i++) {
                            orders[i].displayOrder();
                        }
                    }
                }

                else if (adminChoice == 3) {
                    for (int i = 0; i < 3; i++) {
                        restaurants[i].displayRestaurant();
                    }
                }

            } while (adminChoice != 0);
        }

    } while (mainChoice != 0);

    cout << "\nThank you for using GoOrder!" << endl;

    return 0;
}