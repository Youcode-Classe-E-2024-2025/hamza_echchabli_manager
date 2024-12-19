<?php
require_once '../dao/ArchiveDao.php';
require_once '../dto/ArchiveDTO.php';

class ArchiveController {

    private $archiveDao;

    public function __construct() {
        // Instantiate the ArchiveDao class
        $this->archiveDao = new ArchiveDao();
    }

    // Fetch all archive entries
    public function getAllArchives() {
        $archives = $this->archiveDao->getAll(); // Fetch all archives from the DAO
        include 'views/archiveList.php'; // Pass the data to a view (change as needed)
    }

    // Create a new archive entry
    public function createArchive() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
            $email = $_POST['email'];
            $archive = new ArchiveDTO(null, $email); // Create a new ArchiveDTO
            $success = $this->archiveDao->createArchive($archive); // Insert the archive record
            
            if ($success) {
                header("Location: index.php?action=getAllArchives"); // Redirect on success
                exit();
            } else {
                // Handle failure (you can set a message or show an error)
                echo "Failed to create archive.";
            }
        } else {
            include 'views/createArchiveForm.php'; // Display the form to create an archive entry
        }
    }

    // Delete an archive entry
    public function deleteArchive($id) {
        $success = $this->archiveDao->deleteArchive($id); // Delete the archive record by ID
        
        if ($success) {
            header("Location: index.php?action=getAllArchives"); // Redirect on success
            exit();
        } else {
            // Handle failure (you can set a message or show an error)
            echo "Failed to delete archive.";
        }
    }
}
?>
