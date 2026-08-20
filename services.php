<?php
// services.php
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM services ORDER BY sort_order ASC");
$services = $stmt->fetchAll();
?>

<div class="bg-primary text-white text-center py-5 mb-5" style="background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-info) 100%);">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Our Services</h1>
        <p class="lead mb-0">End-to-end digital solutions designed to scale your business.</p>
    </div>
</div>

<div class="container mb-5">
    <?php if (count($services) > 0): ?>
        <?php foreach ($services as $index => $service): ?>
            <div class="row align-items-center mb-5 <?= $index % 2 !== 0 ? 'flex-row-reverse' : '' ?>">
                <div class="col-md-5 text-center mb-4 mb-md-0">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                        <i class="bi <?= htmlspecialchars($service['icon_class']) ?> text-primary" style="font-size: 4rem;"></i>
                    </div>
                </div>
                <div class="col-md-7">
                    <h2 class="fw-bold mb-3"><?= htmlspecialchars($service['title']) ?></h2>
                    <p class="lead text-muted mb-3"><?= htmlspecialchars($service['short_desc']) ?></p>
                    <p><?= nl2br(htmlspecialchars($service['full_desc'] ?? 'We provide top-notch expertise and scalable infrastructure for ' . $service['title'] . '.')) ?></p>
                </div>
            </div>
            <?php if ($index < count($services) - 1): ?>
                <hr class="text-secondary opacity-25 mb-5">
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center text-muted">No services found.</p>
    <?php endif; ?>
</div>

<div class="bg-light py-5 text-center">
    <div class="container">
        <h3 class="fw-bold mb-3">Ready to start a project?</h3>
        <p class="text-muted mb-4">Contact us today to get a tailored quote for your business needs.</p>
        <a href="contact.php" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">Get in Touch</a>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
