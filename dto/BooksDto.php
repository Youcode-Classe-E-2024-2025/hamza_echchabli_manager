<?php

class BooksDTO {
    private int $id;
    private string $title;
    private string $description;
    private float $price;
    private string $image;

    private string $author;

    public function __construct(int $id, string $title, string $description, float $price, string $image ,string $author) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->author = $author;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getImage(): ?string {
        return $this->image;
    }
    public function getAuthor(): string {
        return $this->author;
    }
}

?>
