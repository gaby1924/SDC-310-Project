<!----------------
Gaby Malaka
5.2.2026
SDC 310-Project
Checkout View
----------------->
<?php require_once __DIR__ . '/../includes/header.php'; ?>

<h1>Checkout Summary</h1>

<?php if (empty($cartItems)): ?>
    <p>Your cart is empty. <a href="index.php?page=catalog">Return to Catalog</a></p>
<?php else: ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>

        <?php foreach ($cartItems as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['id']); ?></td>
                <td><?= htmlspecialchars($item['name']); ?></td>
                <td>$<?= number_format($item['price'], 2); ?></td>
                <td><?= (int)$item['quantity']; ?></td>
                <td>$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="3" style="text-align:right;"><strong>Subtotal:</strong></td>
            <td>$<?= number_format($subtotal, 2); ?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right;">Tax (5%):</td>
            <td>$<?= number_format($tax, 2); ?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right;">Shipping (10%):</td>
            <td>$<?= number_format($shipping, 2); ?></td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right;"><strong>Order Total:</strong></td>
            <td><strong>$<?= number_format($orderTotal, 2); ?></strong></td>
        </tr>
    </table>

    <form method="post" action="index.php?page=checkout&action=confirm">
        <button type="submit">Confirm Order</button>
    </form>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
