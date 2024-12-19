<?php
// Start session at the beginning of the script

// include_once("pages/dash.php");
session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librairie</title>
    <!-- Link to Tailwind CSS -->
    <link href="./css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="css/output.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="./js/script.js" defer></script>
</head>

<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="flex justify-between items-center px-6 py-4 bg-white shadow-md">
        <!-- Logo -->
        <a href="index.php" class="text-2xl font-bold text-gray-800 hover:text-blue-500">
            Librairie
        </a>

        <!-- Login Button -->
        <div class="flex justify-between " id="Hnav">

            <?php if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin'): ?>
                <a href="pages/dash.php"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Dashboard</a>
                <a href="service/logout.php"
                    class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Log
                    out</a>
            <?php elseif (isset($_SESSION['user']) && $_SESSION['user'] == 'customer'): ?>
                <a href="service/logout.php"
                    class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Log
                    out</a>
            <?php elseif (!isset($_SESSION['user'])): ?>
                <a href="pages/authentificationPage.php"
                    class="ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Log
                    In</a>
            <?php endif; ?>





        </div>
    </header>

    <main class="formC">
        test
    </main>



</body>

</html>