#Mubina 20253721

def distribute_items(total_items, groups):
    try:
        result = total_items / groups 
    except ZeroDivisionError:
        print("Error: Cannot divide by zero groups.")
    except TypeError:
        print("Error: Inputs must be numbers.")
    else:
        print(f"Items per group: {result:.1f}")

distribute_items(100, 4)
distribute_items(100, 0)
distribute_items(100, "five")