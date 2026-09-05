<?php
// admin/settings.php
require_once 'includes/admin_header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $error = 'Invalid CSRF token. Please try again.';
    } else {
        $site_name = sanitize($_POST['site_name'] ?? '');
        $contact_email = sanitize($_POST['contact_email'] ?? '');
        $contact_phone = sanitize($_POST['contact_phone'] ?? '');
        $contact_address = sanitize($_POST['contact_address'] ?? '');
        $footer_text = sanitize($_POST['footer_text'] ?? '');
        
        $updates = [
            'site_name' => $site_name,
            'contact_email' => $contact_email,
            'contact_phone' => $contact_phone,
            'contact_address' => $contact_address,
            'footer_text' => $footer_text
        ];

        // Handle Logo Upload
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $file_tmp = $_FILES['logo']['tmp_name'];
            $file_type = mime_content_type($file_tmp);
            
            if (in_array($file_type, $allowed_types)) {
                $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $filename = 'logo_' . time() . '.' . $ext;
                $upload_dir = '../assets/images/';
                
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                if (move_uploaded_file($file_tmp, $upload_dir . $filename)) {
                    $updates['logo_path'] = 'assets/images/' . $filename;
                } else {
                    $error = "Failed to move uploaded logo file.";
                }
            } else {
                $error = "Invalid logo file type. Only JPG, PNG, GIF, and WEBP are allowed.";
            }
        }

        if (!$error) {
            try {
                $pdo->beginTransaction();
                $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
                foreach ($updates as $key => $value) {
                    $stmt->execute([$key, $value]);
                }
                $pdo->commit();
                $success = 'Settings updated successfully.';
            } catch (PDOException $e) {
                $pdo->rollBack();
                $error = 'Database error: ' . $e->getMessage();
            }
        }
    }
}

$csrf_token = generateCSRFToken();
$settings = getSettings();
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h2 class="fw-bold">Site Settings</h2>
</div>

<?php if ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="settings.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

            <h5 class="mb-4 text-primary">General Configuration</h5>
            
            <div class="mb-3">
                <label for="site_name" class="form-label fw-bold">Site Name</label>
                <input type="text" class="form-control" id="site_name" name="site_name" value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Website Logo</label>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <?php if (!empty($settings['logo_path'])): ?>
                        <div class="p-2 border rounded bg-light">
                            <img src="../<?= htmlspecialchars($settings['logo_path']) ?>" alt="Current Logo" style="max-height: 50px;">
                        </div>
                    <?php endif; ?>
                    <input class="form-control" type="file" id="logo" name="logo" accept="image/*">
                </div>
                <div class="form-text">Leave blank to keep the current logo. Recommended height: 40px.</div>
            </div>

            <hr class="my-4">
            <h5 class="mb-4 text-primary">Contact & Footer Information</h5>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="contact_email" class="form-label fw-bold">Contact Email</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" value="<?= htmlspecialchars($settings['contact_email'] ?? '') ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="contact_phone" class="form-label fw-bold">Contact Phone</label>
                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="<?= htmlspecialchars($settings['contact_phone'] ?? '') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="contact_address" class="form-label fw-bold">Contact Address</label>
                <input type="text" class="form-control" id="contact_address" name="contact_address" value="<?= htmlspecialchars($settings['contact_address'] ?? '') ?>">
            </div>

            <div class="mb-4">
                <label for="footer_text" class="form-label fw-bold">Footer Description</label>
                <textarea class="form-control" id="footer_text" name="footer_text" rows="3"><?= htmlspecialchars($settings['footer_text'] ?? '') ?></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4 py-2"><i class="bi bi-save me-2"></i> Save Settings</button>
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/admin_footer.php'; ?>
