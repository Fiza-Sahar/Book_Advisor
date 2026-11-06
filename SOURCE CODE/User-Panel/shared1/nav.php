<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Book Advisor</title>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.navbar {
  width: 100%;
  height: 70px;
  background: linear-gradient(to right, #e7e2db, #dcd6cf);
  display: flex;
  align-items: center;
  font-family: Georgia, serif;
}

.nav-container {
  width: 92%;
  margin: auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.logo {
  font-size: 20px;
  letter-spacing: 2px;
  color: #7a4b2a;
  font-weight: 600;
}

.nav-links {
  display: flex;
  gap: 40px;
}

.nav-links a {
  text-decoration: none;
  font-size: 13px;
  color: #6a6a6a;
}

.nav-links a:hover {
  color: #7a4b2a;
}

/* ICONS */
.nav-icons {
  display: flex;
  gap: 20px;
  list-style: none;
}

.nav-icons a {
  color: #7a4b2a;
  font-size: 18px;
  text-decoration: none;
}

.nav-icons a:hover {
  opacity: 0.7;
}
#icon{
  color: #7a4b2a;
}
</style>
</head>

<body>
<div style="display: flex; justify-content: space-between; align-items: center; padding: 15px 5%; background-color: #f3eee7; font-family: 'Arial', sans-serif; border-bottom: 1px solid #dcd7cf; width: 100%; box-sizing: border-box;">
    
    <!-- Logo -->
    <div style="font-size: 24px; font-weight: bold; color: #8b5e3c; font-family: 'Times New Roman', serif;">
        BOOK ADVISOR
    </div>

    <!-- Navigation Links -->
    <div style="display: flex; gap: 25px; font-size: 13px; letter-spacing: 1px;">
        <a href="./index.php" style="text-decoration: none; color: #8b5e3c; border-bottom: 2px solid #8b5e3c;">HOME</a>
        <a href="./shop.php" style="text-decoration: none; color: #333;">SHOP</a>
        <a href="./about.php" style="text-decoration: none; color: #333;">ABOUT</a>
        <a href="./contact111.php" style="text-decoration: none; color: #333;">CONTACT</a>
    </div>

    <!-- Account Section -->
    <div id="icon" style="display: flex; gap: 20px; align-items: center;">

        <!-- Register -->
        <a href="./register.php" style="text-decoration: none; color: #7a4b2a; display: flex; align-items: center; gap: 6px; font-size: 14px;">
            <i class="fa-solid fa-user-plus"></i>
            <span>Register</span>
        </a>

        <!-- Login -->
        <a href="./login_page.php" style="text-decoration: none; color: #7a4b2a; display: flex; align-items: center; gap: 6px; font-size: 14px;">
            <i class="fa-solid fa-right-to-bracket"></i>
            <span>Login</span>
        </a>

        <!-- Logout -->
        <a href="./logout.php" title="Logout" style="text-decoration: none; color: #7a4b2a; display: flex; align-items: center; gap: 6px; font-size: 14px;">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>

        <a href="./cart.php" title="cart.php" style="text-decoration: none; color: #7a4b2a; display: flex; align-items: center; gap: 6px; font-size: 14px;">
            <i class="fa-solid fa-cart-shopping"></i>
            <span></span>
        </a>

    </div>

</div>