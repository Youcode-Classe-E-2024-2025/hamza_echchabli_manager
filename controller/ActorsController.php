<?php
// Include the service and necessary files
include_once '../service/ActorsService.php';
include_once '../dto/ActorsDto.php';

class ActorsController {

    private $actorsService;

    public function __construct() {
        $this->actorsService = new ActorsService();
    }

    // Register actor
    public function registerActorC() {
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collect data from the registration form
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Call the service to handle registration logic
            $result = $this->actorsService->registerActor($name, $email, $password);

            // Handle the response (e.g., show a success message or error)
            echo $result;
        }
    }

    // Login actor
    public function loginActor() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collect data from the login form
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Call the service to handle login logic
            $result = $this->actorsService->loginActor($email, $password);

            // Handle the response (e.g., show success or error)
            echo $result['message'];
        }
    }
}

// Handle form submissions
$controller = new ActorsController();

// Register form submission
if (isset($_POST['register'])) {
    echo"work inside" ;
   
    $controller->registerActorC();
    
}

// Login form submission
if (isset($_POST['login'])) {
    $controller->loginActor();
}
?>
