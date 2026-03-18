<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once 'includes/db_connect.php';
require_once 'includes/header.php';

// Count key metrics
$totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalAdmins = $pdo->query("SELECT COUNT(*) FROM users WHERE role='admin'")->fetchColumn();
$totalStaff = $pdo->query("SELECT COUNT(*) FROM users WHERE role='staff'")->fetchColumn();
?>

<div class="container mt-5">

    <!-- Hero Section -->
    <div class="text-center mb-5">
        <img src="assets/images/logo.png" alt="Glorious Admin Hub" width="100" class="mb-3">
        <h2 class="fw-bold text-primary">Welcome to Glorious Admin Hub</h2>
        <p class="text-muted">Fashioning Efficiency — Your Centralized Control Panel</p>
    </div>

    <!-- Dashboard Stats -->
    <div class="row g-4">
        <div class="col-md-3">
            <div class="stat-card bg-gradient-primary text-white">
                <h4>Total Products</h4>
                <h2><?= $totalProducts ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-gradient-info text-white">
                <h4>Total Users</h4>
                <h2><?= $totalUsers ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-gradient-success text-white">
                <h4>Admins</h4>
                <h2><?= $totalAdmins ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-gradient-warning text-white">
                <h4>Staff Members</h4>
                <h2><?= $totalStaff ?></h2>
            </div>
        </div>
    </div>

    <!-- Quick Access Buttons -->
    <div class="mt-5">
        <h4 class="mb-3">Quick Access</h4>
        <div class="d-flex flex-wrap gap-3">
            <a href="products.php" class="btn btn-primary flex-fill">Manage Products</a>
            <a href="users.php" class="btn btn-info flex-fill">Manage Users</a>
            <a href="reports.php" class="btn btn-success flex-fill">View Reports</a>
            <a href="settings.php" class="btn btn-secondary flex-fill">Settings</a>
        </div>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>
