#include <iostream>

using namespace std;

class Duration {
    int minutes;
public:
    Duration(int min) : minutes(min) {}

    Duration operator- (const Duration& other) const {
        return Duration(minutes - other.minutes);
    }

    bool operator< (const Duration& other) const {
        return minutes < other.minutes;
    }

    friend ostream& operator<< (ostream& out, const Duration& d) {
        out << d.minutes / 60 << "h "
            << d.minutes % 60 << "m";

        return out;
    }
    
};

int main() {
    Duration movie(130), episode(45);
    Duration gap = movie - episode;
    cout << movie << endl;
    cout << gap << endl;
    if (episode < movie) cout << "episode is shorter" << endl;
    if (movie < episode) cout << "movie is shorter" << endl;
    return 0;
}