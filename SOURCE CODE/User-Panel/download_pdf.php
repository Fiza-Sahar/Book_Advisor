<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Downloads - Book Advisor</title>
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
.page-hero::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M20 20.5V18H0v5h20v-2.5zM0 25h20v5H0z'/%3E%3C/g%3E%3C/svg%3E");}
.page-hero h1{font-family:'Playfair Display',serif;color:#fff;font-size:2.6rem;position:relative;}
.page-hero p{color:rgba(255,255,255,0.65);margin-top:8px;position:relative;}

.container{max-width:1000px;margin:50px auto;padding:0 30px;}

/* TABS */
.dl-tabs{display:flex;gap:0;border-bottom:2px solid rgba(180,140,100,0.2);margin-bottom:35px;}
.dl-tab{
  padding:13px 30px;background:transparent;border:none;
  font-family:'Cormorant Garamond',serif;font-size:1rem;letter-spacing:1px;
  color:var(--text-mid);cursor:pointer;border-bottom:2px solid transparent;
  margin-bottom:-2px;transition:all 0.3s;
}
.dl-tab.active,.dl-tab:hover{color:var(--brown-accent);border-bottom-color:var(--brown-accent);}

/* DOWNLOAD CARD */
.download-card{
  background:var(--warm-white);border:1px solid rgba(180,140,100,0.15);
  border-radius:4px;overflow:hidden;margin-bottom:18px;
  display:flex;align-items:stretch;
  box-shadow:0 3px 18px var(--shadow);
  transition:all 0.35s;
  opacity:0;animation:slideIn 0.5s ease forwards;
}
.download-card:hover{transform:translateX(5px);box-shadow:0 6px 30px rgba(61,31,13,0.2);}
@keyframes slideIn{from{opacity:0;transform:translateX(-25px);}to{opacity:1;transform:translateX(0);}}
.download-card:nth-child(1){animation-delay:0.05s;}
.download-card:nth-child(2){animation-delay:0.12s;}
.download-card:nth-child(3){animation-delay:0.19s;}
.download-card:nth-child(4){animation-delay:0.26s;}
.download-card:nth-child(5){animation-delay:0.33s;}

.dl-thumb{
  width:80px;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
  color:rgba(255,255,255,0.7);font-size:0.75rem;text-align:center;padding:10px;
  font-family:'Playfair Display',serif;line-height:1.3;
}
.dl-info{flex:1;padding:18px 22px;}
.dl-title{font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--brown-dark);margin-bottom:4px;}
.dl-author{font-size:0.82rem;color:var(--text-mid);letter-spacing:0.5px;}
.dl-meta{display:flex;gap:18px;margin-top:10px;}
.dl-meta-item{display:flex;align-items:center;gap:6px;font-size:0.78rem;color:var(--text-mid);}
.dl-meta-item i{color:var(--gold);}

.dl-right{
  padding:18px 22px;display:flex;flex-direction:column;justify-content:center;
  align-items:flex-end;gap:10px;border-left:1px solid rgba(180,140,100,0.12);
  min-width:160px;
}
.dl-size{font-size:0.8rem;color:var(--text-mid);}
.dl-btn{
  padding:9px 20px;background:var(--brown-accent);color:#fff;border:none;
  border-radius:3px;cursor:pointer;font-family:'Cormorant Garamond',serif;
  font-size:0.82rem;letter-spacing:1px;text-transform:uppercase;
  display:flex;align-items:center;gap:7px;transition:all 0.3s;
}
.dl-btn:hover{background:var(--brown-mid);}
.dl-btn.invoice{background:transparent;color:var(--brown-accent);border:1px solid var(--brown-accent);}
.dl-btn.invoice:hover{background:var(--brown-accent);color:#fff;}

/* PROGRESS BAR */
.dl-progress{position:relative;}
.progress-bar{
  height:4px;background:rgba(180,140,100,0.2);border-radius:2px;margin-top:8px;overflow:hidden;
  display:none;
}
.progress-fill{height:100%;background:var(--brown-accent);border-radius:2px;width:0;transition:width 0.05s linear;}

/* INVOICE SECTION */
.invoice-preview{
  background:var(--warm-white);border:1px solid rgba(180,140,100,0.2);
  border-radius:4px;padding:40px;box-shadow:0 4px 25px var(--shadow);
  animation:fadeUp 0.5s ease;max-width:750px;margin:0 auto;
}
@keyframes fadeUp{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
.inv-header{display:flex;justify-content:space-between;margin-bottom:30px;padding-bottom:25px;border-bottom:2px solid rgba(180,140,100,0.2);}
.inv-logo{font-family:'Playfair Display',serif;font-size:1.5rem;color:var(--brown-dark);letter-spacing:2px;}
.inv-badge{background:rgba(155,90,45,0.1);color:var(--brown-accent);padding:6px 18px;border-radius:3px;font-size:0.85rem;letter-spacing:1px;text-transform:uppercase;}
.inv-meta{display:grid;grid-template-columns:1fr 1fr;gap:25px;margin-bottom:30px;}
.inv-block h4{font-size:0.72rem;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:8px;}
.inv-block p{font-size:0.95rem;color:var(--text-mid);line-height:1.6;}
table.inv-table{width:100%;border-collapse:collapse;margin:20px 0;}
table.inv-table th{text-align:left;padding:10px 12px;font-size:0.72rem;letter-spacing:2px;text-transform:uppercase;color:var(--text-mid);background:var(--cream);border-bottom:1px solid rgba(180,140,100,0.15);}
table.inv-table td{padding:14px 12px;border-bottom:1px solid rgba(180,140,100,0.08);font-size:0.95rem;}
.inv-total-row{background:rgba(155,90,45,0.05);}
.inv-total-row td{font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--brown-accent);}
.inv-actions{display:flex;gap:12px;margin-top:25px;}
.btn{padding:12px 28px;border-radius:3px;font-family:'Cormorant Garamond',serif;font-size:0.85rem;letter-spacing:2px;text-transform:uppercase;cursor:pointer;transition:all 0.3s;display:inline-flex;align-items:center;gap:8px;border:none;}
.btn-primary{background:var(--brown-accent);color:#fff;box-shadow:0 4px 15px rgba(155,90,45,0.3);}
.btn-primary:hover{background:var(--brown-mid);}
.btn-outline{background:transparent;color:var(--brown-accent);border:1px solid var(--brown-accent);}
.btn-outline:hover{background:var(--brown-accent);color:#fff;}

.tab-panel{display:none;}
.tab-panel.active{display:block;}

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

<nav>
  <a href="index.php" class="logo">BOOK ADVISOR</a>
  <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="browse_books.php">Shop</a></li>
    <li><a href="about.php">About</a></li>
    <li><a href="contact.php">Contact</a></li>
  </ul>
  <a href="profile.php" style="color:var(--text-mid);text-decoration:none;font-size:0.82rem;letter-spacing:1px;text-transform:uppercase;"><i class="fa fa-user"></i> Account</a>
</nav>

<div class="page-hero">
  <h1>My Downloads</h1>
  <p>Access your digital books & invoices</p>
</div>

<div class="container">
  <div class="dl-tabs">
    <button class="dl-tab active" onclick="openTab('ebooks',this)">E-Books</button>
    <button class="dl-tab" onclick="openTab('invoices',this)">Invoices & Receipts</button>
  </div>

  <!-- E-BOOKS TAB -->
  <div class="tab-panel active" id="ebooks">
    <?php
    $ebooks = [
      ['Twisted Love','Ana Huang','#3d1f0d,#9b5a2d','Feb 14, 2025','PDF','8.4 MB','Romance'],
      ['Bully','Penelope Douglas','#1a0a05,#5a2a10','Feb 5, 2025','EPUB','5.2 MB','Romance'],
      ['God of Vengeance','Michelle Heard','#1a2a1a,#2d5a2d','Jan 28, 2025','PDF','6.8 MB','Fantasy'],
      ['It Ends With Us','Colleen Hoover','#2a0a2a,#6b2f6b','Jan 15, 2025','PDF','7.1 MB','Romance'],
    ];
    foreach($ebooks as $i=>$b) {
      echo "
      <div class='download-card'>
        <div class='dl-thumb' style='background:linear-gradient(135deg,{$b[2]})'>{$b[0]}</div>
        <div class='dl-info'>
          <div class='dl-title'>{$b[0]}</div>
          <div class='dl-author'>{$b[1]}</div>
          <div class='dl-meta'>
            <div class='dl-meta-item'><i class='fa fa-tag'></i>{$b[6]}</div>
            <div class='dl-meta-item'><i class='fa fa-calendar'></i>Purchased: {$b[3]}</div>
            <div class='dl-meta-item'><i class='fa fa-file-pdf-o'></i>{$b[4]}</div>
          </div>
        </div>
        <div class='dl-right'>
          <span class='dl-size'><i class='fa fa-hdd-o'></i> {$b[5]}</span>
          <button class='dl-btn' onclick='startDownload(this,\"{$b[0]}\")'><i class='fa fa-download'></i> Download</button>
          <div class='progress-bar' id='pb{$i}'><div class='progress-fill'></div></div>
        </div>
      </div>";
    }
    ?>
  </div>

  <!-- INVOICES TAB -->
  <div class="tab-panel" id="invoices">
    <?php
    $invoices = [
      ['BA-2025-1043','Feb 14, 2025','$15.12','Paid'],
      ['BA-2025-1031','Jan 28, 2025','$17.27','Paid'],
      ['BA-2025-1024','Jan 15, 2025','$21.06','Paid'],
    ];
    foreach($invoices as $i=>$inv) {
      echo "
      <div class='download-card'>
        <div class='dl-thumb' style='background:linear-gradient(135deg,#3d1f0d,#7a3f1e);font-size:1.5rem;'><i class='fa fa-file-text-o'></i></div>
        <div class='dl-info'>
          <div class='dl-title'>Invoice #{$inv[0]}</div>
          <div class='dl-author'>{$inv[1]}</div>
          <div class='dl-meta'>
            <div class='dl-meta-item'><i class='fa fa-dollar'></i>{$inv[2]}</div>
            <div class='dl-meta-item'><i class='fa fa-check-circle'></i>{$inv[3]}</div>
          </div>
        </div>
        <div class='dl-right'>
          <button class='dl-btn invoice' onclick='showInvoice()'><i class='fa fa-eye'></i> View</button>
          <button class='dl-btn' onclick='startDownload(this,\"Invoice\")'><i class='fa fa-download'></i> PDF</button>
        </div>
      </div>";
    }
    ?>

    <!-- INVOICE PREVIEW -->
    <div id="invoicePreview" style="display:none;margin-top:30px;">
      <div class="invoice-preview">
        <div class="inv-header">
          <div>
            <div class="inv-logo">BOOK ADVISOR</div>
            <div style="font-size:0.82rem;color:var(--text-mid);margin-top:4px;">Curating the finest stories</div>
          </div>
          <div style="text-align:right;">
            <div class="inv-badge">Invoice</div>
            <div style="font-family:'Playfair Display',serif;font-size:1.2rem;color:var(--brown-accent);margin-top:8px;">#BA-2025-1043</div>
            <div style="font-size:0.82rem;color:var(--text-mid);">Feb 14, 2025</div>
          </div>
        </div>
        <div class="inv-meta">
          <div class="inv-block">
            <h4>Billed To</h4>
            <p>Ahmad Khan<br>House 12, Street 5<br>Karachi, Pakistan<br>ahmad@example.com</p>
          </div>
          <div class="inv-block">
            <h4>From</h4>
            <p>Book Advisor<br>support@bookadvisor.com<br>+1 234 567 890</p>
          </div>
        </div>
        <table class="inv-table">
          <tr><th>Item</th><th>Qty</th><th>Price</th><th>Total</th></tr>
          <tr><td>Twisted Love — Ana Huang</td><td>1</td><td>$14.00</td><td>$14.00</td></tr>
          <tr><td style="color:var(--text-mid)">Tax (8%)</td><td>—</td><td>—</td><td>$1.12</td></tr>
          <tr class="inv-total-row"><td colspan="3" style="font-family:'Playfair Display',serif;font-size:1rem;color:var(--brown-dark);">Total</td><td>$15.12</td></tr>
        </table>
        <div style="padding:16px;background:rgba(155,90,45,0.06);border-radius:3px;font-size:0.85rem;color:var(--text-mid);">
          <i class="fa fa-check-circle" style="color:#4caf50;margin-right:6px;"></i> Payment received on Feb 14, 2025 via Credit Card ending in ****3456
        </div>
        <div class="inv-actions">
          <button class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
          <button class="btn btn-outline"><i class="fa fa-download"></i> Download PDF</button>
          <button class="btn" style="border:1px solid rgba(180,140,100,0.3);color:var(--text-mid);background:transparent;" onclick="document.getElementById('invoicePreview').style.display='none'"><i class="fa fa-times"></i> Close</button>
        </div>
      </div>
    </div>
  </div>
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
function openTab(id,btn){
  document.querySelectorAll('.tab-panel').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.dl-tab').forEach(b=>b.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  btn.classList.add('active');
}
function startDownload(btn, name) {
  btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Downloading...';
  btn.style.opacity = '0.8';
  const card = btn.closest('.download-card');
  const pb = card.querySelector('.progress-bar');
  const fill = card.querySelector('.progress-fill');
  if(pb) { pb.style.display='block'; let w=0; const t=setInterval(()=>{w+=Math.random()*15;fill.style.width=Math.min(w,100)+'%';if(w>=100){clearInterval(t);setTimeout(()=>{pb.style.display='none';fill.style.width='0';btn.innerHTML='<i class="fa fa-check"></i> Downloaded';btn.style.background='#4caf50';btn.style.opacity='1';setTimeout(()=>{btn.innerHTML='<i class="fa fa-download"></i> Download';btn.style.background='';},3000);},300);}},80); }
  else { setTimeout(()=>{btn.innerHTML='<i class="fa fa-check"></i> Downloaded';btn.style.background='#4caf50';setTimeout(()=>{btn.innerHTML='<i class="fa fa-download"></i> PDF';btn.style.background='';},3000);},2000); }
}
function showInvoice(){
  const p=document.getElementById('invoicePreview');
  p.style.display=p.style.display==='none'?'block':'none';
  if(p.style.display==='block')p.scrollIntoView({behavior:'smooth',block:'center'});
}
</script>
</body>
</html>
