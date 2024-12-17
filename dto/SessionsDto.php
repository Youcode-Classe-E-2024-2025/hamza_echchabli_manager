<?php

class SessionsDTO {
    private int $id;
    private string $key;
    private int $actorsId;

    public function __construct(int $id, string $key, int $actorsId) {
        $this->id = $id;
        $this->key = $key;
        $this->actorsId = $actorsId;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getKey(): string {
        return $this->key;
    }

    public function getActorsId(): int {
        return $this->actorsId;
    }
}

?>
