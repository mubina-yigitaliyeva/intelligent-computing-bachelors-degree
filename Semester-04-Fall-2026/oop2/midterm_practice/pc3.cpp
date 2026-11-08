#include <iostream>

using namespace std;

class ParkingLot {
    int capacity;
    int parked;

public:
    ParkingLot(int cap) : capacity(cap), parked(0) {}
    bool enter() {
        if (parked >= capacity) {
            return false;
        }
        parked++;
        return true;
    }

    bool leave() {
        if (parked == 0) {
            return false;
        }
        parked--;
        return true;
    }

    int freeSpots() {
        return capacity - parked;
    }
};

int main() {
    ParkingLot lot(2);
    for (int i = 0; i < 3; i++) {
        if (lot.enter()) cout << "Car parked" << endl;
        else cout << "Lot is full" << endl;
    }
    cout << "Free: " << lot.freeSpots() << endl;
    lot.leave();
    cout << "Free: " << lot.freeSpots() << endl;

    ParkingLot small(3);
    if (!small.leave()) cout << "No car to leave" << endl;
    return 0;
}