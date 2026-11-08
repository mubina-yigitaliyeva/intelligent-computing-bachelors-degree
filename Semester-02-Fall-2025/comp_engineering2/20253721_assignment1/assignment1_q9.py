# creating a list of numbers
numbers = []

# asking the user to enter 5 numbers
num1 = int(input("Enter 1st number: "))
numbers.append(num1)

num2 = int(input("Enter 2nd number: "))
numbers.append(num2)

num3 = int(input("Enter 3rd number: "))
numbers.append(num3)

num4 = int(input("Enter 4th number: "))
numbers.append(num4)

num5 = int(input("Enter 5th number: "))
numbers.append(num5)

# printing the list of sorted numbers in ascending order
print("Ascending order: ", sorted(numbers))

# printing the list of sorted numbers in descending order
print("Descending order: ", sorted(numbers, reverse=True))

# trying out the out of range list index error
index = 15
if index < len(numbers): # checking if the index given is within the length of the list
    print(f"Element at index {index} is {numbers[index]}")
else: # index is out of range
    print(f"Error: Index at {index} is out of range. The list has {len(numbers)} elements.")