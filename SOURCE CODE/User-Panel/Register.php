<?php 
include("connection.php"); 
// Nav bar include (Iske andar session_start ho sakta hai)
include("shared1/nav.php"); 

// Professional way to start session without notices
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Backend Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_btn'])) {
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $u_name    = mysqli_real_escape_string($con, $_POST['u_name']);
    $contact   = mysqli_real_escape_string($con, $_POST['contact']);
    $email     = mysqli_real_escape_string($con, $_POST['email']);
    $pass      = $_POST['pass'];
    $time      = time(); 

    $check = mysqli_query($con, "SELECT * FROM register_table WHERE register_email='$email' OR register_user_name='$u_name'");
    
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Error: Username or Email already exists!');</script>";
    } else {
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO register_table 
                (register_full_name, register_user_name, register_password, register_contact_number, register_email, register_question, register_answer, register_time) 
                VALUES 
                ('$full_name', '$u_name', '$hashed_pass', '$contact', '$email', '', '', '$time')";
        
        if (mysqli_query($con, $sql)) {
            // users table mein bhi insert karo (admin panel k liye)
            $sql2 = "INSERT INTO users (user_name, email, created_at) 
                     VALUES ('$u_name', '$email', NOW())";
            mysqli_query($con, $sql2);

            echo "<script>alert('Welcome to Book Advisor! Account Created.'); window.location='login_page.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Book Advisor</title>
    <style>
        :root { 
            --bg: #FDF8F3; 
            --brown: #5D4037; 
            --text: #3E2723; 
            --border: #E0D7D0; 
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        body { background-color: var(--bg); color: var(--text); }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px); /* Adjust based on your nav height */
            padding: 20px;
        }

        .auth-container {
            display: flex;
            width: 1000px;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        }

        /* Left Side: Form */
        .form-content {
            flex: 1.2;
            padding: 50px 70px;
        }

        .form-content h1 { font-family: 'Georgia', serif; font-size: 2.8rem; margin-bottom: 10px; color: var(--text); }
        .form-content p.subtitle { color: #888; margin-bottom: 35px; font-size: 1rem; }

        .input-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }

        .input-group { margin-bottom: 15px; }
        .input-group label { 
            display: block; 
            font-size: 0.75rem; 
            font-weight: 800; 
            text-transform: uppercase; 
            margin-bottom: 8px; 
            letter-spacing: 0.5px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            background-color: #FBFAFA;
            font-size: 0.95rem;
            outline: none;
            transition: 0.2s ease;
        }

        .input-group input::placeholder { color: #BBB; }
        .input-group input:focus { border-color: var(--brown); background: #fff; }

        .btn-register {
            width: 100%;
            padding: 16px;
            background-color: var(--brown);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-register:hover { background-color: #432E27; transform: translateY(-1px); }

        .footer-text { text-align: center; margin-top: 25px; font-size: 0.9rem; color: #666; }
        .footer-text a { color: var(--text); font-weight: 700; text-decoration: none; }

        /* Right Side: Image with Quote */
        .image-panel {
            flex: 0.8;
            background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), 
                        url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            padding: 40px;
        }

        .quote-box { color: #fff; }
        .quote-box p { font-family: 'Georgia', serif; font-size: 1.4rem; font-style: italic; line-height: 1.5; margin-bottom: 15px; }
        .quote-box span { font-size: 0.75rem; letter-spacing: 2px; text-transform: uppercase; }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="auth-container">
        <div class="form-content">
            <h1>Create Account</h1>
            <p class="subtitle">Join the Book Advisor community today.</p>

            <form id="registerForm" method="POST" onsubmit="return handleValidation()">
                <div class="input-grid">
                    <div class="input-group full-width">
                        <label>Full Name</label>
                        <input type="text" name="full_name" placeholder="Enter your full legal name" required>
                    </div>

                    <div class="input-group">
                        <label>Username</label>
                        <input type="text" name="u_name" placeholder="e.g. reader_01" required>
                    </div>

                    <div class="input-group">
                        <label>Contact Number</label>
                        <input type="text" name="contact" placeholder="e.g. 0323XXXXXXX" required>
                    </div>

                    <div class="input-group full-width">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="example@domain.com" required>
                    </div>

                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" id="pass" name="pass" placeholder="Min 8 characters" required>
                    </div>

                    <div class="input-group">
                        <label>Confirm Password</label>
                        <input type="password" id="cpass" name="cpass" placeholder="Repeat password" required>
                    </div>
                </div>

                <button type="submit" name="register_btn" class="btn-register">Register Now</button>

                <p class="footer-text">Already a reader? <a href="login_page.php">Sign In</a></p>
            </form>
        </div>

        <div class="image-panel">
            <div class="quote-box">
                <p>"A library is not a luxury but one of the necessities of life."</p>
                <span>— Henry Ward Beecher</span>
            </div>
        </div>
    </div>
</div>

<script>
    function handleValidation() {
        const pass = document.getElementById('pass').value;
        const cpass = document.getElementById('cpass').value;

        if (pass.length < 8) {
            alert("Password must be at least 8 characters long.");
            return false;
        }
        if (pass !== cpass) {
            alert("Passwords do not match!");
            return false;
        }
        return true;
    }
</script>

  <?php
include("./shared1/footer.php");
?>

</body>
</html>