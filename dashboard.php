<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require 'includes/db_connect.php';
require 'includes/header.php';

// Count key metrics
$totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalAdmins = $pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn();
$totalStaff = $pdo->query("SELECT COUNT(*) FROM users WHERE role='staff'")->fetchColumn();
?>

<div class="container mt-5">

    <!-- Welcome Header -->
    <div class="text-center mb-5">
        <img src="assets/images/logo.png" alt="Glorious Admin Hub" width="100" class="mb-3">
        <h2 class="fw-bold text-primary">Welcome to Glorious Admin Hub</h2>
        <p class="text-muted">Fashioning Efficiency — Your Centralized Control Panel</p>
    </div>

    <!-- Dashboard Stats -->
    <div class="row g-4 text-center">
        <div class="col-md-3">
            <div class="stat-card gradient-blue text-white shadow-sm rounded-4 py-4">
                <h5 class="fw-semibold mb-2">Total Products</h5>
                <h2 class="fw-bold mb-0"><?php echo $totalProducts; ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-green text-white shadow-sm rounded-4 py-4">
                <h5 class="fw-semibold mb-2">Total Users</h5>
                <h2 class="fw-bold mb-0"><?php echo $totalUsers; ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-orange text-white shadow-sm rounded-4 py-4">
                <h5 class="fw-semibold mb-2">Admins</h5>
                <h2 class="fw-bold mb-0"><?php echo $totalAdmins; ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card gradient-pink text-white shadow-sm rounded-4 py-4">
                <h5 class="fw-semibold mb-2">Staff Members</h5>
                <h2 class="fw-bold mb-0"><?php echo $totalStaff; ?></h2>
            </div>
        </div>
    </div>

    <!-- Quick Access Section -->
    <div class="mt-5">
        <h4 class="fw-bold mb-3">Quick Access</h4>
        <div class="d-flex flex-wrap gap-3">
            <a href="products.php" class="btn btn-outline-primary flex-fill fw-semibold">Manage Products</a>
            <a href="users.php" class="btn btn-outline-info flex-fill fw-semibold">Manage Users</a>
            <a href="reports.php" class="btn btn-outline-success flex-fill fw-semibold">View Reports</a>
            <a href="settings.php" class="btn btn-outline-secondary flex-fill fw-semibold">Settings</a>
        </div>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
