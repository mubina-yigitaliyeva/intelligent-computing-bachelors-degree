SELECT COUNT(*) AS total_products,
SUM(stock_qty) AS total_units,
AVG(unit_price) AS avg_price,
MIN(unit_price) AS min_price,
MAX(unit_price) AS max_price,
SUM(unit_price * stock_qty) AS total_inventory_value
FROM products;

SELECT
    COUNT(*) AS online_course_count,
    AVG(lab_fee) AS avg_online_lab_fee,
    SUM(max_seats) AS total_online_seats
FROM courses
WHERE is_online = 1;