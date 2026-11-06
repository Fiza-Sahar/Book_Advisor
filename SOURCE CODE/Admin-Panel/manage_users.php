<?php
require_once 'config.php';
requireLogin();

$pageTitle = 'Manage Users';
$db = getDB();

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $db->prepare('DELETE FROM users WHERE user_id=?')->execute([$_GET['delete']]);
    setFlash('success', 'User deleted.');
    header('Location: manage_users.php');
    exit;
}

// Filters
$search = trim($_GET['search'] ?? '');

$where  = ['1=1'];
$params = [];

if ($search) {
    $where[]  = '(user_name LIKE ? OR email LIKE ?)';
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$whereStr = implode(' AND ', $where);

$page    = max(1, (int)($_GET['page'] ?? 1));
$perPage = 12;
$offset  = ($page - 1) * $perPage;

$totalStmt = $db->prepare("SELECT COUNT(*) FROM users WHERE $whereStr");
$totalStmt->execute($params);
$totalRows  = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $perPage);

$stmt = $db->prepare("
    SELECT u.*,
           COUNT(DISTINCT o.order_id) AS order_count,
           COALESCE(SUM(o.order_total_price), 0) AS total_spent
    FROM users u
    LEFT JOIN order_table o ON u.user_id = o.order_register_id
    WHERE $whereStr
    GROUP BY u.user_id
    ORDER BY u.created_at DESC
    LIMIT $perPage OFFSET $offset
");
$stmt->execute($params);
$users = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Manage Users</h1>
        <p><?= number_format($totalRows) ?> registered user<?= $totalRows !== 1 ? 's' : '' ?></p>
    </div>
</div>

<!-- FILTER -->
<div class="card" style="margin-bottom:20px">
    <div class="card-body">
        <form method="GET">
            <div class="filter-bar">
                <div class="search-box" style="flex:2">
                    <span class="search-icon">🔍</span>
                    <input type="text" name="search" value="<?= sanitize($search) ?>" placeholder="Search username, email…">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="manage_users.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- TABLE -->
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Orders</th>
                    <th>Total Spent</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $i => $user): ?>
                <tr>
                    <td class="text-muted text-sm"><?= $offset + $i + 1 ?></td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px">
                            <div style="width:32px; height:32px; background:linear-gradient(135deg, var(--accent), #4e9af1); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:0.75rem; font-weight:700; color:#000; flex-shrink:0">
                                <?= strtoupper(substr($user['user_name'], 0, 2)) ?>
                            </div>
                            <div>
                                <div style="font-weight:500"><?= sanitize($user['user_name']) ?></div>
                                <div style="font-size:0.72rem; color:var(--text-muted)">ID: <?= $user['user_id'] ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="text-sm"><?= sanitize($user['email']) ?></td>
                    <td class="text-sm"><?= $user['order_count'] ?></td>
                    <td style="color:var(--accent); font-weight:600"><?= formatCurrency($user['total_spent']) ?></td>
                    <td class="text-muted text-sm"><?= formatDate($user['created_at']) ?></td>
                    <td>
                        <div style="display:flex; gap:6px">
                            <button class="btn btn-sm btn-secondary" onclick="showUserDetails(<?= $user['user_id'] ?>, '<?= addslashes(sanitize($user['user_name'])) ?>', '<?= addslashes(sanitize($user['email'])) ?>', '<?= formatDate($user['created_at']) ?>', <?= $user['order_count'] ?>, '<?= formatCurrency($user['total_spent']) ?>')">
                                👁️ View
                            </button>
                            <a href="manage_users.php?delete=<?= $user['user_id'] ?>"
                               class="btn btn-sm btn-danger"
                               data-confirm="Delete user <?= sanitize($user['user_name']) ?>? All their orders will remain but be orphaned."
                               title="Delete">🗑</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($users)): ?>
                <tr><td colspan="7"><div class="empty-state"><div class="empty-icon">👥</div><p>No users found.</p></div></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
    <div style="padding:16px 20px; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between">
        <span style="font-size:0.78rem; color:var(--text-muted)">Showing <?= $offset+1 ?>–<?= min($offset+$perPage, $totalRows) ?> of <?= number_format($totalRows) ?></span>
        <div style="display:flex; gap:6px">
            <?php for ($p=1; $p<=$totalPages; $p++): ?>
            <a href="?page=<?= $p ?>&search=<?= urlencode($search) ?>"
               class="btn btn-sm <?= $p===$page ? 'btn-primary' : 'btn-secondary' ?>"><?= $p ?></a>
            <?php endfor; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- USER DETAILS MODAL -->
<div id="userModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7); z-index:1000; align-items:center; justify-content:center">
    <div style="background:var(--bg-surface); border:1px solid var(--border); border-radius:12px; padding:28px; width:500px; max-width:95vw">
        <h2 style="font-family:'DM Serif Display',serif; margin-bottom:20px">User Details</h2>
        <div id="userDetails"></div>
        <button type="button" class="btn btn-secondary" onclick="closeModal()" style="width:100%; margin-top:16px; justify-content:center">Close</button>
    </div>
</div>

<script>
function showUserDetails(id, name, email, joined, orderCount, totalSpent) {
    document.getElementById('userDetails').innerHTML = `
        <div style="display:grid; gap:14px; font-size:0.875rem">
            <div><strong>User ID:</strong> ${id}</div>
            <div><strong>Name:</strong> ${name}</div>
            <div><strong>Email:</strong> ${email}</div>
            <div><strong>Joined:</strong> ${joined}</div>
            <div><strong>Total Orders:</strong> ${orderCount}</div>
            <div><strong>Total Spent:</strong> <span style="color:var(--accent); font-size:1.1rem; font-weight:600">${totalSpent}</span></div>
        </div>
    `;
    document.getElementById('userModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('userModal').style.display = 'none';
}

document.getElementById('userModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>

<?php include 'includes/footer.php'; ?>
