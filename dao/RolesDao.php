<?php
require_once '../config/databaseConfig.php';
require_once '../dto/RolesDTO.php';

class RolesDAO {

    
    public function getActorRole(string $email): ?string {
        global $conn;
        $query = "SELECT * FROM roles WHERE name = $1";
        $result = pg_query_params($conn, $query, [$email]);
        
        if ($row = pg_fetch_assoc($result)) {
            
            return $row['role_name'];
        }
        return null; 
    }

    public function createRole(RolesDTO $role): bool {
        global $conn;
        $query = "INSERT INTO roles (name, role_name) VALUES ($1, $2)";
        $result = pg_query_params($conn, $query, [$role->getName(),$role->getRN() ]);
        
        return $result !== false;
    }

    public function updateRole($email,$role) {
        global $conn;
        $query = "UPDATE roles SET role_name = $1 WHERE name = $2";
        $result = pg_query_params($conn, $query, [$role , $email]);
        
    }

   
}
?>
