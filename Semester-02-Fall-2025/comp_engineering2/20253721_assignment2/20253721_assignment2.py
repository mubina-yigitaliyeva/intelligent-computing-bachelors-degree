inventory = []

def add_gadget(arg_name, **kwargs):
    data = {
        "name": arg_name.title(),
        "status": "available"
    }

    for key, value in kwargs.items():
        data[key] = value

    inventory.append(data)
    return 0

def checkout_gadget(gadget_name):
    check = 0

    for gadget in inventory:
        if gadget["name"].lower() == gadget_name.lower():
            check = 1

            if gadget["status"] != "available":
                raise ValueError(f"{gadget_name.title()} is ALREADY borrowed.")

            gadget["status"] = "borrowed"
            print(f"{gadget_name.title()} is successfully borrowed.")
            return 0

    if not check:
        raise KeyError(f"{gadget_name.title()} is not found in inventory.")


def generate_report(filename):
    available = borrowed = count = 0
    for gadget in inventory:
        if gadget["status"] == "available":
            available += 1
        else:
            borrowed += 1
        count += 1 

    borrowed_gadgets = [g["name"] for g in inventory if g["status"] == "borrowed"]

    with open(filename, "w") as file:
        file.write("======================\n")
        file.write("   TECHSHARE REPORT\n")
        file.write("======================\n\n")

        file.write(f"Total count of gadgets             : {count}.\n")
        file.write(f"The number of available gadgets    : {available}.\n")
        file.write(f"The number of borrowed gadgets     : {borrowed}.\n\n")

        file.write("--- Borrowed items --- \n")
        for item in borrowed_gadgets:
            file.write(item + "\n")

if __name__ == "__main__":
    ext = True
    while ext:
        cmd = 0 
        print("MENU:")
        print("1. Add Equipment.")
        print("2. Checkout Equipment.")
        print("3. Generate Report.")
        print("4. Exit.")
        cmd = int(input("Choose the command: "))
        match cmd:
            case 1:
                details = {}
                gadget = input("Enter a gadget name: ")
                print(f"Now let's add details of {gadget}!")
                n = int(input("How many features do you want to add?: "))
                print("Great. Let's add.")
                for i in range(n):
                    feature_name = input("Enter a feature name: ")
                    feature = input("Feature: ")
                    details[feature_name.lower()] = feature.lower()
                add_gadget(gadget, **details)
                print(f"{gadget} is successfully added.")
            case 2:
                gadget = input("Enter a gadget name: ")
                try:
                    checkout_gadget(gadget)
                except ValueError as ve:
                    print(ve) 
                except KeyError as ke:
                    print(ke)  
            case 3:
                file = input("Enter a filename: ").lower()
                generate_report(file)
            case 4:
                print("\nExit from the program.\n")
                ext = False
            case _:
                print("Please choose the command between 1-4.")