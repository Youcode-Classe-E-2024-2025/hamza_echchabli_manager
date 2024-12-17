<?php
require_once 'config/databaseConnection.php';
require_once 'PurchasesDTO.php';

class PurchasesDAO {

    public function getAllPurchases(): array {
        global $conn;
        $query = "SELECT * FROM purchases";
        $result = pg_query($conn, $query);
        
        $purchases = [];
        while ($row = pg_fetch_assoc($result)) {
            $purchases[] = new PurchasesDTO($row['id'], $row['actors_id'], $row['books_id'], $row['purchase_date'], $row['total']);
        }
        return $purchases;
    }

    public function getPurchaseById(int $id): ?PurchasesDTO {
        global $conn;
        $query = "SELECT * FROM purchases WHERE id = $1";
        $result = pg_query_params($conn, $query, [$id]);
        
        if ($row = pg_fetch_assoc($result)) {
            return new PurchasesDTO($row['id'], $row['actors_id'], $row['books_id'], $row['purchase_date'], $row['total']);
        }
        return null;
    }

    public function createPurchase(PurchasesDTO $purchase): bool {
        global $conn;
        $query = "INSERT INTO purchases (actors_id, books_id, purchase_date, total) VALUES ($1, $2, $3, $4)";
        $result = pg_query_params($conn, $query, [
            $purchase->getActorsId(),
            $purchase->getBooksId(),
            $purchase->getPurchaseDate(),
            $purchase->getTotal()
        ]);
        return $result !== false;
    }

    public function updatePurchase(PurchasesDTO $purchase): bool {
        global $conn;
        $query = "UPDATE purchases SET actors_id = $1, books_id = $2, purchase_date = $3, total = $4 WHERE id = $5";
        $result = pg_query_params($conn, $query, [
            $purchase->getActorsId(),
            $purchase->getBooksId(),
            $purchase->getPurchaseDate(),
            $purchase->getTotal(),
            $purchase->getId()
        ]);
        return $result !== false;
    }

    public function deletePurchase(int $id): bool {
        global $conn;
        $query = "DELETE FROM purchases WHERE id = $1";
        $result = pg_query_params($conn, $query, [$id]);
        return $result !== false;
    }
}
?>
