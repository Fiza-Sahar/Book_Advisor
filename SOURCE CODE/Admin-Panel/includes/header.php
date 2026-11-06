<?php
// includes/header.php
// Usage: include at top of every admin page
// Requires: $pageTitle variable to be set
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?> — eBooks Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
    <style>
        /* ===== DESIGN TOKENS ===== */
        :root {
            --bg-base:       #0d0f14;
            --bg-surface:    #13161e;
            --bg-elevated:   #1a1e29;
            --bg-hover:      #21273a;
            --border:        #252b3b;
            --border-light:  #2e3650;

            --text-primary:  #e8eaf0;
            --text-secondary:#8892a4;
            --text-muted:    #4e5a70;

            --accent:        #f0a500;
            --accent-dim:    rgba(240, 165, 0, 0.12);
            --accent-glow:   rgba(240, 165, 0, 0.25);

            --danger:        #e05263;
            --danger-dim:    rgba(224, 82, 99, 0.12);
            --success:       #3ecf8e;
            --success-dim:   rgba(62, 207, 142, 0.12);
            --warning:       #f0a500;
            --warning-dim:   rgba(240, 165, 0, 0.12);
            --info:          #4e9af1;
            --info-dim:      rgba(78, 154, 241, 0.12);

            --sidebar-w:     260px;
            --header-h:      64px;
            --radius:        10px;
            --radius-sm:     6px;
            --shadow:        0 4px 24px rgba(0,0,0,0.4);
        }

        /* ===== RESET ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { font-size: 15px; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        a { color: inherit; text-decoration: none; }
        button { cursor: pointer; font-family: inherit; }
        input, select, textarea { font-family: inherit; }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--bg-surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-logo {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 38px; height: 38px;
            background: var(--accent);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .logo-text {
            font-family: 'DM Serif Display', serif;
            font-size: 1.2rem;
            color: var(--text-primary);
            line-height: 1.1;
        }

        .logo-text span {
            display: block;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.7rem;
            font-weight: 500;
            color: var(--text-muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 16px 12px;
        }

        .nav-section {
            margin-bottom: 24px;
        }

        .nav-section-title {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 8px;
            margin-bottom: 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 400;
            transition: all 0.15s ease;
            margin-bottom: 2px;
        }

        .nav-link:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
        }

        .nav-link.active {
            background: var(--accent-dim);
            color: var(--accent);
            font-weight: 500;
        }

        .nav-link .nav-icon {
            width: 18px; height: 18px;
            opacity: 0.7;
            flex-shrink: 0;
        }

        .nav-link.active .nav-icon { opacity: 1; }

        .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: #000;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px;
            line-height: 1.4;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border-radius: var(--radius-sm);
        }

        .admin-avatar {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--accent), #ff6b35);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            color: #000;
            flex-shrink: 0;
        }

        .admin-details {
            flex: 1;
            min-width: 0;
        }

        .admin-name {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .admin-role {
            font-size: 0.68rem;
            color: var(--text-muted);
        }

        .logout-btn {
            width: 28px; height: 28px;
            background: none;
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--text-muted);
            display: flex; align-items: center; justify-content: center;
            transition: all 0.15s;
            flex-shrink: 0;
        }

        .logout-btn:hover {
            background: var(--danger-dim);
            border-color: var(--danger);
            color: var(--danger);
        }

        /* ===== MAIN AREA ===== */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ===== TOP BAR ===== */
        .topbar {
            height: var(--header-h);
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 50;
            gap: 16px;
        }

        .topbar-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            flex: 1;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-time {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* ===== PAGE CONTENT ===== */
        .content {
            flex: 1;
            padding: 28px;
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .card-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .card-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.05rem;
            color: var(--text-primary);
        }

        .card-body {
            padding: 22px;
        }

        /* ===== STAT CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 22px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s, transform 0.2s;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
        }

        .stat-card.gold::before  { background: var(--accent); }
        .stat-card.green::before { background: var(--success); }
        .stat-card.red::before   { background: var(--danger); }
        .stat-card.blue::before  { background: var(--info); }

        .stat-card:hover {
            border-color: var(--border-light);
            transform: translateY(-1px);
        }

        .stat-icon {
            width: 40px; height: 40px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
            font-size: 1.1rem;
        }

        .stat-card.gold  .stat-icon { background: var(--accent-dim);  }
        .stat-card.green .stat-icon { background: var(--success-dim); }
        .stat-card.red   .stat-icon { background: var(--danger-dim);  }
        .stat-card.blue  .stat-icon { background: var(--info-dim);    }

        .stat-value {
            font-family: 'DM Serif Display', serif;
            font-size: 1.9rem;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.78rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .stat-change {
            font-size: 0.75rem;
            margin-top: 8px;
        }

        .stat-change.up   { color: var(--success); }
        .stat-change.down { color: var(--danger); }

        /* ===== TABLES ===== */
        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        thead th {
            text-align: left;
            padding: 12px 16px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.12s;
        }

        tbody tr:last-child { border-bottom: none; }

        tbody tr:hover { background: var(--bg-hover); }

        tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            color: var(--text-secondary);
        }

        tbody td:first-child { color: var(--text-primary); }

        /* ===== BADGES ===== */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.04em;
        }

        .badge-success   { background: var(--success-dim); color: var(--success); }
        .badge-danger    { background: var(--danger-dim);  color: var(--danger);  }
        .badge-warning   { background: var(--warning-dim); color: var(--warning); }
        .badge-info      { background: var(--info-dim);    color: var(--info);    }
        .badge-secondary { background: rgba(255,255,255,0.06); color: var(--text-muted); }
        .badge-gold      { background: var(--accent-dim);  color: var(--accent);  }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            font-size: 0.825rem;
            font-weight: 500;
            border: 1px solid transparent;
            transition: all 0.15s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-primary {
            background: var(--accent);
            color: #0d0f14;
            border-color: var(--accent);
        }

        .btn-primary:hover {
            background: #ffb629;
            box-shadow: 0 0 20px var(--accent-glow);
        }

        .btn-secondary {
            background: var(--bg-elevated);
            color: var(--text-secondary);
            border-color: var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg-hover);
            color: var(--text-primary);
            border-color: var(--border-light);
        }

        .btn-danger {
            background: var(--danger-dim);
            color: var(--danger);
            border-color: transparent;
        }

        .btn-danger:hover {
            background: var(--danger);
            color: white;
        }

        .btn-success {
            background: var(--success-dim);
            color: var(--success);
            border-color: transparent;
        }

        .btn-success:hover {
            background: var(--success);
            color: #0d0f14;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 0.775rem;
        }

        .btn-icon {
            padding: 6px;
            width: 32px; height: 32px;
            justify-content: center;
        }

        /* ===== FORMS ===== */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        input[type="date"],
        input[type="file"],
        select,
        textarea {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-primary);
            padding: 9px 13px;
            font-size: 0.875rem;
            transition: border-color 0.15s, box-shadow 0.15s;
            width: 100%;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-dim);
        }

        textarea { resize: vertical; min-height: 100px; }

        select option { background: var(--bg-elevated); }

        .form-hint {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        /* ===== ALERTS / FLASH ===== */
        .alert {
            padding: 13px 18px;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .alert-success { background: var(--success-dim); color: var(--success); border: 1px solid rgba(62,207,142,0.2); }
        .alert-danger  { background: var(--danger-dim);  color: var(--danger);  border: 1px solid rgba(224,82,99,0.2); }
        .alert-warning { background: var(--warning-dim); color: var(--warning); border: 1px solid rgba(240,165,0,0.2); }
        .alert-info    { background: var(--info-dim);    color: var(--info);    border: 1px solid rgba(78,154,241,0.2); }

        /* ===== SEARCH & FILTERS ===== */
        .filter-bar {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .search-box input {
            padding-left: 36px;
        }

        .search-icon {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        /* ===== MISC ===== */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .page-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 1.6rem;
        }

        .page-header p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state .empty-icon {
            font-size: 2.5rem;
            margin-bottom: 12px;
            opacity: 0.4;
        }

        .empty-state p { font-size: 0.9rem; }

        .book-cover {
            width: 36px; height: 48px;
            background: var(--bg-elevated);
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .book-cover img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .book-cover-placeholder {
            width: 100%; height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--text-muted);
        }

        .flex { display: flex; }
        .items-center { align-items: center; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .ml-auto { margin-left: auto; }
        .text-muted { color: var(--text-muted); }
        .text-sm { font-size: 0.8rem; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .content { padding: 16px; }
        }
    </style>
</head>
<body>
<?php
startSecureSession();
$adminName = $_SESSION['admin_name'] ?? 'Admin';
$adminInitials = strtoupper(substr($adminName, 0, 2));
$currentPage = basename($_SERVER['PHP_SELF']);

$navLinks = [
    'main' => [
        ['href' => 'dashboard.php',  'icon' => '⬡', 'label' => 'Dashboard'],
    ],
    'catalog' => [
        ['href' => 'manage_books.php',  'icon' => '📚', 'label' => 'Books'],
        ['href' => 'add_book.php',      'icon' => '➕', 'label' => 'Add Book'],
    ],
    'commerce' => [
        ['href' => 'manage_orders.php', 'icon' => '🛒', 'label' => 'Orders'],
        ['href' => 'manage_users.php',  'icon' => '👥', 'label' => 'Users'],
    ],
    'engagement' => [
        ['href' => 'competitions.php',    'icon' => '🏆', 'label' => 'Competitions'],
        ['href' => 'view_submissions.php','icon' => '📄', 'label' => 'Submissions'],
    ],
];
?>
<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">📖</div>
        <div class="logo-text">
            eBooks
            <span>Admin Panel</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <?php foreach ($navLinks as $section => $links): ?>
        <div class="nav-section">
            <div class="nav-section-title"><?= ucfirst($section) ?></div>
            <?php foreach ($links as $link): ?>
            <a href="<?= $link['href'] ?>"
               class="nav-link <?= $currentPage === $link['href'] ? 'active' : '' ?>">
                <span class="nav-icon"><?= $link['icon'] ?></span>
                <?= $link['label'] ?>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-info">
            <div class="admin-avatar"><?= $adminInitials ?></div>
            <div class="admin-details">
                <div class="admin-name"><?= htmlspecialchars($adminName) ?></div>
                <div class="admin-role">Administrator</div>
            </div>
            <a href="logout.php" class="logout-btn" title="Logout">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </a>
        </div>
    </div>
</aside>

<!-- MAIN -->
<div class="main">
    <header class="topbar">
        <div class="topbar-title"><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?></div>
        <div class="topbar-actions">
            <span class="topbar-time" id="clock"></span>
        </div>
    </header>

    <div class="content">
        <?php $flash = getFlash(); if ($flash): ?>
        <div class="alert alert-<?= $flash['type'] ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
        <?php endif; ?>
