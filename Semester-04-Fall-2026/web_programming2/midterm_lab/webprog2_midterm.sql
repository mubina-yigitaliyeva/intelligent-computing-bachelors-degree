CREATE DATABASE IF NOT EXISTS webprog2_midterm
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE webprog2_midterm;

DROP TABLE IF EXISTS products;
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    sku VARCHAR(20) NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    category VARCHAR(40) NOT NULL,
    unit_price DECIMAL(8, 2) NOT NULL,
    stock_qty INT NOT NULL,
    is_featured TINYINT(1) NOT NULL DEFAULT 0,
    added_date DATE NOT NULL
);

INSERT INTO products (sku, product_name, category, unit_price, stock_qty, is_featured, added_date) VALUES
('HW-101', 'Mechanical Keyboard RGB', 'Peripherals', 89.99, 24, 1, '2026-01-15'),
('HW-102', 'Wireless Ergonomic Mouse', 'Peripherals', 45.50, 50, 0, '2026-01-20'),
('HW-103', '27-inch 4K IPS Monitor', 'Monitors', 329.00, 12, 1, '2026-02-01'),
('HW-104', 'USB-C 8-in-1 Hub', 'Accessories', 34.95, 85, 0, '2026-02-10'),
('HW-105', '1TB NVMe M.2 SSD', 'Storage', 79.99, 30, 1, '2026-02-14'),
('HW-106', '2TB Portable External SSD', 'Storage', 139.50, 18, 0, '2026-02-18'),
('HW-107', '34-inch Ultrawide Monitor', 'Monitors', 499.99, 5, 1, '2026-02-22'),
('HW-108', 'Noise-Canceling USB Headset', 'Audio', 64.00, 40, 0, '2026-03-01'),
('HW-109', 'Braided HDMI 2.1 Cable 2m', 'Accessories', 14.99, 120, 0, '2026-03-05'),
('HW-110', 'Studio Condenser Microphone', 'Audio', 115.00, 9, 1, '2026-03-10'),
('HW-111', 'Laptop Aluminum Stand', 'Accessories', 29.99, 60, 0, '2026-03-12'),
('HW-112', '4TB Desktop HDD 7200RPM', 'Storage', 94.00, 15, 0, '2026-03-15');

DROP TABLE IF EXISTS courses;
CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(15) NOT NULL,
    title VARCHAR(100) NOT NULL,
    department VARCHAR(30) NOT NULL,
    credits INT NOT NULL,
    lab_fee DECIMAL(6, 2) NOT NULL,
    max_seats INT NOT NULL,
    is_online TINYINT(1) NOT NULL DEFAULT 0
);

INSERT INTO courses (course_code, title, department, credits, lab_fee, max_seats, is_online) VALUES
('CS101', 'Introduction to Programming', 'CS', 4, 50.00, 35, 0),
('CS202', 'Web Programming 2 (PHP & SQL)', 'CS', 4, 75.00, 30, 0),
('CS215', 'Database Management Systems', 'CS', 3, 60.00, 30, 1),
('IT110', 'Networking Fundamentals', 'IT', 3, 85.00, 25, 0),
('IT240', 'Cloud Infrastructure Basics', 'IT', 3, 40.00, 40, 1),
('DS105', 'UI/UX Design Principles', 'Design', 3, 30.00, 28, 1),
('DS220', 'Responsive Frontend Systems', 'Design', 4, 55.00, 24, 0),
('CS301', 'Software Engineering Lab', 'CS', 4, 90.00, 20, 0);