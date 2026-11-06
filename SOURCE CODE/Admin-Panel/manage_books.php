<?php
require_once 'config.php';
requireLogin();

$pageTitle = 'Manage Books';
$db = getDB();

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $stmt = $db->prepare('DELETE FROM book_table WHERE book_id = ?');
    $stmt->execute([$_GET['delete']]);
    setFlash('success', 'Book deleted successfully.');
    header('Location: manage_books.php');
    exit;
}

// Filters
$search   = trim($_GET['search'] ?? '');
$type     = $_GET['type'] ?? ''; // free or paid
$sort     = $_GET['sort'] ?? 'book_time';
$order    = strtoupper($_GET['order'] ?? 'DESC');
if (!in_array($order, ['ASC','DESC'])) $order = 'DESC';
$allowed_sorts = ['book_name','book_author','book_price','download_count','book_time'];
if (!in_array($sort, $allowed_sorts)) $sort = 'book_time';

// Pagination
$page    = max(1, (int)($_GET['page'] ?? 1));
$perPage = 10;
$offset  = ($page - 1) * $perPage;

// Build query
$where  = ['1=1'];
$params = [];

if ($search) {
    $where[]  = '(book_name LIKE ? OR book_author LIKE ?)';
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($type === 'free') {
    $where[]  = 'is_free = 1';
}
if ($type === 'paid') {
    $where[]  = 'is_free = 0';
}

$whereStr = implode(' AND ', $where);

$total = $db->prepare("SELECT COUNT(*) FROM book_table WHERE $whereStr");
$total->execute($params);
$totalRows  = $total->fetchColumn();
$totalPages = ceil($totalRows / $perPage);

$stmt = $db->prepare("
    SELECT *
    FROM book_table
    WHERE $whereStr
    ORDER BY $sort $order
    LIMIT $perPage OFFSET $offset
");
$stmt->execute($params);
$books = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Manage Books</h1>
        <p><?= number_format($totalRows) ?> book<?= $totalRows !== 1 ? 's' : '' ?> in catalog</p>
    </div>
    <a href="add_book.php" class="btn btn-primary">+ Add Book</a>
</div>

<!-- FILTER BAR -->
<div class="card" style="margin-bottom:20px">
    <div class="card-body">
        <form method="GET" action="manage_books.php">
            <div class="filter-bar">
                <div class="search-box" style="flex:2">
                    <span class="search-icon">🔍</span>
                    <input type="text" name="search" value="<?= sanitize($search) ?>" placeholder="Search title, author…">
                </div>
                <select name="type" style="min-width:130px">
                    <option value="">All Books</option>
                    <option value="free" <?= $type === 'free' ? 'selected' : '' ?>>Free Books</option>
                    <option value="paid" <?= $type === 'paid' ? 'selected' : '' ?>>Paid Books</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="manage_books.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- BOOKS TABLE -->
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Book</th>
                    <th>
                        <a href="?sort=book_author&order=<?= $sort==='book_author' && $order==='ASC' ? 'DESC' : 'ASC' ?>&search=<?= urlencode($search) ?>&type=<?= $type ?>"
                           style="color:inherit; display:flex; align-items:center; gap:4px">
                            Author <?= $sort==='book_author' ? ($order==='ASC' ? '↑' : '↓') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="?sort=book_price&order=<?= $sort==='book_price' && $order==='ASC' ? 'DESC' : 'ASC' ?>&search=<?= urlencode($search) ?>&type=<?= $type ?>"
                           style="color:inherit">
                            Price <?= $sort==='book_price' ? ($order==='ASC' ? '↑' : '↓') : '' ?>
                        </a>
                    </th>
                    <th>Downloads</th>
                    <th>Type</th>
                    <th>Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $i => $book): ?>
                <tr>
                    <td class="text-muted text-sm"><?= $offset + $i + 1 ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px">
                            <div class="book-cover">
                                <?php if ($book['book_img']): ?>
                                <img src="<?= sanitize($book['book_img']) ?>" alt="">
                                <?php else: ?>
                                <div class="book-cover-placeholder">📖</div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <div style="font-weight:500; font-size:0.875rem"><?= sanitize($book['book_name']) ?></div>
                                <div style="font-size:0.7rem; color:var(--text-muted)">ID: <?= $book['book_id'] ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="text-sm"><?= sanitize($book['book_author']) ?></td>
                    <td>
                        <?php if ($book['is_free'] == 1): ?>
                        <span class="badge badge-success">FREE</span>
                        <?php else: ?>
                        <span style="color:var(--accent); font-weight:600"><?= formatCurrency($book['book_price']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-sm" style="color:var(--text-muted)"><?= number_format($book['download_count']) ?></td>
                    <td>
                        <?php if ($book['is_free'] == 1): ?>
                        <span class="badge badge-success">Free</span>
                        <?php else: ?>
                        <span class="badge badge-gold">Paid</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-muted text-sm"><?= formatDate($book['book_time']) ?></td>
                    <td>
                        <div style="display:flex; gap:6px">
                            <a href="edit_book.php?id=<?= $book['book_id'] ?>" class="btn btn-sm btn-secondary" title="Edit">✏️</a>
                            <a href="manage_books.php?delete=<?= $book['book_id'] ?>"
                               class="btn btn-sm btn-danger"
                               data-confirm="Delete '<?= sanitize($book['book_name']) ?>'? This cannot be undone."
                               title="Delete">🗑</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($books)): ?>
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-icon">📚</div>
                            <p>No books found. <a href="add_book.php" style="color:var(--accent)">Add your first book →</a></p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <?php if ($totalPages > 1): ?>
    <div style="padding:16px 20px; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; gap:12px;">
        <span style="font-size:0.78rem; color:var(--text-muted)">
            Showing <?= $offset+1 ?>–<?= min($offset+$perPage, $totalRows) ?> of <?= number_format($totalRows) ?>
        </span>
        <div style="display:flex; gap:6px">
            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <a href="?page=<?= $p ?>&search=<?= urlencode($search) ?>&type=<?= $type ?>&sort=<?= $sort ?>&order=<?= $order ?>"
               class="btn btn-sm <?= $p === $page ? 'btn-primary' : 'btn-secondary' ?>"><?= $p ?></a>
            <?php endfor; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
