<?php
// admin/inquiries.php
require_once 'includes/admin_header.php';

// Handle delete
if (isset($_POST['delete_id'])) {
    if (verifyCSRFToken($_POST['csrf_token'])) {
        $stmt = $pdo->prepare("DELETE FROM inquiries WHERE id = ?");
        $stmt->execute([$_POST['delete_id']]);
        $msg = "Inquiry deleted successfully.";
    }
}

// Handle status update
if (isset($_POST['update_id'])) {
    if (verifyCSRFToken($_POST['csrf_token'])) {
        $stmt = $pdo->prepare("UPDATE inquiries SET status = ? WHERE id = ?");
        $stmt->execute([$_POST['status'], $_POST['update_id']]);
        $msg = "Status updated successfully.";
    }
}

$statusFilter = $_GET['status'] ?? '';
if ($statusFilter) {
    $stmt = $pdo->prepare("SELECT * FROM inquiries WHERE status = ? ORDER BY created_at DESC");
    $stmt->execute([$statusFilter]);
} else {
    $stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC");
}
$inquiries = $stmt->fetchAll();
$csrf_token = generateCSRFToken();
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h2 class="fw-bold">Manage Inquiries</h2>
    <div>
        <a href="inquiries.php" class="btn btn-sm btn-outline-secondary">All</a>
        <a href="inquiries.php?status=new" class="btn btn-sm btn-warning">New</a>
        <a href="inquiries.php?status=contacted" class="btn btn-sm btn-info">Contacted</a>
        <a href="inquiries.php?status=closed" class="btn btn-sm btn-success">Closed</a>
    </div>
</div>

<?php if (isset($msg)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<div class="table-responsive bg-white rounded shadow-sm p-3">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Service</th>
                <th>Budget</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($inquiries) > 0): ?>
                <?php foreach ($inquiries as $inq): ?>
                    <tr>
                        <td><?= date('Y-m-d', strtotime($inq['created_at'])) ?></td>
                        <td>
                            <strong><?= htmlspecialchars($inq['name']) ?></strong><br>
                            <small class="text-muted"><?= htmlspecialchars($inq['email']) ?></small>
                        </td>
                        <td><?= htmlspecialchars($inq['service_required']) ?></td>
                        <td><?= htmlspecialchars($inq['budget'] ?? 'N/A') ?></td>
                        <td>
                            <span class="badge bg-<?= $inq['status'] === 'new' ? 'warning text-dark' : ($inq['status'] === 'closed' ? 'success' : 'info') ?>">
                                <?= ucfirst($inq['status']) ?>
                            </span>
                        </td>
                        <td>
                            <!-- View Button (Triggers Modal in a real app, here we can just show a simpler form) -->
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal<?= $inq['id'] ?>">View</button>
                            
                            <!-- Delete Form -->
                            <form action="inquiries.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this inquiry?');">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                                <input type="hidden" name="delete_id" value="<?= $inq['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal<?= $inq['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Inquiry Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Name:</strong> <?= htmlspecialchars($inq['name']) ?></p>
                                    <p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($inq['email']) ?>"><?= htmlspecialchars($inq['email']) ?></a></p>
                                    <p><strong>Phone:</strong> <?= htmlspecialchars($inq['phone'] ?? 'N/A') ?></p>
                                    <p><strong>Service:</strong> <?= htmlspecialchars($inq['service_required']) ?></p>
                                    <p><strong>Budget:</strong> <?= htmlspecialchars($inq['budget'] ?? 'N/A') ?></p>
                                    <p><strong>Message:</strong></p>
                                    <div class="bg-light p-3 rounded border"><?= nl2br(htmlspecialchars($inq['message'])) ?></div>
                                    
                                    <hr>
                                    <form action="inquiries.php" method="POST">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                                        <input type="hidden" name="update_id" value="<?= $inq['id'] ?>">
                                        <div class="mb-3">
                                            <label class="form-label">Update Status</label>
                                            <select name="status" class="form-select">
                                                <option value="new" <?= $inq['status'] === 'new' ? 'selected' : '' ?>>New</option>
                                                <option value="contacted" <?= $inq['status'] === 'contacted' ? 'selected' : '' ?>>Contacted</option>
                                                <option value="closed" <?= $inq['status'] === 'closed' ? 'selected' : '' ?>>Closed</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No inquiries found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once 'includes/admin_footer.php'; ?>
