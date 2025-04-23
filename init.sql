-- Create the 'category' table (No FK)
CREATE TABLE category (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(255)
);

-- Create the 'users' table (No FK)
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_loginname VARCHAR(255),
    user_location VARCHAR(255) DEFAULT 'Rosario, Argentina',
    user_telephone1 VARCHAR(20),
    user_telephone2 VARCHAR(20),
    user_cellphone1 VARCHAR(20),
    user_cellphone2 VARCHAR(20),
    user_contactemail VARCHAR(255),
    user_website VARCHAR(255),
    user_name VARCHAR(255),
    user_description TEXT,
    user_photo VARCHAR(255),
    user_type BOOLEAN,
    user_count INT,
    user_password VARCHAR(255),
);

-- Create the 'offers' table (FK with users)
CREATE TABLE offers (
    offer_id INT PRIMARY KEY AUTO_INCREMENT,
    offer_name VARCHAR(255),
    offer_ownername VARCHAR(255),
    offer_dimension VARCHAR(255) DEFAULT '1kg',
    offer_brand VARCHAR(255),
    offer_minimun INT,
    offer_time DATE,
    offer_price DECIMAL(10, 2),
    offer_date DATE,
    offer_owner INT,
    offer_category INT,
    FOREIGN KEY (offer_category) REFERENCES category(category_id),  -- Added foreign key constraint
    FOREIGN KEY (offer_owner) REFERENCES users(user_id)
);

-- Create the 'products' table (FK with users, category)
CREATE TABLE products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(255),
    product_dimension VARCHAR(255) DEFAULT '1kg',
    product_brand VARCHAR(255),
    product_price DECIMAL(10, 2),
    price DECIMAL(10,2),
    product_date DATE,
    product_ownername VARCHAR(255),
    product_owner INT,
    product_category INT,  -- Added product_category column
    FOREIGN KEY (product_owner) REFERENCES users(user_id),
    FOREIGN KEY (product_category) REFERENCES category(category_id)  -- Added foreign key constraint
);

-- Create the 'requests' table (FK with users)
CREATE TABLE requests (
    request_id INT PRIMARY KEY AUTO_INCREMENT,
    request_name VARCHAR(255),
    request_dimension VARCHAR(255) DEFAULT '1kg',
    request_brand VARCHAR(255),
    category_name VARCHAR(255),
    request_owner INT,
    request_ownername VARCHAR(255),
    request_category INT,
    FOREIGN KEY (request_category) REFERENCES category(category_id),  -- Added foreign key constraint
    FOREIGN KEY (request_owner) REFERENCES users(user_id)
);

-- Create the 'users_category' table (FK with category, users)
CREATE TABLE users_category (
    category_id INT,
    user_id INT,
    FOREIGN KEY (category_id) REFERENCES category(category_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    PRIMARY KEY (category_id, user_id)
);

-- Insert dummy data into 'category'
INSERT INTO category (category_id , category_name)
VALUES (1 , 'Food Supplies');

-- Insert dummy data into 'users'
INSERT INTO users ( user_loginname, user_location, user_telephone1, user_telephone2, user_cellphone1, user_cellphone2, user_email, user_website, user_name, user_description, user_photo, user_type, user_password, user_count)
VALUES ('test', 'Rosario, Argentina', '341-555-1234', '341-555-5678', '341-555-9012', '341-555-9012', 'maria.perez@example.com', 'www.example.com/mariaperez', 'Maria Perez', 'A leading supplier of restaurant food products in Rosario.', 'maria_perez.jpg', 1, 'password123', 0);

-- Insert dummy data into 'offers'
INSERT INTO offers (offer_category , offer_ownername , offer_name, offer_dimension, offer_brand, offer_minimun, offer_time, offer_price, offer_date, offer_owner)
VALUES ( 1 , 'test' , 'Special Offer on Rice', '1kg', 'Arroz Gallo', 50, '2024-07-29', 120.50, '2024-07-28', 1);



-- Insert dummy data into 'products'
INSERT INTO products (product_name, product_dimension, product_brand, product_price, price, product_date, product_owner, product_category, product_ownername)
VALUES ('Premium Olive Oil', '1kg', 'Olivares del Sur', 250.00, 220.00, '2024-07-28', 1, 1 , "Test");


-- Insert dummy data into 'requests'
INSERT INTO requests (request_category, request_ownername, request_name, request_dimension, request_brand, category_name, request_owner)
VALUES (1 , 'test' , 'Request for Flour', '1kg', 'Harinas Rosario', 'Food Supplies', 1);

-- Insert dummy data into 'users_category'
INSERT INTO users_category (category_id, user_id)
VALUES (1, 1);
