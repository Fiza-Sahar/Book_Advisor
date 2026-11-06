<?php
// Session cookie ko root path pe set karo taake dono panels share kar sakein
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_path', '/');
    session_start();
}

include("connection.php");

// Pehle se logged in hai toh redirect
if (isset($_SESSION['admin_id'])) { header('Location: /Book%20Advisor/Admin-Panel/dashboard.php'); exit; }
if (isset($_SESSION['user_id']))  { header('Location: index.php'); exit; }

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['user_email'] ?? '');
    $password = $_POST['pass'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        $esc = mysqli_real_escape_string($con, $username);

        // ── STEP 1: ADMIN CHECK ──
        $result = mysqli_query($con, "SELECT * FROM admin_table WHERE admin_user_name='$esc' LIMIT 1");
        $admin  = mysqli_fetch_assoc($result);

        if ($admin) {
            $match = false;
            if ($password === $admin['admin_password']) {
                $match = true;
            }
            elseif (password_verify($password, $admin['admin_password'])) {
                $match = true;
            }
            elseif (md5($password) === $admin['admin_password']) {
                $match = true;
            }

            if ($match) {
                $_SESSION['admin_id']   = $admin['admin_id'];
                $_SESSION['admin_name'] = $admin['admin_user_name'];
                $_SESSION['role']       = 'admin';
                header('Location: /Book%20Advisor/Admin-Panel/dashboard.php');
                exit;
            }
        }

        // ── STEP 2: USER CHECK ──
        $result = mysqli_query($con, "SELECT * FROM register_table WHERE register_user_name='$esc' OR register_email='$esc' LIMIT 1");
        $user   = mysqli_fetch_assoc($result);

        $match = false;
        if ($user) {
            if     (password_verify($password, $user['register_password'])) { $match = true; }
            elseif ($password === $user['register_password'])                {
                $match = true;
                $h = password_hash($password, PASSWORD_DEFAULT);
                mysqli_query($con, "UPDATE register_table SET register_password='$h' WHERE register_id={$user['register_id']}");
            }
            elseif (md5($password) === $user['register_password'])           {
                $match = true;
                $h = password_hash($password, PASSWORD_DEFAULT);
                mysqli_query($con, "UPDATE register_table SET register_password='$h' WHERE register_id={$user['register_id']}");
            }
        }

        if ($match) {
            $_SESSION['user_id']       = $user['register_id'];
            $_SESSION['user_name']     = $user['register_user_name'];
            $_SESSION['user_fullname'] = $user['register_full_name'];
            $_SESSION['user_email']    = $user['register_email'];
            $_SESSION['role']          = 'user';
            header('Location: index.php');
            exit;
        }

        $error = 'Invalid username/email or password.';
    }
}

include("shared1/nav.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Book Advisor</title>
    <style>
        /* White Library Theme Colors from your Image */
        :root {
            --bg-page: #FDF8F3;
            --white: #ffffff;
            --btn-brown: #5D4037;
            --text-dark: #3E2723;
            --input-bg: #FDF8F3;
            --border-color: #D7CCC8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Georgia', serif; }

        body {
            background-color: var(--bg-page);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Wrapper to center card while keeping nav at top */
        .page-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .login-card {
            display: flex;
            width: 1000px;
            height: 600px;
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        /* LEFT SIDE: FORM (Structure like Purple version) */
        .left-panel {
            flex: 1.1;
            padding: 60px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .brand-header {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--text-dark);
            letter-spacing: 2px;
            margin-bottom: 40px;
        }

        .welcome-section h1 {
            font-size: 2.8rem;
            color: var(--text-dark);
            margin-bottom: 10px;
            font-weight: 400;
        }
        .welcome-section p {
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 40px;
        }

        .form-group { margin-bottom: 25px; }
        .form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: bold;
            color: var(--text-dark);
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .form-group input {
            width: 100%;
            padding: 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--input-bg);
            font-size: 1rem;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: var(--btn-brown);
            background-color: #fff;
        }

        .login-btn {
            width: 100%;
            padding: 18px;
            background-color: var(--btn-brown);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            letter-spacing: 2px;
            transition: 0.3s;
            text-transform: uppercase;
        }

        .login-btn:hover {
            background-color: #3E2723;
            transform: translateY(-2px);
        }

        .footer-link {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #777;
        }
        .footer-link a { color: var(--btn-brown); font-weight: bold; text-decoration: none; }

        /* RIGHT SIDE: IMAGE PANEL */
        .right-panel {
            flex: 1;
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), 
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1000&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: #fff;
            text-align: center;
            position: relative;
        }

        /* "Sign In" button at the top of the Image Panel */
        .top-nav-hint {
            position: absolute;
            top: 30px;
            right: 30px;
            font-size: 0.8rem;
        }
        .top-nav-hint a {
            color: #fff;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,0.6);
            padding: 5px 15px;
            border-radius: 20px;
            margin-left: 10px;
        }

        .right-panel blockquote {
            font-size: 1.5rem;
            font-style: italic;
            line-height: 1.6;
            margin-bottom: 20px;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
        }
        .right-panel cite {
            font-size: 0.8rem;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<div class="page-content">
    <div class="login-card">
        
        <div class="left-panel">
            <div class="brand-header">BOOK<span>ADVISOR</span></div>
            
            <div class="welcome-section">
                <h1>Welcome Back</h1>
                <p>Please enter your credentials to access your books.</p>
            </div>

            <?php if ($error): ?>
            <div style="background:#fff0f0; border:1px solid #ffcdd2; color:#c62828; border-radius:8px; padding:12px 16px; font-size:0.85rem; margin-bottom:20px; font-family:'Segoe UI',sans-serif;">
                ⚠️ <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>

            <form action="login_page.php" method="POST">
                <div class="form-group">
                    <label>USERNAME</label>
                    <input type="text" name="user_email" placeholder="Enter username" required>
                </div>

                <div class="form-group">
                    <label>PASSWORD</label>
                    <input type="password" name="pass" placeholder="Enter password" required>
                </div>

                <button type="submit" class="login-btn">SIGN IN</button>
            </form>

            <div class="footer-link">
                New reader? <a href="Register.php">Join the library</a>
            </div>
        </div>

        <div class="right-panel">
            <div class="top-nav-hint">
                Already a reader? <a href="./Register.php">Sign In</a>
            </div>
            
            <blockquote>"A library is not a luxury but one of the necessities of life."</blockquote>
            <cite>— HENRY WARD BEECHER</cite>
        </div>

    </div>
</div>

  <?php
include("./shared1/footer.php");
?>

</body>
</html>