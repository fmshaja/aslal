<?php
// includes/footer.php
?>
    </main>
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3"><?= SITE_NAME ?></h5>
                    <p class="text-white-50"><?= FOOTER_TEXT ?></p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="about.php" class="text-decoration-none text-white-50 hover-white">About Us</a></li>
                        <li><a href="services.php" class="text-decoration-none text-white-50 hover-white">Services</a></li>
                        <li><a href="portfolio.php" class="text-decoration-none text-white-50 hover-white">Portfolio</a></li>
                        <li><a href="contact.php" class="text-decoration-none text-white-50 hover-white">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Contact</h5>
                    <ul class="list-unstyled text-white-50">
                        <li><i class="bi bi-envelope-fill me-2"></i> <?= CONTACT_EMAIL ?></li>
                        <?php if (CONTACT_PHONE): ?>
                        <li><i class="bi bi-telephone-fill me-2"></i> <?= CONTACT_PHONE ?></li>
                        <?php endif; ?>
                        <?php if (CONTACT_ADDRESS): ?>
                        <li><i class="bi bi-geo-alt-fill me-2"></i> <?= CONTACT_ADDRESS ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-4 border-top border-secondary mt-4">
                <p class="mb-0 text-white-50">&copy; <?= date("Y") ?> <?= SITE_NAME ?>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>