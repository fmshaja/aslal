<?php
// contact.php
require_once 'includes/header.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $error = 'Invalid CSRF token. Please try again.';
    } else {
        $name = sanitize($_POST['name'] ?? '');
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        $phone = sanitize($_POST['phone'] ?? '');
        $service = sanitize($_POST['service_required'] ?? '');
        $budget = sanitize($_POST['budget'] ?? '');
        $message = sanitize($_POST['message'] ?? '');

        if (empty($name) || empty($email) || empty($service) || empty($message)) {
            $error = 'Please fill out all required fields.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email address.';
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO inquiries (name, email, phone, service_required, budget, message) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $email, $phone, $service, $budget, $message]);
                $success = true;
            } catch (PDOException $e) {
                $error = 'An error occurred while submitting your inquiry. Please try again later.';
            }
        }
    }
}
$csrf_token = generateCSRFToken();

// Fetch services for the dropdown
$servStmt = $pdo->query("SELECT title FROM services ORDER BY sort_order ASC");
$services = $servStmt->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-primary">Get in Touch</h1>
                <p class="lead text-muted">We'd love to hear from you. Fill out the form below to request a quote or ask a question.</p>
            </div>
            
            <div class="card border-0 shadow-lg p-4 p-md-5 rounded-4">
                <?php if ($success): ?>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                        <div>
                            <strong>Thank you!</strong> Your inquiry has been submitted successfully. We will get back to you soon.
                        </div>
                    </div>
                <?php else: ?>
                    <?php if ($error): ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                            <div><?= htmlspecialchars($error) ?></div>
                        </div>
                    <?php endif; ?>
                    
                    <form action="contact.php" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control bg-light" id="name" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control bg-light" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-bold">Phone Number</label>
                                <input type="text" class="form-control bg-light" id="phone" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="budget" class="form-label fw-bold">Project Budget</label>
                                <select class="form-select bg-light" id="budget" name="budget">
                                    <option value="" disabled selected>Select a range</option>
                                    <option value="<$1000">Less than $1,000</option>
                                    <option value="$1000 - $5000">$1,000 - $5,000</option>
                                    <option value="$5000 - $10000">$5,000 - $10,000</option>
                                    <option value=">$10000">More than $10,000</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="service_required" class="form-label fw-bold">Service Required <span class="text-danger">*</span></label>
                            <select class="form-select bg-light" id="service_required" name="service_required" required>
                                <option value="" disabled selected>Select a service</option>
                                <?php foreach ($services as $srv): ?>
                                    <option value="<?= htmlspecialchars($srv) ?>"><?= htmlspecialchars($srv) ?></option>
                                <?php endforeach; ?>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label fw-bold">Project Details / Message <span class="text-danger">*</span></label>
                            <textarea class="form-control bg-light" id="message" name="message" rows="5" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill py-3 fw-bold shadow-sm">Send Message</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
