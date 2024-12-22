<?php
require_once '../dao/ArchiveDao.php';
require_once '../dto/ArchiveDTO.php';

class ArchiveController {

    private $archiveDao;

    public function __construct() {
        $this->archiveDao = new ArchiveDao();
    }

    public function getAllArchives() {
        $archives = $this->archiveDao->getAll(); 
        include 'views/archiveList.php'; 
    }

    public function createArchive() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
            $email = $_POST['email'];
            $archive = new ArchiveDTO(null, $email); 
            $success = $this->archiveDao->createArchive($archive); 
            
            if ($success) {
                header("Location: index.php?action=getAllArchives"); 
                exit();
            } else {
            
                echo "Failed to create archive.";
            }
        } else {
            include 'views/createArchiveForm.php'; 
        }
    }

    public function deleteArchive($id) {
        $success = $this->archiveDao->deleteArchive($id); 
        
        if ($success) {
            header("Location: index.php?action=getAllArchives"); 
            exit();
        } else {
           
            echo "Failed to delete archive.";
        }
    }

}
?>
