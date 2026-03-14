

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
email VARCHAR(100),
password VARCHAR(100)
);

INSERT INTO users(name,email,password) VALUES
('Demo User','demo@email.com','123');

CREATE TABLE products (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(200),
price INT
);

INSERT INTO products(name,price) VALUES
('Laptop',50000),
('Headphones',2000),
('Mobile Phone',25000),
('Smart Watch',4000);

CREATE TABLE cart (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
product_id INT
);

CREATE TABLE wishlist (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
product_id INT
);