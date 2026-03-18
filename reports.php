<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require 'includes/db_connect.php';
require 'includes/header.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Reports & Analytics</h2>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <?php
        // Fetch data
        $totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
        $totalSales = $pdo->query("SELECT SUM(stock) FROM products")->fetchColumn() ?? 0; // Placeholder
        $totalRevenue = $pdo->query("SELECT SUM(price * stock) FROM products")->fetchColumn() ?? 0;
        ?>

        <div class="card text-center p-2 py-1 h-auto min-h-[80px] flex flex-col justify-center">
            <h5 class="mb-1 text-sm font-semibold">Total Products</h5>
            <h2 class="text-accent text-lg font-bold"><?= $totalProducts ?></h2>
        </div>

        <div class="card text-center p-2 py-1 h-auto min-h-[80px] flex flex-col justify-center">
            <h5 class="mb-1 text-sm font-semibold">Total Stock</h5>
            <h2 class="text-accent text-lg font-bold"><?= $totalSales ?></h2>
        </div>

        <div class="card text-center p-2 py-1 h-auto min-h-[80px] flex flex-col justify-center">
            <h5 class="mb-1 text-sm font-semibold">Estimated Inventory Value</h5>
            <h2 class="text-accent text-lg font-bold">$<?= number_format($totalRevenue, 2) ?></h2>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="card mt-4">
        <h4 class="mb-3">Sales Overview</h4>
        <canvas id="salesChart" height="100"></canvas>
    </div>

    <!-- Low Stock Table -->
    <div class="card mt-4">
        <h4 class="mb-3">Low Stock Alerts</h4>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Added By</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT p.*, u.username AS added_by_name FROM products p LEFT JOIN users u ON p.added_by = u.id WHERE p.stock < 5 ORDER BY p.stock ASC");
                $lowStock = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($lowStock) {
                    foreach ($lowStock as $row) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['product_name']}</td>
                            <td>{$row['category']}</td>
                            <td><span class='badge bg-danger'>{$row['stock']}</span></td>
                            <td>" . ($row['added_by_name'] ?? 'N/A') . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No low-stock products 🎉</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js for visual analytics -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        datasets: [{
            label: 'Monthly Sales ($)',
            data: [500, 800, 1200, 900, 1400, 2000, 1800, 2300, 2500],
            borderColor: '#00c4cc',
            backgroundColor: 'rgba(0, 196, 204, 0.1)',
            borderWidth: 3,
            tension: 0.3,
            fill: true,
            pointRadius: 5,
            pointHoverRadius: 7,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true, position: 'top' },
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: '#2e2b63' },
            },
            x: {
                ticks: { color: '#2e2b63' },
            }
        }
    }
});
</script>

<?php require 'includes/footer.php'; ?>
