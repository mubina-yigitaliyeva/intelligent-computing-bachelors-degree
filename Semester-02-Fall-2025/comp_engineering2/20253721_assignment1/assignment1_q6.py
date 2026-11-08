# predefining the original username and password
org_username = "admin"
org_password = "admin777"

# asking the user to enter the username and password
username = input("Enter the username: ")
password = input("Enter the password: ")

# checking if the entered username and password are correct with the original ones
if org_username == username and org_password == password:
    print("Access granted.") # granting access if it is correct
else:
    print("Access denied.") # denying access if it is incorrect