<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librairie</title>
    <!-- Link to Tailwind CSS -->
    <link href="./css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/output.css">
    <script src="./js/script.js" defer></script>
</head>
<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="flex justify-between items-center px-6 py-4 bg-white shadow-md">
        <!-- Logo -->
        <a href="../index.php" class="text-2xl font-bold text-gray-800 hover:text-blue-500">
            Librairie
        </a>

        <!-- Login Button -->
        <div>
            <a href="login.php" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Log In
            </a>
        </div>
    </header>

    <!-- Form Container -->
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <!-- Login Form -->
            <form id="login-form"  action="../controller/ActorsController.php" class="space-y-4" method="POST">
                <h2 class="text-2xl font-bold text-gray-800">Login</h2>
                <input for="register" name="login" class="hidden">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" 
                           placeholder="Enter your email" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" 
                           placeholder="Enter your password" required>
                </div>
                <button type="submit" 
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">
                    Log In
                </button>
                <p class="text-sm text-center text-gray-600">
                    Don't have an account? <a href="#" id="show-register" class="text-blue-500 hover:underline">Go to Register</a>
                </p>
            </form>

            <!-- Register Form (Hidden by Default) -->
            <form id="register-form"  action="../controller/ActorsController.php"  class="space-y-4 hidden" method="POST">
                <h2 class="text-2xl font-bold text-gray-800">Register</h2>
                <input for="register" name="register" class="hidden">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" 
                           placeholder="Enter your name" required>
                </div>
                <div>
                    <label for="email-register" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email-register" name="email" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" 
                           placeholder="Enter your email" required>
                </div>
                <div>
                    <label for="password-register" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password-register" name="password" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" 
                           placeholder="Create a password" required>
                </div>
                <div>
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" 
                           placeholder="Confirm your password" required>
                </div>
                <button type="submit" 
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">
                    Register
                </button>
                <p class="text-sm text-center text-gray-600">
                    Already have an account? <a href="#" id="show-login" class="text-blue-500 hover:underline">Go to Login</a>
                </p>
            </form>
        </div>
    </div>


    <script src="../js/script.js"></script>
</body>
</html>
