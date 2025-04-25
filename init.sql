-- Crear la tabla 'category' (Sin clave externa)
CREATE TABLE IF NOT EXISTS category (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL
);

-- Crear la tabla 'users' (Sin clave externa)
CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_loginname VARCHAR(255) NOT NULL UNIQUE,
    user_location VARCHAR(255) DEFAULT 'Rosario, Argentina',
    user_telephone1 VARCHAR(20),
    user_telephone2 VARCHAR(20),
    user_cellphone1 VARCHAR(20),
    user_cellphone2 VARCHAR(20),
    user_contactemail VARCHAR(255) NOT NULL UNIQUE,
    user_website VARCHAR(255),
    user_name VARCHAR(255) NOT NULL,
    user_description TEXT,
    user_photo VARCHAR(255),
    user_type BOOLEAN NOT NULL,  -- 0: Proveedor, 1: Cliente
    user_count INT DEFAULT 0,
    user_password VARCHAR(255) NOT NULL
);

-- Crear la tabla 'offers' (Con claves externas a 'users' y 'category')
CREATE TABLE IF NOT EXISTS offers (
    offer_id INT PRIMARY KEY AUTO_INCREMENT,
    offer_name VARCHAR(255) NOT NULL,
    offer_ownername VARCHAR(255) NOT NULL,
    offer_dimension VARCHAR(255) DEFAULT '1kg',
    offer_brand VARCHAR(255) NOT NULL,
    offer_minimun INT,
    offer_time INT,
    offer_price DECIMAL(10, 2) NOT NULL,
    offer_date DATETIME NOT NULL,  -- Cambiado de DATE a DATETIME
    offer_owner INT NOT NULL,
    offer_category INT NOT NULL,
    FOREIGN KEY (offer_owner) REFERENCES users(user_id),
    FOREIGN KEY (offer_category) REFERENCES category(category_id)
);

-- Crear la tabla 'products' (Con claves externas a 'users' y 'category')
CREATE TABLE IF NOT EXISTS products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(255) NOT NULL,
    product_dimension VARCHAR(255) DEFAULT '1kg',
    product_brand VARCHAR(255) NOT NULL,
    product_price DECIMAL(10, 2) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    product_date DATETIME NOT NULL,  -- Cambiado de DATE a DATETIME
    product_ownername VARCHAR(255) NOT NULL,
    product_owner INT NOT NULL,
    product_category INT NOT NULL,
    FOREIGN KEY (product_owner) REFERENCES users(user_id),
    FOREIGN KEY (product_category) REFERENCES category(category_id)
);

-- Crear la tabla 'requests' (Con claves externas a 'users' y 'category')
CREATE TABLE IF NOT EXISTS requests (
    request_id INT PRIMARY KEY AUTO_INCREMENT,
    request_name VARCHAR(255) NOT NULL,
    request_dimension VARCHAR(255) DEFAULT '1kg',
    request_brand VARCHAR(255) NOT NULL,
    category_name VARCHAR(255) NOT NULL,
    request_owner INT NOT NULL,
    request_ownername VARCHAR(255) NOT NULL,
    request_category INT NOT NULL,
    FOREIGN KEY (request_category) REFERENCES category(category_id),
    FOREIGN KEY (request_owner) REFERENCES users(user_id)
);

-- Crear la tabla 'users_category' (Con claves externas a 'category' y 'users')
CREATE TABLE IF NOT EXISTS users_category (
    category_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category(category_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    PRIMARY KEY (category_id, user_id)
);

-- Crear la tabla 'admins' (Sin claves externas)
CREATE TABLE IF NOT EXISTS admins (
    admin_loginname VARCHAR(255) PRIMARY KEY NOT NULL,
    admin_password VARCHAR(255) NOT NULL
);

-- Insertar datos de ejemplo en 'admins'
INSERT INTO admins (admin_loginname, admin_password)
VALUES ('admin', 'password123')
ON DUPLICATE KEY UPDATE admin_password = 'password123';

-- Insertar datos de ejemplo en 'category'
INSERT INTO category (category_id, category_name)
VALUES (1, 'Lacteos'),
       (2, 'Verduras'),
       (3, 'Carnes'),
       (4, 'Panificados')
ON DUPLICATE KEY UPDATE category_name = VALUES(category_name);

-- Insertar 5 nuevas categorías
INSERT INTO category (category_name)
VALUES ('Frutas'),
       ('Bebidas'),
       ('Cereales'),
       ('Aceites'),
       ('Congelados')
ON DUPLICATE KEY UPDATE category_name = VALUES(category_name);

-- Insertar datos de ejemplo en 'users'
INSERT INTO users (user_loginname, user_location, user_telephone1, user_telephone2, user_cellphone1, user_cellphone2, user_contactemail, user_website, user_name, user_description, user_photo, user_type, user_password, user_count)
VALUES ('cliente', 'Rosario, Argentina', '341-555-1234', '341-555-5678', '341-555-9012', '341-555-9012', 'cliente@example.com', '[www.example.com/mariaperez](https://www.example.com/mariaperez)', 'Cliente', 'A leading supplier of restaurant food products in Rosario.', 'maria_perez.jpg', 1, 'password123', 0)
ON DUPLICATE KEY UPDATE user_location = VALUES(user_location), user_telephone1 = VALUES(user_telephone1), user_telephone2 = VALUES(user_telephone2), user_cellphone1 = VALUES(user_cellphone1), user_cellphone2 = VALUES(user_cellphone2), user_website = VALUES(user_website), user_name = VALUES(user_name), user_description = VALUES(user_description), user_photo = VALUES(user_photo), user_type = VALUES(user_type), user_password = VALUES(user_password), user_count = VALUES(user_count);
INSERT INTO users (user_loginname, user_location, user_telephone1, user_telephone2, user_cellphone1, user_cellphone2, user_contactemail, user_website, user_name, user_description, user_photo, user_type, user_password, user_count)
VALUES ('proveedor', 'Rosario, Argentina', '341-555-1234', '341-555-5678', '341-555-9012', '341-555-9012', 'proveedor@example.com', '[www.example.com/mariaperez](https://www.example.com/mariaperez)', 'Proveedor', 'A leading supplier of restaurant food products in Rosario.', 'maria_perez.jpg', 0, 'password123', 0)
ON DUPLICATE KEY UPDATE user_location = VALUES(user_location), user_telephone1 = VALUES(user_telephone1), user_telephone2 = VALUES(user_telephone2), user_cellphone1 = VALUES(user_cellphone1), user_cellphone2 = VALUES(user_cellphone2), user_website = VALUES(user_website), user_name = VALUES(user_name), user_description = VALUES(user_description), user_photo = VALUES(user_photo), user_type = VALUES(user_type), user_password = VALUES(user_password), user_count = VALUES(user_count);

-- Insertar 2 nuevos proveedores
INSERT INTO users (user_loginname, user_location, user_contactemail, user_name, user_type, user_password)
VALUES ('granja_feliz', 'Santa Fe, Argentina', 'ventas@granjafeliz.com', 'Granja Feliz SRL', 0, 'seguro456')
ON DUPLICATE KEY UPDATE user_location = VALUES(user_location), user_contactemail = VALUES(user_contactemail), user_name = VALUES(user_name), user_type = VALUES(user_type), user_password = VALUES(user_password);
INSERT INTO users (user_loginname, user_location, user_contactemail, user_name, user_type, user_password)
VALUES ('distribuidora_sur', 'Córdoba, Argentina', 'pedidos@distribuidorasur.com.ar', 'Distribuidora del Sur', 0, 'clave789')
ON DUPLICATE KEY UPDATE user_location = VALUES(user_location), user_contactemail = VALUES(user_contactemail), user_name = VALUES(user_name), user_type = VALUES(user_type), user_password = VALUES(user_password);

-- Insertar datos de ejemplo en 'offers'
INSERT INTO offers (offer_category, offer_ownername, offer_name, offer_dimension, offer_brand, offer_minimun, offer_time, offer_price, offer_date, offer_owner)
VALUES (1, 'test', 'Special Offer on Rice', '1kg', 'Arroz Gallo', 50, 24, 120.50, '2024-07-28 12:00:00', (SELECT user_id FROM users WHERE user_loginname = 'cliente')); #YYYY-MM-DD HH:MM:SS

-- Insertar 10 ofertas de ejemplo para el usuario con ID 2
INSERT INTO offers (offer_category, offer_ownername, offer_name, offer_dimension, offer_brand, offer_minimun, offer_time, offer_price, offer_date, offer_owner)
VALUES (2, 'proveedor', 'Oferta de Zanahorias', '1kg', 'Los Nietitos', 10, 48, 50.00, '2025-07-29 10:00:00', (SELECT user_id FROM users WHERE user_loginname = 'proveedor')),
       (2, 'proveedor', 'Oferta de Tomates', '1kg', 'La Huerta', 20, 24, 60.00, '2025-07-30 14:00:00', (SELECT user_id FROM users WHERE user_loginname = 'proveedor')),
       (3, 'proveedor', 'Oferta de Carne de Res', '1kg', 'El Novillo', 5, 72, 200.00, '2025-07-31 09:00:00', (SELECT user_id FROM users WHERE user_loginname = 'proveedor')),
       (4, 'proveedor', 'Oferta de Pan Francés', '1kg', 'La Espiga', 30, 12, 30.00, '2025-08-01 11:00:00', (SELECT user_id FROM users WHERE user_loginname = 'distribuidora_sur')),
       (1, 'proveedor', 'Oferta de Leche Entera', '1L', 'Sancor', 15, 24, 80.00, '2025-04-23 16:00:00', (SELECT user_id FROM users WHERE user_loginname = 'proveedor')),
       (2, 'proveedor', 'Oferta de Papas', '1kg', 'Del Campo', 25, 36, 40.00, '2025-08-03 13:00:00', (SELECT user_id FROM users WHERE user_loginname = 'distribuidora_sur')),
       (3, 'proveedor', 'Oferta de Pollo Fresco', '1kg', 'Granja Avícola', 10, 48, 120.00, '2025-08-04 10:00:00', (SELECT user_id FROM users WHERE user_loginname = 'granja_feliz')),
       (4, 'proveedor', 'Oferta de Facturas', '1kg', 'El Molino', 12, 24, 70.00, '2025-08-05 15:00:00', (SELECT user_id FROM users WHERE user_loginname = 'proveedor')),
       (1, 'proveedor', 'Oferta de Queso Cremoso', '1kg', 'La Serenísima', 8, 36, 150.00, '2025-08-06 12:00:00', (SELECT user_id FROM users WHERE user_loginname = 'proveedor')),
       (2, 'proveedor', 'Oferta de Cebollas', '1kg', 'Directo del Productor', 18, 24, 55.00, '2025-08-07 17:00:00', (SELECT user_id FROM users WHERE user_loginname = 'proveedor'));

-- Insertar 10 nuevas ofertas
INSERT INTO offers (offer_category, offer_ownername, offer_name, offer_dimension, offer_brand, offer_minimun, offer_time, offer_price, offer_date, offer_owner)
VALUES (5, 'Granja Feliz SRL', 'Pollo Entero Congelado', '1 unidad', 'Granja Feliz', 20, 72, 250.00, '2024-08-08 09:30:00', (SELECT user_id FROM users WHERE user_loginname = 'granja_feliz')),
       (6, 'Distribuidora del Sur', 'Gaseosa Cola', '2L', 'Coca-Cola', 100, 48, 95.00, '2024-08-09 14:15:00', (SELECT user_id FROM users WHERE user_loginname = 'distribuidora_sur')),
       (1, 'proveedor', 'Yogurt Bebible Frutilla', '1L', 'La Serenísima', 30, 36, 75.50, '2024-08-10 11:00:00', (SELECT user_id FROM users WHERE user_loginname = 'proveedor')),
       (7, 'Granja Feliz SRL', 'Avena en Hojuelas', '500g', 'Quaker', 60, 60, 45.25, '2024-08-11 16:45:00', (SELECT user_id FROM users WHERE user_loginname = 'granja_feliz')),
       (8, 'Distribuidora del Sur', 'Aceite de Girasol', '3L', 'Cocinero', 40, 96, 320.00, '2024-08-12 10:30:00', (SELECT user_id FROM users WHERE user_loginname = 'distribuidora_sur')),
       (5, 'Granja Feliz SRL', 'Hamburguesas de Carne Congeladas', '8 unidades', 'Swift', 50, 72, 180.75, '2024-08-13 15:00:00', (SELECT user_id FROM users WHERE user_loginname = 'granja_feliz')),
       (6, 'Distribuidora del Sur', 'Agua Mineral sin Gas', '6x500ml', 'Villavicencio', 80, 48, 65.90, '2024-08-14 12:30:00', (SELECT user_id FROM users WHERE user_loginname = 'distribuidora_sur')),
       (7, 'proveedor', 'Arroz Integral', '1kg', 'Molinos Ala', 70, 60, 80.40, '2024-08-15 17:15:00', (SELECT user_id FROM users WHERE user_loginname = 'proveedor')),
       (8, 'Granja Feliz SRL', 'Aceite de Oliva Extra Virgen', '500ml', 'Zuccardi', 25, 120, 210.50, '2024-08-16 09:00:00', (SELECT user_id FROM users WHERE user_loginname = 'granja_feliz')),
       (9, 'Distribuidora del Sur', 'Pizza Congelada Muzzarella', '1 unidad', 'Patagonia', 100, 72, 110.00, '2024-08-17 13:45:00', (SELECT user_id FROM users WHERE user_loginname = 'distribuidora_sur'));

-- Insertar datos de ejemplo en 'products'
INSERT INTO products (product_name, product_dimension, product_brand, product_price, price, product_date, product_owner, product_category, product_ownername)
VALUES ('Leche Entera', '3kg', 'Sancor', 38584, 38584, '2024-04-18 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '1kg', 'Verdulería Central', 43878, 43878, '2024-08-01 12:00:00', 2, 2, 'Proveedor'),
       ('Lechuga Repollada', '1kg', 'Verdulería Central', 49772, 49772, '2025-01-17 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '2kg', 'La Serenísima', 27768, 27768, '2024-02-07 12:00:00', 2, 1, 'Proveedor'),
       ('Papa', '1kg', 'Campo Claro', 27171, 27171, '2024-09-02 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '1kg', 'Sancor', 47171, 47171, '2024-05-18 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '1kg', 'Verdulería Central', 45845, 45845, '2024-05-27 12:00:00', 2, 2, 'Proveedor'),
       ('Queso Cremoso', '2kg', 'Milkaut', 45778, 45778, '2024-08-07 12:00:00', 2, 1, 'Proveedor'),
       ('Cebolla', '2kg', 'La Frescura', 15845, 15845, '2024-03-05 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '1kg', 'La Serenísima', 24814, 24814, '2024-05-04 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '1kg', 'El Productor', 18784, 18784, '2024-03-18 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '4kg', 'Sancor', 44883, 44883, '2024-06-16 12:00:00', 2, 1, 'Proveedor'),
       ('Zanahoria', '4kg', 'Sol de Otoño', 37483, 37483, '2024-07-27 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '5kg', 'La Serenísima', 27437, 27437, '2024-08-25 12:00:00', 2, 1, 'Proveedor'),
       ('Papa', '3kg', 'Campo Claro', 26867, 26867, '2024-07-06 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '1kg', 'Sancor', 25946, 25946, '2024-09-17 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '4kg', 'Verdulería Central', 27385, 27385, '2024-03-27 12:00:00', 2, 2, 'Proveedor'),
       ('Yogurt Natural', '3kg', 'Danone', 37117, 37117, '2024-07-18 12:00:00', 2, 1, 'Proveedor'),
       ('Cebolla', '1kg', 'La Frescura', 24458, 24458, '2024-06-15 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '1kg', 'La Serenísima', 47271, 47271, '2024-07-05 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '5kg', 'El Productor', 37926, 37926, '2024-08-14 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '1kg', 'Sancor', 38814, 38814, '2024-09-24 12:00:00', 2, 1, 'Proveedor'),
       ('Zanahoria', '1kg', 'Sol de Otoño', 45191, 45191, '2024-02-03 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '5kg', 'La Serenísima', 18844, 18844, '2024-06-02 12:00:00', 2, 1, 'Proveedor'),
       ('Papa', '1kg', 'Campo Claro', 49449, 49449, '2024-04-12 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '5kg', 'Sancor', 24675, 24675, '2024-02-22 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '1kg', 'Verdulería Central', 39722, 39722, '2024-06-21 12:00:00', 2, 2, 'Proveedor'),
       ('Yogurt Natural', '1kg', 'Danone', 28544, 28544, '2024-02-09 12:00:00', 2, 1, 'Proveedor'),
       ('Cebolla', '5kg', 'Aromas de Campo', 45582, 45582, '2024-03-12 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '4kg', 'La Serenísima', 48419, 48419, '2024-04-22 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '1kg', 'El Productor', 33798, 33798, '2024-05-02 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '5kg', 'Sancor', 37128, 37128, '2024-08-01 12:00:00', 2, 1, 'Proveedor'),
       ('Zanahoria', '5kg', 'Tierras del Sur', 45296, 45296, '2024-09-08 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '4kg', 'La Serenísima', 16942, 16942, '2025-01-02 12:00:00', 2, 1, 'Proveedor'),
       ('Papa', '4kg', 'Campo Claro', 28987, 28987, '2024-04-26 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '2kg', 'Sancor', 37476, 37476, '2024-03-08 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '3kg', 'Verdulería Central', 45417, 45417, '2024-07-07 12:00:00', 2, 2, 'Proveedor'),
       ('Yogurt de Frutilla', '1kg', 'Yogurísimo', 34771, 34771, '2024-05-23 12:00:00', 2, 1, 'Proveedor'),
       ('Morrón Rojo', '2kg', 'La Frescura', 24771, 24771, '2024-02-13 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '5kg', 'La Serenísima', 18417, 18417, '2024-09-28 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '1kg', 'El Productor', 37265, 37265, '2024-03-03 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '4kg', 'Sancor', 38241, 38241, '2024-07-03 12:00:00', 2, 1, 'Proveedor'),
       ('Zanahoria', '2kg', 'Sol de Otoño', 35146, 35146, '2024-04-03 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '3kg', 'La Serenísima', 27218, 27218, '2024-02-17 12:00:00', 2, 1, 'Proveedor'),
       ('Papa', '1kg', 'Campo Claro', 48115, 48115, '2024-05-13 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '5kg', 'Sancor', 43198, 43198, '2024-09-13 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '4kg', 'Verdulería Central', 49419, 49419, '2024-06-25 12:00:00', 2, 2, 'Proveedor'),
       ('Yogurt de Frutilla', '4kg', 'Yogurísimo', 49794, 49794, '2024-03-24 12:00:00', 2, 1, 'Proveedor'),
       ('Morrón Rojo', '4kg', 'La Frescura', 38446, 38446, '2024-07-24 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '1kg', 'La Serenísima', 28549, 28549, '2024-04-07 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '3kg', 'El Productor', 26732, 26732, '2024-02-27 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '3kg', 'Sancor', 22765, 22765, '2024-06-28 12:00:00', 2, 1, 'Proveedor'),
       ('Pepino', '2kg', 'Sol de Otoño', 35748, 35748, '2024-08-28 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '2kg', 'La Serenísima', 48476, 48476, '2024-05-08 12:00:00', 2, 1, 'Proveedor'),
       ('Papa', '5kg', 'Campo Claro', 37166, 37166, '2024-03-13 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '3kg', 'Sancor', 39517, 39517, '2024-07-13 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '2kg', 'Verdulería Central', 39718, 39718, '2024-04-16 12:00:00', 2, 2, 'Proveedor'),
       ('Yogurt de Frutilla', '5kg', 'Yogurísimo', 47544, 47544, '2024-02-06 12:00:00', 2, 1, 'Proveedor'),
       ('Morrón Rojo', '5kg', 'La Frescura', 36177, 36177, '2024-09-11 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '3kg', 'La Serenísima', 37402, 37402, '2024-06-11 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '4kg', 'El Productor', 37728, 37728, '2024-04-20 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '2kg', 'Sancor', 18387, 18387, '2024-08-18 12:00:00', 2, 1, 'Proveedor'),
       ('Pepino', '4kg', 'Tierras del Sur', 26365, 26365, '2024-05-28 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '1kg', 'La Serenísima', 18644, 18644, '2024-03-20 12:00:00', 2, 1, 'Proveedor'),
       ('Papa', '2kg', 'Campo Claro', 39417, 39417, '2024-07-20 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '4kg', 'Sancor', 22822, 22822, '2024-02-02 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '5kg', 'Verdulería Central', 28854, 28854, '2024-09-05 12:00:00', 2, 2, 'Proveedor'),
       ('Queso Cremoso', '1kg', 'Milkaut', 48846, 48846, '2024-06-06 12:00:00', 2, 1, 'Proveedor'),
       ('Morrón Verde', '3kg', 'Aromas de Campo', 43467, 43467, '2024-03-29 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '5kg', 'La Serenísima', 39739, 39739, '2024-08-04 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '2kg', 'El Productor', 48485, 48485, '2024-05-10 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '2kg', 'Sancor', 37255, 37255, '2024-03-16 12:00:00', 2, 1, 'Proveedor'),
       ('Pepino', '1kg', 'Tierras del Sur', 49954, 49954, '2024-07-16 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '3kg', 'La Serenísima', 39675, 39675, '2024-04-29 12:00:00', 2, 1, 'Proveedor'),
       ('Papa', '5kg', 'Campo Claro', 36248, 36248, '2024-02-10 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '4kg', 'Sancor', 47728, 47728, '2024-06-10 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '1kg', 'Verdulería Central', 36474, 36474, '2024-04-13 12:00:00', 2, 2, 'Proveedor'),
       ('Queso Cremoso', '5kg', 'Milkaut', 37497, 37497, '2024-02-20 12:00:00', 2, 1, 'Proveedor'),
       ('Morrón Verde', '2kg', 'Aromas de Campo', 37121, 37121, '2024-08-23 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '1kg', 'La Serenísima', 27744, 27744, '2024-05-20 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '5kg', 'El Productor', 27622, 27622, '2024-03-23 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '3kg', 'Sancor', 28658, 28658, '2024-07-23 12:00:00', 2, 1, 'Proveedor'),
       ('Pepino', '5kg', 'Tierras del Sur', 37217, 37217, '2024-02-06 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '2kg', 'La Serenísima', 28785, 28785, '2024-09-03 12:00:00', 2, 1, 'Proveedor'),
       ('Cebolla', '4kg', 'La Chacra', 39467, 39467, '2024-06-04 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '5kg', 'Sancor', 39542, 39542, '2024-04-09 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '2kg', 'Verdulería Central', 39117, 39117, '2024-08-09 12:00:00', 2, 2, 'Proveedor'),
       ('Queso Duro', '4kg', 'Tregar', 48439, 48439, '2024-05-26 12:00:00', 2, 1, 'Proveedor'),
       ('Morrón Verde', '1kg', 'Aromas de Campo', 26038, 26038, '2024-03-02 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '4kg', 'La Serenísima', 43851, 43851, '2024-07-02 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '1kg', 'El Productor', 26344, 26344, '2024-02-16 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '2kg', 'Sancor', 27821, 27821, '2024-09-29 12:00:00', 2, 1, 'Proveedor'),
       ('Pepino', '3kg', 'Tierras del Sur', 48545, 48545, '2024-06-29 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '1kg', 'La Serenísima', 39715, 39715, '2024-08-21 12:00:00', 2, 1, 'Proveedor'),
       ('Cebolla', '2kg', 'La Chacra', 37449, 37449, '2024-05-22 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '4kg', 'Sancor', 35748, 35748, '2024-03-22 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '3kg', 'Verdulería Central', 28734, 28734, '2024-07-22 12:00:00', 2, 2, 'Proveedor'),
       ('Queso Duro', '1kg', 'Tregar', 39742, 39742, '2024-04-02 12:00:00', 2, 1, 'Proveedor'),
       ('Morrón Verde', '5kg', 'Aromas de Campo', 36475, 36475, '2024-02-23 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '2kg', 'La Serenísima', 38914, 38914, '2024-09-22 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '4kg', 'El Productor', 48744, 48744, '2024-06-24 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '5kg', 'Sancor', 25721, 25721, '2024-08-08 12:00:00', 2, 1, 'Proveedor'),
       ('Pepino', '2kg', 'Tierras del Sur', 39710, 39710, '2024-03-04 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '5kg', 'La Serenísima', 47715, 47715, '2024-07-04 12:00:00', 2, 1, 'Proveedor'),
       ('Cebolla', '1kg', 'La Chacra', 39496, 39496, '2024-04-23 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '1kg', 'Sancor', 26867, 26867, '2024-02-14 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '2kg', 'Verdulería Central', 37422, 37422, '2024-05-17 12:00:00', 2, 2, 'Proveedor'),
       ('Queso Duro', '5kg', 'Tregar', 43814, 43814, '2024-09-19 12:00:00', 2, 1, 'Proveedor'),
       ('Zapallo', '4kg', 'Aromas de Campo', 47746, 47746, '2024-03-26 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '3kg', 'La Serenísima', 37192, 37192, '2024-06-13 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '5kg', 'El Productor', 37887, 37887, '2024-04-27 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '5kg', 'Sancor', 47754, 47754, '2024-08-27 12:00:00', 2, 1, 'Proveedor'),
       ('Pepino', '1kg', 'Tierras del Sur', 49791, 49791, '2024-05-31 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Descremada', '4kg', 'La Serenísima', 38782, 38782, '2024-02-21 12:00:00', 2, 1, 'Proveedor'),
       ('Cebolla', '3kg', 'La Chacra', 28552, 28552, '2024-07-21 12:00:00', 2, 2, 'Proveedor'),
       ('Leche Entera', '2kg', 'Sancor', 27572, 27572, '2024-09-04 12:00:00', 2, 1, 'Proveedor'),
       ('Tomate Perita', '2kg', 'Verdulería Central', 27077, 27077, '2024-03-10 12:00:00', 2, 2, 'Proveedor'),
       ('Queso Duro', '2kg', 'Tregar', 37482, 37482, '2024-06-07 12:00:00', 2, 1, 'Proveedor');

-- Insertar datos de ejemplo en 'requests'
INSERT INTO requests (request_category, request_ownername, request_name, request_dimension, request_brand, category_name, request_owner)
VALUES (1, 'Cliente', 'Queso Crema', '2kg', 'Sancor', 'Lacteos', 1),
       (1, 'Cliente', 'Leche en Polvo', '10kg', 'Ilolay', 'Lacteos', 1),
       (1, 'Cliente', 'Queso Sardo', '2kg', 'Todas', 'Lacteos', 1);

-- Insertar datos de ejemplo en 'users_category'
INSERT INTO users_category (category_id, user_id)
VALUES (1, 2),
       (2, 2);