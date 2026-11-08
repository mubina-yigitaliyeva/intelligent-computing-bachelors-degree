#include <iostream>

using namespace std;

int main() {

	// int x = 15;

	// // cout << "\n value x = " << x;
	// // cout << "\n the address x = " << &x;

	// // cout << "\n value at address << &x>>" << "is = " << *(&x) << endl;

	// int & y = x;
	// int * z = &x;
	// cout << "\n value x = " << x;
	// cout << "\n value y = " << y;
	// cout << "\n value z = " << z;

// 	int x, y;
// 	cin >> x;
// 	cin >> y;

// 	int * px = &y;
// 	int * py = &x;

// 	cout << *px << " " << *py << endl;
// 	cout << x << " " << y << endl;

    // int val = 10;
    // int *p, **k;
    // p=&val;
    // k = &p;
    
    // cout << "\n" << p << " " << *p << " " << *k << " " << **k << endl;
    
    char ch;
    char *p;
    
    ch = 'A';
    p =& ch;
    
    cout << "\n" << ch << " " << (*p)++ << endl;

	return 0;
}