<?php
include("connection.php");
if (session_status() === PHP_SESSION_NONE) session_start();

$success = '';
$error   = '';

// ── COLUMN DETECTION (once, at top) ──
$_comp_cols = [];
$_sub_cols  = [];
$r1 = mysqli_query($con, "SHOW COLUMNS FROM competitions");
if ($r1) while ($row = mysqli_fetch_assoc($r1)) $_comp_cols[] = $row['Field'];
$r2 = mysqli_query($con, "SHOW COLUMNS FROM competitions_submissions");
if ($r2) while ($row = mysqli_fetch_assoc($r2)) $_sub_cols[] = $row['Field'];

$PK     = in_array('comp_id', $_comp_cols) ? 'comp_id' : 'id';
$FK     = in_array('competition_id', $_sub_cols) ? 'competition_id' : 'comp_id';
$SPK    = in_array('id', $_sub_cols) ? 'id' : 'sub_id';
$HAS_ST = in_array('status', $_comp_cols);

// ── HANDLE SUBMISSION ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_entry'])) {
    $comp_id     = (int)($_POST['comp_id'] ?? 0);
    $author_name = trim($_POST['author_name'] ?? '');
    $entry_title = trim($_POST['entry_title'] ?? '');
    $entry_cont  = trim($_POST['entry_content'] ?? '');

    if (!$comp_id || !$author_name || !$entry_title || !$entry_cont) {
        $error = 'Tamam fields bharna zaroori hain.';
    } else {
        $esc_author  = mysqli_real_escape_string($con, $author_name);
        $esc_title   = mysqli_real_escape_string($con, $entry_title);
        $esc_content = mysqli_real_escape_string($con, $entry_cont);

        // Duplicate check
        $dup = mysqli_query($con, "SELECT $SPK FROM competitions_submissions WHERE $FK=$comp_id AND author_name='$esc_author'");
        if ($dup && mysqli_num_rows($dup) > 0) {
            $error = 'Aap is competition mein pehle se submit kar chuke hain.';
        } else {
            $ins = mysqli_query($con, "INSERT INTO competitions_submissions ($FK, title, content, author_name, submitted_at, is_winner)
                                       VALUES ($comp_id, '$esc_title', '$esc_content', '$esc_author', NOW(), 0)");
            if ($ins) {
                $success = 'Aapki entry submit ho gayi! Best of luck! 🎉';
            } else {
                $error = 'Submit nahi hua: ' . mysqli_error($con);
            }
        }
    }
}

// ── FETCH COMPETITIONS ──
$sw_active = $HAS_ST ? "WHERE c.status IN ('active','draft')" : "WHERE 1=1";
$sw_past   = $HAS_ST ? "WHERE c.status IN ('ended','cancelled')" : "WHERE 1=0";

$active_comps = [];
$q = mysqli_query($con, "SELECT c.*, COUNT(s.$SPK) AS sub_count
    FROM competitions c
    LEFT JOIN competitions_submissions s ON c.$PK = s.$FK
    $sw_active
    GROUP BY c.$PK ORDER BY c.end_date ASC");
if ($q) $active_comps = mysqli_fetch_all($q, MYSQLI_ASSOC);

$past_comps = [];
$q2 = mysqli_query($con, "SELECT c.*, COUNT(s.$SPK) AS sub_count
    FROM competitions c
    LEFT JOIN competitions_submissions s ON c.$PK = s.$FK
    $sw_past
    GROUP BY c.$PK ORDER BY c.end_date DESC LIMIT 6");
if ($q2) $past_comps = mysqli_fetch_all($q2, MYSQLI_ASSOC);

$winners = [];
$q3 = mysqli_query($con, "SELECT s.title, s.author_name, c.comp_name, c.prizes
    FROM competitions_submissions s
    JOIN competitions c ON c.$PK = s.$FK
    WHERE s.is_winner = 1 ORDER BY s.submitted_at DESC LIMIT 6");
if ($q3) $winners = mysqli_fetch_all($q3, MYSQLI_ASSOC);

// Store competitions as JS-safe array for modal
$comps_for_js = [];
foreach ($active_comps as $c) {
    $comps_for_js[$c[$PK]] = [
        'name'  => $c['comp_name'],
        'rules' => $c['rules'] ?? '',
    ];
}

include("./shared1/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK ADVISOR | Competitions</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .comp-banner {
            min-height: 400px;
            background: linear-gradient(to bottom, rgba(30,18,12,0.75) 0%, rgba(30,18,12,0.5) 60%, rgba(30,18,12,0.85) 100%),
                        url('https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            display:flex; flex-direction:column; align-items:center; justify-content:center;
            text-align:center; padding:100px 8% 70px;
        }
        .comp-banner .eyebrow { font-family:'Montserrat',sans-serif; font-size:0.72rem; letter-spacing:5px; color:#D4AF7A; text-transform:uppercase; margin-bottom:16px; }
        .comp-banner h1 { font-family:'Cinzel',serif; font-size:clamp(2.4rem,6vw,4.5rem); color:#fff; letter-spacing:6px; margin-bottom:16px; }
        .comp-banner p  { color:rgba(255,255,255,0.75); font-size:1.05rem; max-width:520px; line-height:1.7; }

        .section-header { text-align:center; padding:60px 8% 28px; }
        .section-header h2 { font-family:'Cinzel',serif; font-size:clamp(1.5rem,3vw,2.2rem); letter-spacing:5px; color:#2c1a0e; margin-bottom:14px; }
        .section-header .line { width:55px; height:2px; background:#D4AF7A; margin:0 auto; }

        .comp-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(310px,1fr)); gap:24px; padding:4px 8% 50px; }

        .comp-card { background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 6px 28px rgba(62,39,35,0.08); border:1px solid #f0e6dd; transition:transform 0.3s,box-shadow 0.3s; display:flex; flex-direction:column; }
        .comp-card:hover { transform:translateY(-6px); box-shadow:0 18px 48px rgba(62,39,35,0.14); }

        .comp-card-head { background:linear-gradient(140deg,#5D4037,#3E2723); padding:26px 24px 20px; color:#fff; position:relative; }
        .comp-card-head h3 { font-family:'Playfair Display',serif; font-size:1.25rem; line-height:1.35; margin-bottom:6px; padding-right:70px; }
        .comp-card-head .sc { font-size:0.74rem; opacity:0.7; }
        .active-pill { position:absolute; top:18px; right:18px; background:rgba(46,125,50,0.35); border:1px solid #81c784; color:#c8e6c9; padding:3px 11px; border-radius:20px; font-size:0.68rem; letter-spacing:1px; text-transform:uppercase; }

        .comp-card-body { padding:20px 24px 24px; flex:1; display:flex; flex-direction:column; gap:14px; }
        .prize-pill { display:inline-flex; align-items:center; gap:6px; background:#fff8f0; border:1px solid #f0e6dd; border-radius:8px; padding:8px 14px; font-size:0.82rem; color:#5D4037; font-weight:700; width:fit-content; }
        .comp-desc { font-size:0.86rem; color:#777; line-height:1.65; }
        .comp-dates { display:flex; gap:14px; font-size:0.76rem; color:#a1887f; flex-wrap:wrap; }
        .comp-dates span { display:flex; align-items:center; gap:5px; }
        .days-left { font-size:0.8rem; font-weight:700; }

        .btn-enter { margin-top:auto; padding:14px; background:#5D4037; color:#fff; border:none; border-radius:10px; font-family:'Montserrat',sans-serif; font-size:0.88rem; font-weight:700; letter-spacing:1px; cursor:pointer; transition:background 0.2s; width:100%; text-align:center; display:block; text-decoration:none; }
        .btn-enter:hover { background:#3E2723; }

        /* MODAL */
        .modal-overlay { display:none; position:fixed; inset:0; background:rgba(10,5,2,0.75); z-index:9999; align-items:center; justify-content:center; padding:20px; }
        .modal-overlay.open { display:flex !important; }
        .modal-box { background:#fff; border-radius:18px; width:600px; max-width:100%; max-height:90vh; overflow-y:auto; padding:36px 38px 30px; position:relative; animation:slideUp 0.25s ease; }
        @keyframes slideUp { from{transform:translateY(24px);opacity:0} to{transform:translateY(0);opacity:1} }
        .modal-close { position:absolute; top:16px; right:20px; background:none; border:none; font-size:1.6rem; cursor:pointer; color:#bbb; line-height:1; }
        .modal-close:hover { color:#3E2723; }
        .modal-box h2 { font-family:'Playfair Display',serif; font-size:1.8rem; color:#3E2723; margin-bottom:4px; }
        .modal-sub { color:#a1887f; font-size:0.84rem; font-style:italic; margin-bottom:20px; }
        .rules-box { background:#faf5f0; border-left:4px solid #D4AF7A; border-radius:0 8px 8px 0; padding:12px 16px; margin-bottom:20px; font-size:0.82rem; color:#666; line-height:1.7; }
        .flabel { display:block; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; color:#3E2723; margin-bottom:6px; }
        .finput, .ftextarea { width:100%; padding:12px 14px; border:1.5px solid #e0d5cc; border-radius:9px; font-size:0.9rem; font-family:'Montserrat',sans-serif; color:#3E2723; background:#fdf8f3; outline:none; transition:border-color 0.2s; margin-bottom:18px; box-sizing:border-box; }
        .finput:focus, .ftextarea:focus { border-color:#5D4037; background:#fff; }
        .ftextarea { resize:vertical; min-height:140px; }
        .char-hint { font-size:0.7rem; color:#bbb; text-align:right; margin-top:-16px; margin-bottom:18px; }

        /* HALL OF FAME */
        .fame-section { background:linear-gradient(135deg,#3E2723,#5D4037); padding:60px 8%; }
        .fame-section .section-header { padding:0 0 30px; }
        .fame-section .section-header h2 { color:#D4AF7A; }
        .fame-section .section-header .line { background:#D4AF7A; }
        .winners-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(250px,1fr)); gap:20px; }
        .winner-card { background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); border-radius:14px; padding:28px 22px; text-align:center; transition:transform 0.3s; }
        .winner-card:hover { transform:translateY(-4px); }
        .trophy { font-size:2.6rem; margin-bottom:12px; }
        .wname { font-family:'Playfair Display',serif; font-size:1.1rem; color:#fff; font-weight:700; margin-bottom:4px; }
        .wtitle { font-style:italic; font-size:0.84rem; color:rgba(255,255,255,0.65); margin-bottom:8px; }
        .wcomp { font-size:0.7rem; text-transform:uppercase; letter-spacing:1.5px; color:#D4AF7A; }

        /* PAST */
        .past-wrap { padding:4px 8% 60px; display:flex; flex-direction:column; gap:10px; }
        .past-row { background:#fff; border:1px solid #f0e6dd; border-radius:10px; padding:14px 20px; display:flex; align-items:center; gap:14px; opacity:0.75; }
        .past-info { flex:1; }
        .past-name { font-weight:700; font-size:0.9rem; color:#3E2723; }
        .past-meta { font-size:0.74rem; color:#aaa; }
        .ended-pill { background:#f5f5f5; color:#999; border:1px solid #e0e0e0; padding:3px 12px; border-radius:20px; font-size:0.7rem; white-space:nowrap; }

        /* ALERTS */
        .alert-wrap { padding:0 8%; margin-top:28px; }
        .alert { padding:14px 18px; border-radius:10px; font-size:0.87rem; line-height:1.5; margin-bottom:6px; }
        .alert-success { background:#e8f5e9; color:#2e7d32; border:1px solid #a5d6a7; }
        .alert-error   { background:#fff0f0; color:#c62828; border:1px solid #ffcdd2; }
        .empty-box { text-align:center; padding:48px 20px; color:#bbb; }
        .empty-box .ei { font-size:3rem; margin-bottom:12px; }
    </style>
</head>
<body>

<div id="loader">
    <div class="loader-book"></div>
    <h2 style="color:var(--accent-gold);margin-top:20px;font-family:'Cinzel';letter-spacing:5px;">BOOK ADVISOR</h2>
</div>

<main class="fade-in-page">

    <!-- BANNER -->
    <div class="comp-banner">
        <div class="eyebrow">Book Advisor</div>
        <h1>COMPETITIONS</h1>
        <p>Share your writing talent, win amazing prizes, and get noticed by fellow book lovers.</p>
    </div>

    <!-- ALERTS -->
    <?php if ($success): ?>
    <div class="alert-wrap"><div class="alert alert-success">✅ <?= htmlspecialchars($success) ?></div></div>
    <?php endif; ?>
    <?php if ($error): ?>
    <div class="alert-wrap"><div class="alert alert-error">⚠️ <?= htmlspecialchars($error) ?></div></div>
    <?php endif; ?>

    <!-- ACTIVE COMPETITIONS -->
    <section>
        <div class="section-header fade-up">
            <h2>ACTIVE COMPETITIONS</h2>
            <div class="line"></div>
        </div>

        <?php if (empty($active_comps)): ?>
        <div style="padding:0 8% 50px">
            <div class="empty-box"><div class="ei">🏆</div><p>No competitions yet will come soon!</p></div>
        </div>
        <?php else: ?>
        <div class="comp-grid">
            <?php foreach ($active_comps as $comp):
                $cid    = $comp[$PK];
                $end    = new DateTime($comp['end_date']);
                $now    = new DateTime();
                $days   = max(0, (int)$now->diff($end)->days);
                $urgent = $days <= 3;
            ?>
            <div class="comp-card card-stagger">
                <div class="comp-card-head">
                    <span class="active-pill">● Active</span>
                    <h3><?= htmlspecialchars($comp['comp_name']) ?></h3>
                    <div class="sc"><?= (int)$comp['sub_count'] ?> entr<?= $comp['sub_count'] != 1 ? 'ies' : 'y' ?> submitted</div>
                </div>
                <div class="comp-card-body">
                    <?php if (!empty($comp['prizes'])): ?>
                    <div class="prize-pill">🎁 <?= htmlspecialchars($comp['prizes']) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($comp['comp_description'])): ?>
                    <p class="comp-desc"><?= htmlspecialchars(mb_substr($comp['comp_description'], 0, 140)) ?><?= mb_strlen($comp['comp_description']) > 140 ? '…' : '' ?></p>
                    <?php endif; ?>
                    <div class="comp-dates">
                        <span><i class="fas fa-play-circle"></i> <?= date('M j, Y', strtotime($comp['start_date'])) ?></span>
                        <span><i class="fas fa-flag-checkered"></i> <?= date('M j, Y', strtotime($comp['end_date'])) ?></span>
                        <?php if (!empty($comp['max_entries'])): ?>
                        <span><i class="fas fa-users"></i> Max <?= (int)$comp['max_entries'] ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="days-left" style="color:<?= $urgent ? '#c62828' : '#e65100' ?>">
                        <?= $urgent ? '🔥' : '⏳' ?> <?= $days ?> day<?= $days != 1 ? 's' : '' ?> remaining
                    </div>
                    <!-- Button uses data attributes - no inline JS string issues -->
                    <button class="btn-enter open-modal-btn"
                            data-id="<?= $cid ?>"
                            data-name="<?= htmlspecialchars($comp['comp_name'], ENT_QUOTES) ?>"
                            data-rules="<?= htmlspecialchars($comp['rules'] ?? '', ENT_QUOTES) ?>">
                        ✍️ Enter Competition
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>

    <!-- HALL OF FAME -->
    <?php if (!empty($winners)): ?>
    <section class="fame-section">
        <div class="section-header">
            <h2>HALL OF FAME</h2>
            <div class="line"></div>
        </div>
        <div class="winners-grid">
            <?php foreach ($winners as $w): ?>
            <div class="winner-card card-stagger">
                <div class="trophy">🏆</div>
                <div class="wname"><?= htmlspecialchars($w['author_name']) ?></div>
                <div class="wtitle">"<?= htmlspecialchars($w['title']) ?>"</div>
                <div class="wcomp"><?= htmlspecialchars($w['comp_name']) ?></div>
                <?php if (!empty($w['prizes'])): ?>
                <div style="margin-top:10px;font-size:0.75rem;color:#D4AF7A;font-weight:600">🎁 <?= htmlspecialchars($w['prizes']) ?></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- PAST COMPETITIONS -->
    <?php if (!empty($past_comps)): ?>
    <section style="background:#eaddcf">
        <div class="section-header fade-up">
            <h2>PAST COMPETITIONS</h2>
            <div class="line"></div>
        </div>
        <div class="past-wrap">
            <?php foreach ($past_comps as $comp): ?>
            <div class="past-row">
                <div style="font-size:1.5rem">📜</div>
                <div class="past-info">
                    <div class="past-name"><?= htmlspecialchars($comp['comp_name']) ?></div>
                    <div class="past-meta">
                        Ended <?= date('M j, Y', strtotime($comp['end_date'])) ?>
                        &nbsp;·&nbsp; <?= (int)$comp['sub_count'] ?> entries
                        <?php if (!empty($comp['prizes'])): ?>&nbsp;·&nbsp; 🎁 <?= htmlspecialchars($comp['prizes']) ?><?php endif; ?>
                    </div>
                </div>
                <span class="ended-pill">Ended</span>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

</main>

<!-- SUBMISSION MODAL -->
<div class="modal-overlay" id="submitModal">
    <div class="modal-box">
        <button class="modal-close" id="closeModalBtn">✕</button>
        <h2>✍️ Submit Entry</h2>
        <p class="modal-sub" id="modal-comp-name">—</p>
        <div class="rules-box" id="modal-rules" style="display:none"></div>
        <form method="POST" action="competitions.php" id="submitForm">
            <input type="hidden" name="submit_entry" value="1">
            <input type="hidden" name="comp_id" id="modal-comp-id" value="">
            <label class="flabel">Your Name *</label>
            <input type="text" name="author_name" class="finput" placeholder="Your Full Name" required>
            <label class="flabel">Email Address *</label>
            <input type="email" name="author_email" class="finput" placeholder="your@gmail.com" required>
            <label class="flabel">Entry Title *</label>
            <input type="text" name="entry_title" class="finput" placeholder="Enter your Entry Title" required maxlength="200">
            <label class="flabel">Entry Description *</label>
            <textarea name="entry_content" class="ftextarea"
                      placeholder="Enter Description" required maxlength="5000"
                      oninput="document.getElementById('charCount').textContent=this.value.length"></textarea>
            <div class="char-hint"><span id="charCount">0</span> / 5000</div>
            <button type="submit" class="btn-enter">🚀 Submit Entry</button>
        </form>
    </div>
</div>

<?php include("shared1/footer.php"); ?>

<script>
// ── LOADER ──
window.addEventListener('load', function() {
    setTimeout(function() {
        var l = document.getElementById('loader');
        if (l) { l.style.opacity = '0'; setTimeout(function(){ l.style.display='none'; }, 800); }
    }, 1800);
    checkAnimations();
});

// ── SCROLL ANIMATIONS ──
var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.12 });
function checkAnimations() {
    document.querySelectorAll('.fade-up, .card-stagger').forEach(function(el) { observer.observe(el); });
}

// ── MODAL: use data attributes, no inline JS ──
document.addEventListener('DOMContentLoaded', function() {

    // Open modal on button click
    document.querySelectorAll('.open-modal-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id    = this.getAttribute('data-id');
            var name  = this.getAttribute('data-name');
            var rules = this.getAttribute('data-rules');

            document.getElementById('modal-comp-id').value    = id;
            document.getElementById('modal-comp-name').textContent = name;

            var rBox = document.getElementById('modal-rules');
            if (rules && rules.trim() !== '') {
                rBox.innerHTML = '<strong>📋 Rules:</strong><br>' + rules.replace(/\n/g, '<br>');
                rBox.style.display = 'block';
            } else {
                rBox.style.display = 'none';
            }

            document.getElementById('submitModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close button
    document.getElementById('closeModalBtn').addEventListener('click', closeModal);

    // Click outside to close
    document.getElementById('submitModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
});

function closeModal() {
    document.getElementById('submitModal').classList.remove('open');
    document.body.style.overflow = '';
}
</script>
</body>
</html>
