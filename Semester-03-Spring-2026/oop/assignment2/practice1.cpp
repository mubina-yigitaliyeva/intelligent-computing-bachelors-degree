#include <iostream>

using namespace std;

class dayType {
private:
    string day;
    static const string days[7];

public:
    dayType() {
        day = "Sun";
    }

    dayType(string d) {
        setDay(d);
    }

    void setDay(string d) {
        for (int i = 0; i < 7; i++) {
            if (days[i] == d) {
                day = d;
                return;
            }
        }
        cout << "Invalid day! Setting to Sun." << endl;
        day = "Sun";
    }

    void printDay() const {
        cout << day << endl;
    }

    string getDay() const {
        return day;
    }

    int getIndex() const {
        for (int i = 0; i < 7; i++) {
            if (days[i] == day)
                return i;
        }
        return 0;
    }

    string nextDay() const {
        int index = getIndex();
        return days[(index + 1) % 7];
    }

    string prevDay() const {
        int index = getIndex();
        return days[(index - 1 + 7) % 7];
    }

    string addDays(int n) const {
        int index = getIndex();
        return days[(index + n) % 7];
    }
};

const string dayType::days[7] = {"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"};

int main() {
    dayType d1("Wed");

    cout << "Current day: ";
    d1.printDay();

    cout << "Next day: " << d1.nextDay() << endl;
    cout << "Previous day: " << d1.prevDay() << endl;

    cout << "After 9 days: " << d1.addDays(9) << endl;
    cout << "After 27 days: " << d1.addDays(27) << endl;

    return 0;
}