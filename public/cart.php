<!--------------
Gaby Malaka
Update: 5/2/2026
SDC 310-Project
---------------->

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

// Handles removing products from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $removeId = (int)($_POST['remove_id'] ?? 0);
    unset($_SESSION['cart'][$removeId]);  
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

// Checkout/clear cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $_SESSION['cart'] = [];
    header("Location: index.php?page=catalog");
    exit;
}
// Get cart items for display
$cartItems = $_SESSION['cart'];
?>

<h1>Your Shopping Cart</h1>

<?php if (empty($cartItems)): ?>
    <p>Your cart is empty</p>
<?php else: ?>
    <form method="post" action="index.php?page=cart">
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <!-- loop thru cart items and calculate grand total -->
            <?php $grandTotal = 0; ?>
            <?php foreach ($cartItems as $item): ?>
                <?php
                    $itemTotal = $item['price'] * $item['quantity'];
                    $grandTotal += $itemTotal;
                ?>
                <tr>
                    <td><?php echo (int)$item['id']; ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>
                        <input
                            type="number"
                            name="quantities[<?php echo (int)$item['id']; ?>]"
                            value="<?php echo (int)$item['quantity']; ?>"
                            min="0"
                        >
                        <br>
                        <button type="submit" name="remove_from_cart" value="1">Remove</button>
                        <input type="hidden" name="remove_id" value="<?php echo (int)$item['id']; ?>">
                    </td>
                    <td>$<?php echo number_format($itemTotal, 2); ?></td>
                </tr>
            <?php endforeach; ?>

            <!-- Subtotal -->
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Subtotal:</strong></td>
                <td><strong>$<?php echo number_format($grandTotal, 2); ?></strong></td>
            </tr>

            <?php
            $tax = $grandTotal * 0.05;
            $shipping = $grandTotal * 0.10;
            $orderTotal = $grandTotal + $tax + $shipping;
            ?>

            <!-- Tax -->
            <tr>
                <td colspan="4" style="text-align:right;">Tax (5%):</td>
                <td>$<?php echo number_format($tax, 2); ?></td>
            </tr>

            <!-- Shipping --> 
            <tr>
                <td colspan="4" style="text-align:right;">Shipping (10%):</td>
                <td>$<?php echo number_format($shipping, 2); ?></td>
            </tr>

            <!-- Order Total -->
            <tr>
                <td colspan="4" style="text-align:right;"><strong>Order Total:</strong></td>
                <td><strong>$<?php echo number_format($orderTotal, 2); ?></strong></td>
            </tr>
        </table>

        <br>

        <button type="submit" name="update_cart">Update Cart</button>
        <button type="submit" name="checkout">Checkout</button>
        <a href="index.php?page=catalog" style="padding:6px 12px; background:#ddd; border:1px solid #aaa; text-decoration:none;">Continue Shopping</a>
    </form>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

                    
