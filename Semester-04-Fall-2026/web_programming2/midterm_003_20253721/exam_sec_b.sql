CREATE DATABASE IF NOT EXISTS exam_sec_b;
USE exam_sec_b;

DROP TABLE IF EXISTS library_books;
CREATE TABLE library_books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(80) NOT NULL,
    genre VARCHAR(30) NOT NULL,
    replacement_cost DECIMAL(8, 2) NOT NULL,
    copies INT NOT NULL
);

INSERT INTO library_books (title, genre, replacement_cost, copies) VALUES
('Learning PHP 8', 'Programming', 38.00, 12),
('SQL Pocket Guide', 'Database', 18.50, 25),
('Database Internals', 'Database', 65.00, 6),
('HTML & CSS Design', 'Web', 29.00, 30),
('Linux Server Admin', 'Systems', 52.00, 8),
('Git Essentials', 'Programming', 15.00, 40);
