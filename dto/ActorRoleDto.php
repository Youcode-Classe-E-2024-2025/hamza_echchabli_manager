<?php

class ActorRoleDTO {
    private int $actorsId;
    private int $rolesId;

    public function __construct(int $actorsId, int $rolesId) {
        $this->actorsId = $actorsId;
        $this->rolesId = $rolesId;
    }

    // Getters
    public function getActorsId(): int {
        return $this->actorsId;
    }

    public function getRolesId(): int {
        return $this->rolesId;
    }
}

?>
