<?php
// includes/header.php
ob_start();
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> | IT Solutions & Digital Consultancy</title>
    <meta name="description" content="<?= SITE_NAME ?> delivers modern digital solutions including Custom Web, Mobile App Development, Enterprise Software, POS, and Digital Support.">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="assets/images/favicon.jpg">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top py-3">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-triangle-half logo-icon"></i> AZLAL <span class="fs-6 text-muted fw-normal">PVT LTD</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="services.php">All Services</a></li>
                            <li><a class="dropdown-item" href="#">Web & App Development</a></li>
                            <li><a class="dropdown-item" href="#">Construction & QS</a></li>
                            <li><a class="dropdown-item" href="#">Quality Assurance</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="portfolio.php">Our Work</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="d-none d-lg-block">
                <a href="contact.php" class="btn btn-primary rounded-pill px-4 fw-bold">Get a Quote <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </nav>
    <main class="min-vh-100">
