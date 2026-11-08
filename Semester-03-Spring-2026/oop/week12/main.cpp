#include <iostream> 

using namespace std;

class Matrix {
    private:
        int rows, cols;
        int **data; // pointer to pointer
    public:
        // Constructor to initialize matrix given rows and columns
        Matrix(int r, int c) {
            rows = r;
            cols = c;

            // Dynamically allocate memory for 2D array
            data = new int*[rows];
            for (int i = 0; i < rows; i++) {
                data[i] = new int[cols];
            }
        }

        void inputMatrix() {
                cout << "Enter the elements of the Matrix (" << rows << "x" << cols << "):\n";
                for (int i = 0; i < rows; i++) {
                    for (int j = 0; j < cols; j++) {
                        cin >> data[i][j];
                    }
                }
        }

        void displayMatrix() const {
            for (int i = 0; i < rows; i++) {
                for (int j = 0; j < cols; j++) {
                    cout << data[i][j] << " ";
                }

                cout << endl;
            }
        }

        Matrix operator*(const Matrix & other) {
            if (cols != other.rows) {
                cout << "Matrix multiplication is not possible with these dimensions" << endl;

                exit(1);
            }

            Matrix result(rows, other.cols);

            for (int i = 0; i < rows; i++) {
                for (int j = 0; j < other.cols; j++) {
                    result.data[i][j] = 0;
                    for (int k = 0; k < cols; k++) {
                        result.data[i][j] += data[i][k] * other.data[k][j];
                    }
                }
            }

            return result;
        }

        Matrix() {
            for (int i = 0; i < rows; i++) {
                delete[] data[i];
            }

            delete[] data;
        }
};

int main() {

    int r1, c1, r2, c2;

    cout << "Enter the number of rows and columns for the first matrix: ";
    cin >> r1 >> c1;

    cout << "Enter the number of rows and columns for the second matrix: ";
    cin >> r2 >> c2;

    Matrix matrix1(r1, c1);
    Matrix matrix2(r2, c2);

    matrix1.inputMatrix();
    matrix2.inputMatrix();

    Matrix result = matrix1 * matrix2;

    cout << "Resultant matrix after multiplication:\n";

    result.displayMatrix();

    return 0;
}