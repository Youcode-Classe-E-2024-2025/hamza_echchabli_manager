<?php
require_once 'config/databaseConnection.php';
require_once 'SessionsDTO.php';

class SessionsDAO {

    public function getAllSessions(): array {
        global $conn;
        $query = "SELECT * FROM sessions";
        $result = pg_query($conn, $query);
        
        $sessions = [];
        while ($row = pg_fetch_assoc($result)) {
            $sessions[] = new SessionsDTO($row['id'], $row['key'], $row['actors_id']);
        }
        return $sessions;
    }

    public function getSessionById(int $id): ?SessionsDTO {
        global $conn;
        $query = "SELECT * FROM sessions WHERE id = $1";
        $result = pg_query_params($conn, $query, [$id]);
        
        if ($row = pg_fetch_assoc($result)) {
            return new SessionsDTO($row['id'], $row['key'], $row['actors_id']);
        }
        return null;
    }

    public function createSession(SessionsDTO $session): bool {
        global $conn;
        $query = "INSERT INTO sessions (key, actors_id) VALUES ($1, $2)";
        $result = pg_query_params($conn, $query, [
            $session->getKey(),
            $session->getActorsId()
        ]);
        return $result !== false;
    }

    public function updateSession(SessionsDTO $session): bool {
        global $conn;
        $query = "UPDATE sessions SET key = $1, actors_id = $2 WHERE id = $3";
        $result = pg_query_params($conn, $query, [
            $session->getKey(),
            $session->getActorsId(),
            $session->getId()
        ]);
        return $result !== false;
    }

    public function deleteSession(int $id): bool {
        global $conn;
        $query = "DELETE FROM sessions WHERE id = $1";
        $result = pg_query_params($conn, $query, [$id]);
        return $result !== false;
    }
}
?>
