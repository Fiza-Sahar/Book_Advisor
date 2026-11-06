<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile - Book Advisor</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/font-awesome.min.css">
<style>
  :root {
    --cream: #f5f0e8;
    --warm-white: #faf7f2;
    --brown-dark: #3d1f0d;
    --brown-mid: #7a3f1e;
    --brown-accent: #9b5a2d;
    --brown-light: #c4956a;
    --gold: #b8966e;
    --text-dark: #2a1810;
    --text-mid: #5c3d2e;
    --shadow: rgba(61,31,13,0.15);
  }
  * { margin:0; padding:0; box-sizing:border-box; }
  body {
    background: var(--cream);
    font-family: 'Cormorant Garamond', serif;
    color: var(--text-dark);
    min-height: 100vh;
  }

  /* NAV */
  nav {
    background: var(--warm-white);
    padding: 18px 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(180,140,100,0.2);
    position: sticky; top:0; z-index:100;
    box-shadow: 0 2px 20px var(--shadow);
  }
  .logo { font-family:'Playfair Display',serif; font-size:1.3rem; color:var(--brown-dark); letter-spacing:2px; text-decoration:none; }
  .nav-links { display:flex; gap:36px; list-style:none; }
  .nav-links a { text-decoration:none; color:var(--text-mid); font-size:0.85rem; letter-spacing:2px; text-transform:uppercase; position:relative; transition:color 0.3s; }
  .nav-links a::after { content:''; position:absolute; bottom:-4px; left:0; width:0; height:1px; background:var(--brown-accent); transition:width 0.3s; }
  .nav-links a:hover::after, .nav-links a.active::after { width:100%; }
  .nav-links a:hover, .nav-links a.active { color:var(--brown-accent); }

  /* PAGE HERO */
  .page-hero {
    background: linear-gradient(135deg, var(--brown-dark) 0%, var(--brown-mid) 60%, var(--brown-accent) 100%);
    padding: 60px;
    position: relative;
    overflow: hidden;
  }
  .page-hero::before {
    content:'';
    position:absolute; inset:0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  }
  .page-hero h1 { font-family:'Playfair Display',serif; color:#fff; font-size:2.8rem; position:relative; }
  .page-hero p { color:rgba(255,255,255,0.7); margin-top:8px; font-size:1.1rem; letter-spacing:1px; position:relative; }

  /* PROFILE LAYOUT */
  .profile-container {
    max-width: 1100px;
    margin: 50px auto;
    padding: 0 30px;
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
  }

  .card {
    background: var(--warm-white);
    border-radius: 4px;
    box-shadow: 0 4px 30px var(--shadow);
    border: 1px solid rgba(180,140,100,0.15);
    overflow: hidden;
    animation: fadeUp 0.6s ease both;
  }
  @keyframes fadeUp {
    from { opacity:0; transform:translateY(30px); }
    to { opacity:1; transform:translateY(0); }
  }

  /* SIDEBAR CARD */
  .sidebar-card { text-align:center; animation-delay:0.1s; }
  .avatar-wrap {
    background: linear-gradient(135deg, var(--brown-dark), var(--brown-mid));
    padding: 40px 30px 30px;
    position: relative;
  }
  .avatar-wrap::after {
    content:'';
    position:absolute; bottom:-1px; left:0; right:0;
    height:30px;
    background: var(--warm-white);
    clip-path: ellipse(55% 100% at 50% 100%);
  }
  .avatar {
    width:110px; height:110px;
    border-radius:50%;
    border:4px solid rgba(255,255,255,0.3);
    background: var(--brown-accent);
    display:flex; align-items:center; justify-content:center;
    margin:0 auto 15px;
    font-family:'Playfair Display',serif;
    font-size:2.5rem; color:#fff;
    position:relative; z-index:1;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    transition: transform 0.3s;
  }
  .avatar:hover { transform: scale(1.05); }
  .avatar-name { color:#fff; font-family:'Playfair Display',serif; font-size:1.3rem; position:relative; z-index:1; }
  .avatar-role { color:rgba(255,255,255,0.6); font-size:0.85rem; letter-spacing:1px; position:relative; z-index:1; }

  .sidebar-body { padding: 25px; }
  .stat-row {
    display:flex; justify-content:space-around;
    border-bottom:1px solid rgba(180,140,100,0.15);
    padding-bottom:20px; margin-bottom:20px;
  }
  .stat { text-align:center; }
  .stat-num { font-family:'Playfair Display',serif; font-size:1.6rem; color:var(--brown-accent); }
  .stat-label { font-size:0.78rem; color:var(--text-mid); letter-spacing:1px; text-transform:uppercase; }

  .sidebar-menu { list-style:none; }
  .sidebar-menu li { border-bottom:1px solid rgba(180,140,100,0.1); }
  .sidebar-menu a {
    display:flex; align-items:center; gap:12px;
    padding:13px 15px; text-decoration:none;
    color:var(--text-mid); font-size:0.95rem;
    transition:all 0.3s; border-left:3px solid transparent;
  }
  .sidebar-menu a:hover, .sidebar-menu a.active {
    color:var(--brown-accent);
    background:rgba(155,90,45,0.06);
    border-left-color:var(--brown-accent);
    padding-left:20px;
  }
  .sidebar-menu i { width:18px; color:var(--gold); }

  /* MAIN CONTENT */
  .main-col { display:flex; flex-direction:column; gap:25px; }

  .card-header {
    padding:25px 30px;
    border-bottom:1px solid rgba(180,140,100,0.15);
    display:flex; justify-content:space-between; align-items:center;
  }
  .card-header h2 { font-family:'Playfair Display',serif; font-size:1.4rem; color:var(--brown-dark); }
  .card-body { padding:30px; }

  .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
  .form-group { display:flex; flex-direction:column; gap:8px; }
  .form-group.full { grid-column:1/-1; }
  .form-group label { font-size:0.78rem; letter-spacing:2px; text-transform:uppercase; color:var(--text-mid); font-weight:500; }
  .form-group input, .form-group textarea, .form-group select {
    padding:12px 16px;
    border:1px solid rgba(180,140,100,0.3);
    border-radius:3px;
    background:var(--cream);
    font-family:'Cormorant Garamond',serif;
    font-size:1rem;
    color:var(--text-dark);
    transition:all 0.3s;
    outline:none;
  }
  .form-group input:focus, .form-group textarea:focus {
    border-color:var(--brown-accent);
    background:var(--warm-white);
    box-shadow:0 0 0 3px rgba(155,90,45,0.1);
  }
  .form-group textarea { resize:vertical; min-height:100px; }

  .btn {
    padding:12px 32px;
    border:none; cursor:pointer;
    font-family:'Cormorant Garamond',serif;
    font-size:0.85rem; letter-spacing:2px; text-transform:uppercase;
    border-radius:3px; transition:all 0.3s;
    display:inline-flex; align-items:center; gap:8px;
  }
  .btn-primary {
    background:var(--brown-accent); color:#fff;
    box-shadow:0 4px 15px rgba(155,90,45,0.3);
  }
  .btn-primary:hover { background:var(--brown-mid); transform:translateY(-2px); box-shadow:0 6px 20px rgba(155,90,45,0.4); }
  .btn-outline {
    background:transparent; color:var(--brown-accent);
    border:1px solid var(--brown-accent);
  }
  .btn-outline:hover { background:var(--brown-accent); color:#fff; }

  /* READING PREFERENCES */
  .genre-chips { display:flex; flex-wrap:wrap; gap:10px; margin-top:5px; }
  .chip {
    padding:8px 18px;
    border:1px solid rgba(180,140,100,0.4);
    border-radius:30px;
    font-size:0.85rem; cursor:pointer;
    color:var(--text-mid);
    transition:all 0.3s;
    background:transparent;
    font-family:'Cormorant Garamond',serif;
  }
  .chip:hover, .chip.active {
    background:var(--brown-accent); color:#fff; border-color:var(--brown-accent);
    box-shadow:0 4px 12px rgba(155,90,45,0.3);
  }

  /* RECENT ORDERS mini */
  .order-mini {
    display:flex; align-items:center; gap:16px;
    padding:15px 0;
    border-bottom:1px solid rgba(180,140,100,0.1);
    animation: fadeUp 0.5s ease both;
  }
  .order-mini:last-child { border-bottom:none; }
  .order-book-thumb {
    width:50px; height:68px;
    border-radius:3px;
    background:linear-gradient(135deg, var(--brown-dark), var(--brown-accent));
    flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    color:rgba(255,255,255,0.4); font-size:1.2rem;
    box-shadow:3px 3px 10px var(--shadow);
  }
  .order-info { flex:1; }
  .order-title { font-family:'Playfair Display',serif; font-size:1rem; color:var(--brown-dark); }
  .order-meta { font-size:0.82rem; color:var(--text-mid); margin-top:3px; }
  .order-badge {
    padding:4px 14px; border-radius:30px;
    font-size:0.75rem; letter-spacing:1px; text-transform:uppercase;
  }
  .badge-delivered { background:rgba(76,175,80,0.15); color:#2e7d32; }
  .badge-pending { background:rgba(255,152,0,0.15); color:#e65100; }

  /* FOOTER */
  footer {
    background:var(--brown-dark);
    color:rgba(255,255,255,0.6);
    padding:50px 60px 30px;
    margin-top:60px;
  }
  .footer-grid { display:grid; grid-template-columns:1fr 1fr 1fr; gap:40px; margin-bottom:40px; }
  .footer-brand h3 { font-family:'Playfair Display',serif; color:var(--gold); letter-spacing:2px; margin-bottom:12px; }
  .footer-brand p { font-size:0.9rem; line-height:1.7; }
  .footer-col h4 { color:var(--gold); letter-spacing:2px; font-size:0.8rem; text-transform:uppercase; margin-bottom:15px; }
  .footer-col a { display:block; color:rgba(255,255,255,0.6); text-decoration:none; margin-bottom:10px; font-size:0.9rem; transition:color 0.3s; }
  .footer-col a:hover { color:var(--gold); }
  .social-icons { display:flex; gap:14px; margin-top:15px; }
  .social-icons a {
    width:36px; height:36px; border-radius:50%;
    border:1px solid rgba(255,255,255,0.2);
    display:flex; align-items:center; justify-content:center;
    color:rgba(255,255,255,0.6); text-decoration:none; transition:all 0.3s;
  }
  .social-icons a:hover { border-color:var(--gold); color:var(--gold); }
  .footer-bottom { border-top:1px solid rgba(255,255,255,0.1); padding-top:20px; text-align:center; font-size:0.82rem; }

  /* ANIMATIONS */
  .card:nth-child(1) { animation-delay:0.1s; }
  .card:nth-child(2) { animation-delay:0.2s; }
  .card:nth-child(3) { animation-delay:0.3s; }

  @media(max-width:768px) {
    .profile-container { grid-template-columns:1fr; }
    .form-grid { grid-template-columns:1fr; }
    .footer-grid { grid-template-columns:1fr; }
    nav { padding:15px 20px; }
    .page-hero { padding:40px 20px; }
  }
</style>
</head>
<body>

    <!-- NAVIGATION -->
<?php
include("./shared1/nav.php");
?>


<div class="page-hero">
  <h1>My Profile</h1>
  <p>Manage your account & reading preferences</p>
</div>

<div class="profile-container">

  <!-- SIDEBAR -->
  <div>
    <div class="card sidebar-card">
      <div class="avatar-wrap">
        <div class="avatar">A</div>
        <div class="avatar-name">Ahmad Reader</div>
        <div class="avatar-role">Book Enthusiast</div>
      </div>
      <div class="sidebar-body">
        <div class="stat-row">
          <div class="stat"><div class="stat-num">12</div><div class="stat-label">Books</div></div>
          <div class="stat"><div class="stat-num">5</div><div class="stat-label">Orders</div></div>
          <div class="stat"><div class="stat-num">3</div><div class="stat-label">Essays</div></div>
        </div>
        <ul class="sidebar-menu">
          <li><a href="profile.php" class="active"><i class="fa fa-user"></i> My Profile</a></li>
          <li><a href="my_orders.php"><i class="fa fa-shopping-bag"></i> My Orders</a></li>
          <li><a href="browse_books.php"><i class="fa fa-book"></i> Browse Books</a></li>
          <li><a href="competitions.php"><i class="fa fa-trophy"></i> Competitions</a></li>
          <li><a href="download_pdf.php"><i class="fa fa-download"></i> Downloads</a></li>
          <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- MAIN -->
  <div class="main-col">

    <!-- Personal Info Card -->
    <div class="card" style="animation-delay:0.15s;">
      <div class="card-header">
        <h2>Personal Information</h2>
        <button class="btn btn-outline" onclick="toggleEdit()"><i class="fa fa-edit"></i> Edit</button>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-grid">
            <div class="form-group">
              <label>First Name</label>
              <input type="text" name="first_name" value="Ahmad" id="inp1" readonly>
            </div>
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" name="last_name" value="Reader" id="inp2" readonly>
            </div>
            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email" value="ahmad@example.com" id="inp3" readonly>
            </div>
            <div class="form-group">
              <label>Phone Number</label>
              <input type="tel" name="phone" value="+92 300 0000000" id="inp4" readonly>
            </div>
            <div class="form-group full">
              <label>Bio / About Me</label>
              <textarea name="bio" id="inp5" readonly>Passionate about stories that take me to new worlds. Fantasy and Sci-Fi are my favorites.</textarea>
            </div>
          </div>
          <div id="save-btn" style="margin-top:20px;display:none;">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Reading Preferences -->
    <div class="card" style="animation-delay:0.25s;">
      <div class="card-header">
        <h2>Reading Preferences</h2>
      </div>
      <div class="card-body">
        <label style="font-size:0.78rem;letter-spacing:2px;text-transform:uppercase;color:var(--text-mid);">Favorite Genres</label>
        <div class="genre-chips" style="margin-top:15px;">
          <button class="chip active" onclick="this.classList.toggle('active')">Fantasy</button>
          <button class="chip active" onclick="this.classList.toggle('active')">Sci-Fi</button>
          <button class="chip" onclick="this.classList.toggle('active')">Romance</button>
          <button class="chip" onclick="this.classList.toggle('active')">Mystery</button>
          <button class="chip" onclick="this.classList.toggle('active')">Thriller</button>
          <button class="chip" onclick="this.classList.toggle('active')">Literary Fiction</button>
          <button class="chip" onclick="this.classList.toggle('active')">Horror</button>
          <button class="chip active" onclick="this.classList.toggle('active')">Adventure</button>
        </div>
        <div style="margin-top:25px;">
          <button class="btn btn-primary"><i class="fa fa-heart"></i> Save Preferences</button>
        </div>
      </div>
    </div>

    <!-- Recent Orders -->
    <div class="card" style="animation-delay:0.35s;">
      <div class="card-header">
        <h2>Recent Orders</h2>
        <a href="my_orders.php" class="btn btn-outline">View All</a>
      </div>
      <div class="card-body">
        <div class="order-mini">
          <div class="order-book-thumb"><i class="fa fa-book"></i></div>
          <div class="order-info">
            <div class="order-title">Bully — Penelope Douglas</div>
            <div class="order-meta">Order #1042 · Feb 12, 2025 · $21.00</div>
          </div>
          <span class="order-badge badge-delivered">Delivered</span>
        </div>
        <div class="order-mini">
          <div class="order-book-thumb"><i class="fa fa-book"></i></div>
          <div class="order-info">
            <div class="order-title">Twisted Love — Ana Huang</div>
            <div class="order-meta">Order #1038 · Feb 5, 2025 · $14.00</div>
          </div>
          <span class="order-badge badge-pending">Pending</span>
        </div>
        <div class="order-mini">
          <div class="order-book-thumb"><i class="fa fa-book"></i></div>
          <div class="order-info">
            <div class="order-title">Fearless — Lauren Roberts</div>
            <div class="order-meta">Order #1031 · Jan 28, 2025 · $26.00</div>
          </div>
          <span class="order-badge badge-delivered">Delivered</span>
        </div>
      </div>
    </div>

    <!-- Change Password -->
    <div class="card" style="animation-delay:0.45s;">
      <div class="card-header">
        <h2>Change Password</h2>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="form-grid">
            <div class="form-group full">
              <label>Current Password</label>
              <input type="password" name="current_password" placeholder="Enter current password">
            </div>
            <div class="form-group">
              <label>New Password</label>
              <input type="password" name="new_password" placeholder="New password">
            </div>
            <div class="form-group">
              <label>Confirm New Password</label>
              <input type="password" name="confirm_password" placeholder="Confirm new password">
            </div>
          </div>
          <div style="margin-top:20px;">
            <button type="submit" class="btn btn-primary"><i class="fa fa-lock"></i> Update Password</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <h3>BOOK ADVISOR</h3>
      <p>Curating the finest stories for the modern reader. Step into a world of imagination and luxury reading.</p>
    </div>
    <div class="footer-col">
      <h4>Quick Links</h4>
      <a href="index.php">Home</a>
      <a href="browse_books.php">Shop Collection</a>
      <a href="about.php">About Us</a>
      <a href="contact.php">Contact Support</a>
    </div>
    <div class="footer-col">
      <h4>Connect</h4>
      <p>support@bookadvisor.com</p>
      <p>+1 234 567 890</p>
      <div class="social-icons">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">© 2025 Book Advisor. All Rights Reserved.</div>
</footer>

<script>
function toggleEdit() {
  const inputs = ['inp1','inp2','inp3','inp4','inp5'];
  const saveBtn = document.getElementById('save-btn');
  const isReadOnly = document.getElementById('inp1').readOnly;
  inputs.forEach(id => {
    document.getElementById(id).readOnly = !isReadOnly;
    if(!isReadOnly) {
      document.getElementById(id).style.background = '';
    } else {
      document.getElementById(id).style.background = '#fff';
      document.getElementById(id).style.borderColor = 'var(--brown-accent)';
    }
  });
  saveBtn.style.display = isReadOnly ? 'block' : 'none';
}

// Scroll reveal
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if(e.isIntersecting) e.target.style.opacity = '1';
  });
});
document.querySelectorAll('.card').forEach(c => observer.observe(c));
</script>
</body>
</html>
