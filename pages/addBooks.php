<?php  
include_once('../dao/BooksDao.php');
include_once('../dto/BooksDto.php');
include_once('../dao/ActorBookDao.php');
require_once '../config/databaseConfig.php';
include_once('../controller/booksController.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $price = floatval($_POST['price']);
    $image = htmlspecialchars($_POST['image']);
    $author_id=htmlspecialchars($_POST['user_id']);
    $book = new BooksDTO(0, $title, $description, $price, $image, ' ');
    $booksController = new BooksController();
    $booksController->addBB($book);
    
    
    
    
} ?>




<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/AddBookStyling.css">
    
</head>

<body class="bg-gray-100">

<header class="flex justify-between items-center px-6 py-4 bg-white shadow-md">
 
    <a href="../index.php" class="text-2xl font-bold text-gray-800 hover:text-blue-500">
        Librairie
    </a>

    <!-- <a href="../service/logout.php"
        class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
        Log out
    </a> -->
    <div class="flex justify-between " id="Hnav">

            <a href="addBooks.php" class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Add Book</a>
    <a href="deleteBook.php" class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Delete Book</a>

        <a href="../service/logout.php" class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Log out</a>






        </div>
    



</header>
<main class="pageContent">
<div class="form-container">
        

       
         

        
        <h2>Add a Book</h2>
        <form id="ADD_FORM" action="" method="POST">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8') ?>">
            <div class="form-group">
                <label for="title">Book Title</label>
                <input type="text" id="title" name="title" placeholder="Enter book title" >
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Enter book description"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" placeholder="Enter book price" >
            </div>
            
            <div class="form-group">
                <label for="image">Image URL</label>
                <input  id="image" name="image" placeholder="Enter image URL">
            </div>
            <div class="form-group">
                <button type="submit">Add Book</button>
            </div>
        </form>
    </div>


    <div class="author_books_container">
        <h1> Your Books</h1>
 <?php  
        $BooksController = new BooksController();
        $books = $BooksController->getMyBooks();
        
        ?>
        <section class="author_books" id="books_display">
            
        <?php if (empty($books)): ?>
            <p>No books found for this author.</p>
        <?php else: ?>
            <?php foreach ($books as $book): ?>
                <div class="book-card">
                    <img src="<?php echo $book->getImage(); ?>" alt="Book Cover" class="book-cover">
                    <h3 class="book-title"><?php echo htmlspecialchars($book->getTitle()); ?></h3>
                    <p class="book-description"><?php echo htmlspecialchars($book->getDescription()); ?></p>
                    <p class="book-price">$<?php echo number_format($book->getPrice(), 2); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

       

        </section>
    </div>

</main>












<script src="../js/script.js"></script>

</body>
</html>
<?PHP  








// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
//     $title = htmlspecialchars($_POST['title']);
//     $description = htmlspecialchars($_POST['description']);
//     $price = floatval($_POST['price']);
//     $image = htmlspecialchars($_POST['image']);
//     $author_id=htmlspecialchars($_POST['user_id']);
//     $book = new BooksDTO(0, $title, $description, $price, $image, ' ');
//     $booksController = new BooksController();
//     $booksController->addBB($book);
    
    
    
//     header('Location: ../index.php');
//     exit();
// }
 ?>