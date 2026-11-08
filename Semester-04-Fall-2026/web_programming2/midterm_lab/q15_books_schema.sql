CREATE table books (
    book_id int auto_increment primary key,
    isbn varchar(17) not null,
    title varchar(120) not null,
    retail_price decimal(6, 2),
    published_date date not null,
    in_print tinyint(1) not null default 1
);

SELECT * from books;