<?php
// Start session at the beginning of the script
include('dao/BooksDao.php');
include('dto/BooksDto.php');
include('dao/ActorBookDao.php');
require 'config/databaseConfig.php';

include_once("sql/create.php");

session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librairie</title>
    
    <link rel="stylesheet" href="css/output.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body class="bg-gray-100">


    <header class="flex justify-between items-center px-6 py-4 bg-white shadow-md">
       
        <a href="index.php" class="text-2xl font-bold text-gray-800 hover:text-blue-500">
            Librairie
        </a>

        <div class="flex justify-between " id="Hnav">

        <?php if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin'): ?>
    <a href="pages/dash.php"
        class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Dashboard</a>
    <a href="service/logout.php"
        class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Log out</a>
<?php elseif (isset($_SESSION['user']) && $_SESSION['user'] == 'customer'): ?>
    <a href="service/logout.php"
        class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Log out</a>
<?php elseif (isset($_SESSION['user']) && $_SESSION['user'] == 'author'): ?>
    <a href="pages/addBooks.php"
        class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Add Book</a>
    <a href="pages/deleteBook.php"
        class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Delete Book</a>

        <a href="service/logout.php"
        class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Log out</a>
<?php elseif (!isset($_SESSION['user'])): ?>
    <a href="pages/authentificationPage.php"
        class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Log In</a>
<?php endif; ?>






        </div>
    </header>

    <main class="formC">


    <section class="search-bar">
  <input 
    type="text" 
    placeholder="Search for books..." 
    class="search-input"
  >
</section>

<section class="book-cards mTop">
  
  <?php 
  include_once('controller/booksController.php');
   $b=new BooksController() ;
  $boosRes= $b->getBooks() ;
  
  
  foreach ($boosRes as $book): ?>
       
            <div class="book-card">
                <img src="<?php echo $book->getImage(); ?>" alt="Book Cover" class="book-cover">
                <h3 class="book-title"><?php echo htmlspecialchars($book->getTitle()); ?></h3>
                <p class="book-author"><?php echo htmlspecialchars($book->getAuthor()); ?></p>
                <p class="book-author">test</p>
                <p class="book-price">$<?php echo number_format($book->getPrice(), 2); ?></p>
            </div>
        <?php endforeach; ?>

</section>

    
    </main>



</body>

</html>