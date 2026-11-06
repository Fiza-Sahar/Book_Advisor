<?php
require_once 'config.php';
requireLogin();

$pageTitle = 'Manage Orders';
$db = getDB();

// Filters
$search  = trim($_GET['search'] ?? '');

$where  = ['1=1'];
$params = [];

if ($search) {
    $where[]  = '(o.order_id LIKE ? OR o.order_name LIKE ? OR o.order_mobile LIKE ? OR u.email LIKE ?)';
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$whereStr = implode(' AND ', $where);

$page    = max(1, (int)($_GET['page'] ?? 1));
$perPage = 12;
$offset  = ($page - 1) * $perPage;

$totalStmt = $db->prepare("SELECT COUNT(*) FROM order_table o LEFT JOIN users u ON o.order_register_id=u.user_id WHERE $whereStr");
$totalStmt->execute($params);
$totalRows  = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $perPage);

$stmt = $db->prepare("
    SELECT o.*, u.user_name, u.email
    FROM order_table o
    LEFT JOIN users u ON o.order_register_id = u.user_id
    WHERE $whereStr
    ORDER BY o.order_id DESC
    LIMIT $perPage OFFSET $offset
");
$stmt->execute($params);
$orders = $stmt->fetchAll();

// Summary stats
$totalRevenue  = $db->query('SELECT SUM(order_total_price) FROM order_table')->fetchColumn() ?? 0;
$totalOrders   = $db->query('SELECT COUNT(*) FROM order_table')->fetchColumn();

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Manage Orders</h1>
        <p><?= number_format($totalRows) ?> orders total</p>
    </div>
</div>

<!-- SUMMARY -->
<div class="stats-grid" style="grid-template-columns: repeat(2, 1fr); margin-bottom:20px">
    <div class="stat-card green">
        <div class="stat-icon">💰</div>
        <div class="stat-value"><?= formatCurrency($totalRevenue) ?></div>
        <div class="stat-label">Total Revenue</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-icon">🛒</div>
        <div class="stat-value"><?= $totalOrders ?></div>
        <div class="stat-label">Total Orders</div>
    </div>
</div>

<!-- FILTER -->
<div class="card" style="margin-bottom:20px">
    <div class="card-body">
        <form method="GET">
            <div class="filter-bar">
                <div class="search-box" style="flex:2">
                    <span class="search-icon">🔍</span>
                    <input type="text" name="search" value="<?= sanitize($search) ?>" placeholder="Search order ID, customer name, mobile, email…">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="manage_orders.php" class="btn btn-secondary">Reset</a>
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
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Mobile</th>
                    <th>City</th>
                    <th>Address</th>
                    <th>Amount</th>
                    <th>Books</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><span style="color:var(--accent); font-weight:600; font-size:0.82rem">#<?= $order['order_id'] ?></span></td>
                    <td>
                        <div style="font-weight:500; font-size:0.875rem"><?= sanitize($order['order_name']) ?></div>
                        <div style="font-size:0.72rem; color:var(--text-muted)"><?= sanitize($order['email'] ?? 'N/A') ?></div>
                    </td>
                    <td class="text-sm"><?= sanitize($order['order_mobile']) ?></td>
                    <td class="text-sm"><?= sanitize($order['order_city']) ?>, <?= sanitize($order['order_state']) ?></td>
                    <td class="text-sm" style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">
                        <?= sanitize($order['order_address']) ?><br>
                        <span style="color:var(--text-muted)">PIN: <?= sanitize($order['order_pincode']) ?></span>
                    </td>
                    <td style="font-weight:600"><?= formatCurrency($order['order_total_price']) ?></td>
                    <td>
                        <button class="btn btn-sm btn-secondary" onclick="showBooks(<?= $order['order_id'] ?>, '<?= addslashes($order['order_list_books']) ?>')">
                            📚 View
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-secondary" onclick="showOrderDetails(<?= $order['order_id'] ?>, '<?= addslashes(sanitize($order['order_name'])) ?>', '<?= addslashes(sanitize($order['order_address'])) ?>', '<?= addslashes(sanitize($order['order_city'])) ?>', '<?= addslashes(sanitize($order['order_state'])) ?>', '<?= addslashes(sanitize($order['order_pincode'])) ?>', '<?= addslashes(sanitize($order['order_mobile'])) ?>', '<?= formatCurrency($order['order_total_price']) ?>', '<?= addslashes($order['order_list_books']) ?>')">
                            👁️ Details
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($orders)): ?>
                <tr><td colspan="8"><div class="empty-state"><div class="empty-icon">🛒</div><p>No orders found.</p></div></td></tr>
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

<!-- BOOKS MODAL -->
<div id="booksModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7); z-index:1000; align-items:center; justify-content:center">
    <div style="background:var(--bg-surface); border:1px solid var(--border); border-radius:12px; padding:28px; width:500px; max-width:95vw">
        <h2 style="font-family:'DM Serif Display',serif; margin-bottom:20px">Order Books</h2>
        <div id="booksList" style="max-height:400px; overflow-y:auto"></div>
        <button type="button" class="btn btn-secondary" onclick="closeModal('booksModal')" style="width:100%; margin-top:16px; justify-content:center">Close</button>
    </div>
</div>

<!-- ORDER DETAILS MODAL -->
<div id="detailsModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.7); z-index:1000; align-items:center; justify-content:center">
    <div style="background:var(--bg-surface); border:1px solid var(--border); border-radius:12px; padding:28px; width:600px; max-width:95vw">
        <h2 style="font-family:'DM Serif Display',serif; margin-bottom:20px">Order Details</h2>
        <div id="orderDetails"></div>
        <button type="button" class="btn btn-secondary" onclick="closeModal('detailsModal')" style="width:100%; margin-top:16px; justify-content:center">Close</button>
    </div>
</div>

<script>
function showBooks(orderId, booksList) {
    const books = booksList.split(',').map(b => b.trim()).filter(b => b);
    const html = books.length 
        ? books.map((book, i) => `<div style="padding:10px; border:1px solid var(--border); border-radius:6px; margin-bottom:8px; font-size:0.875rem"><strong>${i+1}.</strong> ${book}</div>`).join('')
        : '<p style="color:var(--text-muted)">No books listed</p>';
    document.getElementById('booksList').innerHTML = html;
    document.getElementById('booksModal').style.display = 'flex';
}

function showOrderDetails(id, name, address, city, state, pincode, mobile, total, books) {
    const booksList = books.split(',').map(b => b.trim()).filter(b => b);
    const booksHtml = booksList.map((book, i) => `<li>${book}</li>`).join('');
    
    document.getElementById('orderDetails').innerHTML = `
        <div style="display:grid; gap:16px; font-size:0.875rem">
            <div><strong>Order ID:</strong> #${id}</div>
            <div><strong>Customer:</strong> ${name}</div>
            <div><strong>Mobile:</strong> ${mobile}</div>
            <div><strong>Address:</strong><br>${address}<br>${city}, ${state} - ${pincode}</div>
            <div><strong>Total Amount:</strong> <span style="color:var(--accent); font-size:1.1rem; font-weight:600">${total}</span></div>
            <div><strong>Books Ordered:</strong><ul style="margin:8px 0 0 20px">${booksHtml || '<li style="color:var(--text-muted)">None</li>'}</ul></div>
        </div>
    `;
    document.getElementById('detailsModal').style.display = 'flex';
}

function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

document.querySelectorAll('[id$="Modal"]').forEach(modal => {
    modal.addEventListener('click', function(e) {
        if (e.target === this) closeModal(this.id);
    });
});
</script>

<?php include 'includes/footer.php'; ?>
