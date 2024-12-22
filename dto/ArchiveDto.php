<?php

class ArchiveDTO {
    private int $id;
    private string $email;

    public function __construct(int $id, string $email) {
        $this->id = $id;
        $this->email = $email;
       
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): int {
        return $this->email;
    }

    
}

?>
