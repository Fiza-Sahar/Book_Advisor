<?php
include("shared1/nav.php"); 
include("connection.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Book Advisor</title>
    <style>
        :root {
            --bg-paper: #FDF8F3;
            --primary-brown: #5D4037;
            --dark-brown: #3E2723;
            --accent-tan: #D7CCC8;
            --gold-text: #A1887F;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Palatino', 'Georgia', serif; }

        body {
            background-color: var(--bg-paper);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .signup-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 20px;
        }

        .signup-card {
            display: flex;
            width: 1100px;
            min-height: 750px;
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(62, 39, 35, 0.15);
            border: 1px solid var(--accent-tan);
        }

        .form-area { flex: 1.2; padding: 60px; }
        .form-area h1 { color: var(--dark-brown); font-size: 2.8rem; margin-bottom: 5px; }
        .form-area .tagline { color: var(--gold-text); font-size: 1rem; margin-bottom: 40px; font-style: italic; }

        .input-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .input-group { margin-bottom: 20px; }
        .full-row { grid-column: span 2; }

        .input-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: bold;
            color: var(--primary-brown);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 14px;
            border: 1.5px solid var(--accent-tan);
            border-radius: 6px;
            background-color: #fcfcfc;
            outline: none;
            font-size: 0.95rem;
            color: var(--dark-brown);
            transition: 0.3s;
        }

        .input-group input:focus { border-color: var(--primary-brown); background-color: #fff; }

        .btn-register {
            width: 100%;
            padding: 16px;
            background-color: var(--primary-brown);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: 0.4s;
            margin-top: 25px;
        }

        .btn-register:hover { background-color: var(--dark-brown); transform: translateY(-2px); }

        .image-area {
            flex: 1;
            background: linear-gradient(rgba(62, 39, 35, 0.6), rgba(62, 39, 35, 0.6)), 
                        url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=2000&auto=format&fit=crop'); 
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            color: #fff;
            text-align: center;
        }

        .quote-box { border: 2px solid rgba(255,255,255,0.3); padding: 40px; background: rgba(0,0,0,0.15); backdrop-filter: blur(5px); }

        .login-footer { text-align: center; margin-top: 30px; color: #777; }
        .login-footer a { color: var(--primary-brown); text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <div class="signup-container">
        <div class="signup-card">
            <div class="form-area">
                <h1>Join the Library</h1>
                <p class="tagline">Start your reading journey with us today.</p>

                <form id="signupForm" method="POST" action="">
                    <div class="input-grid">
                        <div class="input-group">
                            <label>First Name</label>
                            <input type="text" name="fname" placeholder="Enter your first name" required>
                        </div>
                        <div class="input-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" placeholder="Enter your last name" required>
                        </div>
                        <div class="input-group full-row">
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="e.g. name@example.com" required>
                        </div>
                        <div class="input-group">
                            <label>Username</label>
                            <input type="text" name="user" placeholder="Create a unique username" required>
                        </div>
                        <div class="input-group">
                            <label>Gender</label>
                            <select name="gender">
                                <option value="" disabled selected>Select your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Password</label>
                            <input type="password" id="pass" name="pass" placeholder="Create a strong password" required>
                        </div>
                        <div class="input-group">
                            <label>Confirm Password</label>
                            <input type="password" id="cpass" name="cpass" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-register">Create My Account</button>
                </form>

                <div class="login-footer">
                    Already a reader? <a href="login_page.php">Log In</a>
                </div>
            </div>

            <div class="image-area">
                <div class="quote-box">
                    <h2>"Not all those who wander are lost... some are just in the library."</h2>
                    <p style="letter-spacing: 2px; font-size: 0.8rem; text-transform: uppercase;">— Book Advisor</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            const p1 = document.getElementById('pass').value;
            const p2 = document.getElementById('cpass').value;
            if(p1 !== p2) {
                alert("Passwords do not match. Please check again.");
                e.preventDefault();
            }
        });
    </script>

      <?php
include("./shared1/footer.php");
?>

</body>
</html>