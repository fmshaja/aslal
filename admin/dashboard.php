<?php
// admin/dashboard.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'includes/admin_header.php';

// Fetch stats
$inqCountStmt = $pdo->query("SELECT COUNT(*) FROM inquiries");
$inqCount = $inqCountStmt->fetchColumn();

$newInqStmt = $pdo->query("SELECT COUNT(*) FROM inquiries WHERE status = 'new'");
$newInqCount = $newInqStmt->fetchColumn();

$projCountStmt = $pdo->query("SELECT COUNT(*) FROM projects");
$projCount = $projCountStmt->fetchColumn();
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h2 class="fw-bold">Dashboard</h2>
    <span class="text-muted">Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 shadow-sm h-100 border-0">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-envelope me-2"></i> Total Inquiries</h5>
                <p class="card-text display-4 fw-bold"><?= $inqCount ?></p>
            </div>
            <div class="card-footer bg-transparent border-top-0 pt-0">
                <a href="inquiries.php" class="text-white text-decoration-none">View Details <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning mb-3 shadow-sm h-100 border-0">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-envelope-exclamation me-2"></i> New Inquiries</h5>
                <p class="card-text display-4 fw-bold"><?= $newInqCount ?></p>
            </div>
            <div class="card-footer bg-transparent border-top-0 pt-0">
                <a href="inquiries.php?status=new" class="text-dark text-decoration-none">Review Now <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 shadow-sm h-100 border-0">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-briefcase me-2"></i> Total Projects</h5>
                <p class="card-text display-4 fw-bold"><?= $projCount ?></p>
            </div>
            <div class="card-footer bg-transparent border-top-0 pt-0">
                <a href="projects.php" class="text-white text-decoration-none">Manage Portfolio <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/admin_footer.php'; ?>
