<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bookstoredatabase');

// Application Settings
define('APP_NAME', 'eBooks Admin');
define('APP_URL', 'http://localhost/ebooks-admin');
define('UPLOAD_PATH', __DIR__ . '/uploads/');
define('COVERS_PATH', __DIR__ . '/uploads/covers/');
define('BOOKS_PATH', __DIR__ . '/uploads/books/');
define('SUBMISSIONS_PATH', __DIR__ . '/uploads/submissions/');

// Session
define('SESSION_LIFETIME', 3600);

// Create database connection
function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        } catch (PDOException $e) {
            die('<div style="font-family:monospace;padding:20px;background:#1a1a1a;color:#ff6b6b;">
                <strong>Database Connection Failed:</strong> ' . htmlspecialchars($e->getMessage()) . '
                <br><small>Check your config.php database settings.</small>
            </div>');
        }
    }
    return $pdo;
}

// Start session with security
function startSecureSession() {
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.cookie_path', '/');
        session_start();
    }
}

// Auth check
function requireLogin() {
    startSecureSession();
    if (!isset($_SESSION['admin_id'])) {
        header('Location: ../User-Panel/login_page.php');
        exit;
    }
}

// Flash messages
function setFlash($type, $message) {
    startSecureSession();
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash() {
    startSecureSession();
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

// Sanitize input
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Format currency
function formatCurrency($amount) {
    return '₹' . number_format($amount, 2);
}

// Format date
function formatDate($date) {
    return date('M d, Y', strtotime($date));
}

// Generate order number
function generateOrderNumber() {
    return 'ORD-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
}

// Status badge helper
function statusBadge($status) {
    $classes = [
        'active'    => 'badge-success',
        'inactive'  => 'badge-secondary',
        'draft'     => 'badge-warning',
        'pending'   => 'badge-warning',
        'completed' => 'badge-success',
        'cancelled' => 'badge-danger',
        'refunded'  => 'badge-info',
        'suspended' => 'badge-danger',
        'approved'  => 'badge-success',
        'rejected'  => 'badge-danger',
        'winner'    => 'badge-gold',
        'ended'     => 'badge-secondary',
        'paid'      => 'badge-success',
        'unpaid'    => 'badge-warning',
    ];
    $class = $classes[$status] ?? 'badge-secondary';
    return '<span class="badge ' . $class . '">' . ucfirst($status) . '</span>';
}

// Map book status (0 = paid, 1 = free)
function getBookStatus($is_free) {
    return $is_free == 1 ? 'Free' : 'Paid';
}
?>
