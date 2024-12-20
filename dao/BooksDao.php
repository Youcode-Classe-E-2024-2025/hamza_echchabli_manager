<?php
require_once 'config/databaseConfig.php';
require_once 'dto/BooksDTO.php';

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
           
            $books[] = new BooksDTO(
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
    

    public function getBookById(int $id): ?BooksDTO {
        global $conn;
        $query = "SELECT * FROM books WHERE id = $1";
        $result = pg_query_params($conn, $query, [$id]);
        
        if ($row = pg_fetch_assoc($result)) {
            return new BooksDTO($row['id'], $row['title'], $row['description'], $row['price'], $row['image']);
        }
        return null;
    }

    public function createBook(BooksDTO $book): bool {
        global $conn;
        $query = "INSERT INTO books (title, description, price, image) VALUES ($1, $2, $3, $4)";
        $result = pg_query_params($conn, $query, [
            $book->getTitle(),
            $book->getDescription(),
            $book->getPrice(),
            $book->getImage()
        ]);
        return $result !== false;
    }

    public function updateBook(BooksDTO $book): bool {
        global $conn;
        $query = "UPDATE books SET title = $1, description = $2, price = $3, image = $4 WHERE id = $5";
        $result = pg_query_params($conn, $query, [
            $book->getTitle(),
            $book->getDescription(),
            $book->getPrice(),
            $book->getImage(),
            $book->getId()
        ]);
        return $result !== false;
    }

    public function deleteBook(int $id): bool {
        global $conn;
        $query = "DELETE FROM books WHERE id = $1";
        $result = pg_query_params($conn, $query, [$id]);
        return $result !== false;
    }
}
?>
