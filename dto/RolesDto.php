<?php

class RolesDTO {
    private int $id;
    private string $name;

    private string $role_name;

    public function __construct(int $id, string $name ) {
        $this->id = $id;
        $this->name = $name;
        $this->role_name='custmor';
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getRN(): string {
        return $this->role_name;
    }
}

?>
