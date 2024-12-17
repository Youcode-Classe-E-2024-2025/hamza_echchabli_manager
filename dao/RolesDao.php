<?php
require_once 'config/databaseConnection.php';
require_once 'RolesDTO.php';

class RolesDAO {

    public function getAllRoles(): array {
        global $conn;
        $query = "SELECT * FROM roles";
        $result = pg_query($conn, $query);
        
        $roles = [];
        while ($row = pg_fetch_assoc($result)) {
            $roles[] = new RolesDTO($row['id'], $row['name']);
        }
        return $roles;
    }

    public function getRoleById(int $id): ?RolesDTO {
        global $conn;
        $query = "SELECT * FROM roles WHERE id = $1";
        $result = pg_query_params($conn, $query, [$id]);
        
        if ($row = pg_fetch_assoc($result)) {
            return new RolesDTO($row['id'], $row['name']);
        }
        return null;
    }

    public function createRole(RolesDTO $role): bool {
        global $conn;
        $query = "INSERT INTO roles (name) VALUES ($1)";
        $result = pg_query_params($conn, $query, [$role->getName()]);
        return $result !== false;
    }

    public function updateRole(RolesDTO $role): bool {
        global $conn;
        $query = "UPDATE roles SET name = $1 WHERE id = $2";
        $result = pg_query_params($conn, $query, [$role->getName(), $role->getId()]);
        return $result !== false;
    }

    public function deleteRole(int $id): bool {
        global $conn;
        $query = "DELETE FROM roles WHERE id = $1";
        $result = pg_query_params($conn, $query, [$id]);
        return $result !== false;
    }
}
?>
