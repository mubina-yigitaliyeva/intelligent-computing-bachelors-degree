#include <iostream>

using namespace std;

class A {
    public:
        void show() {
            cout << "This is class A." << endl;
        }
};

class B : virtual public A {
    
};

class C : virtual public A {
    
};

class D : public B, public C {};

int main() {
    D d;
    d.show(); // "D::show is ambiguous"

    return 0;
}
