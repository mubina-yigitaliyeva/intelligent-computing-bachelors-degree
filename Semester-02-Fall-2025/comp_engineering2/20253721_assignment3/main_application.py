from geometry_pkg import areas

def display_menu():
    print("\n*** GEOMETRIC AREA CALCULATOR ***")
    print("1. Circle 🔵")
    print("2. Rectangle 🎫")
    print("3. Triangle 📐")
    print("4. Quit ❌")

def print_result(result):
    print(f"✅ Result: The area is {result:.2f}")

def main():
    while True:
        display_menu()
        choice = input("Select operation: ")

        try:
            if choice == "1":
                radius = float(input("Enter radius: "))
                result = areas.calculate_circle_area(radius)
                print_result(result)

            elif choice == "2":
                length = float(input("Enter length: "))
                width = float(input("Enter width: "))
                result = areas.calculate_rectangle_area(length, width)
                print_result(result)

            elif choice == "3":
                base = float(input("Enter base: "))
                height = float(input("Enter height: "))
                result = areas.calculate_triangle_area(base, height)
                print_result(result)

            elif choice == "4":
                print("Goodbye! 👋")
                break

            else:
                print("❌ Invalid selection. Please choose again.")

        except ValueError as ve:
            print(f"Error: {ve}")

        except Exception as e:
            print("Unexpected error occurred:", e)


if __name__ == "__main__":
    main()
