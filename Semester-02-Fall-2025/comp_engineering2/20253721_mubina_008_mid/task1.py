def book_info(title, author, year):
    return f"{title} by {author} ({year})"

book_title = input("Please enter book title: ").title()
book_author = input("Please enter book author: ").title()
book_year = input("Please enter book year: ")

print(book_info(book_title, book_author, book_year))