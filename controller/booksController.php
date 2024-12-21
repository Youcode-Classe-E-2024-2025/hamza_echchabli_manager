<?php
// include_once('../dao/BooksDao.php');
// include_once('../dto/BooksDto.php');
// include_once('../dao/ActorBookDao.php');
// require_once '../config/databaseConfig.php';


class BooksController {

private $BooksDao;

private $actorBookDao ;


public function __construct() {  
    $this->BooksDao = new BooksDAO();
    $this->actorBookDao =new ActorBookDao();
}

public function getBooks() {
   
    
    $books = $this->BooksDao->getAllBooks();
     
   return $books ;
   }


public function addBB($book){
     
    $books_id = $this->BooksDao->createBook($book);
    session_start();
    $this->actorBookDao->createActorBook($_SESSION['user_id'] ,intval($books_id));
    
    
    

}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $price = floatval($_POST['price']);
    $image = htmlspecialchars($_POST['image']);
    $author_id=htmlspecialchars($_POST['user_id']);
    $book = new BooksDTO(0, $title, $description, $price, $image, ' ');
    $booksController = new BooksController();
    $booksController->addBB($book);
    
    // $books_id = $this->BooksDao->createBook($book);

    // $this->$actorBookDao->createActorBook($_SESSION['user_id'] ,$books_id);
    
    header('Location: ../index.php');
    exit();
} 
?>

