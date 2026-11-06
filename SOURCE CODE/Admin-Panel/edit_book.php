<?php
require_once 'config.php';
requireLogin();

$db = getDB();
$id = (int)($_GET['id'] ?? 0);

if (!$id) { header('Location: manage_books.php'); exit; }

$book = $db->prepare('SELECT * FROM book_table WHERE book_id = ?');
$book->execute([$id]);
$book = $book->fetch();
if (!$book) { setFlash('danger', 'Book not found.'); header('Location: manage_books.php'); exit; }

$pageTitle  = 'Edit Book';
$errors     = [];
$formData   = $book;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $_POST;

    $required = ['book_name', 'book_author', 'book_price'];
    foreach ($required as $field) {
        if (empty(trim($_POST[$field] ?? ''))) {
            $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }

    if (!isset($errors['book_price']) && !is_numeric($_POST['book_price'])) {
        $errors['book_price'] = 'Price must be a valid number.';
    }

    if (empty($errors)) {
        $stmt = $db->prepare('
            UPDATE book_table SET
                book_name = ?,
                book_author = ?,
                book_price = ?,
                book_img = ?,
                is_free = ?
            WHERE book_id = ?
        ');
        $stmt->execute([
            trim($_POST['book_name']),
            trim($_POST['book_author']),
            (float)$_POST['book_price'],
            trim($_POST['book_img'] ?? ''),
            isset($_POST['is_free']) ? 1 : 0,
            $id,
        ]);

        // Refresh book data
        $bookStmt = $db->prepare('SELECT * FROM book_table WHERE book_id = ?');
        $bookStmt->execute([$id]);
        $formData = $bookStmt->fetch();

        setFlash('success', 'Book updated successfully!');
        header('Location: manage_books.php');
        exit;
    }
}

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Edit Book</h1>
        <p>Editing: <em><?= sanitize($book['book_name']) ?></em></p>
    </div>
    <div style="display:flex; gap:10px">
        <a href="manage_books.php" class="btn btn-secondary">← Back</a>
        <a href="manage_books.php?delete=<?= $id ?>"
           class="btn btn-danger"
           data-confirm="Permanently delete this book?">🗑 Delete Book</a>
    </div>
</div>

<form method="POST" action="edit_book.php?id=<?= $id ?>">
<div style="display:grid; grid-template-columns: 1fr 340px; gap:20px; align-items:start">
    <div class="card">
        <div class="card-header"><span class="card-title">Book Information</span></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full-width">
                    <label>Book Name *</label>
                    <input type="text" name="book_name" value="<?= sanitize($formData['book_name'] ?? '') ?>" required>
                    <?php if (isset($errors['book_name'])): ?><span style="color:var(--danger); font-size:0.78rem"><?= $errors['book_name'] ?></span><?php endif; ?>
                </div>
                <div class="form-group full-width">
                    <label>Author *</label>
                    <input type="text" name="book_author" value="<?= sanitize($formData['book_author'] ?? '') ?>" required>
                    <?php if (isset($errors['book_author'])): ?><span style="color:var(--danger); font-size:0.78rem"><?= $errors['book_author'] ?></span><?php endif; ?>
                </div>
                <div class="form-group full-width">
                    <label>Cover Image URL</label>
                    <?php if ($book['book_img']): ?>
                    <div style="margin-bottom:8px">
                        <img src="<?= sanitize($book['book_img']) ?>" style="height:100px; border-radius:4px; border:1px solid var(--border)" alt="Current cover">
                        <div style="font-size:0.72rem; color:var(--text-muted); margin-top:4px">Current cover</div>
                    </div>
                    <?php endif; ?>
                    <input type="text" name="book_img" value="<?= sanitize($formData['book_img'] ?? '') ?>" placeholder="https://... or uploads/covers/...">
                    <span class="form-hint">Update URL to change cover image</span>
                </div>
            </div>
        </div>
    </div>

    <div style="display:flex; flex-direction:column; gap:20px">
        <div class="card">
            <div class="card-header"><span class="card-title">Pricing</span></div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:16px">
                <div class="form-group">
                    <label>Price (₹) *</label>
                    <input type="number" name="book_price" value="<?= sanitize($formData['book_price'] ?? '') ?>" step="0.01" min="0" required>
                    <?php if (isset($errors['book_price'])): ?><span style="color:var(--danger); font-size:0.78rem"><?= $errors['book_price'] ?></span><?php endif; ?>
                </div>

                <label style="display:flex; align-items:center; gap:10px; padding:12px; border:1px solid <?= $formData['is_free'] == 1 ? 'var(--success)' : 'var(--border)' ?>; border-radius:8px; cursor:pointer; background:<?= $formData['is_free'] == 1 ? 'var(--success-dim)' : 'transparent' ?>">
                    <input type="checkbox" name="is_free" value="1" <?= $formData['is_free'] == 1 ? 'checked' : '' ?>
                           style="width:auto; margin:0; accent-color:var(--success)">
                    <div>
                        <div style="font-weight:500; font-size:0.85rem; color:var(--success)">🆓 Free Book</div>
                        <div style="font-size:0.72rem; color:var(--text-muted)">Check if free to download</div>
                    </div>
                </label>
            </div>
        </div>

        <div style="font-size:0.75rem; color:var(--text-muted); padding:10px 0">
            Added: <?= formatDate($book['book_time']) ?><br>
            Downloads: <?= number_format($book['download_count']) ?><br>
            Book ID: <?= $book['book_id'] ?>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px">✏️ Update Book</button>
        <a href="manage_books.php" class="btn btn-secondary" style="width:100%; justify-content:center">Cancel</a>
    </div>
</div>
</form>

<?php include 'includes/footer.php'; ?>
