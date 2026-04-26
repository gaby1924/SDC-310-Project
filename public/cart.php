// Shopping Cart Page
// Gaby Malaka
// 4.26.2026

<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../models/ProductModel.php';

// Ensure cart session exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handles adding products to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
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

// Handles quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
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

$cartItems = $_SESSION['cart'];
?>

<h1>Your Shopping Cart</h1>

<?php if (empty($cartItems)): ?>
    <p>Your cart is empty</p>
<?php else: ?>
    <form method="post" action="index.php?page=cart">
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php $grandTotal = 0; ?>
            <?php foreach ($cartItems as $item): ?>
                <?php
                    $itemTotal = $item['price'] * $item['quantity'];
                    $grandTotal += $itemTotal;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>
                        <input
                            type="number"
                            name="quantities[<?php echo (int)$item['id']; ?>]"
                            value="<?php echo (int)$item['quantity']; ?>"
                            min="0"
                        >
                    </td>
                    <td>$<?php echo number_format($itemTotal, 2); ?></td>
                </tr>
            <?php endforeach; ?>

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Total:</strong></td>
                <td><strong>$<?php echo number_format($grandTotal, 2); ?></strong></td>
            </tr>
        </table>

        <br>
        <button type="submit" name="update_cart">Update Cart</button>
    </form>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
                    
