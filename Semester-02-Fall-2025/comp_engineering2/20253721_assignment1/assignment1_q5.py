# asking the user to enter the purchase amount
amount = float(input("Enter the purchase amount: "))

# checking if the purchase amount is positive
if amount < 0:
    print("Error: amount cannot be negative.") # showing error to the user
else:
    # the purchase amount is positive.
    if amount >= 100:
        # 20% off if the purchase amount is greater than or equal to 100
        discount = 0.20
    elif amount >= 50:
        # 10% off if the purchase amount is greater than or equal to 50
        discount = 0.10
    else:
        # no discounts if the purchase amount is less than 50
        discount = 0.0

    # calculating the final amount with a discount
    final_price = amount * (1 - discount)

    # printing out the final price to the user 
    print(f"You need to pay {final_price} in total with a discount of {discount*100}%.")