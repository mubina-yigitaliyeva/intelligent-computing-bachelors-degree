CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(15) NOT NULL,
    email VARCHAR(30) NOT NULL,
    pwd VARCHAR(20) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comments (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    comment_text TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    users_id INT(11) NOT NULL,
    FOREIGN KEY (users_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (username, email, pwd)
VALUES
('Alice', 'alice@gmail.com', 'alice123'),
('Bob', 'bob@gmail.com', 'bob123'),
('Charlie', 'charlie@gmail.com', 'charlie123'),
('David', 'david@gmail.com', 'david123'),
('Emma', 'emma@gmail.com', 'emma123');

INSERT INTO comments (username, comment_text, users_id)
VALUES
('Alice', 'Hello everyone! This is my first comment.', 1),
('Bob', 'I am learning PHP and MySQL.', 2),
('Charlie', 'Database relationships are interesting.', 3),
('Alice', 'I really enjoy learning web programming.', 1),
('David', 'How do foreign keys work?', 4),
('Emma', 'PHP with PDO is very useful.', 5),
('Bob', 'I just created my first database!', 2),
('Charlie', 'I want to learn SQL JOIN next.', 3);