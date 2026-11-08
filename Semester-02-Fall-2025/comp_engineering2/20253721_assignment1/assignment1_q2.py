# asking the user to enter their age
age = int(input("Please input your age: "))

# identifying the user's age group and showing it to them
if age < 18 and age >= 0:
    print("You are a minor.")
elif age >= 18 and age < 65:
    print("You are an adult.")
elif age >= 65:
    print("You are a senior citizen.")
else: # handling the non-positive-number case
    print("Age can be only a positive number.")