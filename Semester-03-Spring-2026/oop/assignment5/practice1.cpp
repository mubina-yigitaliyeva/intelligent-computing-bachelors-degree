#include <iostream> 
#include <vector>

using namespace std;

int main() {

    // printing MxN matrix
    int m, n, num;
    cout << "Enter the number of columns: ";
    cin >> m;
    cout << "Enter the number of rows: ";
    cin >> n;
    
    vector<vector<int> > mat(m, vector<int>(n));

    for (int i = 0; i < m; i++) {
        for (int k = 0; k < n; k++) {
            cout << "Enter the element[" << i + 1 << "][" << k + 1 << "]: "; 
            cin >> num;
            mat[i][k] = num;
        }
    }

    cout << "\nMatrix:\n";

    for (int i = 0; i < m; i++) {
        for (int k = 0; k < n; k++) {
            cout << mat[i][k] << " ";
        }
        cout << endl;
    }

    return 0;
}