<?php  
include_once('../controller/booksController.php');
include_once('../dao/BooksDao.php');
include_once('../dto/BooksDto.php');
include_once('../dao/ActorBookDao.php');
require_once '../config/databaseConfig.php';
session_start();

?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
    .form-container {
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            margin: auto;
            margin-top: 40px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            background: #007BFF;
            color: #fff;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .form-group button:hover {
            background: #0056b3;
        }
        </style>
</head>

<body class="bg-gray-100">

<!-- Header Section -->
<header class="flex justify-between items-center px-6 py-4 bg-white shadow-md">
    <!-- Logo -->
    <a href="../index.php" class="text-2xl font-bold text-gray-800 hover:text-blue-500">
        Librairie
    </a>

    <div class="flex justify-between " id="Hnav">

            <a href="addBooks.php" class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Add Book</a>
    <a href="deleteBook.php" class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Delete Book</a>

        <a href="../service/logout.php" class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Log out</a>






        </div>
    



</header>
<div class="form-container">
        <h2>Add a Book</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="title">Book Title</label>
                <input type="text" id="title" name="title" placeholder="Enter book title" required>
            </div>
          
            
           
            <div class="form-group">
                <button type="submit">delete Book</button>
            </div>
        </form>
</body>
</html>
<?PHP  








if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $title = $_POST['title'];
   
    $booksController = new BooksController();
   $res = $booksController->deleteOne($title);
   if($res == false){
    echo'<script> alert("this book title doesnt exist") </script>';

   }else{
    echo'<script> alert("success") </script>';
   }
    
    
    
} ?>