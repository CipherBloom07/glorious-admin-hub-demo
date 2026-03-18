<?php include 'includes/header.php'; ?>
<!-- header.php should include your top-nav and opening <body> -->

<div class="container mt-5">

  <!-- Page Header -->
  <div class="text-center mb-5">
    <h2 class="fw-bold text-primary">Our Services</h2>
    <p class="text-muted" style="max-width: 700px; margin: 0 auto;">
      At <strong>Glorious Admin Hub</strong>, we deliver efficient digital solutions that help organizations 
      streamline operations, boost productivity, and achieve excellence through innovation.
    </p>
  </div>

  <!-- Services Cards -->
  <div class="row g-4">
    <!-- Service 1 -->
    <div class="col-md-3">
      <div class="card shadow-sm rounded-4 p-4 text-center">
        <div class="icon mb-3" style="color: var(--primary);">
          <i class="fas fa-cogs fa-2x"></i>
        </div>
        <h5 class="fw-semibold text-primary mb-2">System Management</h5>
        <p class="text-dark">Robust tools for managing users, data, and processes efficiently with precision and security.</p>
      </div>
    </div>

    <!-- Service 2 -->
    <div class="col-md-3">
      <div class="card shadow-sm rounded-4 p-4 text-center">
        <div class="icon mb-3" style="color: var(--primary);">
          <i class="fas fa-chart-line fa-2x"></i>
        </div>
        <h5 class="fw-semibold text-primary mb-2">Analytics & Reports</h5>
        <p class="text-dark">Gain actionable insights with real-time data analytics and detailed performance dashboards.</p>
      </div>
    </div>

    <!-- Service 3 -->
    <div class="col-md-3">
      <div class="card shadow-sm rounded-4 p-4 text-center">
        <div class="icon mb-3" style="color: var(--primary);">
          <i class="fas fa-user-shield fa-2x"></i>
        </div>
        <h5 class="fw-semibold text-primary mb-2">User Security</h5>
        <p class="text-dark">Advanced authentication and role-based access ensure that your system remains protected.</p>
      </div>
    </div>

    <!-- Service 4 -->
    <div class="col-md-3">
      <div class="card shadow-sm rounded-4 p-4 text-center">
        <div class="icon mb-3" style="color: var(--primary);">
          <i class="fas fa-headset fa-2x"></i>
        </div>
        <h5 class="fw-semibold text-primary mb-2">24/7 Support</h5>
        <p class="text-dark">Our support team is available around the clock to assist with any technical needs or inquiries.</p>
      </div>
    </div>
  </div>

</div>

<footer class="mt-5 text-center text-muted">
  <p>© <?php echo date('Y'); ?> Glorious Admin Hub. All Rights Reserved.</p>
</footer>

<?php include 'includes/footer.php'; ?>
