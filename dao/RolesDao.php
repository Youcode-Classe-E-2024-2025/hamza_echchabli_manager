<?php
require_once '../config/databaseConfig.php';
require_once '../dto/RolesDTO.php';

class RolesDAO {

    // Retrieve all roles from the database
    public function getAllRoles(): array {
        global $conn;
        $query = "SELECT * FROM roles";
        $result = pg_query($conn, $query);
        
        $roles = [];
        while ($row = pg_fetch_assoc($result)) {
            // Pass the role_name as well
            $roles[] = new RolesDTO($row['id'], $row['name'], $row['role_name']);
        }
        return $roles;
    }

    // Retrieve a specific role by its ID
    public function getActorRole(string $email): ?string {
        global $conn;
        $query = "SELECT * FROM roles WHERE name = $1";
        $result = pg_query_params($conn, $query, [$email]);
        
        if ($row = pg_fetch_assoc($result)) {
            // Pass the role_name as well
            return $row['role_name'];
        }
        return null; // Return null if the role is not found
    }

    // Insert a new role into the database
    public function createRole(RolesDTO $role): bool {
        global $conn;
        $query = "INSERT INTO roles (name, role_name) VALUES ($1, $2)";
        $result = pg_query_params($conn, $query, [$role->getName(),$role->getRN() ]);
        
        return $result !== false; // Return true if the query was successful, false otherwise
    }

    // Update an existing role in the database
    public function updateRole($email,$role) {
        global $conn;
        $query = "UPDATE roles SET role_name = $1 WHERE name = $2";
        $result = pg_query_params($conn, $query, [$role , $email]);
        
    }

    // Delete a role by its ID
    public function deleteRole(int $id): bool {
        global $conn;
        $query = "DELETE FROM roles WHERE id = $1";
        $result = pg_query_params($conn, $query, [$id]);
        
        return $result !== false; // Return true if the query was successful, false otherwise
    }
}
?>
