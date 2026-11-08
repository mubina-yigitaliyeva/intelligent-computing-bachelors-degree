def format_title(book_t):
    return book_t.title()

book_titles = ["python Programming basics", "THE GREAT GATSBY", 'Alice IN WONDERLAND']

for i in book_titles:
    print("Original:", i)
    print("Formatted:", format_title(i))