# asking the user to enter the current temperature
temperature = float(input("Please enter the current temperature: "))

# showing to the user the current weather condition based on temperature
if temperature <= 0:
    print("Freezing.")
elif temperature <= 10:
    print("Chilly.")
elif temperature <= 20:
    print("Cool.")
elif temperature <= 30:
    print("Warm.")
else:
    print("Hot.")