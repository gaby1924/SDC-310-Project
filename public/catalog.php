// Catalog Page
// Gaby Malaka
// 4.26.2026

<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../models/ProductModel.php';

$products = getAllProducts($conn);
?>

<h1>Product Catalog</h1>

<?php if (empty($products)): ?>
    <p>No products available.</p>
<?php else: ?>
    <?php foreach ($products as $product): ?>
        <div class='product'>
            <h3><?php echo htmlspecialchars($product['prod_name']); ?></h3>
            <p><?php echo htmlspecialchars($product['prod_desc']); ?></p>
            <p><strong>$<?php echo htmlspecialchars(number_format($product['prod_price'], 2)); ?></strong></p>


            <form method="post" action="index.php?page=cart">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars((int)$product['prod_ID']); ?>">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
