<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require 'includes/db_connect.php';
require 'includes/header.php';

// Mock existing settings; in real scenario, fetch from DB
$settings = [
    "full_name" => "John Doe",
    "email" => "admin@example.com",
    "password_protected" => "enabled",
    "theme_color" => "#4FC3F7",
    "notifications" => "enabled",
    "timezone" => "UTC"
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings['full_name'] = trim($_POST['full_name']);
    $settings['email'] = trim($_POST['email']);
    $settings['password_protected'] = $_POST['password_protected'];
    $settings['theme_color'] = $_POST['theme_color'];
    $settings['notifications'] = $_POST['notifications'];
    $settings['timezone'] = $_POST['timezone'];

    $_SESSION['success'] = "Settings updated successfully!";
    header("Location: settings.php");
    exit;
}
?>

<div class="container mt-5">

    <!-- Page Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #4FC3F7;">
            <i class="fas fa-cogs me-2" style="color: #4FC3F7;"></i>Settings
        </h2>
        <p class="text-muted fs-5">Manage your account, privacy, appearance, and preferences</p>
    </div>

    <!-- Success Alert -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert" style="border-left: 5px solid #4FC3F7;">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="">

        <!-- ================= PROFILE SETTINGS ================= -->
        <div class="card shadow-sm p-4 rounded-4 mb-4" style="border-top: 5px solid #4FC3F7;">
            <h4 class="fw-bold mb-3" style="color: #4FC3F7;"><i class="fas fa-user me-2" style="color: #4FC3F7;"></i>Profile</h4>
            <div class="mb-3">
                <label for="full_name" class="form-label fw-semibold">Full Name</label>
                <input type="text" name="full_name" id="full_name" class="form-control"
                       value="<?= htmlspecialchars($settings['full_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="<?= htmlspecialchars($settings['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password Protection</label>
                <select name="password_protected" class="form-select" style="border-color: #4FC3F7;">
                    <option value="enabled" <?= $settings['password_protected'] === 'enabled' ? 'selected' : ''; ?>>Enabled</option>
                    <option value="disabled" <?= $settings['password_protected'] === 'disabled' ? 'selected' : ''; ?>>Disabled</option>
                </select>
            </div>
        </div>

        <!-- ================= PRIVACY SETTINGS ================= -->
        <div class="card shadow-sm p-4 rounded-4 mb-4" style="border-top: 5px solid #4FC3F7;">
            <h4 class="fw-bold mb-3" style="color: #4FC3F7;"><i class="fas fa-shield-alt me-2" style="color: #4FC3F7;"></i>Privacy</h4>
            <div class="mb-3">
                <label class="form-label fw-semibold">Account Visibility</label>
                <select name="account_visibility" class="form-select" style="border-color: #4FC3F7;">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Two-Factor Authentication</label>
                <select name="two_factor" class="form-select" style="border-color: #4FC3F7;">
                    <option value="enabled">Enabled</option>
                    <option value="disabled" selected>Disabled</option>
                </select>
            </div>
        </div>

        <!-- ================= THEME SETTINGS ================= -->
        <div class="card shadow-sm p-4 rounded-4 mb-4" style="border-top: 5px solid #4FC3F7;">
            <h4 class="fw-bold mb-3" style="color: #4FC3F7;"><i class="fas fa-paint-brush me-2" style="color: #4FC3F7;"></i>Theme & Appearance</h4>
            <div class="mb-3">
                <label for="theme_color" class="form-label fw-semibold">Theme Color</label>
                <input type="color" name="theme_color" id="theme_color" class="form-control form-control-color"
                       value="<?= htmlspecialchars($settings['theme_color']); ?>">
            </div>
        </div>

        <!-- ================= NOTIFICATIONS ================= -->
        <div class="card shadow-sm p-4 rounded-4 mb-4" style="border-top: 5px solid #4FC3F7;">
            <h4 class="fw-bold mb-3" style="color: #4FC3F7;"><i class="fas fa-bell me-2" style="color: #4FC3F7;"></i>Notifications</h4>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email Notifications</label>
                <select name="notifications" class="form-select" style="border-color: #4FC3F7;">
                    <option value="enabled" <?= $settings['notifications'] === 'enabled' ? 'selected' : ''; ?>>Enabled</option>
                    <option value="disabled" <?= $settings['notifications'] === 'disabled' ? 'selected' : ''; ?>>Disabled</option>
                </select>
            </div>
        </div>

        <!-- ================= TIMEZONE ================= -->
        <div class="card shadow-sm p-4 rounded-4 mb-4" style="border-top: 5px solid #4FC3F7;">
            <h4 class="fw-bold mb-3" style="color: #4FC3F7;"><i class="fas fa-clock me-2" style="color: #4FC3F7;"></i>Timezone</h4>
            <div class="mb-3">
                <label for="timezone" class="form-label fw-semibold">Select Timezone</label>
                <select name="timezone" id="timezone" class="form-select" style="border-color: #4FC3F7;">
                    <option value="UTC" <?= $settings['timezone'] === 'UTC' ? 'selected' : ''; ?>>UTC</option>
                    <option value="America/New_York" <?= $settings['timezone'] === 'America/New_York' ? 'selected' : ''; ?>>New York (EST)</option>
                    <option value="Europe/London" <?= $settings['timezone'] === 'Europe/London' ? 'selected' : ''; ?>>London (GMT)</option>
                    <option value="Asia/Kolkata" <?= $settings['timezone'] === 'Asia/Kolkata' ? 'selected' : ''; ?>>Kolkata (IST)</option>
                </select>
            </div>
        </div>

        <!-- ================= SAVE / CANCEL ================= -->
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary px-4 me-2">
                <i class="fas fa-save me-1"></i> Save Changes
            </button>
            <a href="dashboard.php" class="btn btn-secondary px-4">
                <i class="fas fa-arrow-left me-1"></i> Cancel
            </a>
        </div>

    </form>
</div>

<?php require 'includes/footer.php'; ?>
