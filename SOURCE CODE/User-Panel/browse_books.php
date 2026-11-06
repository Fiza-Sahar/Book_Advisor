<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Browse Books - Book Advisor</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/font-awesome.min.css">
<style>
:root {
  --cream:#f5f0e8; --warm-white:#faf7f2;
  --brown-dark:#3d1f0d; --brown-mid:#7a3f1e;
  --brown-accent:#9b5a2d; --brown-light:#c4956a; --gold:#b8966e;
  --text-dark:#2a1810; --text-mid:#5c3d2e; --shadow:rgba(61,31,13,0.15);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{background:var(--cream);font-family:'Cormorant Garamond',serif;color:var(--text-dark);}

nav{background:var(--warm-white);padding:18px 60px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(180,140,100,0.2);position:sticky;top:0;z-index:100;box-shadow:0 2px 20px var(--shadow);}
.logo{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--brown-dark);letter-spacing:2px;text-decoration:none;}
.nav-links{display:flex;gap:36px;list-style:none;}
.nav-links a{text-decoration:none;color:var(--text-mid);font-size:0.85rem;letter-spacing:2px;text-transform:uppercase;position:relative;transition:color 0.3s;}
.nav-links a::after{content:'';position:absolute;bottom:-4px;left:0;width:0;height:1px;background:var(--brown-accent);transition:width 0.3s;}
.nav-links a:hover::after,.nav-links a.active::after{width:100%;}
.nav-links a:hover,.nav-links a.active{color:var(--brown-accent);}
.nav-right{display:flex;gap:20px;align-items:center;}
.cart-btn{background:var(--brown-accent);color:#fff;padding:8px 20px;border-radius:3px;text-decoration:none;font-size:0.82rem;letter-spacing:1px;text-transform:uppercase;transition:all 0.3s;}
.cart-btn:hover{background:var(--brown-mid);}

/* HERO */
.shop-hero{
  background:linear-gradient(160deg,var(--brown-dark) 0%,var(--brown-mid) 100%);
  padding:70px 60px 50px;
  position:relative;overflow:hidden;
}
.shop-hero::before{
  content:'';position:absolute;inset:0;
  background:url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M20 20.5V18H0v5h20v-2.5zM0 25h20v5H0zM0 10h20v5H0zM20 5.5V3H0v5h20V5.5z'/%3E%3C/g%3E%3C/svg%3E");
}
.shop-hero h1{font-family:'Playfair Display',serif;color:#fff;font-size:3rem;position:relative;letter-spacing:2px;}
.shop-hero p{color:rgba(255,255,255,0.65);margin-top:10px;font-size:1.1rem;position:relative;}

/* SEARCH & FILTER BAR */
.filter-bar{
  background:var(--warm-white);
  padding:25px 60px;
  display:flex;gap:20px;align-items:center;flex-wrap:wrap;
  border-bottom:1px solid rgba(180,140,100,0.15);
  box-shadow:0 2px 15px var(--shadow);
  position:sticky;top:63px;z-index:90;
}
.search-wrap{flex:1;position:relative;min-width:200px;}
.search-wrap i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--gold);}
.search-wrap input{
  width:100%;padding:12px 16px 12px 40px;
  border:1px solid rgba(180,140,100,0.3);border-radius:3px;
  background:var(--cream);font-family:'Cormorant Garamond',serif;font-size:1rem;
  color:var(--text-dark);outline:none;transition:all 0.3s;
}
.search-wrap input:focus{border-color:var(--brown-accent);box-shadow:0 0 0 3px rgba(155,90,45,0.1);}
.filter-select{
  padding:12px 16px;border:1px solid rgba(180,140,100,0.3);border-radius:3px;
  background:var(--cream);font-family:'Cormorant Garamond',serif;font-size:0.95rem;
  color:var(--text-dark);outline:none;cursor:pointer;transition:all 0.3s;
}
.filter-select:focus{border-color:var(--brown-accent);}
.results-count{color:var(--text-mid);font-size:0.9rem;margin-left:auto;}

/* BOOKS GRID */
.shop-container{max-width:1300px;margin:0 auto;padding:50px 30px;}
.books-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(200px,1fr));
  gap:30px;
}

.book-card{
  background:var(--warm-white);
  border-radius:4px;
  overflow:hidden;
  box-shadow:0 4px 20px var(--shadow);
  border:1px solid rgba(180,140,100,0.12);
  transition:all 0.4s cubic-bezier(0.25,0.8,0.25,1);
  cursor:pointer;
  opacity:0;
  animation:fadeUp 0.5s ease forwards;
}
.book-card:hover{
  transform:translateY(-8px) rotate(0.5deg);
  box-shadow:0 15px 40px rgba(61,31,13,0.25);
}
@keyframes fadeUp{from{opacity:0;transform:translateY(30px);}to{opacity:1;transform:translateY(0);}}

.book-cover{
  height:260px;
  position:relative;
  overflow:hidden;
}
.book-cover img{width:100%;height:100%;object-fit:cover;transition:transform 0.5s;}
.book-card:hover .book-cover img{transform:scale(1.05);}
.cover-placeholder{
  width:100%;height:100%;
  display:flex;align-items:center;justify-content:center;
  font-family:'Playfair Display',serif;color:rgba(255,255,255,0.8);
  font-size:1rem;text-align:center;padding:20px;
  background:linear-gradient(135deg,var(--brown-dark),var(--brown-accent));
}

.book-overlay{
  position:absolute;inset:0;
  background:linear-gradient(to top,rgba(61,31,13,0.85) 0%,transparent 60%);
  opacity:0;transition:opacity 0.3s;
  display:flex;align-items:flex-end;justify-content:center;padding:20px;
}
.book-card:hover .book-overlay{opacity:1;}
.quick-add{
  background:var(--gold);color:var(--brown-dark);
  border:none;padding:10px 20px;border-radius:3px;
  font-family:'Cormorant Garamond',serif;font-size:0.85rem;letter-spacing:1px;text-transform:uppercase;
  cursor:pointer;transition:all 0.3s;width:100%;font-weight:600;
}
.quick-add:hover{background:#fff;}

.book-info{padding:16px;}
.book-title{font-family:'Playfair Display',serif;font-size:1rem;color:var(--brown-dark);line-height:1.3;margin-bottom:4px;}
.book-author{font-size:0.8rem;color:var(--text-mid);letter-spacing:0.5px;text-transform:uppercase;}
.book-bottom{display:flex;justify-content:space-between;align-items:center;margin-top:12px;padding-top:12px;border-top:1px solid rgba(180,140,100,0.15);}
.book-price{font-family:'Playfair Display',serif;font-size:1.1rem;color:var(--brown-accent);}
.view-btn{
  font-size:0.78rem;color:var(--text-mid);text-decoration:none;
  letter-spacing:1px;text-transform:uppercase;transition:color 0.3s;
}
.view-btn:hover{color:var(--brown-accent);}

/* GENRE TABS */
.genre-tabs{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:35px;}
.genre-tab{
  padding:8px 22px;border:1px solid rgba(180,140,100,0.35);border-radius:30px;
  font-size:0.85rem;cursor:pointer;color:var(--text-mid);
  background:transparent;font-family:'Cormorant Garamond',serif;
  transition:all 0.3s;
}
.genre-tab:hover,.genre-tab.active{background:var(--brown-accent);color:#fff;border-color:var(--brown-accent);}

/* PAGINATION */
.pagination{display:flex;justify-content:center;gap:8px;margin-top:50px;}
.page-btn{
  width:40px;height:40px;border:1px solid rgba(180,140,100,0.3);border-radius:3px;
  background:transparent;cursor:pointer;font-family:'Cormorant Garamond',serif;
  color:var(--text-mid);transition:all 0.3s;display:flex;align-items:center;justify-content:center;
}
.page-btn.active,.page-btn:hover{background:var(--brown-accent);color:#fff;border-color:var(--brown-accent);}

footer{background:var(--brown-dark);color:rgba(255,255,255,0.6);padding:50px 60px 30px;margin-top:60px;}
.footer-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:40px;margin-bottom:40px;}
.footer-brand h3{font-family:'Playfair Display',serif;color:var(--gold);letter-spacing:2px;margin-bottom:12px;}
.footer-col h4{color:var(--gold);letter-spacing:2px;font-size:0.8rem;text-transform:uppercase;margin-bottom:15px;}
.footer-col a{display:block;color:rgba(255,255,255,0.6);text-decoration:none;margin-bottom:10px;font-size:0.9rem;transition:color 0.3s;}
.footer-col a:hover{color:var(--gold);}
.social-icons{display:flex;gap:14px;margin-top:15px;}
.social-icons a{width:36px;height:36px;border-radius:50%;border:1px solid rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.6);text-decoration:none;transition:all 0.3s;}
.social-icons a:hover{border-color:var(--gold);color:var(--gold);}
.footer-bottom{border-top:1px solid rgba(255,255,255,0.1);padding-top:20px;text-align:center;font-size:0.82rem;}
</style>
</head>
<body>

    <!-- NAVIGATION -->
<?php
include("./shared1/nav.php");
?>


<div class="shop-hero">
  <h1>THE LIBRARY</h1>
  <p>Choose your destiny from thousands of titles.</p>
</div>

<div class="filter-bar">
  <div class="search-wrap">
    <i class="fa fa-search"></i>
    <input type="text" placeholder="Search books, authors..." id="searchInput" oninput="filterBooks()">
  </div>
  <select class="filter-select" onchange="filterBooks()" id="sortSelect">
    <option>Sort: Featured</option>
    <option>Price: Low to High</option>
    <option>Price: High to Low</option>
    <option>Newest First</option>
  </select>
  <select class="filter-select" onchange="filterBooks()" id="genreSelect">
    <option value="">All Genres</option>
    <option>Fantasy</option>
    <option>Romance</option>
    <option>Sci-Fi</option>
    <option>Mystery</option>
    <option>Thriller</option>
  </select>
  <span class="results-count" id="count">Showing 8 books</span>
</div>

<div class="shop-container">
  <div class="genre-tabs">
    <button class="genre-tab active" onclick="setTab(this)">All Books</button>
    <button class="genre-tab" onclick="setTab(this)">Fantasy</button>
    <button class="genre-tab" onclick="setTab(this)">Romance</button>
    <button class="genre-tab" onclick="setTab(this)">Sci-Fi</button>
    <button class="genre-tab" onclick="setTab(this)">Mystery</button>
    <button class="genre-tab" onclick="setTab(this)">Thriller</button>
    <button class="genre-tab" onclick="setTab(this)">Literary</button>
  </div>

  <div class="books-grid" id="booksGrid">

    <?php
    $books = [
      ['Bully','Penelope Douglas','$21.00','Romance'],
      ['God of Vengeance','Michelle Heard','$15.99','Fantasy'],
      ['It Ends With Us','Colleen Hoover','$19.50','Romance'],
      ['L\'Ombre D\'Adeline','H.D. Carlton','$28.00','Thriller'],
      ['Twisted Love','Ana Huang','$14.00','Romance'],
      ['Fearless','Lauren Roberts','$26.00','Fantasy'],
      ['The Midnight Library','Matt Haig','$18.00','Literary'],
      ['Project Hail Mary','Andy Weir','$22.00','Sci-Fi'],
      ['Gone Girl','Gillian Flynn','$16.50','Mystery'],
      ['The Name of the Wind','Patrick Rothfuss','$24.00','Fantasy'],
      ['Dune','Frank Herbert','$20.00','Sci-Fi'],
      ['Pride & Prejudice','Jane Austen','$12.00','Literary'],
    ];
    $colors = ['#3d1f0d,#7a3f1e','#1a2a1a,#2d5a2d','#1a0a2e,#6b2fb3','#2a0a0a,#8b2020','#0a1a2a,#1e4a7a','#2a1a0a,#7a4a1e','#0a2a1a,#1e6b4a','#1a1a2a,#3a3a6b'];
    foreach($books as $i=>$book) {
      $c = $colors[$i % count($colors)];
      echo "
      <div class='book-card' style='animation-delay:".($i*0.07)."s' data-title='{$book[0]}' data-genre='{$book[3]}'>
        <div class='book-cover'>
          <div class='cover-placeholder' style='background:linear-gradient(135deg,{$c})'>
            <div>
              <div style='font-size:1.1rem;font-weight:700;margin-bottom:8px;line-height:1.2'>{$book[0]}</div>
              <div style='font-size:0.75rem;opacity:0.7;letter-spacing:1px'>{$book[1]}</div>
            </div>
          </div>
          <div class='book-overlay'>
            <button class='quick-add' onclick='addToCart(\"{$book[0]}\")'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
          </div>
        </div>
        <div class='book-info'>
          <div class='book-title'>{$book[0]}</div>
          <div class='book-author'>{$book[1]}</div>
          <div class='book-bottom'>
            <span class='book-price'>{$book[2]}</span>
            <a href='book_details.php?id=".($i+1)."' class='view-btn'>Details →</a>
          </div>
        </div>
      </div>";
    }
    ?>

  </div>

  <div class="pagination">
    <button class="page-btn active">1</button>
    <button class="page-btn">2</button>
    <button class="page-btn">3</button>
    <button class="page-btn"><i class="fa fa-chevron-right"></i></button>
  </div>
</div>

<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <h3>BOOK ADVISOR</h3>
      <p>Curating the finest stories for the modern reader.</p>
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
function setTab(el) {
  document.querySelectorAll('.genre-tab').forEach(t=>t.classList.remove('active'));
  el.classList.add('active');
}
function filterBooks() {
  const q = document.getElementById('searchInput').value.toLowerCase();
  const cards = document.querySelectorAll('.book-card');
  let visible = 0;
  cards.forEach(c => {
    const title = c.dataset.title.toLowerCase();
    c.style.display = title.includes(q) ? '' : 'none';
    if(title.includes(q)) visible++;
  });
  document.getElementById('count').textContent = 'Showing '+visible+' books';
}
function addToCart(title) {
  const btn = event.target;
  btn.textContent = '✓ Added!';
  btn.style.background = '#4caf50';
  btn.style.color = '#fff';
  setTimeout(()=>{ btn.innerHTML = '<i class="fa fa-shopping-cart"></i> Add to Cart'; btn.style.background=''; btn.style.color=''; },1500);
}
</script>
</body>
</html>
