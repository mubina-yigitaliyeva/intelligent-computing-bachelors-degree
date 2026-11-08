#Mubina 20253721

SALES_FILE = "sales.txt"
DAILY_REPORT_FILE = "daily_report.txt"

total = 0

with open(SALES_FILE, "r") as file:
    for line in file: 
        price = int(line.split(',')[1])
        total += price

with open(DAILY_REPORT_FILE, "w") as file:
    file.write(f"Total Revenue: ${total}")

print(f"Check the {DAILY_REPORT_FILE} file.")