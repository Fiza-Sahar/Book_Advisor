<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Orders - Book Advisor</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/font-awesome.min.css">
<style>
:root{--cream:#f5f0e8;--warm-white:#faf7f2;--brown-dark:#3d1f0d;--brown-mid:#7a3f1e;--brown-accent:#9b5a2d;--gold:#b8966e;--text-dark:#2a1810;--text-mid:#5c3d2e;--shadow:rgba(61,31,13,0.15);}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--cream);font-family:'Cormorant Garamond',serif;color:var(--text-dark);}
nav{background:var(--warm-white);padding:18px 60px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(180,140,100,0.2);position:sticky;top:0;z-index:100;box-shadow:0 2px 20px var(--shadow);}
.logo{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-dark);letter-spacing:2px;text-decoration:none;}
.nav-links{display:flex;gap:36px;list-style:none;}
.nav-links a{text-decoration:none;color:var(--text-mid);font-size:0.85rem;letter-spacing:2px;text-transform:uppercase;transition:color 0.3s;}
.nav-links a:hover{color:var(--brown-accent);}

.page-hero{background:linear-gradient(160deg,var(--brown-dark),var(--brown-mid));padding:55px 60px;position:relative;overflow:hidden;}
.page-hero::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M20 20.5V18H0v5h20v-2.5zM0 25h20v5H0zM0 10h20v5H0z'/%3E%3C/g%3E%3C/svg%3E");}
.page-hero h1{font-family:'Playfair Display',serif;color:#fff;font-size:2.6rem;position:relative;letter-spacing:2px;}
.page-hero p{color:rgba(255,255,255,0.65);margin-top:8px;position:relative;}

.main-container{max-width:1100px;margin:50px auto;padding:0 30px;}

/* STATS ROW */
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-bottom:40px;}
.stat-card{
  background:var(--warm-white);border:1px solid rgba(180,140,100,0.15);
  border-radius:4px;padding:22px;text-align:center;
  box-shadow:0 3px 15px var(--shadow);
  animation:fadeUp 0.5s ease both;
}
.stat-card:nth-child(1){animation-delay:0.05s;}
.stat-card:nth-child(2){animation-delay:0.1s;}
.stat-card:nth-child(3){animation-delay:0.15s;}
.stat-card:nth-child(4){animation-delay:0.2s;}
@keyframes fadeUp{from{opacity:0;transform:translateY(25px);}to{opacity:1;transform:translateY(0);}}
.stat-icon{width:46px;height:46px;border-radius:50%;background:rgba(155,90,45,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;color:var(--brown-accent);font-size:1.1rem;}
.stat-num{font-family:'Playfair Display',serif;font-size:1.8rem;color:var(--brown-dark);}
.stat-lbl{font-size:0.78rem;letter-spacing:1px;text-transform:uppercase;color:var(--text-mid);margin-top:3px;}

/* FILTER BAR */
.orders-toolbar{
  display:flex;gap:15px;align-items:center;margin-bottom:25px;flex-wrap:wrap;
}
.filter-tabs{display:flex;gap:8px;}
.ftab{
  padding:8px 20px;border:1px solid rgba(180,140,100,0.3);border-radius:30px;
  background:transparent;cursor:pointer;font-family:'Cormorant Garamond',serif;
  font-size:0.88rem;color:var(--text-mid);transition:all 0.3s;
}
.ftab:hover,.ftab.active{background:var(--brown-accent);color:#fff;border-color:var(--brown-accent);}
.search-orders{
  margin-left:auto;display:flex;align-items:center;gap:0;
  border:1px solid rgba(180,140,100,0.3);border-radius:3px;overflow:hidden;background:var(--warm-white);
}
.search-orders i{padding:0 12px;color:var(--gold);}
.search-orders input{padding:10px 12px 10px 0;border:none;background:transparent;font-family:'Cormorant Garamond',serif;font-size:0.95rem;outline:none;color:var(--text-dark);}

/* ORDER CARDS */
.order-card{
  background:var(--warm-white);border:1px solid rgba(180,140,100,0.15);
  border-radius:4px;overflow:hidden;margin-bottom:20px;
  box-shadow:0 3px 20px var(--shadow);
  transition:all 0.3s;animation:fadeUp 0.5s ease both;
}
.order-card:hover{box-shadow:0 8px 35px rgba(61,31,13,0.2);transform:translateY(-2px);}
.order-card:nth-child(1){animation-delay:0.1s;}
.order-card:nth-child(2){animation-delay:0.18s;}
.order-card:nth-child(3){animation-delay:0.26s;}
.order-card:nth-child(4){animation-delay:0.34s;}
.order-card:nth-child(5){animation-delay:0.42s;}

.order-header{
  display:flex;justify-content:space-between;align-items:center;
  padding:18px 24px;background:rgba(155,90,45,0.05);
  border-bottom:1px solid rgba(180,140,100,0.12);
}
.order-id{font-family:'Playfair Display',serif;color:var(--brown-dark);font-size:1.05rem;}
.order-date{font-size:0.82rem;color:var(--text-mid);}
.order-right{display:flex;align-items:center;gap:15px;}
.status-badge{
  padding:5px 16px;border-radius:30px;font-size:0.75rem;letter-spacing:1px;text-transform:uppercase;
}
.s-delivered{background:rgba(76,175,80,0.12);color:#2e7d32;}
.s-pending{background:rgba(255,152,0,0.12);color:#e65100;}
.s-processing{background:rgba(33,150,243,0.12);color:#1565c0;}
.s-cancelled{background:rgba(244,67,54,0.12);color:#c62828;}

.order-body{padding:20px 24px;}
.order-items{display:flex;gap:16px;flex-wrap:wrap;}
.order-item{display:flex;gap:14px;align-items:flex-start;flex:1;min-width:220px;}
.item-thumb{
  width:55px;height:75px;border-radius:3px;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  color:rgba(255,255,255,0.6);font-size:0.7rem;text-align:center;padding:5px;
  box-shadow:3px 3px 10px var(--shadow);
}
.item-title{font-family:'Playfair Display',serif;font-size:0.95rem;color:var(--brown-dark);line-height:1.3;}
.item-author{font-size:0.78rem;color:var(--text-mid);margin-top:2px;}
.item-qty{font-size:0.78rem;color:var(--text-mid);margin-top:4px;}
.item-price{font-family:'Playfair Display',serif;color:var(--brown-accent);font-size:1rem;margin-top:4px;}

.order-footer{
  display:flex;justify-content:space-between;align-items:center;
  padding:14px 24px;border-top:1px solid rgba(180,140,100,0.1);
  background:rgba(245,240,232,0.5);
}
.order-total{font-family:'Playfair Display',serif;color:var(--brown-dark);}
.order-total span{color:var(--brown-accent);font-size:1.1rem;}
.order-actions{display:flex;gap:10px;}
.action-btn{
  padding:8px 18px;border-radius:3px;font-family:'Cormorant Garamond',serif;
  font-size:0.82rem;letter-spacing:1px;text-transform:uppercase;cursor:pointer;
  transition:all 0.3s;text-decoration:none;border:1px solid rgba(180,140,100,0.3);
  color:var(--text-mid);background:transparent;display:inline-flex;align-items:center;gap:6px;
}
.action-btn:hover{border-color:var(--brown-accent);color:var(--brown-accent);}
.action-btn.primary{background:var(--brown-accent);color:#fff;border-color:var(--brown-accent);}
.action-btn.primary:hover{background:var(--brown-mid);}

/* TRACKING */
.tracking-bar{display:flex;align-items:center;padding:16px 24px;background:rgba(245,240,232,0.7);border-top:1px solid rgba(180,140,100,0.1);}
.track-step{display:flex;flex-direction:column;align-items:center;flex:1;position:relative;}
.track-step::before{content:'';position:absolute;top:12px;left:50%;right:-50%;height:2px;background:rgba(180,140,100,0.2);z-index:0;}
.track-step:last-child::before{display:none;}
.track-dot{width:26px;height:26px;border-radius:50%;border:2px solid rgba(180,140,100,0.3);display:flex;align-items:center;justify-content:center;background:var(--warm-white);position:relative;z-index:1;font-size:0.7rem;color:var(--text-mid);}
.track-dot.done{background:var(--brown-accent);border-color:var(--brown-accent);color:#fff;}
.track-dot.current{background:var(--warm-white);border-color:var(--gold);color:var(--gold);box-shadow:0 0 0 4px rgba(184,150,110,0.15);}
.track-label{font-size:0.72rem;letter-spacing:0.5px;color:var(--text-mid);margin-top:6px;text-align:center;}

/* EMPTY STATE */
.empty-state{text-align:center;padding:80px 30px;}
.empty-icon{font-size:4rem;color:rgba(155,90,45,0.2);margin-bottom:20px;}
.empty-state h3{font-family:'Playfair Display',serif;font-size:1.8rem;color:var(--brown-dark);margin-bottom:10px;}
.empty-state p{color:var(--text-mid);margin-bottom:25px;}
.btn-shop{display:inline-block;padding:14px 35px;background:var(--brown-accent);color:#fff;text-decoration:none;border-radius:3px;font-family:'Cormorant Garamond',serif;letter-spacing:2px;text-transform:uppercase;transition:all 0.3s;}
.btn-shop:hover{background:var(--brown-mid);transform:translateY(-2px);}

footer{background:var(--brown-dark);color:rgba(255,255,255,0.6);padding:45px 60px 25px;margin-top:60px;}
.footer-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:40px;margin-bottom:35px;}
.footer-brand h3{font-family:'Playfair Display',serif;color:var(--gold);letter-spacing:2px;margin-bottom:10px;}
.footer-col h4{color:var(--gold);letter-spacing:2px;font-size:0.8rem;text-transform:uppercase;margin-bottom:12px;}
.footer-col a{display:block;color:rgba(255,255,255,0.6);text-decoration:none;margin-bottom:8px;font-size:0.9rem;transition:color 0.3s;}
.footer-col a:hover{color:var(--gold);}
.footer-bottom{border-top:1px solid rgba(255,255,255,0.1);padding-top:18px;text-align:center;font-size:0.82rem;}
</style>
</head>
<body>

    <!-- NAVIGATION -->
<?php
include("./shared1/nav.php");
?>


<div class="page-hero">
  <h1>My Orders</h1>
  <p>Track and manage all your book purchases</p>
</div>

<div class="main-container">

  <!-- STATS -->
  <div class="stats-row">
    <div class="stat-card">
      <div class="stat-icon"><i class="fa fa-shopping-bag"></i></div>
      <div class="stat-num">8</div>
      <div class="stat-lbl">Total Orders</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon"><i class="fa fa-check-circle"></i></div>
      <div class="stat-num">6</div>
      <div class="stat-lbl">Delivered</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon"><i class="fa fa-truck"></i></div>
      <div class="stat-num">1</div>
      <div class="stat-lbl">In Transit</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon"><i class="fa fa-dollar"></i></div>
      <div class="stat-num">$142</div>
      <div class="stat-lbl">Total Spent</div>
    </div>
  </div>

  <!-- TOOLBAR -->
  <div class="orders-toolbar">
    <div class="filter-tabs">
      <button class="ftab active" onclick="filterOrders('all',this)">All Orders</button>
      <button class="ftab" onclick="filterOrders('delivered',this)">Delivered</button>
      <button class="ftab" onclick="filterOrders('pending',this)">Pending</button>
      <button class="ftab" onclick="filterOrders('processing',this)">Processing</button>
    </div>
    <div class="search-orders">
      <i class="fa fa-search"></i>
      <input type="text" placeholder="Search orders...">
    </div>
  </div>

  <!-- ORDER CARDS -->
  <?php
  $orders = [
    ['BA-2025-1043','Feb 14, 2025','delivered',[['Twisted Love','Ana Huang','#3d1f0d,#9b5a2d','1','$14.00']],'$15.12',['done','done','done','done']],
    ['BA-2025-1038','Feb 5, 2025','processing',[['Bully','Penelope Douglas','#1a0a05,#5a2a10','2','$42.00'],['Fearless','Lauren Roberts','#0a1a2a,#1e4a7a','1','$26.00']],'$73.44',['done','done','current','']],
    ['BA-2025-1031','Jan 28, 2025','delivered',[['God of Vengeance','Michelle Heard','#1a2a1a,#2d5a2d','1','$15.99']],'$17.27',['done','done','done','done']],
    ['BA-2025-1024','Jan 15, 2025','delivered',[['It Ends With Us','Colleen Hoover','#2a0a2a,#6b2f6b','1','$19.50']],'$21.06',['done','done','done','done']],
    ['BA-2025-1018','Jan 3, 2025','cancelled',[['L\'Ombre D\'Adeline','H.D. Carlton','#2a0a0a,#8b2020','1','$28.00']],'$30.24',['done','','','']],
  ];
  $statusClass = ['delivered'=>'s-delivered','pending'=>'s-pending','processing'=>'s-processing','cancelled'=>'s-cancelled'];
  $trackLabels = ['Order Placed','Confirmed','Shipped','Delivered'];

  foreach($orders as $i=>$o) {
    $sid = $o[2]; $sc = $statusClass[$sid] ?? 's-pending';
    echo "<div class='order-card' data-status='{$sid}'>";
    echo "<div class='order-header'>";
    echo "<div><div class='order-id'>Order #{$o[0]}</div><div class='order-date'><i class='fa fa-calendar-o' style='color:var(--gold);margin-right:5px;'></i>{$o[1]}</div></div>";
    echo "<div class='order-right'><span class='status-badge {$sc}'>".ucfirst($sid)."</span></div>";
    echo "</div>";

    // tracking bar (not for cancelled)
    if($sid !== 'cancelled') {
      echo "<div class='tracking-bar'>";
      foreach($trackLabels as $ti=>$tl) {
        $dc = $o[5][$ti] === 'done' ? 'done' : ($o[5][$ti] === 'current' ? 'current' : '');
        $icon = $dc === 'done' ? '<i class="fa fa-check" style="font-size:0.65rem;"></i>' : ($ti+1);
        echo "<div class='track-step'><div class='track-dot {$dc}'>{$icon}</div><div class='track-label'>{$tl}</div></div>";
      }
      echo "</div>";
    }

    echo "<div class='order-body'><div class='order-items'>";
    foreach($o[3] as $item) {
      echo "
      <div class='order-item'>
        <div class='item-thumb' style='background:linear-gradient(135deg,{$item[2]})'>{$item[0]}</div>
        <div>
          <div class='item-title'>{$item[0]}</div>
          <div class='item-author'>{$item[1]}</div>
          <div class='item-qty'>Qty: {$item[3]}</div>
          <div class='item-price'>{$item[4]}</div>
        </div>
      </div>";
    }
    echo "</div></div>";

    echo "<div class='order-footer'>";
    echo "<div class='order-total'>Total: <span>{$o[4]}</span></div>";
    echo "<div class='order-actions'>";
    if($sid === 'delivered') {
      echo "<a href='download_pdf.php' class='action-btn'><i class='fa fa-download'></i> Invoice</a>";
      echo "<button class='action-btn primary'><i class='fa fa-refresh'></i> Reorder</button>";
    } elseif($sid === 'processing') {
      echo "<button class='action-btn'><i class='fa fa-map-marker'></i> Track</button>";
    } elseif($sid === 'cancelled') {
      echo "<a href='browse_books.php' class='action-btn primary'><i class='fa fa-shopping-cart'></i> Buy Again</a>";
    }
    echo "</div></div></div>";
  }
  ?>

</div>

<footer>
  <div class="footer-grid">
    <div class="footer-brand"><h3>BOOK ADVISOR</h3><p>Curating the finest stories for the modern reader.</p></div>
    <div class="footer-col"><h4>Quick Links</h4><a href="index.php">Home</a><a href="browse_books.php">Shop</a><a href="about.php">About Us</a></div>
    <div class="footer-col"><h4>Connect</h4><p>support@bookadvisor.com</p><p>+1 234 567 890</p></div>
  </div>
  <div class="footer-bottom">© 2025 Book Advisor. All Rights Reserved.</div>
</footer>

<script>
function filterOrders(status, btn) {
  document.querySelectorAll('.ftab').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.order-card').forEach(c=>{
    if(status==='all'||c.dataset.status===status) c.style.display='';
    else c.style.display='none';
  });
}
</script>
</body>
</html>
