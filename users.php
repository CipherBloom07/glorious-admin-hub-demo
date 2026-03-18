<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

require 'includes/db_connect.php';
require 'includes/header.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Manage Users</h2>

    <!-- Success / Error Alerts -->
    <?php
    if (isset($_GET['success'])) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                " . htmlspecialchars($_GET['success']) . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }

    if (isset($_GET['error'])) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                " . htmlspecialchars($_GET['error']) . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    ?>

    <a href="register.php" class="btn btn-success mb-3">Add New User</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($users) {
                    foreach ($users as $user) {
                        echo "<tr class='text-center align-middle'>
                                <td>{$user['id']}</td>
                                <td>" . htmlspecialchars($user['username']) . "</td>
                                <td>" . htmlspecialchars($user['email']) . "</td>";

                        // Role badge
                        echo "<td>";
                        if($user['role'] === 'admin') {
                            echo "<span class='badge bg-primary'>Admin</span>";
                        } else {
                            echo "<span class='badge bg-secondary'>Staff</span>";
                        }
                        echo "</td>";

                        echo "<td>{$user['created_at']}</td>";

                        // Actions
                        echo "<td>
                                <a href='edit_user.php?id={$user['id']}' class='btn btn-primary btn-sm'>Edit</a> ";

                        // Prevent self-deletion
                        if ($user['id'] != $_SESSION['user_id']) {
                            echo "<a href='process/delete_user.php?id={$user['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>";
                        }

                        echo "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'includes/footer.php'; ?>
