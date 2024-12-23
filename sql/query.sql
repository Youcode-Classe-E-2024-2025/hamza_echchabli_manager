-- Create the database
CREATE DATABASE librairie;

-- Use the database
USE librairie;

-- Create the actors table
CREATE TABLE actors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    slug VARCHAR(255) NOT NULL,
    state VARCHAR(50) NOT NULL
);

-- Create the roles table
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create the actor_role table (Associative Table)
CREATE TABLE actor_role (
    actors_id INT NOT NULL,
    roles_id INT NOT NULL,
    PRIMARY KEY (actors_id, roles_id),
    FOREIGN KEY (actors_id) REFERENCES actors(id) ON DELETE CASCADE,
    FOREIGN KEY (roles_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255)
);

CREATE TABLE actor_book (
    actors_id INT NOT NULL,
    books_id INT NOT NULL,
    PRIMARY KEY (actors_id, books_id),
    FOREIGN KEY (actors_id) REFERENCES actors(id) ON DELETE CASCADE,
    FOREIGN KEY (books_id) REFERENCES books(id) ON DELETE CASCADE
);


