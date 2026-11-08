#Mubina 20253721

inventory = [
    {'name': 'Apples', 'stock': 50, 'price': 0.50},
    {'name': 'Bananas', 'stock': 5, 'price': 0.20},
    {'name': 'Cherries', 'stock': 20, 'price': 3.00},
]

low_stock = inventory[0]['stock']
low_stock_name = "" 
total_value = 0 

for element in inventory:
    if element['stock'] <= low_stock:
        low_stock = element['stock']
        low_stock_name = element['name']
        
    total_value += element['stock'] * element['price']

print(f"Alert: Low stock on {low_stock_name}")
print(f"Total Inventory Value: ${total_value:.1f}")