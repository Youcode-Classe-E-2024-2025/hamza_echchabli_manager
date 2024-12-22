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
    
    $this->actorBookDao->createActorBook($_SESSION['user_id'] ,intval($books_id));
    
    
    

}

public function getMyBooks(){
    
   return $this->actorBookDao->getAuthorBooks();
}



public function ifExist($title){

    $res = $this->BooksDao->getBookByTitle($title);
    return $res;
 
}

public function deleteOne($title){

    $result = $this->BooksDao->getBookByTitle($title);
    if (!$result) {
        return false ;
    }

    $res = $this->BooksDao->deleteBook($title);
    return $res;
 
}


}




 ?>

