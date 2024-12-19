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
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collect data from the registration form
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Call the service to handle registration logic
            $result = $this->actorsService->registerActor($name, $email, $password);
           
            // Handle the response (e.g., show a success message or error)
            if($result == 'email'){
               
                $_SESSION['res'] = 'email already exist';
                header('Location: ../pages/authentificationPage.php');
                
                exit();
                
            }else if($result == 'error'){
               
               
                $_SESSION['res'] = 'something went wrong please try again';
                header('Location: ../pages/authentificationPage.php');
                exit();


            }else {
               
                $_SESSION['res'] = 'your account has been created wait for admin validation ';
                header('Location: ../pages/authentificationPage.php');
                exit();
            } 

           
        }
    }

    // Login actor

    public function getconfirmedAC(){
          $res = $this->actorsService->getconfirmedA();
          return $res;
    }
    public function getNewdAC(){
        $res = $this->actorsService->getNewA();
        return $res;
  }



    public function loginActor() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collect data from the login form
            $email = $_POST['email'] ;
            $password = $_POST['password'] ;
            

            // Call the service to handle login logic
            $result = $this->actorsService->loginActor($email, $password);
            session_start();
            if($result == 'not comfirmed'){
               
                $_SESSION['res'] = 'your account is not comfirmed';
                
                header('Location: ../pages/authentificationPage.php');
                
                exit();
                
            }else if($result == 'wrong password' || $result=="this account doesn't exist"){
               
               
                $_SESSION['res'] = 'something went wrong please try again';
               
                header('Location: ../pages/authentificationPage.php');
                exit();


            }else {
                $_SESSION['user'] = $result;
               
                header('Location: ../index.php');
                exit();
            } 
            // Handle the response (e.g., show success or error)
           
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
