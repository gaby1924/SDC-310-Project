<!-------------
Gaby Malaka
5.2.2026
SDC 310-Project
Cart View
--------------->
<?php require_once __DIR__ . '/../includes/header.php'; ?>

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

            <tr>
                <td colspan="4" style="text-align:right;"><strong>Subtotal:</strong></td>
                <td><strong>$<?php echo number_format($grandTotal, 2); ?></strong></td>
            </tr>

            <?php
            $tax = $grandTotal * 0.05;
            $shipping = $grandTotal * 0.10;
            $orderTotal = $grandTotal + $tax + $shipping;
            ?>

            <tr>
                <td colspan="4" style="text-align:right;">Tax (5%):</td>
                <td>$<?php echo number_format($tax, 2); ?></td>
            </tr>

            <tr>
                <td colspan="4" style="text-align:right;">Shipping (10%):</td>
                <td>$<?php echo number_format($shipping, 2); ?></td>
            </tr>

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
