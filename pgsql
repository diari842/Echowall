CREATE DATABASE IF NOT EXISTS echowall_db;
USE echowall_db;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    category VARCHAR(100),
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    reaction_type VARCHAR(50),
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    icon VARCHAR(100)
);
