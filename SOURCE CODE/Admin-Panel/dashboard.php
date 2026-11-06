<?php
require_once 'config.php';
requireLogin();

$pageTitle = 'Dashboard';
$db = getDB();

// Fetch stats from existing tables
$stats = [];
$stats['books']   = $db->query('SELECT COUNT(*) FROM book_table')->fetchColumn();
$stats['orders']  = $db->query('SELECT COUNT(*) FROM order_table')->fetchColumn();
$stats['users']   = $db->query('SELECT COUNT(*) FROM users')->fetchColumn();
$stats['revenue'] = $db->query('SELECT SUM(order_total_price) FROM order_table')->fetchColumn() ?? 0;

// Additional stats
$freeBooks       = $db->query('SELECT COUNT(*) FROM book_table WHERE is_free = 1')->fetchColumn();
$paidBooks       = $db->query('SELECT COUNT(*) FROM book_table WHERE is_free = 0')->fetchColumn();
$totalDownloads  = $db->query('SELECT SUM(download_count) FROM book_table')->fetchColumn() ?? 0;
$activeComps     = $db->query('SELECT COUNT(*) FROM competitions')->fetchColumn();

// Recent orders (last 6)
$recentOrders = $db->query('
    SELECT o.*, u.user_name, u.email
    FROM order_table o
    LEFT JOIN users u ON o.order_register_id = u.user_id
    ORDER BY o.order_id DESC
    LIMIT 6
')->fetchAll();

// Top books by downloads
$topBooks = $db->query('
    SELECT book_name, book_author, download_count, book_price, is_free
    FROM book_table
    ORDER BY download_count DESC
    LIMIT 5
')->fetchAll();

// Recent books
$recentBooks = $db->query('
    SELECT *
    FROM book_table
    ORDER BY book_time DESC
    LIMIT 5
')->fetchAll();

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Dashboard</h1>
        <p>Welcome back, <?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin') ?>. Here's what's happening.</p>
    </div>
    <a href="add_book.php" class="btn btn-primary">+ Add New Book</a>
</div>

<!-- STAT CARDS -->
<div class="stats-grid">
    <div class="stat-card gold">
        <div class="stat-icon">📚</div>
        <div class="stat-value"><?= number_format($stats['books']) ?></div>
        <div class="stat-label">Total Books</div>
        <div class="stat-change up"><?= $freeBooks ?> free / <?= $paidBooks ?> paid</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">💰</div>
        <div class="stat-value"><?= formatCurrency($stats['revenue']) ?></div>
        <div class="stat-label">Total Revenue</div>
        <div class="stat-change up">All orders</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-icon">🛒</div>
        <div class="stat-value"><?= number_format($stats['orders']) ?></div>
        <div class="stat-label">Total Orders</div>
        <div class="stat-change">All time</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">👥</div>
        <div class="stat-value"><?= number_format($stats['users']) ?></div>
        <div class="stat-label">Registered Users</div>
        <div class="stat-change up">Active customers</div>
    </div>
</div>

<!-- ROW 2: MINI STATS -->
<div class="stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 28px;">
    <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px; padding: 14px 18px; display:flex; align-items:center; gap:10px;">
        <span style="font-size:1.2rem">📥</span>
        <div>
            <div style="font-weight:600; font-size:1.1rem"><?= number_format($totalDownloads) ?></div>
            <div style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.05em">Total Downloads</div>
        </div>
    </div>
    <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px; padding: 14px 18px; display:flex; align-items:center; gap:10px;">
        <span style="font-size:1.2rem">🏆</span>
        <div>
            <div style="font-weight:600; font-size:1.1rem"><?= $activeComps ?></div>
            <div style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.05em">Competitions</div>
        </div>
    </div>
    <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px; padding: 14px 18px; display:flex; align-items:center; gap:10px;">
        <span style="font-size:1.2rem">🆓</span>
        <div>
            <div style="font-weight:600; font-size:1.1rem"><?= $freeBooks ?></div>
            <div style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.05em">Free Books</div>
        </div>
    </div>
</div>

<!-- BOTTOM GRID -->
<div style="display:grid; grid-template-columns: 1.6fr 1fr; gap:20px; margin-bottom:28px;">
    <!-- Recent Orders -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">Recent Orders</span>
            <a href="manage_orders.php" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>City</th>
                        <th>Amount</th>
                        <th>Mobile</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentOrders as $order): ?>
                    <tr>
                        <td><span style="color:var(--accent); font-weight:600; font-size:0.82rem">#<?= $order['order_id'] ?></span></td>
                        <td>
                            <div style="font-weight:500; font-size:0.875rem"><?= sanitize($order['order_name']) ?></div>
                            <div style="font-size:0.72rem; color:var(--text-muted)"><?= sanitize($order['email'] ?? 'N/A') ?></div>
                        </td>
                        <td class="text-sm"><?= sanitize($order['order_city']) ?></td>
                        <td style="font-weight:600"><?= formatCurrency($order['order_total_price']) ?></td>
                        <td class="text-muted text-sm"><?= sanitize($order['order_mobile']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($recentOrders)): ?>
                    <tr><td colspan="5" class="text-muted text-sm" style="text-align:center; padding:30px">No orders yet</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Top Books -->
    <div class="card">
        <div class="card-header">
            <span class="card-title">Top Books</span>
            <a href="manage_books.php" class="btn btn-secondary btn-sm">All Books</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>DL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($topBooks as $i => $book): ?>
                    <tr>
                        <td><span style="color:var(--text-muted); font-size:0.75rem"><?= $i+1 ?></span></td>
                        <td>
                            <div style="font-size:0.82rem; font-weight:500"><?= sanitize($book['book_name']) ?></div>
                            <div style="font-size:0.72rem; color:var(--text-muted)">
                                <?= sanitize($book['book_author']) ?>
                                <?php if ($book['is_free'] == 1): ?>
                                <span class="badge badge-success" style="margin-left:4px; font-size:0.65rem">FREE</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td><span style="color:var(--accent); font-weight:600"><?= number_format($book['download_count']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($topBooks)): ?>
                    <tr><td colspan="3" class="text-muted text-sm" style="text-align:center; padding:30px">No data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <span class="card-title">Quick Actions</span>
    </div>
    <div class="card-body" style="display:flex; gap:12px; flex-wrap:wrap;">
        <a href="add_book.php" class="btn btn-primary">📚 Add New Book</a>
        <a href="manage_books.php" class="btn btn-secondary">📖 View All Books</a>
        <a href="manage_orders.php" class="btn btn-secondary">🛒 View Orders</a>
        <a href="manage_users.php" class="btn btn-secondary">👥 Manage Users</a>
        <a href="competitions.php" class="btn btn-secondary">🏆 Competitions</a>
        <a href="view_submissions.php" class="btn btn-secondary">📄 Submissions</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
