<?php
// admin/projects.php
require_once 'includes/admin_header.php';

$uploadDir = __DIR__ . '/../assets/images/portfolio/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if (verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        if ($_POST['action'] === 'delete') {
            $stmt = $pdo->prepare("SELECT image_url FROM projects WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            $proj = $stmt->fetch();
            if ($proj && $proj['image_url']) {
                $filePath = __DIR__ . '/../' . ltrim($proj['image_url'], '/');
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $delStmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
            $delStmt->execute([$_POST['id']]);
            $msg = "Project deleted successfully.";
        } elseif ($_POST['action'] === 'save') {
            $title = sanitize($_POST['title']);
            $category = sanitize($_POST['category']);
            $client_name = sanitize($_POST['client_name']);
            $description = sanitize($_POST['description']);
            $live_url = filter_var($_POST['live_url'], FILTER_SANITIZE_URL);
            $id = $_POST['id'] ?? null;
            
            $imageUrl = $_POST['existing_image'] ?? '';
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('proj_') . '.' . $ext;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                    // if editing, remove old image
                    if ($id && $imageUrl) {
                        $oldPath = __DIR__ . '/../' . ltrim($imageUrl, '/');
                        if (file_exists($oldPath)) unlink($oldPath);
                    }
                    $imageUrl = 'assets/images/portfolio/' . $filename;
                }
            }

            if ($id) {
                $stmt = $pdo->prepare("UPDATE projects SET title=?, category=?, client_name=?, description=?, live_url=?, image_url=? WHERE id=?");
                $stmt->execute([$title, $category, $client_name, $description, $live_url, $imageUrl, $id]);
                $msg = "Project updated successfully.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO projects (title, category, client_name, description, live_url, image_url) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$title, $category, $client_name, $description, $live_url, $imageUrl]);
                $msg = "Project added successfully.";
            }
        }
    } else {
        $error = "Invalid CSRF token.";
    }
}

$stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
$projects = $stmt->fetchAll();
$csrf_token = generateCSRFToken();
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
    <h2 class="fw-bold">Manage Projects</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">Add New Project</button>
</div>

<?php if (isset($msg)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>
<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="row g-4">
    <?php foreach ($projects as $project): ?>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <?php if ($project['image_url']): ?>
                    <img src="../<?= htmlspecialchars($project['image_url']) ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                <?php else: ?>
                    <div class="bg-secondary text-white text-center py-5 card-img-top" style="height: 180px;"><i class="bi bi-image display-4"></i></div>
                <?php endif; ?>
                <div class="card-body">
                    <span class="badge bg-primary mb-2"><?= htmlspecialchars($project['category']) ?></span>
                    <h5 class="card-title fw-bold"><?= htmlspecialchars($project['title']) ?></h5>
                    <p class="text-muted small mb-0"><?= htmlspecialchars($project['client_name']) ?></p>
                </div>
                <div class="card-footer bg-white border-top d-flex justify-content-between">
                    <button class="btn btn-sm btn-outline-primary" onclick="editProject(<?= htmlspecialchars(json_encode($project)) ?>)">Edit</button>
                    <form action="projects.php" method="POST" onsubmit="return confirm('Delete this project?');">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $project['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="projectModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="projects.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" id="proj_id">
                <input type="hidden" name="existing_image" id="existing_image">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Project Title</label>
                            <input type="text" class="form-control" name="title" id="proj_title" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category" id="proj_category" required>
                                <option value="Web">Web</option>
                                <option value="Mobile">Mobile</option>
                                <option value="POS">POS</option>
                                <option value="Enterprise">Enterprise</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Client Name</label>
                            <input type="text" class="form-control" name="client_name" id="proj_client">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Live URL</label>
                            <input type="url" class="form-control" name="live_url" id="proj_url">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="proj_desc" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Project Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                        <small class="text-muted">Leave empty to keep existing image.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editProject(project) {
    document.getElementById('modalTitle').innerText = 'Edit Project';
    document.getElementById('proj_id').value = project.id;
    document.getElementById('proj_title').value = project.title;
    document.getElementById('proj_category').value = project.category;
    document.getElementById('proj_client').value = project.client_name;
    document.getElementById('proj_url').value = project.live_url;
    document.getElementById('proj_desc').value = project.description;
    document.getElementById('existing_image').value = project.image_url;
    
    var myModal = new bootstrap.Modal(document.getElementById('projectModal'));
    myModal.show();
}

document.getElementById('projectModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('modalTitle').innerText = 'Add Project';
    document.getElementById('proj_id').value = '';
    document.querySelector('#projectModal form').reset();
    document.getElementById('existing_image').value = '';
});
</script>

<?php require_once 'includes/admin_footer.php'; ?>
