<?php


class BooksDAO {

    public function getAllBooks(): array {
        global $conn;
        $query = "SELECT 
                    b.id,
                    b.image AS book_image,
                    b.title AS book_title, 
                    a.name AS author_name,
                    b.price AS book_price
                  FROM 
                    public.books b
                  JOIN 
                    public.actor_book ba ON b.id = ba.books_id
                  JOIN 
                    public.actors a ON ba.actors_id = a.id
                  ORDER BY 
                    b.title;
        ";
        
        $result = pg_query($conn, $query);
        
        $books = [];
        while ($row = pg_fetch_assoc($result)) {
           
            $books[] = new BooksDto(
                $row['id'], 
                $row['book_title'], 
                 'test',
                floatval($row['book_price']), 
                $row['book_image'], 
                $row['author_name']
            );
        }
        return $books;
    }
    

    public function getBookByTitle(string $title): bool {
        global $conn;
        $query = "SELECT * FROM books WHERE title = $1";
        $result = pg_query_params($conn, $query, [$title]);
        
        if ($row = pg_fetch_assoc($result)) {
           return  true ;
        }
        return false;
    }

    public function createBook(BooksDTO $book): ?string {
        global $conn;
    
        // Check if a book with the same title already exists
        $checkQuery = "SELECT id FROM books WHERE title = $1";
        $checkResult = pg_query_params($conn, $checkQuery, [$book->getTitle()]);
        
        if ($existingBook = pg_fetch_assoc($checkResult)) {
            // If the book exists, return its ID
            return $existingBook['id'];
        }
    
        // Insert the new book
        $query = "INSERT INTO books (title, description, price, image) VALUES ($1, $2, $3, $4) RETURNING id";
        $result = pg_query_params($conn, $query, [
            $book->getTitle(),
            $book->getDescription(),
            $book->getPrice(),
            $book->getImage()
        ]);
    
        if (!$result) {
            // Handle insertion failure
            throw new Exception("Failed to insert book: " . pg_last_error($conn));
        }
    
        // Fetch and return the newly inserted book's ID
        $row = pg_fetch_assoc($result);
        return $row['id'];
    }
    

    public function updateBook(BooksDTO $book): bool {
        global $conn;
        $query = "UPDATE books SET title = $1, description = $2, price = $3, image = $4 WHERE id = $5 ";
        $result = pg_query_params($conn, $query, [
            $book->getTitle(),
            $book->getDescription(),
            $book->getPrice(),
            $book->getImage(),
            $book->getId()
        ]);
        return $result !== false;
    }

    public function deleteBook(string $title): bool {
        global $conn;
        $query = "DELETE FROM books WHERE title = $1 RETURNING id";
        $result = pg_query_params($conn, $query, [$title]);
        return $result !== false;
    }
}
?>
