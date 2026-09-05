<?php
// index.php
require_once 'includes/header.php';

// Fetch top 3 services
$stmt = $pdo->query("SELECT * FROM services ORDER BY sort_order ASC LIMIT 3");
$services = $stmt->fetchAll();

// Fetch top 4 projects
$projStmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT 4");
$projects = $projStmt->fetchAll();
?>

<!-- Hero Section -->
<section class="hero bg-primary text-white text-center py-5 mb-5 shadow" style="background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-info) 100%);">
    <div class="container py-5">
        <h1 class="display-4 fw-bold mb-3">Modern Digital Solutions for the Enterprise</h1>
        <p class="lead mb-4 mx-auto" style="max-width: 700px;">
            <?= SITE_NAME ?> is your trusted partner for Full-Stack Web, Mobile Apps, Enterprise Software, and POS/ERP Systems. We scale your business with robust tech.
        </p>
        <div>
            <a href="services.php" class="btn btn-light btn-lg px-4 me-2 shadow-sm rounded-pill fw-bold text-primary">Explore Services</a>
            <a href="contact.php" class="btn btn-outline-light btn-lg px-4 shadow-sm rounded-pill fw-bold">Get a Quote</a>
        </div>
    </div>
</section>

<!-- Value Proposition -->
<section class="container mb-5">
    <div class="row text-center g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4">
                <i class="bi bi-speedometer2 text-primary display-4 mb-3"></i>
                <h4 class="fw-bold">High Performance</h4>
                <p class="text-muted">Lightning-fast load times and optimized architecture for maximum efficiency.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4">
                <i class="bi bi-shield-lock text-primary display-4 mb-3"></i>
                <h4 class="fw-bold">Secure by Design</h4>
                <p class="text-muted">Industry-standard security practices ensuring your data is always protected.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm p-4">
                <i class="bi bi-headset text-primary display-4 mb-3"></i>
                <h4 class="fw-bold">24/7 Support</h4>
                <p class="text-muted">Dedicated infrastructure maintenance and continuous digital support.</p>
            </div>
        </div>
    </div>
</section>

<!-- Core Services -->
<section class="bg-light py-5 mb-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Core Services</h2>
            <p class="text-muted">Tailored solutions to drive your digital transformation.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($services as $service): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm service-card transition-all">
                        <div class="card-body p-4 text-center">
                            <i class="bi <?= htmlspecialchars($service['icon_class']) ?> text-primary display-4 mb-3 d-block"></i>
                            <h4 class="fw-bold mb-3"><?= htmlspecialchars($service['title']) ?></h4>
                            <p class="text-muted"><?= htmlspecialchars($service['short_desc']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="services.php" class="btn btn-outline-primary rounded-pill px-4">View All Services</a>
        </div>
    </div>
</section>

<!-- Recent Projects Preview -->
<section class="container mb-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Recent Case Studies</h2>
        <p class="text-muted">A glimpse into our successful digital deployments.</p>
    </div>
    <div class="row g-4">
        <?php if (count($projects) > 0): ?>
            <?php foreach ($projects as $project): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        <?php if ($project['image_url']): ?>
                            <img src="<?= htmlspecialchars($project['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($project['title']) ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-light text-secondary text-center d-flex align-items-center justify-content-center card-img-top" style="height: 200px;">
                                <i class="bi bi-image display-1"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body p-4">
                            <span class="badge bg-primary mb-2"><?= htmlspecialchars($project['category']) ?></span>
                            <h5 class="fw-bold mb-2"><?= htmlspecialchars($project['title']) ?></h5>
                            <?php if ($project['client_name']): ?>
                                <p class="text-muted small mb-3"><i class="bi bi-person-workspace me-1"></i> Client: <?= htmlspecialchars($project['client_name']) ?></p>
                            <?php endif; ?>
                            <p class="text-secondary small" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;"><?= nl2br(htmlspecialchars($project['description'] ?? '')) ?></p>
                        </div>
                        <?php if ($project['live_url']): ?>
                        <div class="card-footer bg-white border-0 p-4 pt-0 text-end">
                            <a href="<?= htmlspecialchars($project['live_url']) ?>" target="_blank" class="btn btn-sm btn-primary rounded-pill">View Live <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center text-muted">
                <p>No projects to display yet.</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="text-center mt-4">
        <a href="portfolio.php" class="btn btn-primary rounded-pill px-4">View Portfolio</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
