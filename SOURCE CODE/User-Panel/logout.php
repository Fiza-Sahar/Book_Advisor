<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_path', '/');
    session_start();
}

$_SESSION = [];

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

session_destroy();
header('Location: login_page.php');
exit;
