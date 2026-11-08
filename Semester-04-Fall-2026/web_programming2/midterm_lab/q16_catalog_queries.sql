SELECT sku, product_name, category, unit_price
FROM products
WHERE is_featured = 1 
AND unit_price BETWEEN 50.00 AND 350.00 
ORDER BY unit_price DESC;

SELECT sku, product_name, category, stock_qty
FROM products 
WHERE category IN('Storage', 'Audio') 
AND stock_qty < 25 
ORDER BY stock_qty ASC;

SELECT sku, product_name, unit_price 
FROM products 
WHERE product_name LIKE '%SSD%' 
ORDER BY product_name ASC;