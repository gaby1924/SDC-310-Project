<!--------------
Gaby Malaka
Update: 5/2/2026
SDC 310-Project
---------------->

<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../models/ProductModel.php';

// Get all products
$products = getAllProducts($conn);

// Ensure cart session exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<h1>Product Catalog</h1>
<p>
    <a href="index.php?page=cart" 
       style="padding:6px 12px; background:#ddd; border:1px solid #aaa; text-decoration:none;">
       View Cart
    </a>
</p>

<?php if (empty($products)): ?>
    <p>No products available.</p>
<?php else: ?>
    <?php foreach ($products as $product): ?>
        <div class='product' style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

            <!-- Product Name -->
            <h3><?php echo htmlspecialchars($product['prod_name']); ?></h3>

            <!-- Product Description -->
            <p><?php echo htmlspecialchars($product['prod_desc']); ?></p>

            <!-- Product Price -->
            <p><strong>$<?php echo number_format($product['prod_price'], 2); ?></strong></p>

            <!-- Quantity currently in cart -->
            <p>
                Quantity in cart:
                <?php
                    $id = $product['prod_ID'];
                    echo isset($_SESSION['cart'][$id])
                        ? $_SESSION['cart'][$id]['quantity']
                        : 0;
                ?>
            </p>

            <!-- Add to Cart -->
            <form method="post" action="index.php?page=cart" style="display:inline;">
                <input type="hidden" name="product_id" value="<?php echo (int)$product['prod_ID']; ?>">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>

            <!-- Remove from Cart -->
            <form method="post" action="index.php?page=cart" style="display:inline;">
                <input type="hidden" name="remove_id" value="<?php echo (int)$product['prod_ID']; ?>">
                <button type="submit" name="remove_from_cart">Remove</button>
            </form>

            <!-- Adjust Quantity -->
            <form method="post" action="index.php?page=cart" style="margin-top:5px;">
                <input type="number"
                       name="quantities[<?php echo (int)$product['prod_ID']; ?>]"
                       min="0"
                       value="<?php echo isset($_SESSION['cart'][$product['prod_ID']]) ? $_SESSION['cart'][$product['prod_ID']]['quantity'] : 0; ?>">
                <button type="submit" name="update_cart">Update Quantity</button>
            </form>

        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
