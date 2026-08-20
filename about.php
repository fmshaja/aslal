<?php
// about.php
require_once 'includes/header.php';
?>

<div class="container py-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-6 mb-4 mb-md-0">
            <h1 class="display-4 fw-bold text-primary mb-3">About <?= SITE_NAME ?></h1>
            <p class="lead text-muted mb-4">We are a premier IT solutions provider dedicated to transforming businesses through modern digital technology.</p>
            <p>At <?= SITE_NAME ?>, our mission is to deliver high-quality, scalable, and secure software applications. From tailored POS systems for retail outlets to comprehensive enterprise mobile applications, we handle the full software development lifecycle.</p>
            <p>Our engineering values focus on clean code, performance optimization, and creating intuitive user experiences.</p>
        </div>
        <div class="col-md-6">
            <div class="bg-light p-5 rounded-4 shadow-sm text-center">
                <i class="bi bi-buildings-fill text-primary display-1 mb-3 d-block"></i>
                <h3 class="fw-bold">Building Digital Futures</h3>
            </div>
        </div>
    </div>
    
    <div class="row g-4 mt-4 text-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 p-4">
                <h3 class="fw-bold text-primary">Vision</h3>
                <p class="text-muted mt-2">To be the most trusted technology partner globally, driving innovation and digital excellence.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 p-4">
                <h3 class="fw-bold text-primary">Mission</h3>
                <p class="text-muted mt-2">To empower enterprises by engineering robust, efficient, and user-centric digital products.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 p-4">
                <h3 class="fw-bold text-primary">Expertise</h3>
                <p class="text-muted mt-2">Full-stack development, mobile solutions, cloud infrastructure, and enterprise ERP systems.</p>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
