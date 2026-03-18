<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require 'includes/header.php';
?>

<div class="container mt-5">
    <h2>Add New Product</h2>

    <form action="process/add_product.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category">
        </div>

        <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="number" class="form-control" id="price" name="price" required>
</div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" required>
        </div>

       <div class="mb-3">
    <label for="image" class="form-label">Product Image (required)</label>
    <input type="file" class="form-control" id="image" name="image" required>
</div>

        <button type="submit" class="btn btn-success">Add Product</button>
        <a href="products.php" class="btn btn-secondary">Back to Products</a>
    </form>
</div>

<?php require 'includes/footer.php'; ?>
