# creating a list of 5 predefined numbers
numbers = [12, 7, 25, 3, 18]

# creating a list of select values
selected_values = []

# checking if the value at index 0 is greater than 10
if numbers[0] > 10:
    selected_values.append(numbers[0])
    print(f"{numbers[0]} is greater than 10.")

# checking if the value at index 2 is even
if numbers[2] % 2 == 0:
    selected_values.append(numbers[2])
    print(f"{numbers[2]} is even.")

# determining the length of the list
ln = len(numbers) - 1

# checking if the last value is less than 20
if numbers[ln] < 20:
    selected_values.append(numbers[ln])
    print(f"{numbers[ln]} is less than 20")

# printing the list of selected_values
print("The list of numbers that have passed the conditions are: ")
print(selected_values)
