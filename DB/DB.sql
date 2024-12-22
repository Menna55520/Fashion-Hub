-- create DB
CREATE DATABASE FashionHub COLLATE utf8mb4_unicode_ci ;
-- users Table
CREATE TABLE users(
    id int unsigned AUTO_INCREMENT PRIMARY KEY ,
    userName varchar(200) NOT null unique,
    email varchar(255) NOT null unique ,
    password varchar(255) NOT null ,
    phone varchar(200) NOT null ,
    address varchar(255) ,
    is_admin boolean DEFAULT false 
);
-- Categories Table
CREATE TABLE categories(
name varchar(100) NOT null PRIMARY KEY 
);
-- products Table
CREATE TABLE products(
    id int unsigned AUTO_INCREMENT PRIMARY KEY ,
    name varchar(100) NOT null ,
    image varchar(255) NOT null ,
    description text ,
    price decimal(10,2) ,
    quantity int ,
    category_name varchar(100) NOT NULL ,
    ADD FOREIGN KEY (`category_name`) REFERENCES `categories`(`name`) ON DELETE CASCADE ON UPDATE CASCADE;
);
-- orders Table
CREATE TABLE orders(
	id int unsigned AUTO_INCREMENT PRIMARY KEY ,
    orderDate datetime DEFAULT CURRENT_TIMESTAMP ,
    STATUS varchar(55) ,
    user_id int unsigned ,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
    
);
-- order_product Table
CREATE TABLE order_product(
     order_id int unsigned ,
     product_id int unsigned ,
     quantity int unsigned ,
     PRIMARY KEY (order_id , product_id) ,
     FOREIGN KEY(order_id) REFERENCES orders(id) ON DELETE CASCADE ON UPDATE CASCADE ,
   	 FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE 
);
-- reviews Table
CREATE TABLE reviews(
	id int unsigned AUTO_INCREMENT PRIMARY KEY ,
    rating int CHECK (rating BETWEEN 1 AND 5) ,
    comments text ,
    reviewDate datetime DEFAULT CURRENT_TIMESTAMP ,
    user_id int unsigned ,
    product_id int unsigned ,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE ,
    FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE
);