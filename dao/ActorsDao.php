<?php
require_once '../config/databaseConfig.php';
require_once '../dto/ActorsDTO.php';

class ActorsDAO {

    public function getConfirmedActors(): array {
        global $conn;
        $query = "SELECT 
    actors.*,
    roles.role_name
FROM 
    actors
LEFT JOIN 
    roles 
ON 
    roles.name = actors.email
WHERE 
    actors.state = 1
    AND NOT EXISTS (
        SELECT 1
        FROM archive
        WHERE archive.email = actors.email
    );

     ";
    
        $result = pg_query($conn, $query);
        
        $actors = [];
        while ($row = pg_fetch_assoc($result)) {
            $actors[] = new ActorsDTO($row['id'], $row['name'], $row['email'], $row['password'],$row['slug'], $row['state'],$row['role_name']);
        }
        return $actors;
    }



    public function getArchiveActors(): array {
        global $conn;
        $query = "SELECT 
    actors.*,
    roles.role_name
FROM 
    actors
LEFT JOIN 
    roles 
ON 
    roles.name = actors.email
WHERE 
    actors.state = 1
    AND EXISTS (
        SELECT 1
        FROM archive
        WHERE archive.email = actors.email
    );"
;
    
        $result = pg_query($conn, $query);
        
        $actors = [];
        while ($row = pg_fetch_assoc($result)) {
            $actors[] = new ActorsDTO($row['id'], $row['name'], $row['email'], $row['password'],$row['slug'], $row['state'],$row['role_name']);
        }
        return $actors;
    }





    public function getNewActors(): array {
        global $conn;
        $query = "SELECT 
        actors.*,
        roles.role_name
    FROM 
        actors
   
    LEFT JOIN 
        roles 
    ON 
        roles.name = actors.email
    WHERE 
    actors.state = 0
     ";
    
        $result = pg_query($conn, $query);
        
        $actors = [];
        while ($row = pg_fetch_assoc($result)) {
            $actors[] = new ActorsDTO($row['id'], $row['name'], $row['email'], $row['password'],$row['slug'], $row['state'],$row['role_name']);
        }
        return $actors;
    }
    public function getActorByEmail(string $email): ?ActorsDTO {
        global $conn;
        
        // Query to select actor by email
        $query = "SELECT * FROM actors  WHERE email = $1";
        
        // Execute the query with parameterized email
        $result = pg_query_params($conn, $query, [$email]);

        if ($row = pg_fetch_assoc($result)) {
            // Return an instance of ActorsDTO
            return new ActorsDTO($row['id'], $row['name'], $row['email'], $row['password'], $row['slug'],$row['state']);
        }
        
        // Return null if no actor found
        return null;
    }

    // Other methods...

    public function emailExists($email) {
        global $conn_str;
        $conn = pg_connect($conn_str);
    
        // Query to check if the email exists in the actors table
        $query = "SELECT 1 FROM actors WHERE email = $1 LIMIT 1";
        $result = pg_query_params($conn, $query, array($email));
    
        // If a result is returned, the email already exists
        if (pg_num_rows($result) > 0) {
            return true;
        }
    
        return false;
    }
    

   

    public function createActor(ActorsDTO $actor): ?string {
        global $conn;
        $query = "INSERT INTO actors (name, email, password, slug, state) 
                  VALUES ($1, $2, $3, $4, $5) 
                  RETURNING id, name, email, state";
        $result = pg_query_params($conn, $query, [
            $actor->getName(),
            $actor->getEmail(),
            $actor->getPassword(),
            $actor->getSlug(),
            $actor->getState()
        ]);
    
        if ($result !== false) {
            $row = pg_fetch_assoc($result);
            return $row['email']; // Return the actor's name
        }
    
        return null; // Return null if the insert failed
    }
    

    public function toggleActorState(string $email): bool {
        global $conn;
        $query = "UPDATE actors SET state = CASE WHEN state = 1 THEN 0 ELSE 1 END WHERE email = $1";
        $params = [$email];
        $result = pg_query_params($conn, $query, $params);
    
        // Ensure the function returns a boolean indicating success or failure
        return $result !== false;
    }
    
    

   
}
?>
