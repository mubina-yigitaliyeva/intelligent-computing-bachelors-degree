# creating a list with 3 predefined guests
guests = ["Pavel", "Kim", "Mark"]

# adding a guest to the list
guests.append("Alex")
print("Alex has been added to the list.")

# inserting a guest at specific index in the list
guests.insert(0, "Jin")
print("Jin has been added to the beginning of the list.")

# removing the guest from the end
removed_guest = guests.pop(1)
print(f"{removed_guest} has been removed from the list.")

# printing out the final list of guests
print("The final list of guests: ", guests)