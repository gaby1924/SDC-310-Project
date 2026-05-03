<!-----------
Gaby Malaka
5.2.2026
SDC 310-Project
Catalog Controller
------------->
<?php
require_once __DIR__ . '/../models/ProductModel.php';

class CatalogController
{
    public function index()
    {
        // Get products from model
        global $conn;
        $products = getAllProducts($conn);

        // Show view
        require dirname(__DIR__) . '/views/CatalogView.php';
    }
}
?>