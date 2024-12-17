<?php

class PurchasesDTO {
    private int $id;
    private int $actorsId;
    private int $booksId;
    private string $purchaseDate;
    private float $total;

    public function __construct(int $id, int $actorsId, int $booksId, string $purchaseDate, float $total) {
        $this->id = $id;
        $this->actorsId = $actorsId;
        $this->booksId = $booksId;
        $this->purchaseDate = $purchaseDate;
        $this->total = $total;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getActorsId(): int {
        return $this->actorsId;
    }

    public function getBooksId(): int {
        return $this->booksId;
    }

    public function getPurchaseDate(): string {
        return $this->purchaseDate;
    }

    public function getTotal(): float {
        return $this->total;
    }
}

?>
