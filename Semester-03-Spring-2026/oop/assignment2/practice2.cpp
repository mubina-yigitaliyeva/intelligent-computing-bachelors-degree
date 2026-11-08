#include <iostream>

using namespace std;

class boxType {
private:
    float length;
    float width;
    float height;
public:
    void setBox(float l, float w, float h) {
        length = l;
        width = w;
        height = h;
    }

    void printBox() {
        cout << "Length: " << length << "\n";
        cout << "Width: " << width << "\n";
        cout << "Height: " << height << "\n";
    }
    
    float calcVolume() {
        return length * width * height;
    }
};

int main() {

    boxType box1, box2;
    box1.setBox(2, 5, 10);
    box2.setBox(10, 10, 5);

    cout << "The volume of two boxes: " <<  box1.calcVolume() + box2.calcVolume();

    return 0;
}