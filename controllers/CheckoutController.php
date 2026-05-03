<!-----------------
Gaby Malaka
5.2.2026
SDC 310-Project
Checkout Controller
-------------------->
<?php
require_once __DIR__ . '/../models/ProductModel.php';

class CheckoutController
{
    public function index()
    {
        // Ensure session exists
        if (!isset($_SESSION)) {
            session_start();
        }

        // Get cart items
        $cartItems = $_SESSION['cart'] ?? [];

        // Calculate totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = $subtotal * 0.05;
        $shipping = $subtotal * 0.10;
        $orderTotal = $subtotal + $tax + $shipping;

        // Load the checkout view
        require __DIR__ . '/../views/CheckoutView.php';
    }

    public function confirm()
    {
        // Clear cart after confirmation
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['cart'] = [];

        // Load confirmation view
        require __DIR__ . '/../views/CheckoutConfirmView.php';
    }
}
?>