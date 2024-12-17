<?php
require_once 'config/databaseConnection.php';
require_once 'ActorRoleDTO.php';

class ActorRoleDAO {

    public function getAllActorRoles(): array {
        global $conn;
        $query = "SELECT * FROM actor_role";
        $result = pg_query($conn, $query);
        
        $actorRoles = [];
        while ($row = pg_fetch_assoc($result)) {
            $actorRoles[] = new ActorRoleDTO($row['actors_id'], $row['roles_id']);
        }
        return $actorRoles;
    }

    public function createActorRole(ActorRoleDTO $actorRole): bool {
        global $conn;
        $query = "INSERT INTO actor_role (actors_id, roles_id) VALUES ($1, $2)";
        $result = pg_query_params($conn, $query, [
            $actorRole->getActorsId(),
            $actorRole->getRolesId()
        ]);
        return $result !== false;
    }

    public function deleteActorRole(int $actorsId, int $rolesId): bool {
        global $conn;
        $query = "DELETE FROM actor_role WHERE actors_id = $1 AND roles_id = $2";
        $result = pg_query_params($conn, $query, [$actorsId, $rolesId]);
        return $result !== false;
    }
}
?>
