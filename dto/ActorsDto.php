<?php

class ActorsDTO {
    private int $id;
    private string $name;
    private string $email;

    private string $password;
    private string $slug;
    private bool $state;
    private string $role;

    // Constructor to initialize the object with default values
    public function __construct(
        int $id = 0,
        string $name = "",
        string $email = "",
        string $password ="",
        string $slug = "",
        int $state = 0, // Default state
        string $role='cutsmor'
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password= $password;
        $this->slug = $slug;
        $this->state = $state;
        $this->role = $role ;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function getPassword(): string {
        return $this->password;
    }

    public function getSlug(): string {
        return $this->slug;
    }

    public function getState(): int {
        return filter_var($this->state, FILTER_VALIDATE_BOOLEAN);
    }
    

    

    public function setState(string $state): void {
        $this->state = $state;
    }

    public function getRole(): string {
        return $this->role;
    }
}
?>
