<?php
include_once('dao/BooksDao.php');

class BooksController {

private $BooksDao;

public function __construct() {  
    $this->BooksDao = new BooksDAO();
}

public function getBooks() {
   
    
    $books = $this->BooksDao->getAllBooks();
     
   return $books ;
   }
}

?>