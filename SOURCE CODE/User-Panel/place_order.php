<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Place Order - Book Advisor</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/font-awesome.min.css">
<style>
:root{--cream:#f5f0e8;--warm-white:#faf7f2;--brown-dark:#3d1f0d;--brown-mid:#7a3f1e;--brown-accent:#9b5a2d;--gold:#b8966e;--text-dark:#2a1810;--text-mid:#5c3d2e;--shadow:rgba(61,31,13,0.15);}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--cream);font-family:'Cormorant Garamond',serif;color:var(--text-dark);}
nav{background:var(--warm-white);padding:18px 60px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(180,140,100,0.2);box-shadow:0 2px 20px var(--shadow);}
.logo{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-dark);letter-spacing:2px;text-decoration:none;}
.nav-links{display:flex;gap:36px;list-style:none;}
.nav-links a{text-decoration:none;color:var(--text-mid);font-size:0.85rem;letter-spacing:2px;text-transform:uppercase;transition:color 0.3s;}
.nav-links a:hover{color:var(--brown-accent);}

/* STEPS */
.checkout-steps{
  background:var(--warm-white);
  padding:25px 60px;
  display:flex;justify-content:center;gap:0;
  border-bottom:1px solid rgba(180,140,100,0.15);
}
.step{display:flex;align-items:center;gap:10px;color:var(--text-mid);font-size:0.82rem;letter-spacing:1px;text-transform:uppercase;}
.step.active{color:var(--brown-accent);}
.step-num{
  width:32px;height:32px;border-radius:50%;
  border:2px solid rgba(180,140,100,0.3);
  display:flex;align-items:center;justify-content:center;
  font-family:'Playfair Display',serif;font-size:0.9rem;transition:all 0.3s;
}
.step.active .step-num{background:var(--brown-accent);border-color:var(--brown-accent);color:#fff;}
.step.done .step-num{background:var(--gold);border-color:var(--gold);color:#fff;}
.step-line{width:80px;height:1px;background:rgba(180,140,100,0.25);margin:0 15px;}

/* LAYOUT */
.checkout-container{max-width:1100px;margin:50px auto;padding:0 30px;display:grid;grid-template-columns:1fr 400px;gap:35px;}

.card{background:var(--warm-white);border:1px solid rgba(180,140,100,0.15);border-radius:4px;box-shadow:0 4px 25px var(--shadow);animation:fadeUp 0.5s ease both;}
@keyframes fadeUp{from{opacity:0;transform:translateY(25px);}to{opacity:1;transform:translateY(0);}}
.card-header{padding:22px 28px;border-bottom:1px solid rgba(180,140,100,0.12);}
.card-header h2{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-dark);}
.card-body{padding:28px;}

/* FORM */
.form-section{margin-bottom:30px;}
.form-section-title{
  font-size:0.75rem;letter-spacing:3px;text-transform:uppercase;
  color:var(--gold);margin-bottom:20px;
  display:flex;align-items:center;gap:10px;
}
.form-section-title::after{content:'';flex:1;height:1px;background:rgba(180,140,100,0.2);}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.form-group{display:flex;flex-direction:column;gap:7px;}
.form-group.full{grid-column:1/-1;}
.form-group label{font-size:0.75rem;letter-spacing:2px;text-transform:uppercase;color:var(--text-mid);}
.form-group input,.form-group select,.form-group textarea{
  padding:11px 15px;border:1px solid rgba(180,140,100,0.3);border-radius:3px;
  background:var(--cream);font-family:'Cormorant Garamond',serif;font-size:1rem;
  color:var(--text-dark);outline:none;transition:all 0.3s;
}
.form-group input:focus,.form-group select:focus{border-color:var(--brown-accent);background:var(--warm-white);box-shadow:0 0 0 3px rgba(155,90,45,0.1);}

/* PAYMENT OPTIONS */
.payment-options{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:20px;}
.pay-opt{
  border:2px solid rgba(180,140,100,0.25);border-radius:4px;
  padding:15px;cursor:pointer;text-align:center;transition:all 0.3s;
  background:transparent;font-family:'Cormorant Garamond',serif;
}
.pay-opt:hover,.pay-opt.selected{border-color:var(--brown-accent);background:rgba(155,90,45,0.07);}
.pay-opt i{font-size:1.4rem;color:var(--gold);margin-bottom:8px;display:block;}
.pay-opt span{font-size:0.82rem;letter-spacing:1px;color:var(--text-mid);}
.pay-opt.selected span{color:var(--brown-accent);}

/* ORDER SUMMARY */
.order-summary{animation-delay:0.15s;}
.summary-book{display:flex;gap:14px;padding:16px 0;border-bottom:1px solid rgba(180,140,100,0.12);}
.summary-thumb{width:55px;height:75px;border-radius:3px;background:linear-gradient(135deg,var(--brown-dark),var(--brown-accent));flex-shrink:0;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.5);font-size:0.75rem;text-align:center;padding:5px;}
.summary-book-info{flex:1;}
.summary-book-title{font-family:'Playfair Display',serif;font-size:0.95rem;color:var(--brown-dark);}
.summary-book-author{font-size:0.8rem;color:var(--text-mid);margin-top:2px;}
.summary-book-price{font-family:'Playfair Display',serif;color:var(--brown-accent);font-size:1rem;}

.summary-rows{margin-top:20px;}
.summary-row{display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid rgba(180,140,100,0.08);font-size:0.95rem;color:var(--text-mid);}
.summary-row.total{border-bottom:none;margin-top:10px;border-top:2px solid rgba(180,140,100,0.2);padding-top:15px;font-family:'Playfair Display',serif;font-size:1.2rem;color:var(--brown-dark);}
.summary-row .val{color:var(--text-dark);}
.summary-row.total .val{color:var(--brown-accent);font-size:1.3rem;}

/* PROMO CODE */
.promo-row{display:flex;gap:10px;margin:20px 0;}
.promo-input{flex:1;padding:10px 15px;border:1px solid rgba(180,140,100,0.3);border-radius:3px;background:var(--cream);font-family:'Cormorant Garamond',serif;font-size:0.95rem;outline:none;transition:all 0.3s;}
.promo-input:focus{border-color:var(--brown-accent);}
.promo-btn{padding:10px 18px;background:transparent;border:1px solid var(--brown-accent);color:var(--brown-accent);border-radius:3px;cursor:pointer;font-family:'Cormorant Garamond',serif;font-size:0.85rem;letter-spacing:1px;text-transform:uppercase;transition:all 0.3s;}
.promo-btn:hover{background:var(--brown-accent);color:#fff;}

.btn-place{
  width:100%;padding:16px;
  background:var(--brown-accent);color:#fff;border:none;border-radius:3px;
  font-family:'Cormorant Garamond',serif;font-size:1rem;letter-spacing:2px;text-transform:uppercase;
  cursor:pointer;transition:all 0.3s;margin-top:15px;
  display:flex;align-items:center;justify-content:center;gap:10px;
  box-shadow:0 5px 20px rgba(155,90,45,0.35);
}
.btn-place:hover{background:var(--brown-mid);transform:translateY(-2px);box-shadow:0 8px 25px rgba(155,90,45,0.4);}

.security-note{display:flex;align-items:center;justify-content:center;gap:8px;margin-top:15px;color:var(--text-mid);font-size:0.82rem;}

/* SUCCESS OVERLAY */
.success-overlay{
  position:fixed;inset:0;background:rgba(61,31,13,0.7);
  display:none;align-items:center;justify-content:center;z-index:999;
  backdrop-filter:blur(5px);
}
.success-box{
  background:var(--warm-white);padding:50px;border-radius:8px;text-align:center;
  max-width:450px;width:90%;animation:popIn 0.5s cubic-bezier(0.34,1.56,0.64,1);
}
@keyframes popIn{from{opacity:0;transform:scale(0.8);}to{opacity:1;transform:scale(1);}}
.success-icon{width:80px;height:80px;border-radius:50%;background:rgba(155,90,45,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:2rem;color:var(--brown-accent);}
.success-box h2{font-family:'Playfair Display',serif;font-size:2rem;color:var(--brown-dark);margin-bottom:10px;}
.success-box p{color:var(--text-mid);line-height:1.7;margin-bottom:25px;}
.btn-go{display:inline-block;padding:12px 30px;background:var(--brown-accent);color:#fff;text-decoration:none;border-radius:3px;font-family:'Cormorant Garamond',serif;font-size:0.85rem;letter-spacing:2px;text-transform:uppercase;transition:all 0.3s;}
.btn-go:hover{background:var(--brown-mid);}

footer{background:var(--brown-dark);color:rgba(255,255,255,0.6);padding:40px 60px 25px;margin-top:60px;}
.footer-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:40px;margin-bottom:30px;}
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


<!-- STEPS -->
<div class="checkout-steps">
  <div class="step done">
    <div class="step-num"><i class="fa fa-check" style="font-size:0.7rem;"></i></div>
    <span>Cart</span>
  </div>
  <div class="step-line"></div>
  <div class="step active">
    <div class="step-num">2</div>
    <span>Checkout</span>
  </div>
  <div class="step-line"></div>
  <div class="step">
    <div class="step-num">3</div>
    <span>Confirmation</span>
  </div>
</div>

<div class="checkout-container">
  <!-- FORM SIDE -->
  <div class="card">
    <div class="card-header"><h2>Checkout Details</h2></div>
    <div class="card-body">
      <form id="orderForm">
        <!-- Shipping -->
        <div class="form-section">
          <div class="form-section-title"><i class="fa fa-map-marker"></i> Shipping Address</div>
          <div class="form-grid">
            <div class="form-group"><label>First Name</label><input type="text" required placeholder="Ahmad"></div>
            <div class="form-group"><label>Last Name</label><input type="text" required placeholder="Khan"></div>
            <div class="form-group full"><label>Street Address</label><input type="text" required placeholder="House 12, Street 5, Block A"></div>
            <div class="form-group"><label>City</label><input type="text" required placeholder="Karachi"></div>
            <div class="form-group"><label>Postal Code</label><input type="text" required placeholder="75000"></div>
            <div class="form-group"><label>Country</label>
              <select>
                <option>Pakistan</option><option>India</option><option>USA</option><option>UK</option>
              </select>
            </div>
            <div class="form-group"><label>Phone</label><input type="tel" placeholder="+92 300 0000000"></div>
          </div>
        </div>

        <!-- Delivery -->
        <div class="form-section">
          <div class="form-section-title"><i class="fa fa-truck"></i> Delivery Method</div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
            <label style="border:2px solid var(--brown-accent);border-radius:4px;padding:16px;cursor:pointer;display:flex;gap:12px;align-items:center;background:rgba(155,90,45,0.06);">
              <input type="radio" name="delivery" value="standard" checked style="accent-color:var(--brown-accent);">
              <div><div style="font-family:'Playfair Display',serif;color:var(--brown-dark);">Standard</div><div style="font-size:0.82rem;color:var(--text-mid);">3-5 days · Free</div></div>
            </label>
            <label style="border:1px solid rgba(180,140,100,0.3);border-radius:4px;padding:16px;cursor:pointer;display:flex;gap:12px;align-items:center;">
              <input type="radio" name="delivery" value="express" style="accent-color:var(--brown-accent);">
              <div><div style="font-family:'Playfair Display',serif;color:var(--brown-dark);">Express</div><div style="font-size:0.82rem;color:var(--text-mid);">1-2 days · $9.99</div></div>
            </label>
          </div>
        </div>

        <!-- Payment -->
        <div class="form-section">
          <div class="form-section-title"><i class="fa fa-credit-card"></i> Payment Method</div>
          <div class="payment-options">
            <button type="button" class="pay-opt selected" onclick="selectPay(this)"><i class="fa fa-credit-card"></i><span>Credit Card</span></button>
            <button type="button" class="pay-opt" onclick="selectPay(this)"><i class="fa fa-university"></i><span>Bank Transfer</span></button>
            <button type="button" class="pay-opt" onclick="selectPay(this)"><i class="fa fa-money"></i><span>Cash on Delivery</span></button>
          </div>
          <div id="card-fields" class="form-grid">
            <div class="form-group full"><label>Card Number</label><input type="text" placeholder="1234 5678 9012 3456" maxlength="19" oninput="formatCard(this)"></div>
            <div class="form-group"><label>Expiry Date</label><input type="text" placeholder="MM / YY" maxlength="7"></div>
            <div class="form-group"><label>CVV</label><input type="text" placeholder="123" maxlength="3"></div>
            <div class="form-group full"><label>Cardholder Name</label><input type="text" placeholder="Ahmad Khan"></div>
          </div>
        </div>

        <button type="button" class="btn-place" onclick="placeOrder()">
          <i class="fa fa-lock"></i> Place Order Securely
        </button>
        <div class="security-note"><i class="fa fa-shield"></i> 256-bit SSL Encrypted · Secure Checkout</div>
      </form>
    </div>
  </div>

  <!-- ORDER SUMMARY -->
  <div class="card order-summary">
    <div class="card-header"><h2>Order Summary</h2></div>
    <div class="card-body">
      <div class="summary-book">
        <div class="summary-thumb">Twisted Love</div>
        <div class="summary-book-info">
          <div class="summary-book-title">Twisted Love</div>
          <div class="summary-book-author">Ana Huang</div>
          <div style="font-size:0.78rem;color:var(--text-mid);margin-top:4px;">Qty: 1</div>
        </div>
        <div class="summary-book-price">$14.00</div>
      </div>

      <div class="promo-row">
        <input class="promo-input" type="text" placeholder="Promo code">
        <button class="promo-btn">Apply</button>
      </div>

      <div class="summary-rows">
        <div class="summary-row"><span>Subtotal</span><span class="val">$14.00</span></div>
        <div class="summary-row"><span>Delivery</span><span class="val">Free</span></div>
        <div class="summary-row"><span>Tax (8%)</span><span class="val">$1.12</span></div>
        <div class="summary-row total"><span>Total</span><span class="val">$15.12</span></div>
      </div>

      <div style="margin-top:25px;padding:16px;background:rgba(155,90,45,0.06);border:1px solid rgba(155,90,45,0.15);border-radius:3px;">
        <div style="display:flex;gap:10px;font-size:0.9rem;color:var(--text-mid);margin-bottom:8px;">
          <i class="fa fa-truck" style="color:var(--gold);"></i>
          <span>Estimated delivery: <strong style="color:var(--brown-dark);">Feb 23 – 25, 2025</strong></span>
        </div>
        <div style="display:flex;gap:10px;font-size:0.9rem;color:var(--text-mid);">
          <i class="fa fa-refresh" style="color:var(--gold);"></i>
          <span>30-day hassle-free returns</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SUCCESS OVERLAY -->
<div class="success-overlay" id="successOverlay">
  <div class="success-box">
    <div class="success-icon"><i class="fa fa-check"></i></div>
    <h2>Order Placed!</h2>
    <p>Thank you for your purchase. Your book is on its way. You'll receive a confirmation email shortly.</p>
    <div style="background:var(--cream);padding:15px;border-radius:4px;margin-bottom:25px;font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--brown-dark);">Order #<span style="color:var(--brown-accent);">BA-2025-1043</span></div>
    <a href="my_orders.php" class="btn-go">Track My Order</a>
  </div>
</div>

<footer>
  <div class="footer-grid">
    <div class="footer-brand"><h3>BOOK ADVISOR</h3><p>Curating the finest stories for the modern reader.</p></div>
    <div class="footer-col"><h4>Quick Links</h4><a href="#">Home</a><a href="#">Shop</a><a href="#">About</a></div>
    <div class="footer-col"><h4>Connect</h4><p>support@bookadvisor.com</p><p>+1 234 567 890</p></div>
  </div>
  <div class="footer-bottom">© 2025 Book Advisor. All Rights Reserved.</div>
</footer>

<script>
function selectPay(el){document.querySelectorAll('.pay-opt').forEach(b=>b.classList.remove('selected'));el.classList.add('selected');}
function formatCard(i){let v=i.value.replace(/\D/g,'').match(/.{1,4}/g);i.value=v?v.join(' '):'';}
function placeOrder(){
  document.getElementById('successOverlay').style.display='flex';
}
document.getElementById('successOverlay').addEventListener('click',function(e){if(e.target===this)this.style.display='none';});
</script>
</body>
</html>
