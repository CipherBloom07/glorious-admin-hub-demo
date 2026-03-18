<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require 'includes/db_connect.php';
require 'includes/header.php';

// Show dismissible alerts for success/error/invalid
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $alertClass = '';
    $alertMsg = '';

    switch ($status) {
        case 'deleted':
            $alertClass = 'alert-success';
            $alertMsg = '✅ Product deleted successfully.';
            break;
        case 'error':
            $alertClass = 'alert-danger';
            $alertMsg = '❌ Error deleting product. Please try again.';
            break;
        case 'invalid':
            $alertClass = 'alert-warning';
            $alertMsg = '⚠ Invalid request.';
            break;
    }

    if ($alertMsg) {
        echo "<div class='alert $alertClass alert-dismissible fade show rounded-4 mt-3 mx-3' role='alert'>
                $alertMsg
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Products</h2>

    <!-- Add Product Button -->
    <a href="add_product.php" class="btn btn-success mb-3">Add New Product</a>

    <!-- Display table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Added By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT p.*, u.username AS added_by_name FROM products p LEFT JOIN users u ON p.added_by = u.id ORDER BY p.id DESC");
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($products) {
                    foreach ($products as $row) {
                        echo "<tr class='text-center align-middle'>
                                <td>{$row['id']}</td>";

                        // Image column
                        echo "<td>";
                        if (!empty($row['image']) && file_exists("uploads/{$row['image']}")) {
                            echo "<img src='uploads/{$row['image']}' alt='{$row['product_name']}' width='80'>";
                        } else {
                            echo "No Image";
                        }
                        echo "</td>";

                        // Product info
                        echo "<td>" . htmlspecialchars($row['product_name']) . "</td>
                              <td>" . htmlspecialchars($row['category']) . "</td>
                              <td>$" . number_format($row['price'], 2) . "</td>";

                        // Stock with badge
                        echo "<td><span class='badge " . ($row['stock'] < 5 ? 'bg-danger' : 'bg-success') . "'>{$row['stock']}</span></td>";

                        echo "<td>" . htmlspecialchars($row['added_by_name'] ?? 'N/A') . "</td>";

                        // Actions
                        echo "<td>
                                <a href='edit_product.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>";
                        if ($_SESSION['role'] === 'admin') {
                            echo " <a href='process/delete_product.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>";
                        }
                        echo "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
