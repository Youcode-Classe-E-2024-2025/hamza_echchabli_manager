<?php
require_once '../config/databaseConfig.php';
require_once '../dto/ArchiveDTO.php';

class ArchiveDao {

    // Method to fetch all records from the 'archive' table
    public function getAll(): array {
        global $conn;
        $query = "SELECT * FROM archive";
        $result = pg_query($conn, $query);
        
        $archives = [];
        while ($row = pg_fetch_assoc($result)) {
            $archives[] = new ArchiveDTO($row['id'], $row['email']);
        }
        return $archives;
    }
    public function createArchive(string $email): bool {
        global $conn;
        $query = "INSERT INTO archive (email) VALUES ($1)";
        $result = pg_query_params($conn,$query,[$email]);
        return $result !== false;       
    }

    // Method to delete an archive entry by its ID
    public function deleteArchive(string $email): bool {
        global $conn;
        $query = "DELETE FROM archive WHERE email = $1";
        $result = pg_query_params($conn, $query, [$email]);
        return $result !== false;
    }
}
?>
