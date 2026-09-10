<?php
// about.php
require_once 'includes/header.php';
?>

<div class="bg-primary text-white text-center py-5 mb-5" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
    <div class="container py-5">
        <h1 class="display-4 fw-bold">About <?= SITE_NAME ?></h1>
        <p class="lead mb-0">We are a premier IT solutions provider dedicated to transforming businesses through modern digital technology.</p>
    </div>
</div>

<div class="container py-5 mb-5">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 class="fw-bold mb-4">Building Digital Futures</h2>
            <p class="lead text-muted mb-4">At <?= SITE_NAME ?>, our mission is to deliver high-quality, scalable, and secure software applications. From tailored POS systems for retail outlets to comprehensive enterprise mobile applications, we handle the full software development lifecycle.</p>
            <p class="text-muted">Our engineering values focus on clean code, performance optimization, and creating intuitive user experiences.</p>
        </div>
        <div class="col-lg-6">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="About Us" class="img-fluid rounded-4 shadow-lg">
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
