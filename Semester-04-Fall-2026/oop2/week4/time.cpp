#include <iostream>
using namespace std;

class Time{
    public:
        const int tz = 8;

        Time(int t) : tz(t) {}
};

int main() {
    Time t(3);
    
    return 0;
}