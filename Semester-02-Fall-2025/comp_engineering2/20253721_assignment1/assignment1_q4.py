# asking the user to enter their grade
grade = int(input("Enter your grade: "))

# checking if the grade within 0-100 range
if 0 <= grade <= 100:
    # grade is within the range
    if grade >= 90:
        print("A")
    elif grade >= 80:
        print("B")
    elif grade >= 70:
        print("C")
    elif grade >= 60:
        print("D")
    else:
        print("F")
else:
    # grade is out of range
    print("Error: score must be between 0 and 100.")