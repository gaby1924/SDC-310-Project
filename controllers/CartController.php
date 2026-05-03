<!-----------
Gaby Malaka
5.2.2026
SDC 310-Project
Cart Controller
------------->
<?php
require_once __DIR__ . '/../models/ProductModel.php';

class CartController
{
    public function index()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $cartItems = $_SESSION['cart'];
        require __DIR__ . '/../views/CartView.php';
    }

    public function handlePost()
    {
        global $conn;

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add to cart
        if (isset($_POST['add_to_cart'])) {
            $productId = (int)($_POST['product_id'] ?? 0);
            if ($productId > 0) {
                $product = getProductById($conn, $productId);
                if ($product) {
                    if (isset($_SESSION['cart'][$productId])) {
                        $_SESSION['cart'][$productId]['quantity']++;
                    } else {
                        $_SESSION['cart'][$productId] = [
                            'id'       => $product['prod_ID'],
                            'name'     => $product['prod_name'],
                            'price'    => $product['prod_price'],
                            'quantity' => 1,
                        ];
                    }
                }
            }
        }

        // Remove from cart
        if (isset($_POST['remove_from_cart'])) {
            $removeId = (int)($_POST['remove_id'] ?? 0);
            unset($_SESSION['cart'][$removeId]);
        }

        // Update quantities
        if (isset($_POST['update_cart'])) {
            foreach ($_POST['quantities'] ?? [] as $id => $qty) {
                $id  = (int)$id;
                $qty = (int)$qty;

                if ($qty <= 0) {
                    unset($_SESSION['cart'][$id]);
                } elseif (isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id]['quantity'] = $qty;
                }
            }
        }

        // Checkout
        if (isset($_POST['checkout'])) {
            $_SESSION['cart'] = [];
            header("Location: index.php?page=catalog");
            exit;
        }
    }
}
