<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Details - Book Advisor</title>
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

/* BREADCRUMB */
.breadcrumb{padding:20px 60px;font-size:0.85rem;color:var(--text-mid);}
.breadcrumb a{color:var(--brown-accent);text-decoration:none;}
.breadcrumb span{margin:0 8px;}

/* MAIN BOOK SECTION */
.book-main{
  max-width:1100px;margin:0 auto;padding:20px 30px 60px;
  display:grid;grid-template-columns:350px 1fr;gap:60px;
  animation:fadeUp 0.7s ease;
}
@keyframes fadeUp{from{opacity:0;transform:translateY(30px);}to{opacity:1;transform:translateY(0);}}

/* BOOK VISUAL */
.book-visual{position:sticky;top:90px;height:fit-content;}
.book-3d-wrap{
  perspective:1000px;
  margin-bottom:25px;
}
.book-3d{
  width:280px;
  height:380px;
  position:relative;
  transform-style:preserve-3d;
  transform:rotateY(-15deg);
  transition:transform 0.6s ease;
  margin:0 auto;
}
.book-3d:hover{transform:rotateY(5deg);}
.book-front{
  position:absolute;inset:0;
  background:linear-gradient(135deg,#3d1f0d 0%,#7a3f1e 50%,#9b5a2d 100%);
  border-radius:4px 8px 8px 4px;
  display:flex;align-items:center;justify-content:center;
  box-shadow:8px 8px 30px rgba(0,0,0,0.4);
  padding:30px;text-align:center;
}
.book-spine{
  position:absolute;left:-20px;top:0;bottom:0;width:20px;
  background:linear-gradient(to right,#1a0a05,#3d1f0d);
  border-radius:4px 0 0 4px;
  transform:rotateY(-90deg);transform-origin:right;
}
.book-title-cover{font-family:'Playfair Display',serif;color:#fff;font-size:1.5rem;line-height:1.3;text-shadow:0 2px 10px rgba(0,0,0,0.5);}
.book-author-cover{color:rgba(255,255,255,0.6);font-size:0.85rem;margin-top:15px;letter-spacing:1px;}

.action-buttons{display:flex;flex-direction:column;gap:12px;}
.btn{
  padding:14px 25px;border:none;cursor:pointer;
  font-family:'Cormorant Garamond',serif;font-size:0.9rem;letter-spacing:2px;text-transform:uppercase;
  border-radius:3px;transition:all 0.3s;width:100%;
  display:flex;align-items:center;justify-content:center;gap:10px;
}
.btn-primary{background:var(--brown-accent);color:#fff;box-shadow:0 4px 15px rgba(155,90,45,0.3);}
.btn-primary:hover{background:var(--brown-mid);transform:translateY(-2px);}
.btn-outline{background:transparent;color:var(--brown-accent);border:1px solid var(--brown-accent);}
.btn-outline:hover{background:var(--brown-accent);color:#fff;}

/* BOOK INFO */
.book-info{padding-top:10px;}
.genre-badge{
  display:inline-block;padding:5px 18px;
  background:rgba(155,90,45,0.12);color:var(--brown-accent);
  border:1px solid rgba(155,90,45,0.3);border-radius:30px;
  font-size:0.78rem;letter-spacing:2px;text-transform:uppercase;
  margin-bottom:20px;
}
.book-title-main{
  font-family:'Playfair Display',serif;font-size:3rem;color:var(--brown-dark);
  line-height:1.1;margin-bottom:8px;
}
.book-author-main{font-size:1.2rem;color:var(--text-mid);letter-spacing:1px;margin-bottom:20px;}

.rating-row{display:flex;align-items:center;gap:12px;margin-bottom:25px;}
.stars{color:var(--gold);font-size:1.1rem;}
.rating-num{font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--brown-dark);}
.rating-count{color:var(--text-mid);font-size:0.9rem;}

.price-main{font-family:'Playfair Display',serif;font-size:2.5rem;color:var(--brown-accent);margin-bottom:25px;}

.book-meta-grid{
  display:grid;grid-template-columns:repeat(3,1fr);gap:15px;
  margin-bottom:30px;
}
.meta-item{
  background:var(--warm-white);padding:15px;
  border:1px solid rgba(180,140,100,0.15);border-radius:3px;
  text-align:center;
}
.meta-label{font-size:0.72rem;letter-spacing:2px;text-transform:uppercase;color:var(--text-mid);margin-bottom:5px;}
.meta-val{font-family:'Playfair Display',serif;color:var(--brown-dark);}

.divider{height:1px;background:rgba(180,140,100,0.2);margin:25px 0;}

.synopsis-title{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-dark);margin-bottom:15px;}
.synopsis{font-size:1.05rem;line-height:1.9;color:var(--text-mid);}

/* QTY */
.qty-row{display:flex;align-items:center;gap:15px;margin-bottom:20px;}
.qty-label{font-size:0.8rem;letter-spacing:2px;text-transform:uppercase;color:var(--text-mid);}
.qty-control{display:flex;align-items:center;gap:0;border:1px solid rgba(180,140,100,0.3);border-radius:3px;overflow:hidden;}
.qty-btn{width:38px;height:38px;background:var(--cream);border:none;cursor:pointer;font-size:1.1rem;color:var(--brown-accent);transition:all 0.2s;}
.qty-btn:hover{background:var(--brown-accent);color:#fff;}
.qty-input{width:50px;height:38px;text-align:center;border:none;border-left:1px solid rgba(180,140,100,0.3);border-right:1px solid rgba(180,140,100,0.3);background:var(--warm-white);font-family:'Cormorant Garamond',serif;font-size:1.1rem;color:var(--text-dark);}

/* TABS */
.tabs{display:flex;gap:0;border-bottom:2px solid rgba(180,140,100,0.2);margin:40px 0 25px;max-width:1100px;margin-left:auto;margin-right:auto;padding:0 30px;}
.tab-btn{
  padding:14px 30px;background:transparent;border:none;
  font-family:'Cormorant Garamond',serif;font-size:1rem;letter-spacing:1px;
  color:var(--text-mid);cursor:pointer;border-bottom:2px solid transparent;
  margin-bottom:-2px;transition:all 0.3s;
}
.tab-btn.active,.tab-btn:hover{color:var(--brown-accent);border-bottom-color:var(--brown-accent);}

.tab-content{max-width:1100px;margin:0 auto;padding:0 30px 60px;}
.tab-panel{display:none;}
.tab-panel.active{display:block;animation:fadeUp 0.4s ease;}

/* REVIEWS */
.review-card{
  background:var(--warm-white);padding:25px;
  border:1px solid rgba(180,140,100,0.15);border-radius:4px;
  margin-bottom:20px;
}
.review-header{display:flex;justify-content:space-between;margin-bottom:12px;align-items:center;}
.reviewer{font-family:'Playfair Display',serif;color:var(--brown-dark);}
.review-date{font-size:0.82rem;color:var(--text-mid);}
.review-text{font-size:1rem;line-height:1.8;color:var(--text-mid);}

footer{background:var(--brown-dark);color:rgba(255,255,255,0.6);padding:50px 60px 30px;}
.footer-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:40px;margin-bottom:40px;}
.footer-brand h3{font-family:'Playfair Display',serif;color:var(--gold);letter-spacing:2px;margin-bottom:12px;}
.footer-col h4{color:var(--gold);letter-spacing:2px;font-size:0.8rem;text-transform:uppercase;margin-bottom:15px;}
.footer-col a{display:block;color:rgba(255,255,255,0.6);text-decoration:none;margin-bottom:10px;font-size:0.9rem;transition:color 0.3s;}
.footer-col a:hover{color:var(--gold);}
.social-icons{display:flex;gap:14px;margin-top:15px;}
.social-icons a{width:36px;height:36px;border-radius:50%;border:1px solid rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.6);text-decoration:none;transition:all 0.3s;}
.social-icons a:hover{border-color:var(--gold);color:var(--gold);}
.footer-bottom{border-top:1px solid rgba(255,255,255,0.1);padding-top:20px;text-align:center;font-size:0.82rem;}

/* RELATED */
.related-section{max-width:1100px;margin:0 auto;padding:0 30px 60px;}
.section-heading{font-family:'Playfair Display',serif;font-size:1.8rem;color:var(--brown-dark);margin-bottom:30px;}
.related-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
.related-card{background:var(--warm-white);border:1px solid rgba(180,140,100,0.12);border-radius:3px;overflow:hidden;transition:all 0.3s;cursor:pointer;}
.related-card:hover{transform:translateY(-5px);box-shadow:0 10px 30px var(--shadow);}
.related-cover{height:180px;display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;color:rgba(255,255,255,0.8);font-size:0.95rem;text-align:center;padding:15px;}
.related-info{padding:12px;}
.related-title{font-family:'Playfair Display',serif;font-size:0.95rem;color:var(--brown-dark);}
.related-price{color:var(--brown-accent);font-size:0.9rem;margin-top:5px;}
</style>
</head>
<body>

    <!-- NAVIGATION -->
<?php
include("./shared1/nav.php");
?>


<div class="breadcrumb">
  <a href="index.php">Home</a><span>›</span>
  <a href="browse_books.php">Shop</a><span>›</span>
  <span>Twisted Love</span>
</div>

<div class="book-main">
  <!-- LEFT: BOOK VISUAL -->
  <div class="book-visual">
    <div class="book-3d-wrap">
      <div class="book-3d">
        <div class="book-spine"></div>
        <div class="book-front">
          <div>
            <div class="book-title-cover">Twisted Love</div>
            <div style="color:rgba(255,255,255,0.3);margin:15px 0;font-size:1.5rem;">—</div>
            <div class="book-author-cover">Ana Huang</div>
          </div>
        </div>
      </div>
    </div>
    <div class="action-buttons">
      <a href="place_order.php?id=1" class="btn btn-primary"><i class="fa fa-shopping-bag"></i> Buy Now</a>
      <button class="btn btn-outline" onclick="addToCart()"><i class="fa fa-cart-plus"></i> Add to Cart</button>
      <button class="btn" style="background:transparent;color:var(--text-mid);border:1px solid rgba(180,140,100,0.3);" onclick="toggleWish(this)">
        <i class="fa fa-heart-o"></i> Add to Wishlist
      </button>
    </div>
  </div>

  <!-- RIGHT: BOOK INFO -->
  <div class="book-info">
    <span class="genre-badge">Romance · Contemporary</span>
    <h1 class="book-title-main">Twisted Love</h1>
    <div class="book-author-main">by Ana Huang</div>

    <div class="rating-row">
      <div class="stars">
        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>
      </div>
      <span class="rating-num">4.5</span>
      <span class="rating-count">(2,847 reviews)</span>
    </div>

    <div class="price-main">$14.00</div>

    <div class="book-meta-grid">
      <div class="meta-item">
        <div class="meta-label">Publisher</div>
        <div class="meta-val">Bloom Books</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Pages</div>
        <div class="meta-val">384</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Language</div>
        <div class="meta-val">English</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">ISBN</div>
        <div class="meta-val">978-1-72824</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Published</div>
        <div class="meta-val">Mar 2022</div>
      </div>
      <div class="meta-item">
        <div class="meta-label">Format</div>
        <div class="meta-val">Paperback</div>
      </div>
    </div>

    <div class="divider"></div>

    <h3 class="synopsis-title">Synopsis</h3>
    <p class="synopsis">
      He's everything you've been warned about. Brilliant. Cold. Dangerous. Alex Volkov is a devil dressed in Armani, and I've sold my soul to the devil when I asked for his help. All I need is for him to act as my fake boyfriend for one summer. He needs me to tutor his sister. It's a fair exchange... until it's not. Until I start believing his smiles aren't calculated and his touches aren't schemes. Until it's too late to remember that every devil was once an angel, and every angel is capable of betrayal.
    </p>

    <div class="divider"></div>

    <div class="qty-row">
      <span class="qty-label">Quantity:</span>
      <div class="qty-control">
        <button class="qty-btn" onclick="changeQty(-1)">−</button>
        <input class="qty-input" type="number" value="1" min="1" id="qty">
        <button class="qty-btn" onclick="changeQty(1)">+</button>
      </div>
      <span style="color:var(--text-mid);font-size:0.85rem;"><i class="fa fa-check-circle" style="color:#4caf50;"></i> In Stock</span>
    </div>
  </div>
</div>

<!-- TABS -->
<div class="tabs">
  <button class="tab-btn active" onclick="openTab('reviews',this)">Reviews</button>
  <button class="tab-btn" onclick="openTab('details',this)">Book Details</button>
  <button class="tab-btn" onclick="openTab('shipping',this)">Shipping Info</button>
</div>

<div class="tab-content">
  <div class="tab-panel active" id="reviews">
    <div class="review-card">
      <div class="review-header">
        <span class="reviewer">Sarah M.</span>
        <div>
          <span style="color:var(--gold);">★★★★★</span>
          <span class="review-date" style="margin-left:10px;">Feb 2025</span>
        </div>
      </div>
      <p class="review-text">Absolutely captivating from start to finish. Alex Volkov is the kind of book boyfriend that stays with you long after the last page. Ana Huang has crafted something truly special here.</p>
    </div>
    <div class="review-card">
      <div class="review-header">
        <span class="reviewer">Leila K.</span>
        <div>
          <span style="color:var(--gold);">★★★★☆</span>
          <span class="review-date" style="margin-left:10px;">Jan 2025</span>
        </div>
      </div>
      <p class="review-text">The chemistry between the characters is undeniable. A few slow moments in the middle but the ending makes it all worth it. Highly recommend for romance lovers.</p>
    </div>
  </div>

  <div class="tab-panel" id="details">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;">
      <div>
        <h4 style="font-family:'Playfair Display',serif;margin-bottom:15px;color:var(--brown-dark);">Publication Details</h4>
        <table style="width:100%;border-collapse:collapse;">
          <?php
          $details = [['Publisher','Bloom Books'],['ISBN','978-1-72824-572-3'],['Pages','384'],['Language','English'],['Published','March 15, 2022'],['Edition','First Edition'],['Weight','0.4 kg'],['Dimensions','13 × 2.5 × 20.3 cm']];
          foreach($details as $d) echo "<tr style='border-bottom:1px solid rgba(180,140,100,0.1)'><td style='padding:12px 0;color:var(--text-mid);font-size:0.85rem;letter-spacing:1px;text-transform:uppercase;width:140px'>{$d[0]}</td><td style='padding:12px 0;color:var(--text-dark)'>{$d[1]}</td></tr>";
          ?>
        </table>
      </div>
    </div>
  </div>

  <div class="tab-panel" id="shipping">
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;">
      <?php
      $ship = [['fa-truck','Standard Delivery','3-5 business days. Free on orders over $35.'],['fa-bolt','Express Delivery','1-2 business days. $9.99 flat rate.'],['fa-refresh','Easy Returns','30-day returns. No questions asked.']];
      foreach($ship as $s) echo "
      <div style='background:var(--warm-white);padding:25px;border:1px solid rgba(180,140,100,0.15);border-radius:3px;text-align:center;'>
        <i class='fa {$s[0]}' style='font-size:2rem;color:var(--gold);margin-bottom:15px;display:block;'></i>
        <h4 style='font-family:Playfair Display,serif;color:var(--brown-dark);margin-bottom:10px;'>{$s[1]}</h4>
        <p style='font-size:0.9rem;color:var(--text-mid);line-height:1.7;'>{$s[2]}</p>
      </div>";
      ?>
    </div>
  </div>
</div>

<!-- RELATED BOOKS -->
<div class="related-section">
  <h2 class="section-heading">You May Also Like</h2>
  <div class="related-grid">
    <?php
    $related = [['Twisted Hate','Ana Huang','$14.00','#2a1a0a,#7a4a1e'],['Twisted Games','Ana Huang','$14.00','#0a1a2a,#1e4a7a'],['Icebreaker','Hannah Grace','$16.00','#0a2a2a,#1e6b6b'],['Bully','Penelope Douglas','$21.00','#1a0a05,#5a2a10']];
    foreach($related as $r) echo "
    <div class='related-card'>
      <div class='related-cover' style='background:linear-gradient(135deg,{$r[3]})'>{$r[0]}</div>
      <div class='related-info'>
        <div class='related-title'>{$r[0]}</div>
        <div style='font-size:0.78rem;color:var(--text-mid);margin-top:2px;'>{$r[1]}</div>
        <div class='related-price'>{$r[2]}</div>
      </div>
    </div>";
    ?>
  </div>
</div>

<footer>
  <div class="footer-grid">
    <div class="footer-brand"><h3>BOOK ADVISOR</h3><p>Curating the finest stories for the modern reader.</p></div>
    <div class="footer-col"><h4>Quick Links</h4><a href="index.php">Home</a><a href="browse_books.php">Shop Collection</a><a href="about.php">About Us</a><a href="contact.php">Contact Support</a></div>
    <div class="footer-col"><h4>Connect</h4><p>support@bookadvisor.com</p><p>+1 234 567 890</p><div class="social-icons"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-instagram"></i></a><a href="#"><i class="fa fa-twitter"></i></a></div></div>
  </div>
  <div class="footer-bottom">© 2025 Book Advisor. All Rights Reserved.</div>
</footer>

<script>
function changeQty(d){const i=document.getElementById('qty');i.value=Math.max(1,parseInt(i.value)+d);}
function openTab(id,btn){
  document.querySelectorAll('.tab-panel').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  btn.classList.add('active');
}
function addToCart(){
  const b=event.target;b.innerHTML='<i class="fa fa-check"></i> Added!';b.style.background='var(--brown-accent)';b.style.color='#fff';
  setTimeout(()=>{b.innerHTML='<i class="fa fa-cart-plus"></i> Add to Cart';b.style.background='';b.style.color='';},2000);
}
function toggleWish(b){
  const icon=b.querySelector('i');
  if(icon.classList.contains('fa-heart-o')){icon.classList.replace('fa-heart-o','fa-heart');icon.style.color='#c0392b';b.children[1]&&(b.children[1].textContent=' Wishlisted');}
  else{icon.classList.replace('fa-heart','fa-heart-o');icon.style.color='';}
}
</script>
</body>
</html>
