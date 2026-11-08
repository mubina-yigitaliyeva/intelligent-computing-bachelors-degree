days = int(input("Enter days since checkout: "))

if 0 <= days <= 14:
    print("Status: On time.")
elif 15 <= days <= 30:
    print("Overdue - Please return soon.")
elif days >= 31:
    print("Critical.")
else:
    print("Please enter only positive number.")
    