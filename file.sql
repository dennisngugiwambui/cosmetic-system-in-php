CREATE DATABASE GlowCosmetics;

USE GlowCosmetics;

CREATE TABLE perfumes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    cost DECIMAL(10, 2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    capacity VARCHAR(50) NOT NULL,
    image VARCHAR(255) NOT NULL  
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    perfume_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    quantity INT NOT NULL,
    total_cost DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (perfume_id) REFERENCES perfumes(id)
);

INSERT INTO perfumes (name, cost, category, capacity, image) VALUES
('Rose Essence', 49.99, 'Floral', '50ml', 'https://prix.formesdeluxe.com/app/uploads/2022/07/Heinz-Glas-Parfums-Christian-Dior-Miss-Dior-Rose-Essence-01.jpg.webp'),
('Ocean Breeze', 39.99, 'Fruity', '100ml', 'https://www.wyxloop.com/cdn/shop/files/pixelcut-export-2024-06-11T112540.783.jpg?v=1718210209&width=900'),
('Musk Ambrosia', 59.99, 'Woody', '30ml', 'https://atelierperfumery.com/wp-content/uploads/2024/02/navitus-ambrosia-imperiale-extrait-de-parfum-125ml-01-800x800.jpg'),
('Citrus Splash', 34.99, 'Citrus', '75ml', 'https://www.birkholz-perfumes.com/cdn/shop/products/Citrus-Splash.jpg?v=1672754359&width=1080'),
('Vanilla Dream', 44.99, 'Sweet', '100ml', 'https://bubbletcosmetics.com/cdn/shop/files/vanilla-dream-refreshing-body-mist-moisturising.jpg?v=1714658219&width=600');

INSERT INTO users (name, email, password) VALUES
('Jane Doe', 'jane.doe@example.com', 'hashedpassword123'),
('John Smith', 'john.smith@example.com', 'hashedpassword456'),
('Alice Johnson', 'alice.johnson@example.com', 'hashedpassword789'),
('Bob Brown', 'bob.brown@example.com', 'hashedpassword101'),
('Charlie Green', 'charlie.green@example.com', 'hashedpassword112');

INSERT INTO orders (user_id, perfume_id, quantity, total_cost) VALUES
(1, 2, 1, 39.99),
(2, 1, 2, 99.98),
(3, 3, 1, 59.99),
(4, 5, 3, 134.97),
(5, 4, 1, 34.99);
