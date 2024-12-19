<?php

 
session_start();

if (!isset($_SESSION['user']) || !$_SESSION['user']=='admin') {
       
   header('Location: ../index.php');
    exit();
}


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
    <link rel="stylesheet" href="../css/style.css">
    <script src="./js/script.js" defer></script>
    <style>
        .hidden-section {
            display: none;
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

        <!-- Navigation -->
        <div class="flex justify-between" id="Hnav">
            <a href="dash.php" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Dashboard
            </a>
            <a href="../service/logout.php" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Log out
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex min-h-screen mt-2">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md ml-2">
            <ul class="space-y-2 p-4">
                <li>
                    <button id="users-accounts-btn" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Users Accounts
                    </button>
                </li>
                <li>
                    <button id="new-accounts-btn" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                        New Accounts
                    </button>
                </li>
                <li>
                    <button id="archived-accounts-btn" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                        Archived Accounts
                    </button>
                </li>
            </ul>
        </aside>

        <!-- Main Section -->
        <main class="flex-grow p-6 bg-gray-100">
            <!-- Users Accounts Section -->
            <section id="users-accounts" class="">
            <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>validation</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <!-- getNewdAC -->
        
        <?php

        include_once("../controller/ActorsController.php");
        include_once("../dto/ActorsDto.php");

        $AA= new ActorsController();

        $res = $AA->getconfirmedAC();

if ($res) {
    foreach ($res as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row->getId()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getName()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getEmail()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getState()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getRole()) . "</td>";
        echo "<td class='BTNCon'>";
        echo "<a class='edit-btn'>Edit</a>";
        echo "<a class='delete-btn'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No results found.</td></tr>";
}
?>

            
        </tbody>
    </table>
            </section>

            <!-- New Accounts Section -->
            <section id="new-accounts" class="hidden-section">
            <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>validation</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php

// include_once("../controller/ActorsController.php");
// include_once("../dto/ActorsDto.php");



$resN = $AA->getNewdAC();

        if ($resN) {
        foreach ($resN as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row->getId()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getName()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getEmail()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getState()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getRole()) . "</td>";
        echo "<td class='BTNCon'>";
        echo "<a class='edit-btn'>Edit</a>";
        echo "<a class='delete-btn'>Delete</a>";
        echo "</td>";
        echo "</tr>";
        }
        } else {
        echo "<tr><td colspan='6'>No results found.</td></tr>";
        }
        ?>

    
</tbody>
</table>
            </section>

            <!-- Archived Accounts Section -->
            <section id="archived-accounts" class="hidden-section">
                <h1 class="text-2xl font-bold mb-4">Archived Accounts</h1>
                <p>List of archived accounts goes here...</p>
            </section>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        // Selectors
        const usersAccountsBtn = document.getElementById('users-accounts-btn');
        const newAccountsBtn = document.getElementById('new-accounts-btn');
        const archivedAccountsBtn = document.getElementById('archived-accounts-btn');

        const usersAccountsSection = document.getElementById('users-accounts');
        const newAccountsSection = document.getElementById('new-accounts');
        const archivedAccountsSection = document.getElementById('archived-accounts');

        // Event Listeners
        usersAccountsBtn.addEventListener('click', () => {
            showSection(usersAccountsSection);
        });

        newAccountsBtn.addEventListener('click', () => {
            showSection(newAccountsSection);
        });

        archivedAccountsBtn.addEventListener('click', () => {
            showSection(archivedAccountsSection);
        });

        // Function to Show Only the Selected Section
        function showSection(section) {
            // Hide all sections
            usersAccountsSection.classList.add('hidden-section');
            newAccountsSection.classList.add('hidden-section');
            archivedAccountsSection.classList.add('hidden-section');

            // Show the selected section
            section.classList.remove('hidden-section');
        }
    </script>
</body>
</html>
