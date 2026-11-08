# asking the user to input their age
age = int(input("Enter your age: "))

# creating a list of daily sales
daily_sales = []

# determining the ticket price based on user's age
if age < 5:
    price = 0
elif 5 <= age <= 17:
    price = 5
elif 18 <= age <= 64:
    price = 10
else:
    price = 7

# adding the ticket price to the list of daily sales
daily_sales.append(price)

# printing the list of daily sales
print("The list of daily sales:", daily_sales)