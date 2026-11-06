<?php
require_once 'config.php';
requireLogin();

$pageTitle = 'View Submissions';
$db = getDB();

// Handle winner toggle
if (isset($_GET['toggle_winner']) && is_numeric($_GET['toggle_winner'])) {
    $sid  = (int)$_GET['toggle_winner'];
    $stmt = $db->prepare('SELECT is_winner FROM competitions_submissions WHERE id = ?');
    $stmt->execute([$sid]);
    $current = $stmt->fetchColumn();

    $newValue = $current == 1 ? 0 : 1;
    $db->prepare('UPDATE competitions_submissions SET is_winner = ? WHERE id = ?')->execute([$newValue, $sid]);

    setFlash('success', $newValue == 1 ? 'Marked as winner!' : 'Removed winner status.');
    header('Location: view_submissions.php' . (isset($_GET['competition']) ? '?competition=' . (int)$_GET['competition'] : ''));
    exit;
}

// Filters
$compFilter   = isset($_GET['competition']) ? (int)$_GET['competition'] : 0;
$search       = trim($_GET['search'] ?? '');
$winnerFilter = $_GET['winner'] ?? '';

$where  = ['1=1'];
$params = [];

if ($compFilter) {
    $where[]  = 's.competition_id = ?';
    $params[] = $compFilter;
}
if ($winnerFilter === 'yes') { $where[] = 's.is_winner = 1'; }
if ($winnerFilter === 'no')  { $where[] = 's.is_winner = 0'; }
if ($search) {
    $where[]  = '(s.title LIKE ? OR s.author_name LIKE ?)';
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$whereStr = implode(' AND ', $where);

$page    = max(1, (int)($_GET['page'] ?? 1));
$perPage = 10;
$offset  = ($page - 1) * $perPage;

$totalStmt = $db->prepare("SELECT COUNT(*) FROM competitions_submissions s WHERE $whereStr");
$totalStmt->execute($params);
$totalRows  = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $perPage);

$stmt = $db->prepare("
    SELECT s.*, c.comp_name AS competition_title
    FROM competitions_submissions s
    LEFT JOIN competitions c ON s.competition_id = c.comp_id
    WHERE $whereStr
    ORDER BY s.submitted_at DESC
    LIMIT $perPage OFFSET $offset
");
$stmt->execute($params);
$submissions = $stmt->fetchAll();

// All competitions for filter dropdown
$competitions = $db->query('SELECT comp_id, comp_name FROM competitions ORDER BY created_at DESC')->fetchAll();

// Stats
$totalSubs  = $db->query('SELECT COUNT(*) FROM competitions_submissions')->fetchColumn();
$winners    = $db->query('SELECT COUNT(*) FROM competitions_submissions WHERE is_winner = 1')->fetchColumn();
$nonWinners = $totalSubs - $winners;

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Submissions</h1>
        <p><?= number_format($totalRows) ?> submission<?= $totalRows !== 1 ? 's' : '' ?><?= $compFilter ? ' in selected competition' : ' total' ?></p>
    </div>
    <a href="competitions.php" class="btn btn-secondary">← Competitions</a>
</div>

<!-- STATS -->
<div class="stats-grid" style="grid-template-columns:repeat(3,1fr); margin-bottom:20px">
    <div class="stat-card blue">
        <div class="stat-icon">📄</div>
        <div class="stat-value"><?= $totalSubs ?></div>
        <div class="stat-label">Total Submissions</div>
    </div>
    <div class="stat-card gold">
        <div class="stat-icon">🏆</div>
        <div class="stat-value"><?= $winners ?></div>
        <div class="stat-label">Winners</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">✅</div>
        <div class="stat-value"><?= $nonWinners ?></div>
        <div class="stat-label">Participants</div>
    </div>
</div>

<!-- FILTER -->
<div class="card" style="margin-bottom:20px">
    <div class="card-body">
        <form method="GET">
            <div class="filter-bar">
                <div class="search-box" style="flex:1.5">
                    <span class="search-icon">🔍</span>
                    <input type="text" name="search" value="<?= sanitize($search) ?>"
                           placeholder="Search title, author name…">
                </div>
                <select name="competition" style="min-width:200px">
                    <option value="">All Competitions</option>
                    <?php foreach ($competitions as $comp): ?>
                        <option value="<?= $comp['comp_id'] ?>" <?= $compFilter == $comp['comp_id'] ? 'selected' : '' ?>>
                            <?= sanitize($comp['comp_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <select name="winner" style="min-width:130px">
                    <option value="">All Status</option>
                    <option value="yes" <?= $winnerFilter === 'yes' ? 'selected' : '' ?>>Winners Only</option>
                    <option value="no"  <?= $winnerFilter === 'no'  ? 'selected' : '' ?>>Non-Winners</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="view_submissions.php" class="btn btn-secondary">Reset</a>
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
                    <th>Submission</th>
                    <th>Author</th>
                    <th>Competition</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submissions as $i => $sub): ?>
                    <tr>
                        <td class="text-muted text-sm"><?= $offset + $i + 1 ?></td>
                        <td>
                            <div style="font-weight:500; font-size:0.875rem">
                                <?= sanitize($sub['title'] ?? '—') ?>
                            </div>
                            <div style="font-size:0.72rem; color:var(--text-muted)">
                                <?= sanitize(substr($sub['content'] ?? '', 0, 60)) ?>
                                <?= strlen($sub['content'] ?? '') > 60 ? '…' : '' ?>
                            </div>
                        </td>
                        <td>
                            <div style="font-size:0.85rem; font-weight:500">
                                <?= sanitize($sub['author_name'] ?? '—') ?>
                            </div>
                        </td>
                        <td>
                            <span style="font-size:0.8rem; color:var(--text-secondary)">
                                <?= sanitize($sub['competition_title'] ?? '—') ?>
                            </span>
                        </td>
                        <td class="text-muted text-sm"><?= formatDate($sub['submitted_at']) ?></td>
                        <td>
                            <?php if (!empty($sub['is_winner']) && $sub['is_winner'] == 1): ?>
                                <span class="badge badge-gold">🏆 Winner</span>
                            <?php else: ?>
                                <span class="badge badge-secondary">Participant</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px">
                                <button class="btn btn-sm btn-secondary"
                                        onclick='showDetails(<?= htmlspecialchars(json_encode($sub), ENT_QUOTES) ?>)'>
                                    👁️ View
                                </button>
                                <a href="view_submissions.php?toggle_winner=<?= $sub['id'] ?><?= $compFilter ? '&competition=' . $compFilter : '' ?><?= $search ? '&search=' . urlencode($search) : '' ?><?= $winnerFilter ? '&winner=' . $winnerFilter : '' ?>"
                                   class="btn btn-sm <?= (!empty($sub['is_winner']) && $sub['is_winner'] == 1) ? 'btn-danger' : 'btn-success' ?>"
                                   title="<?= (!empty($sub['is_winner']) && $sub['is_winner'] == 1) ? 'Remove winner' : 'Mark as winner' ?>">
                                    <?= (!empty($sub['is_winner']) && $sub['is_winner'] == 1) ? '✖' : '🏆' ?>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($submissions)): ?>
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon">📄</div>
                                <p>No submissions found.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
        <div style="padding:16px 20px; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between">
            <span style="font-size:0.78rem; color:var(--text-muted)">
                Showing <?= $offset + 1 ?>–<?= min($offset + $perPage, $totalRows) ?> of <?= number_format($totalRows) ?>
            </span>
            <div style="display:flex; gap:6px">
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <a href="?page=<?= $p ?>&search=<?= urlencode($search) ?>&competition=<?= $compFilter ?>&winner=<?= $winnerFilter ?>"
                       class="btn btn-sm <?= $p === $page ? 'btn-primary' : 'btn-secondary' ?>">
                        <?= $p ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- DETAILS MODAL -->
<div id="detailsModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.75); z-index:1000; align-items:center; justify-content:center">
    <div style="background:var(--bg-surface); border:1px solid var(--border); border-radius:12px; padding:28px; width:700px; max-width:95vw; max-height:90vh; overflow-y:auto">
        <div style="display:flex; align-items:start; justify-content:space-between; margin-bottom:20px">
            <h2 style="font-family:'DM Serif Display',serif; margin:0">Submission Details</h2>
            <span id="winnerBadge"></span>
        </div>
        <div id="detailsContent"></div>
        <button type="button" class="btn btn-secondary" onclick="closeModal()"
                style="width:100%; margin-top:20px; justify-content:center">Close</button>
    </div>
</div>

<script>
function showDetails(sub) {
    const isWinner = sub.is_winner == 1;
    const badge = isWinner
        ? '<span class="badge badge-gold" style="font-size:0.9rem">🏆 Winner</span>'
        : '<span class="badge badge-secondary" style="font-size:0.9rem">Participant</span>';
    document.getElementById('winnerBadge').innerHTML = badge;

    let html = '<div style="display:grid; gap:18px; font-size:0.875rem">';
    html += '<div><strong>Submission ID:</strong> #' + sub.id + '</div>';
    html += '<div><strong>Title:</strong> ' + (sub.title || '—') + '</div>';

    if (sub.content) {
        html += '<div><strong>Content:</strong>'
              + '<div style="background:var(--bg-elevated); padding:12px; border-radius:6px; margin-top:6px; line-height:1.6; max-height:200px; overflow-y:auto">'
              + sub.content + '</div></div>';
    }

    html += '<div><strong>Author:</strong> ' + (sub.author_name || '—') + '</div>';
    html += '<div><strong>Competition:</strong> ' + (sub.competition_title || 'N/A') + '</div>';
    html += '<div><strong>Submitted:</strong> ' + new Date(sub.submitted_at).toLocaleDateString('en-US', {year:'numeric', month:'long', day:'numeric'}) + '</div>';

    if (sub.file_path) {
        html += '<div><strong>File:</strong> <a href="' + sub.file_path + '" target="_blank" style="color:var(--accent)">📎 View/Download File</a></div>';
    }

    html += '</div>';

    document.getElementById('detailsContent').innerHTML = html;
    document.getElementById('detailsModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('detailsModal').style.display = 'none';
}

document.getElementById('detailsModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>

<?php include 'includes/footer.php'; ?>