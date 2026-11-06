<?php
require_once 'config.php';
requireLogin();

$pageTitle = 'Competitions';
$db = getDB();

// Handle delete
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $db->prepare('DELETE FROM competitions WHERE comp_id=?')->execute([$_GET['delete']]);
    setFlash('success', 'Competition deleted.');
    header('Location: competitions.php');
    exit;
}

// Handle create/edit
$errors   = [];
$editing  = null;
$formData = [];

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $stmt = $db->prepare('SELECT * FROM competitions WHERE comp_id=?');
    $stmt->execute([$_GET['edit']]);
    $editing  = $stmt->fetch();
    $formData = $editing ?: [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $_POST;
    $cid      = (int)($_POST['competition_id'] ?? 0);

    $required = ['comp_name', 'start_date', 'end_date'];
    foreach ($required as $f) {
        if (empty(trim($_POST[$f] ?? '')))
            $errors[$f] = ucfirst(str_replace('_', ' ', $f)) . ' is required.';
    }

    if (!isset($errors['start_date']) && !isset($errors['end_date'])) {
        if ($_POST['start_date'] > $_POST['end_date']) {
            $errors['end_date'] = 'End date must be after start date.';
        }
    }

    if (empty($errors)) {
        $vals = [
            trim($_POST['comp_name']),
            trim($_POST['comp_description'] ?? ''),
            trim($_POST['prizes'] ?? ''),
            trim($_POST['rules'] ?? ''),
            $_POST['start_date'],
            $_POST['end_date'],
            !empty($_POST['max_entries']) ? (int)$_POST['max_entries'] : null,
            $_POST['status'] ?? 'draft',
        ];

        if ($cid) {
            $stmt = $db->prepare('UPDATE competitions SET comp_name=?,comp_description=?,prizes=?,rules=?,start_date=?,end_date=?,max_entries=?,status=? WHERE comp_id=?');
            $vals[] = $cid;
            $stmt->execute($vals);
            setFlash('success', 'Competition updated!');
        } else {
            $stmt = $db->prepare('INSERT INTO competitions (comp_name,comp_description,prizes,rules,start_date,end_date,max_entries,status) VALUES (?,?,?,?,?,?,?,?)');
            $stmt->execute($vals);
            setFlash('success', 'Competition created!');
        }
        header('Location: competitions.php');
        exit;
    }

    // Re-fetch editing data if validation failed
    if ($cid) {
        $stmt = $db->prepare('SELECT * FROM competitions WHERE comp_id=?');
        $stmt->execute([$cid]);
        $editing = $stmt->fetch();
    }
}

// Fetch all competitions with submission counts
$competitions = $db->query('
    SELECT c.*, COUNT(s.id) AS submission_count
    FROM competitions c
    LEFT JOIN competitions_submissions s ON c.comp_id = s.competition_id
    GROUP BY c.comp_id
    ORDER BY c.created_at DESC
')->fetchAll();

include 'includes/header.php';
?>

<div class="page-header">
    <div>
        <h1>Competitions</h1>
        <p><?= count($competitions) ?> competition<?= count($competitions) !== 1 ? 's' : '' ?> total</p>
    </div>
    <button class="btn btn-primary" onclick="document.getElementById('compForm').scrollIntoView({behavior:'smooth'})">
        + New Competition
    </button>
</div>

<!-- COMPETITIONS LIST -->
<?php if (!empty($competitions)): ?>
    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap:16px; margin-bottom:28px">
        <?php foreach ($competitions as $comp): ?>
            <div class="card" style="position:relative; overflow:visible">
                <div style="padding:20px">
                    <div style="display:flex; align-items:start; gap:10px; margin-bottom:12px">
                        <span style="font-size:1.4rem">🏆</span>
                        <div style="flex:1">
                            <div style="font-family:'DM Serif Display',serif; font-size:1rem; margin-bottom:4px; line-height:1.3">
                                <?= sanitize($comp['comp_name']) ?>
                            </div>
                            <?= statusBadge($comp['status'] ?? 'draft') ?>
                        </div>
                    </div>

                    <?php if (!empty($comp['prizes'])): ?>
                        <div style="background:var(--accent-dim); border-radius:6px; padding:8px 12px; margin-bottom:12px; font-size:0.82rem; color:var(--accent)">
                            🎁 Prize: <?= sanitize($comp['prizes']) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($comp['comp_description'])): ?>
                        <p style="font-size:0.82rem; color:var(--text-secondary); margin-bottom:12px; line-height:1.5">
                            <?= sanitize(substr($comp['comp_description'], 0, 120)) ?>
                            <?= strlen($comp['comp_description']) > 120 ? '…' : '' ?>
                        </p>
                    <?php endif; ?>

                    <div style="display:flex; gap:12px; font-size:0.75rem; color:var(--text-muted); margin-bottom:14px">
                        <span>📅 <?= formatDate($comp['start_date']) ?></span>
                        <span>→</span>
                        <span><?= formatDate($comp['end_date']) ?></span>
                    </div>

                    <div style="display:flex; align-items:center; justify-content:space-between">
                        <a href="view_submissions.php?competition=<?= $comp['comp_id'] ?>"
                           style="font-size:0.8rem; color:var(--accent)">
                            📄 <?= $comp['submission_count'] ?> submission<?= $comp['submission_count'] != 1 ? 's' : '' ?> →
                        </a>
                        <div style="display:flex; gap:6px">
                            <a href="competitions.php?edit=<?= $comp['comp_id'] ?>" class="btn btn-sm btn-secondary">✏️</a>
                            <a href="competitions.php?delete=<?= $comp['comp_id'] ?>"
                               class="btn btn-sm btn-danger"
                               data-confirm="Delete this competition? All submissions will also be deleted.">🗑</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="card" style="margin-bottom:28px">
        <div class="empty-state">
            <div class="empty-icon">🏆</div>
            <p>No competitions yet. Create your first one below.</p>
        </div>
    </div>
<?php endif; ?>

<!-- FORM -->
<div class="card" id="compForm">
    <div class="card-header">
        <span class="card-title"><?= $editing ? 'Edit Competition' : 'Create New Competition' ?></span>
        <?php if ($editing): ?>
            <a href="competitions.php" class="btn btn-secondary btn-sm">+ New Instead</a>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <form method="POST" action="competitions.php<?= $editing ? '?edit=' . $editing['comp_id'] : '' ?>">
            <?php if ($editing): ?>
                <input type="hidden" name="competition_id" value="<?= $editing['comp_id'] ?>">
            <?php endif; ?>

            <div class="form-grid">
                <div class="form-group full-width">
                    <label>Competition Title *</label>
                    <input type="text" name="comp_name"
                           value="<?= sanitize($formData['comp_name'] ?? '') ?>"
                           placeholder="e.g. Best Fiction Story 2024" required>
                    <?php if (isset($errors['comp_name'])): ?>
                        <span style="color:var(--danger); font-size:0.78rem"><?= $errors['comp_name'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group full-width">
                    <label>Description</label>
                    <textarea name="comp_description" rows="3"
                              placeholder="Describe the competition…"><?= sanitize($formData['comp_description'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label>Prize</label>
                    <input type="text" name="prizes"
                           value="<?= sanitize($formData['prizes'] ?? '') ?>"
                           placeholder="e.g. $500 + Publishing Deal">
                </div>

                <div class="form-group">
                    <label>Max Entries</label>
                    <input type="number" name="max_entries"
                           value="<?= sanitize($formData['max_entries'] ?? '') ?>"
                           placeholder="Leave blank for unlimited" min="1">
                </div>

                <div class="form-group">
                    <label>Start Date *</label>
                    <input type="date" name="start_date"
                           value="<?= sanitize($formData['start_date'] ?? '') ?>" required>
                    <?php if (isset($errors['start_date'])): ?>
                        <span style="color:var(--danger); font-size:0.78rem"><?= $errors['start_date'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>End Date *</label>
                    <input type="date" name="end_date"
                           value="<?= sanitize($formData['end_date'] ?? '') ?>" required>
                    <?php if (isset($errors['end_date'])): ?>
                        <span style="color:var(--danger); font-size:0.78rem"><?= $errors['end_date'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="draft"     <?= ($formData['status'] ?? 'draft') === 'draft'     ? 'selected' : '' ?>>Draft</option>
                        <option value="active"    <?= ($formData['status'] ?? '') === 'active'         ? 'selected' : '' ?>>Active</option>
                        <option value="ended"     <?= ($formData['status'] ?? '') === 'ended'          ? 'selected' : '' ?>>Ended</option>
                        <option value="cancelled" <?= ($formData['status'] ?? '') === 'cancelled'      ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label>Rules</label>
                    <textarea name="rules" rows="3"
                              placeholder="Competition rules and requirements…"><?= sanitize($formData['rules'] ?? '') ?></textarea>
                </div>

                <div class="form-group" style="grid-column:1/-1; display:flex; gap:10px; justify-content:flex-end">
                    <?php if ($editing): ?>
                        <a href="competitions.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">✏️ Update Competition</button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-primary">🏆 Create Competition</button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>