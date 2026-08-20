<?php
// portfolio.php
require_once 'includes/header.php';

$category = $_GET['category'] ?? 'All';

if ($category !== 'All') {
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE category = ? ORDER BY created_at DESC");
    $stmt->execute([$category]);
} else {
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
}
$projects = $stmt->fetchAll();

// Get unique categories for filter
$catStmt = $pdo->query("SELECT DISTINCT category FROM projects");
$categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="bg-dark text-white text-center py-5 mb-5">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Our Portfolio</h1>
        <p class="lead mb-0 text-secondary">A selection of our latest and greatest work.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="d-flex justify-content-center gap-2 mb-5 flex-wrap">
        <a href="portfolio.php" class="btn <?= $category === 'All' ? 'btn-primary' : 'btn-outline-primary' ?> rounded-pill px-4">All</a>
        <?php foreach ($categories as $cat): ?>
            <a href="portfolio.php?category=<?= urlencode($cat) ?>" class="btn <?= $category === $cat ? 'btn-primary' : 'btn-outline-primary' ?> rounded-pill px-4"><?= htmlspecialchars($cat) ?></a>
        <?php endforeach; ?>
    </div>

    <div class="row g-4">
        <?php if (count($projects) > 0): ?>
            <?php foreach ($projects as $project): ?>
                <div class="col-md-6 col-lg-4">
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
                            <h4 class="fw-bold mb-2"><?= htmlspecialchars($project['title']) ?></h4>
                            <?php if ($project['client_name']): ?>
                                <p class="text-muted small mb-3"><i class="bi bi-person-workspace me-1"></i> Client: <?= htmlspecialchars($project['client_name']) ?></p>
                            <?php endif; ?>
                            <p class="text-secondary"><?= nl2br(htmlspecialchars($project['description'] ?? '')) ?></p>
                        </div>
                        <?php if ($project['live_url']): ?>
                        <div class="card-footer bg-white border-0 p-4 pt-0 text-end">
                            <a href="<?= htmlspecialchars($project['live_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill">View Live <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center text-muted py-5">
                <i class="bi bi-folder-x display-1 d-block mb-3"></i>
                <p class="lead">No projects found in this category.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
