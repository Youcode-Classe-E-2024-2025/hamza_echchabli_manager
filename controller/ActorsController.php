<?php

include_once '../service/ActorsService.php';
include_once '../dto/ActorsDto.php';
require_once '../dao/ArchiveDao.php';
require_once '../dto/ArchiveDTO.php';

class ActorsController {
    
    private $actorsService;
    private $archiveDao;
    

    public function __construct() {
        $this->actorsService = new ActorsService();
        $this->archiveDao = new ArchiveDao();
    }

  
    public function registerActorC() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         
            
            $name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
            

            $result = $this->actorsService->registerActor($name, $email, $password);
           
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


  public function getarchivedACC(){
    $res= $this->actorsService->archivedOne();
    return $res;
  }

  public function setAstate($email ){
    $this->actorsService->setState($email);
    
    header('Location: ../pages/dash.php');
    exit();
  }

  public function setRole($email ,$role){
    $this->actorsService->setRole($email , $role);

    
    
    header('Location: ../pages/dash.php');
    exit();
  }
  
    public function addArchive($email){
        $this->archiveDao->createArchive($email);
    }



    public function  unbane($value){
    
    $this->archiveDao->deleteArchive($value);
}

    public function loginActor() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
            $email =  htmlspecialchars($_POST['email']  ?? '', ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password']  ?? '', ENT_QUOTES, 'UTF-8');
            

            $result = $this->actorsService->loginActor($email, $password);
            session_start();
            if($result == 'not comfirmed'){
               
                $_SESSION['res'] = 'your account is not comfirmed or banned';
                
                header('Location: ../pages/authentificationPage.php');
                
                exit();
                
            }else if($result == 'wrong password' || $result=="this account doesn't exist"){
               
               
                $_SESSION['res'] = 'something went wrong please try again';
               
                header('Location: ../pages/authentificationPage.php');
                exit();


            }else {
                $_SESSION['user'] = $result[0];
                $_SESSION['user_id'] = $result[1];
                header('Location: ../index.php');
                exit();
            } 
           
        }
    }
}

$controller = new ActorsController();

if (isset($_POST['register'])) {
    echo"work inside" ;
   
    $controller->registerActorC();
    
}



if (isset($_POST['login'])) {
    $controller->loginActor();
}


if (isset($_POST['unarchive'])) {
    $value=$_POST['email'];
   
    $controller->unbane($value);

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        if (isset($_POST['changeRole']) && isset($_POST['role'])) {
           
          $role = $_POST['role'] ;
        
          $controller->setRole($email ,$role);

        } elseif (isset($_POST['block'])) {
         
            $controller->setAstate($email);
        } elseif (isset($_POST['archive'])) {


          $controller->addArchive($email);

            header('Location: ../pages/dash.php');
                
            exit();
            
        } else {
            header('Location: ../pages/dash.php');
                
            exit();
        }
    } else {
        header('Location: ../pages/dash.php');
                
        exit();
    }
}


?>
