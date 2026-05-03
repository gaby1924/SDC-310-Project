<!------------
Gaby Malaka
5.2.2026
SDC 310-Project
Index Page
-------------->
<?php
session_start();

require_once __DIR__ . '/../includes/db.php'; // if not already included here

$page = $_GET['page'] ?? 'catalog';

switch ($page) {
    case 'cart':
        require_once __DIR__ . '/../controllers/CartController.php';
        $controller = new CartController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->handlePost();
        }
        // prepare data for view
        $cartItems = $_SESSION['cart'] ?? [];
        $controller->index();
        break;

    case 'catalog':
    default:
        require_once __DIR__ . '/../controllers/CatalogController.php';
        $controller = new CatalogController();
        $controller->index();
        break;

    case 'checkout':
    require_once __DIR__ . '/../controllers/CheckoutController.php';
    $controller = new CheckoutController();

    if (isset($_GET['action']) && $_GET['action'] === 'confirm') {
        $controller->confirm();
    } else {
        $controller->index();
    }
    break;
}
?>
