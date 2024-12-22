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
  
    
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        .hidden-section {
            display: none;
        }
        main{
            width: 70%;
            margin-left: 10%;
        }
    </style>
</head>
<body class="bg-gray-100">

    <header class="flex justify-between items-center px-6 py-4 bg-white shadow-md">
    
        <a href="../index.php" class="text-2xl font-bold text-gray-800 hover:text-blue-500">
            Librairie
        </a>

      
        <div class="flex justify-between" id="Hnav">
            <a href="dash.php" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Dashboard
            </a>
            <a href="../service/logout.php" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                Log out
            </a>
        </div>
    </header>

    <div class="flex min-h-screen mt-2">
   
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

        <main class="flex-grow p-6 bg-gray-100">
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
        echo "<td>
    <form action='../controller/ActorsController.php' method='POST'>
        <input type='hidden' name='email' value='" . htmlspecialchars($row->getEmail(), ENT_QUOTES, 'UTF-8') . "'>
        <select name='role' class='role-select'>
            <option value='' disabled selected>".$row->getRole()."</option>
        <option value='admin'>admin</option>
        <option value='customer'>customer</option>
        <option value='author'>author</option>
        </select>
        <button type='submit' name='changeRole' class='delete-btn'>Change Role</button>
    </form>
</td>";

        echo "<td class='BTNCon'>";
        echo "<form method='POST' action='../controller/ActorsController.php'>";
echo "    <input type='hidden' name='email' value='" .$row->getEmail() . "'>";
echo "    <button type='submit' name='block' class='edit-btn'>Block</button>";
echo "    <button type='submit' name='archive' class='delete-btn'>Archive</button>";
echo "</form>";
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
        echo "<form method='POST' action='../controller/ActorsController.php'>";
        echo "    <input type='hidden' name='email' value='" .$row->getEmail(). "'>";
        echo "    <button type='submit' name='block' class='edit-btn'>confirm</button>";
       
        echo "</form>";
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

            <section id="archived-accounts" class="hidden-section">
            <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
               
                
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php

// include_once("../controller/ActorsController.php");
// include_once("../dto/ActorsDto.php");



$resAR = $AA->getarchivedACC();

        if ($resAR) {
        foreach ($resAR as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row->getId()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getName()) . "</td>";
        echo "<td>" . htmlspecialchars($row->getEmail()) . "</td>";
      
       
        echo "<td class='BTNCon'>";
        echo "<form method='POST' action='../controller/ActorsController.php'>";
        echo "    <input type='hidden' name='email' value='" .$row->getEmail(). "'>";
        echo "    <button type='submit' name='unarchive' class='edit-btn'>unbanne</button>";
       
        echo "</form>";
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
            
        </main>

    </div>
    
   <script src="../js/dash.js"></script>
</body>
</html>
   