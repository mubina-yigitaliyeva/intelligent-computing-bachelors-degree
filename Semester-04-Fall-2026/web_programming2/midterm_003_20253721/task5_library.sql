create table library_branches (
    branch_id int auto_increment primary key,
    branch_name varchar(60) not null,
    annual_budget decimal(8, 2) not null,
    is_open tinyint(1) not null default 1
);

select title, genre, replacement_cost 
from library_books
where replacement_cost >= 25.00 
order by replacement_cost desc;

select book_id, title, replacement_cost 
from library_books
order by book_id asc
limit 3 offset 3;

select 
count(*) as total_titles, 
avg(replacement_cost) as avg_cost,
min(replacement_cost) as min_cost,
max(replacement_cost) as max_cost
from library_books;

