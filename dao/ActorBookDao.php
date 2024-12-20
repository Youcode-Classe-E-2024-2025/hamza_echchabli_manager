<?php

// require_once '../config/databaseConfig.php';
class ActorBookDao {
    

    // Create a row in actor_book
    public function createActorBook($actorId, $bookId) {
        global $conn;
        try {
            $query = "INSERT INTO actor_book (actor_id, book_id) VALUES ($1, $2)";
            $result = pg_query_params($conn, $query, [$actorId, $bookId]);

            return "Row added successfully.";
        } catch (PDOException $e) {
            return "Error adding row: " . $e->getMessage();
        }
    }

    
}
