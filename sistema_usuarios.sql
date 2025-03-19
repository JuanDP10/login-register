-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS sistema_usuarios;
USE sistema_usuarios;

-- Creación de la tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Índice para búsquedas por email (mejora rendimiento en login)
CREATE INDEX idx_email ON users(email);