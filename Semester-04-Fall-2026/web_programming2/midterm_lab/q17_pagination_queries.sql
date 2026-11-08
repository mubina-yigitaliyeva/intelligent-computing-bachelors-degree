SELECT product_id, sku, product_name, unit_price
FROM products 
ORDER BY product_id ASC 
LIMIT 4 OFFSET 0;

SELECT product_id, sku, product_name, unit_price
FROM products 
ORDER BY product_id ASC 
LIMIT 4 OFFSET 4;

SELECT product_id, sku, product_name, unit_price
FROM products 
ORDER BY product_id ASC 
LIMIT 4 OFFSET 8;

SELECT product_id, sku, product_name, unit_price
FROM products 
WHERE category = 'Accessories'
ORDER BY unit_price ASC 
LIMIT 3;

