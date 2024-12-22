<?php
include_once('dao/BooksDao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $price = floatval($_POST['price']);
    $author = htmlspecialchars($_POST['author']);
    $image = htmlspecialchars($_POST['image']);

    try {
        global $conn;

        $authorQuery = "SELECT id FROM public.actors WHERE name = $1";
        $authorResult = pg_query_params($conn, $authorQuery, [$author]);
        if ($authorRow = pg_fetch_assoc($authorResult)) {
            $authorId = $authorRow['id'];
        } else {
            $insertAuthorQuery = "INSERT INTO public.actors (name) VALUES ($1) RETURNING id";
            $insertResult = pg_query_params($conn, $insertAuthorQuery, [$author]);
            $authorId = pg_fetch_result($insertResult, 0, 'id');
        }

        $bookQuery = "INSERT INTO public.books (title, description, price, image) VALUES ($1, $2, $3, $4) RETURNING id";
        $bookResult = pg_query_params($conn, $bookQuery, [$title, $description, $price, $image]);
        $bookId = pg_fetch_result($bookResult, 0, 'id');

        $linkQuery = "INSERT INTO public.actor_book (actors_id, books_id) VALUES ($1, $2)";
        pg_query_params($conn, $linkQuery, [$authorId, $bookId]);

        echo "Book added successfully!";
    } catch (Exception $e) {
        echo "Error adding book: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
