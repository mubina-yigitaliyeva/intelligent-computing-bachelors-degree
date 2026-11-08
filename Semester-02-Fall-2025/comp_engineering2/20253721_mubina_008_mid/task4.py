count = 0
while True:
    book_title = input("Enter book title (or 'done' to finish): ")
    if book_title.lower() == 'done':
        break 
    count += 1
    
print(f"Total books checked out: {count}")