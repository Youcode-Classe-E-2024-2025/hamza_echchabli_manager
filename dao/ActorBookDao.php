<?php

class ActorBookDao {
    

    // Create a row in actor_book
    public function createActorBook($actorId, $bookId): string {
        global $conn;
    
        // Check if the record already exists
        $checkQuery = "SELECT 1 FROM actor_book WHERE actors_id = $1 AND books_id = $2";
        $checkResult = pg_query_params($conn, $checkQuery, [$actorId, $bookId]);
    
        if (pg_num_rows($checkResult) > 0) {
            return "This actor-book association already exists.";
        }
    
        // Insert the new record
        $insertQuery = "INSERT INTO actor_book (actors_id, books_id) VALUES ($1, $2)";
        $result = pg_query_params($conn, $insertQuery, [$actorId, $bookId]);
    
        if ($result) {
            return "Row added successfully.";
        } else {
            return "Failed to add row: " . pg_last_error($conn);
        }
    }
    
    public function deleteActorBookByBookId($bookId) {
        global $conn;
        try {
            $query = "DELETE FROM actor_book WHERE books_id = $1 ";
            $result = pg_query_params($conn, $query, [$bookId]);
    
            if ($result) {
                return "Row deleted successfully.";
            } else {
                return "Error: Could not delete row.";
            }
        } catch (PDOException $e) {
            return "Error deleting row: " . $e->getMessage();
        }
    }
    public function getAuthorBooks(): array {
        if (!isset($_SESSION['user_id'])) {
          return [];
        }

        $authorId = $_SESSION['user_id'];
        global $conn;

        $query = "SELECT 
    b.id, 
    b.title, 
    array_to_string((string_to_array(b.description, ' '))[1:4], ' ') AS description, 
    b.price, 
    b.image 
FROM 
    books b
JOIN 
    actor_book ab ON b.id = ab.books_id
WHERE 
    ab.actors_id = $1
";

        $result = pg_query_params($conn, $query, [$authorId]);

        $books = [];
        while ($row = pg_fetch_assoc($result)) {
            $books[] = new BooksDTO(
                $row['id'], 
                $row['title'], 
                $row['description'], 
                floatval($row['price']), 
                $row['image'], 
                '' // Author is not fetched here
            );
        }

        return $books;
    }

    
}
