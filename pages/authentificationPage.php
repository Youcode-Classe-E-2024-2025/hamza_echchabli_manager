

<?php
// Start session at the beginning of the script
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
    <link rel="stylesheet" href="../css/output.css">
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <style>
       
        .container {

            background-color: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 384px;
            margin: auto;
        }
        .text-2xl {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
        }
        .space-y-4 > * + * {
            margin-top: 1rem;
        }
        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
        }
        input[type="email"], input[type="password"], input[type="text"] {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            box-sizing: border-box;
        }
        input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 1px #3b82f6;
        }
        button {
            width: 100%;
            padding: 0.5rem;
            background-color: #3b82f6;
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #2563eb;
        }
        p {
            text-align: center;
            font-size: 0.875rem;
            color: #4b5563;
        }
        a {
            color: #3b82f6;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .hidden {
            display: none;
        }
    </style>
   
</head>
<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="flex justify-between items-center px-6 py-4 bg-white shadow-md mb-10">
        <!-- Logo -->
        <a href="../index.php" class="text-2xl font-bold text-gray-800 hover:text-blue-500">
            Librairie
        </a>

        <!-- Login Button -->
        <div>
            <a href="../pages/authentificationPage.php" class=" mr-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Log In
            </a>
        </div>
    </header>

    <!-- Form Container -->
    <div class="container  flex justify-center items-center  ">
        <!-- Login Form -->
        <form id="login-form" action="../controller/ActorsController.php" class="space-y-4" method="POST">
            <h2 class="text-2xl">Login</h2>
            <input for="register" name="login" class="hidden">
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit">Log In</button>
            <p>
                Don't have an account? <a href="#" id="show-register">Go to Register</a>
            </p>
        </form>

        <!-- Register Form (Hidden by Default) -->
        <form id="register-form" action="../controller/ActorsController.php" class="space-y-4 hidden" method="POST">
            <h2 class="text-2xl">Register</h2>
            <input for="register" name="register" class="hidden">
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div>
                <label for="email-register">Email</label>
                <input type="email" id="email-register" name="email" placeholder="Enter your email" required>
            </div>
            <div>
                <label for="password-register">Password</label>
                <input type="password" id="password-register" name="password" placeholder="Create a password" required>
            </div>
            <div>
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
            </div>
            <button type="submit">Register</button>
            <p>
                Already have an account? <a href="#" id="show-login">Go to Login</a>
            </p>
        </form>
    </div>

    <?php
    
    if (isset($_SESSION['res'])) {
       
        // Output the session message as a JavaScript alert
        echo '<script>alert("' . htmlspecialchars($_SESSION['res'], ENT_QUOTES, 'UTF-8') . '");</script>';
        // Clear the message after displaying
        unset($_SESSION['res']);
    }
    ?>
    <script src="../js/script.js"></script> 
</body>
</html>
