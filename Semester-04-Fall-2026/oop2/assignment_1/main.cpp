#include <iostream>

using namespace std;

class Book {
private:
    int id;
    string title;
    string author;
    int year;
public:
    // Default constructor -----------------
    Book() {
        id = 0;
        title = "";
        author = "";
        year = 0;
    }

    // Constructor sets the value -----------------
    Book(int i, string t, string a, int y) : id(i), title(t), author(a), year(y) {}

    // Getters -----------------
    int getId() const {
        return id;
    }

    string getTitle() const {
        return title;
    }

    string getAuthor() const {
        return author;
    }

    int getYear() const {
        return year;
    }

    // Setter -----------------
    void setId(int i) {
        id = i;
    }

    void setTitle(string t) {
        title = t;
    }

    void setAuthor(string a) {
        author = a;
    }

    void setYear(int y) {
        year = y;
    }

    // Display -----------------
    void show() const {
        cout << "Book id: " << id << endl;
        cout << "Book title: " << title << endl;
        cout << "Book author: " << author << endl;
        cout << "Book year: " << year << endl;
        cout << "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" << endl;
    }
};

class Library {
private:
    static const int CAP = 100;
    Book books[CAP];
    int count;
    int nextId;

public:
    Library() {
        count = 0;
        nextId = 1;
    }

    // Adding a book -----------------
    void addBook() {
        if (count >= CAP) {
            cout << "Library is full." << endl;
            return;
        }

        string title;
        string author;
        int year;

        cout << "\nEnter a title: ";
        cin >> title;
        cout << "\nEnter an author: ";
        cin >> author;
        cout << "\nEnter a year: ";
        cin >> year;

        books[count] = Book(nextId, title, author, year);

        cout << "\nBook was added successfully." << endl;
        cout << "Book Id: " << nextId << endl;

        count++;
        nextId++;
    }

    // Listing books -----------------
    void listBooks() const {
        if (count == 0) {
            cout << "No books in the library." << endl;
            return;
        }

        cout << "\n~~~~~~~~~~~BOOK LIST~~~~~~~~~~~" << endl;

        for (int i = 0; i < count; i++) {
            books[i].show();
        }
    }

    // Finding a book by id -----------------
    Book* findById(int id) {
        for (int i = 0; i < count; i++) {
            if (books[i].getId() == id) {
                return &books[i];
            }
        }

        return nullptr;
    }

    // Searching a book -----------------
    void searchBook() {
        int id;

        cout << "Enter book ID: ";
        cin >> id; 

        Book* book = findById(id);

        if (book != nullptr) {
            cout << "\nBook found:" << endl;
            book->show();
        } else {
            cout << "\nBook not found." << endl;
        }
    }

    // Updating the book -----------------
    void updateBook() {
        int id;

        cout << "Enter book ID to update: ";
        cin >> id;

        Book* book = findById(id);

        if (book == nullptr) {
            cout << "Book not found." << endl;
            return;
        }

        string title;
        string author;
        int year;

        cout << "\nEnter new title: ";
        cin >> title;
        cout << "\nEnter new author: ";
        cin >> author;
        cout << "\nEnter new year: ";
        cin >> year;

        book->setTitle(title);
        book->setAuthor(author);
        book->setYear(year);

        cout << "\nBook was updated successfully." << endl;
    }

    //Delete a book -----------------
    void deleteBook() {
        int id;

        cout << "Enter book ID to delete: ";
        cin >> id;

        int index = -1;
        for (int i = 0; i < count; i++) {
            if (books[i].getId() == id) {
                index = i;
                break;
            }
        }

        if (index == -1) {
            cout << "Book not found." << endl;
            return;
        }


        for (int i = index; i < count - 1; i++) {
            books[i] = books[i + 1];
        }

        count--;

        cout << "\nBook was deleted successfully." << endl;
    }

};

int main() {

    Library library;

    int choice;

    do {

        cout << "\n~~~~~~~~~~~~~~~~~~BOOK MANAGEMENT SYSTEM~~~~~~~~~~~~~~~~~~" << endl;

        cout << "1. Add a book" << endl;
        cout << "2. List books" << endl;
        cout << "3. Search a book" << endl;
        cout << "4. Update a book" << endl;
        cout << "5. Delete a book" << endl;
        cout << "6. Exit" << endl;
        
        cout << "Choose an option: ";
        cin >> choice;

        cout << endl;

        switch (choice) {
            case 1:
                library.addBook();
                break;
            case 2:
                library.listBooks();
                break;
            case 3:
                library.searchBook();
                break;
            case 4:
                library.updateBook();
                break;
            case 5:
                library.deleteBook();
                break;
            case 6:
                cout << "Program ended." << endl;
                break;
            default:
                cout << "Invalid option. Choose between 1-6." << endl;
        }
    } while (choice != 6);

    return 0;
}