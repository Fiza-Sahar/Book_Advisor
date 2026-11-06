<?php
require_once 'config.php';
requireLogin();

$pageTitle  = 'Add New Book';
$db         = getDB();
$errors     = [];
$formData   = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $_POST;

    // Validate required fields
    $required = ['book_name', 'book_author', 'book_price'];
    foreach ($required as $field) {
        if (empty(trim($_POST[$field] ?? ''))) {
            $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }

    if (!isset($errors['book_price']) && !is_numeric($_POST['book_price'])) {
        $errors['book_price'] = 'Price must be a valid number.';
    }

    // Handle cover image — file upload pehle, phir URL
    $coverImage = trim($_POST['book_img'] ?? '');

    if (isset($_FILES['book_img_file']) && $_FILES['book_img_file']['error'] === UPLOAD_ERR_OK) {
        $file    = $_FILES['book_img_file'];
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($file['type'], $allowed)) {
            $errors['book_img'] = 'Only JPG, PNG, GIF, WEBP images allowed.';
        } elseif ($file['size'] > $maxSize) {
            $errors['book_img'] = 'Image must be under 5MB.';
        } else {
            $uploadDir = __DIR__ . '/uploads/covers/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            $ext        = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename   = 'cover_' . uniqid() . '.' . strtolower($ext);
            $uploadPath = $uploadDir . $filename;

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                $coverImage = 'uploads/covers/' . $filename;
            } else {
                $errors['book_img'] = 'Upload failed. Check folder permissions (chmod 755 uploads/covers/).';
            }
        }
    }

    if (empty($errors)) {
        $stmt = $db->prepare('
            INSERT INTO book_table (book_name, book_author, book_price, book_img, book_time, is_free, download_count)
            VALUES (?, ?, ?, ?, NOW(), ?, 0)
        ');
        $stmt->execute([
            trim($_POST['book_name']),
            trim($_POST['book_author']),
            (float)$_POST['book_price'],
            $coverImage,
            isset($_POST['is_free']) ? 1 : 0,
        ]);

        setFlash('success', 'Book "' . sanitize($_POST['book_name']) . '" added successfully!');
        header('Location: manage_books.php');
        exit;
    }
}

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Add New Book</h1>
        <p>Fill in the details below to add a book to the catalog.</p>
    </div>
    <a href="manage_books.php" class="btn btn-secondary">← Back to Books</a>
</div>

<form method="POST" action="add_book.php" enctype="multipart/form-data">
<div style="display:grid; grid-template-columns: 1fr 340px; gap:20px; align-items:start">

    <!-- LEFT: MAIN DETAILS -->
    <div class="card">
        <div class="card-header"><span class="card-title">Book Information</span></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full-width">
                    <label>Book Name *</label>
                    <input type="text" name="book_name" value="<?= sanitize($formData['book_name'] ?? '') ?>"
                           placeholder="e.g. The Digital Frontier" required>
                    <?php if (isset($errors['book_name'])): ?>
                    <span style="color:var(--danger); font-size:0.78rem"><?= $errors['book_name'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group full-width">
                    <label>Author *</label>
                    <input type="text" name="book_author" value="<?= sanitize($formData['book_author'] ?? '') ?>"
                           placeholder="Author name" required>
                    <?php if (isset($errors['book_author'])): ?>
                    <span style="color:var(--danger); font-size:0.78rem"><?= $errors['book_author'] ?></span>
                    <?php endif; ?>
                </div>

                <!-- COVER IMAGE SECTION -->
                <div class="form-group full-width">
                    <label>Cover Image</label>

                    <!-- Tab switcher -->
                    <div style="display:flex; gap:0; margin-bottom:12px; border:1px solid var(--border); border-radius:8px; overflow:hidden; width:fit-content">
                        <button type="button" id="tab-upload" onclick="switchTab('upload')"
                                style="padding:8px 20px; background:var(--accent); color:#0d0f14; border:none; cursor:pointer; font-size:0.82rem; font-weight:600">
                            📁 Upload File
                        </button>
                        <button type="button" id="tab-url" onclick="switchTab('url')"
                                style="padding:8px 20px; background:var(--bg-elevated); color:var(--text-secondary); border:none; cursor:pointer; font-size:0.82rem">
                            🔗 Use URL
                        </button>
                    </div>

                    <!-- FILE UPLOAD -->
                    <div id="panel-upload">
                        <input type="file" name="book_img_file" id="imgFile" accept="image/*"
                               style="display:none" onchange="previewImage(this)">
                        <div id="drop-area" onclick="document.getElementById('imgFile').click()"
                             style="border:2px dashed var(--border); border-radius:10px; padding:30px; text-align:center; cursor:pointer; transition:0.2s; background:var(--bg-elevated)">
                            <div id="drop-text">
                                <div style="font-size:2rem; margin-bottom:8px">🖼️</div>
                                <div style="font-size:0.85rem; color:var(--text-secondary)">Click to upload or drag & drop</div>
                                <div style="font-size:0.75rem; color:var(--text-muted); margin-top:4px">JPG, PNG, GIF, WEBP — max 5MB</div>
                            </div>
                            <img id="img-preview" src="" alt=""
                                 style="display:none; max-height:160px; border-radius:6px; margin:0 auto">
                        </div>
                        <?php if (isset($errors['book_img'])): ?>
                        <span style="color:var(--danger); font-size:0.78rem"><?= $errors['book_img'] ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- URL INPUT -->
                    <div id="panel-url" style="display:none">
                        <input type="text" name="book_img" value="<?= sanitize($formData['book_img'] ?? '') ?>"
                               placeholder="https://example.com/cover.jpg"
                               style="width:100%"
                               oninput="previewUrl(this.value)">
                        <span class="form-hint">Paste a direct image URL</span>
                        <img id="url-preview" src="" alt=""
                             style="display:none; max-height:120px; margin-top:10px; border-radius:6px; border:1px solid var(--border)">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: PRICING & TYPE -->
    <div style="display:flex; flex-direction:column; gap:20px">
        <div class="card">
            <div class="card-header"><span class="card-title">Pricing</span></div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:16px">
                <div class="form-group">
                    <label>Price (₹) *</label>
                    <input type="number" name="book_price" value="<?= sanitize($formData['book_price'] ?? '0') ?>"
                           placeholder="299" step="0.01" min="0" required>
                    <?php if (isset($errors['book_price'])): ?>
                    <span style="color:var(--danger); font-size:0.78rem"><?= $errors['book_price'] ?></span>
                    <?php endif; ?>
                </div>

                <label style="display:flex; align-items:center; gap:10px; padding:12px; border:1px solid var(--border); border-radius:8px; cursor:pointer; background:var(--success-dim)">
                    <input type="checkbox" name="is_free" value="1" <?= isset($formData['is_free']) ? 'checked' : '' ?>
                           style="width:auto; margin:0; accent-color:var(--success)">
                    <div>
                        <div style="font-weight:500; font-size:0.85rem; color:var(--success)">🆓 Free Book</div>
                        <div style="font-size:0.72rem; color:var(--text-muted)">Check if this book is free to download</div>
                    </div>
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px; font-size:0.9rem">
            📚 Add Book to Catalog
        </button>
        <a href="manage_books.php" class="btn btn-secondary" style="width:100%; justify-content:center">Cancel</a>
    </div>
</div>
</form>

<script>
function switchTab(tab) {
    const isUpload = tab === 'upload';
    document.getElementById('panel-upload').style.display = isUpload ? 'block' : 'none';
    document.getElementById('panel-url').style.display    = isUpload ? 'none'  : 'block';
    document.getElementById('tab-upload').style.background = isUpload ? 'var(--accent)' : 'var(--bg-elevated)';
    document.getElementById('tab-upload').style.color      = isUpload ? '#0d0f14' : 'var(--text-secondary)';
    document.getElementById('tab-url').style.background    = isUpload ? 'var(--bg-elevated)' : 'var(--accent)';
    document.getElementById('tab-url').style.color         = isUpload ? 'var(--text-secondary)' : '#0d0f14';
}

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('img-preview');
            const dropText = document.getElementById('drop-text');
            preview.src = e.target.result;
            preview.style.display = 'block';
            dropText.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewUrl(url) {
    const preview = document.getElementById('url-preview');
    if (url.trim()) {
        preview.src = url;
        preview.style.display = 'block';
        preview.onerror = () => preview.style.display = 'none';
    } else {
        preview.style.display = 'none';
    }
}

// Drag & drop
const dropArea = document.getElementById('drop-area');
dropArea.addEventListener('dragover', e => { e.preventDefault(); dropArea.style.borderColor = 'var(--accent)'; });
dropArea.addEventListener('dragleave', () => dropArea.style.borderColor = 'var(--border)');
dropArea.addEventListener('drop', e => {
    e.preventDefault();
    dropArea.style.borderColor = 'var(--border)';
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const input = document.getElementById('imgFile');
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        previewImage(input);
    }
});
</script>

<?php include 'includes/footer.php'; ?>
