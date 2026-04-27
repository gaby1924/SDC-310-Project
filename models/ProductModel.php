// Product Model
// Gaby Malaka
// 4.26.2026

<?php
require_once __DIR__ . '/../includes/db.php';

function getAllProducts(PDO $conn): array {
    $sql = "SELECT prod_ID, prod_name, prod_desc, prod_price, prod_quantity
        FROM products";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductById(PDO $conn, int $id): ?array {
    $sql = "SELECT prod_ID, prod_name, prod_desc, prod_price, prod_quantity 
        FROM products
        WHERE prod_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    return $product ?: null;
}