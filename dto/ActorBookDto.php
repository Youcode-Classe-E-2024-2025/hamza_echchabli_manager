<?php

class ActorBookDTO {
    private int $actorsId;
    private int $booksId;

    public function __construct(int $actorsId, int $booksId) {
        $this->actorsId = $actorsId;
        $this->booksId = $booksId;
    }

    // Getters
    public function getActorsId(): int {
        return $this->actorsId;
    }

    public function getBooksId(): int {
        return $this->booksId;
    }
}

?>
