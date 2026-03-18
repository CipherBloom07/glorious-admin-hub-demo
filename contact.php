<?php require 'includes/header.php'; ?>

<div class="container my-5">

  <!-- Page Header -->
  <section class="text-center mb-5">
    <h2 class="fw-bold text-primary">Contact Us</h2>
    <p class="text-muted fs-5">
      We'd love to hear from you! Whether you have questions, feedback, or collaboration ideas,
      the <strong>Glorious Admin Hub</strong> team is always ready to help.
    </p>
  </section>

  <div class="row align-items-center">
    <!-- Contact Info Card -->
    <div class="col-md-5 mb-4 mb-md-0">
      <div class="card shadow-sm p-4 rounded-4" style="border-top: 5px solid var(--primary);">
        <h5 class="fw-semibold text-primary mb-3">Get In Touch</h5>
        <p class="text-dark">You can reach us via the following channels:</p>
        <ul class="list-unstyled text-dark">
          <li><i class="fas fa-envelope me-2 text-primary"></i> support@gloriousadminhub.com</li>
          <li><i class="fas fa-phone me-2 text-primary"></i> +263713008111</li>
          <li><i class="fas fa-map-marker-alt me-2 text-primary"></i> Harare, Zimbabwe</li>
        </ul>
        <hr>
        <p class="small text-dark">Our support team is available <strong>24/7</strong> to assist you with any inquiries or technical needs.</p>
      </div>
    </div>

    <!-- Contact Form Card -->
    <div class="col-md-7">
      <div class="card shadow-sm p-4 rounded-4" style="border-top: 5px solid var(--primary);">
        <form action="contact_process.php" method="post">
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Your Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Your Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
          </div>

          <div class="mb-3">
            <label for="message" class="form-label fw-semibold">Message</label>
            <textarea id="message" name="message" class="form-control" rows="5" placeholder="Type your message..." required></textarea>
          </div>

          <button type="submit" class="btn btn-primary w-100 mt-2 fw-semibold">Send Message</button>
        </form>
      </div>
    </div>
  </div>

</div>

<footer class="mt-5 text-center text-muted">
  <p>© <?php echo date('Y'); ?> Glorious Admin Hub. All Rights Reserved.</p>
</footer>

<?php require 'includes/footer.php'; ?>
