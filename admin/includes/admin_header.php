<?php
// admin/includes/admin_header.php
ob_start();
require_once __DIR__ . '/../../config/constants.php';
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../includes/functions.php';

// Only require login if we are not on the login page
if (basename($_SERVER['PHP_SELF']) !== 'login.php') {
    requireLogin();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?> | Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #343a40; }
        .sidebar a { color: #c2c7d0; text-decoration: none; padding: 10px 15px; display: block; }
        .sidebar a:hover, .sidebar a.active { background-color: #495057; color: #fff; }
    </style>
</head>
<body>
<?php if (isLoggedIn()): ?>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar flex-shrink-0 p-3" style="width: 250px;">
        <a href="dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none border-bottom pb-3">
            <span class="fs-4 fw-bold">Admin Panel</span>
        </a>
        <ul class="nav nav-pills flex-column mb-auto mt-3">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="inquiries.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'inquiries.php' ? 'active' : '' ?>">
                    <i class="bi bi-envelope me-2"></i> Inquiries
                </a>
            </li>
            <li>
                <a href="projects.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'active' : '' ?>">
                    <i class="bi bi-briefcase me-2"></i> Projects
                </a>
            </li>
            <li>
                <a href="settings.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">
                    <i class="bi bi-gear me-2"></i> Settings
                </a>
            </li>
            <li class="mt-4">
                <a href="logout.php" class="nav-link text-danger">
                    <i class="bi bi-box-arrow-left me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- Content -->
    <div class="flex-grow-1 p-4">
<?php else: ?>
    <div class="container p-4">
<?php endif; ?>
