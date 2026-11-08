#include <iostream>

using namespace std;

class Base {
    public: int pub = 4;
    protected: int prot = 5;
    private: int priv = 6;
};

class PublicDerived : public Base {
    void show() {
        cout << pub << prot << endl;
    }
};

class ProtectedDerived : protected Base {
    void show() {
        cout << pub << prot << endl;
    }
};

class PrivateDerived : private Base {
    void show() {
        cout << pub << prot << endl;
    }
};

int main() {

    Base b;
    cout << b.pub << endl;
    // cout << b.prot << endl; // error
    // cout << b.priv << endl; // error

    PublicDerived publicDrived;
    cout << publicDrived.pub << endl;
    
    ProtectedDerived protectedDrived;
    // cout << protectedDrived.pub << endl; 
    // member "Base::pub" is inaccessible

    PrivateDerived privateDrived;
    // cout << privateDrived.pub << endl; 
    // member "Base::pub" is inaccessible

    return 0;
}