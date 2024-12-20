<?php  
include('../dao/BooksDao.php');
include('../dto/BooksDto.php');
include('../dao/ActorBookDao.php');
include '../config/databaseConfig.php';
// include '../dto/BooksDTO.php';
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
    <a href="index.php" class="text-2xl font-bold text-gray-800 hover:text-blue-500">
        Librairie
    </a>

    <a href="../service/logout.php"
        class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
        Log out
    </a>



</header>
<div class="form-container">
        <h2>Add a Book</h2>
        <form action="../controller/booksController.php" method="POST">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8') ?>">
            <div class="form-group">
                <label for="title">Book Title</label>
                <input type="text" id="title" name="title" placeholder="Enter book title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Enter book description"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" placeholder="Enter book price" required>
            </div>
            
            <div class="form-group">
                <label for="image">Image URL</label>
                <input type="url" id="image" name="image" placeholder="Enter image URL">
            </div>
            <div class="form-group">
                <button type="submit">Add Book</button>
            </div>
        </form>
</body>
</html>