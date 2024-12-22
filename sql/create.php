
<?php
// Database connection
$host = 'localhost';
$port=5432;
$dbname = 'librairie';
$username = 'postgres';
$password = 'hamza';

try {
    // Create a new PDO instance
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create tables if they don't exist
    createTables($conn);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function createTables($conn) {
    // SQL queries to create the tables if they don't exist
    $queries = [
        "CREATE TABLE IF NOT EXISTS actors (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            slug VARCHAR(255),
            state INTEGER DEFAULT 0,
            password VARCHAR(255) NOT NULL
        )",
        
        "CREATE TABLE IF NOT EXISTS books (
            id SERIAL PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            price DECIMAL(10, 2),
            image VARCHAR(255)
        )",
        
        "CREATE TABLE IF NOT EXISTS actor_book (
            actors_id INTEGER NOT NULL,
            books_id INTEGER NOT NULL,
            FOREIGN KEY (actors_id) REFERENCES actors(id) ON DELETE CASCADE,
            FOREIGN KEY (books_id) REFERENCES books(id) ON DELETE CASCADE,
            PRIMARY KEY (actors_id, books_id)
        )",
        
        "CREATE TABLE IF NOT EXISTS roles (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            role_name VARCHAR(255) NOT NULL,
            FOREIGN KEY (name) REFERENCES actors(email) ON DELETE CASCADE
        )",
        
        "CREATE TABLE IF NOT EXISTS archive (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            FOREIGN KEY (name) REFERENCES actors(email) ON DELETE CASCADE
        )"
    ];

    // Execute each query to create the tables
    foreach ($queries as $query) {
        try {
            // Execute the query to create the table if it doesn't already exist
            $conn->exec($query);
            echo "Table created or already exists.<br>";
        } catch (PDOException $e) {
            // If there's an error creating the table, print the error message
            echo "Error creating table: " . $e->getMessage() . "<br>";
        }
    }
}
?>
