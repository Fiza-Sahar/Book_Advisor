<?php
include("connection.php");
if (session_status() === PHP_SESSION_NONE) session_start();

// Trending books - top 4 by download_count
$trending = mysqli_fetch_all(
    mysqli_query($con, "SELECT * FROM book_table ORDER BY download_count DESC, book_time DESC LIMIT 4"),
    MYSQLI_ASSOC
);

include("./shared1/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK ADVISOR | Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .nav-actions { display:flex; align-items:center; gap:20px; }
        .cart-btn { position:relative; }
        #cartCount {
            position:absolute; top:-6px; right:-10px;
            background:#000; color:#fff; font-size:12px;
            padding:2px 6px; border-radius:50%;
        }
        .card-img-placeholder {
            width:100%; aspect-ratio:3/4;
            background:#f5ede8; display:flex;
            align-items:center; justify-content:center; font-size:3rem;
        }
    </style>
</head>
<body>

<div id="loader">
    <div class="loader-book"></div>
    <h2 style="color:var(--accent-gold); margin-top:20px; font-family:'Cinzel'; letter-spacing:5px;">BOOK ADVISOR</h2>
</div>

<main class="fade-in-page">
    <!-- HERO SCROLL SECTION -->
    <div class="hero-container">
        <div class="hero-sticky">
            <video class="video-bg active" id="vid1" autoplay muted loop playsinline><source src="video1.mp4.mp4" type="video/mp4"></video>
            <video class="video-bg" id="vid2" autoplay muted loop playsinline><source src="video2.mp4.mp4" type="video/mp4"></video>
            <video class="video-bg" id="vid3" autoplay muted loop playsinline><source src="video3.mp4.mp4" type="video/mp4"></video>
            <div class="hero-text-wrapper">
                <div class="hero-text active" id="text1">
                    <h1>DISCOVER MAGIC</h1>
                    <p>Open a book, open a new world.</p>
                    <a href="shop.php" class="btn-main">Explore Collection</a>
                </div>
                <div class="hero-text" id="text2">
                    <h1>CLASSIC TALES</h1>
                    <p>Stories that have stood the test of time.</p>
                    <a href="shop.php" class="btn-main">View Classics</a>
                </div>
                <div class="hero-text" id="text3">
                    <h1>FUTURE HORIZONS</h1>
                    <p>Sci-Fi and Fantasy awaits your imagination.</p>
                    <a href="shop.php" class="btn-main">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- SERVICES -->
    <section>
        <div class="services-grid">
            <div class="service-item fade-up" onclick="location.href='./fast-delivery.php';">
                <i class="fas fa-shipping-fast service-icon"></i>
                <h3>Fast Delivery</h3>
                <p style="color:var(--text-gray); font-size:0.9rem;">Get your books within 24 hours.</p>
            </div>
            <div class="service-item fade-up" style="transition-delay:0.1s" onclick="location.href='./premium-packaging.php';">
                <i class="fas fa-gift service-icon"></i>
                <h3>Premium Packaging</h3>
                <p style="color:var(--text-gray); font-size:0.9rem;">Gift wrapping available for all orders.</p>
            </div>
            <div class="service-item fade-up" style="transition-delay:0.2s" onclick="location.href='./expert-advice.php';">
                <i class="fas fa-book-reader service-icon"></i>
                <h3>Expert Advice</h3>
                <p style="color:var(--text-gray); font-size:0.9rem;">Not sure what to read? Ask our advisors.</p>
            </div>
            <div class="service-item fade-up" style="transition-delay:0.3s" onclick="location.href='./easy-returns.php';">
                <i class="fas fa-undo service-icon"></i>
                <h3>Easy Returns</h3>
                <p style="color:var(--text-gray); font-size:0.9rem;">30-day return policy for your peace of mind.</p>
            </div>
        </div>
    </section>

    <!-- TRENDING BOOKS - DATABASE SE -->
    <section>
        <div class="section-header fade-up">
            <h2>TRENDING NOW</h2>
            <div class="line"></div>
        </div>
        <div class="grid">
            <?php if (empty($trending)): ?>
                <div style="grid-column:1/-1; text-align:center; padding:40px; color:#999">
                    📚 No books yet. Admin se books add karwao!
                </div>
            <?php else: ?>
                <?php foreach ($trending as $book): ?>
                <div class="card card-stagger">
                    <?php if (!empty($book['book_img'])): ?>
                        <img src="<?= strpos($book['book_img'], 'http') === 0 ? htmlspecialchars($book['book_img']) : '../Admin-Panel/' . htmlspecialchars($book['book_img']) ?>" class="card-img"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <div class="card-img-placeholder" style="display:none">📖</div>
                    <?php else: ?>
                        <div class="card-img-placeholder">📖</div>
                    <?php endif; ?>

                    <div class="card-title"><?= htmlspecialchars($book['book_name']) ?></div>
                    <div class="card-author"><?= htmlspecialchars($book['book_author']) ?></div>

                    <div class="card-footer">
                        <?php if ($book['is_free'] == 1): ?>
                            <span class="price" style="color:#2e7d32; font-weight:700">FREE</span>
                        <?php else: ?>
                            <span class="price">$<?= number_format($book['book_price'], 2) ?></span>
                        <?php endif; ?>

                        <form method="POST" action="shop.php" style="display:inline; margin:0">
                            <input type="hidden" name="book_id"     value="<?= $book['book_id'] ?>">
                            <input type="hidden" name="book_name"   value="<?= htmlspecialchars($book['book_name']) ?>">
                            <input type="hidden" name="book_price"  value="<?= $book['is_free'] ? 0 : $book['book_price'] ?>">
                            <input type="hidden" name="book_img"    value="<?= htmlspecialchars($book['book_img'] ?? '') ?>">
                            <input type="hidden" name="add_to_cart" value="1">
                            <button type="submit" class="btn-add">ADD TO CART</button>
                        </form>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- COMPETITIONS PROMO BANNER -->
    <section style="background: linear-gradient(135deg, #3E2723, #5D4037); padding: 70px 8%; text-align:center">
        <div class="fade-up">
            <div style="font-family:'Montserrat',sans-serif; font-size:0.72rem; letter-spacing:5px; color:#D4AF7A; text-transform:uppercase; margin-bottom:14px">
                Showcase Your Talent
            </div>
            <h2 style="font-family:'Cinzel',serif; font-size:clamp(1.8rem,4vw,3rem); color:#fff; letter-spacing:4px; margin-bottom:16px">
                WRITING COMPETITIONS
            </h2>
            <div style="width:55px; height:2px; background:#D4AF7A; margin:0 auto 24px"></div>
            <p style="color:rgba(255,255,255,0.72); font-size:1rem; max-width:500px; margin:0 auto 32px; line-height:1.7">
                Enter our writing competitions, win amazing prizes, and get your work noticed by fellow book lovers.
            </p>
            <a href="competitions.php" style="
                display: inline-block;
                padding: 16px 44px;
                background: #D4AF7A;
                color: #3E2723;
                font-family: 'Montserrat', sans-serif;
                font-weight: 700;
                font-size: 0.88rem;
                letter-spacing: 2px;
                text-decoration: none;
                border-radius: 50px;
                text-transform: uppercase;
                transition: background 0.2s, transform 0.2s;
                " onmouseover="this.style.background='#fff'; this.style.transform='translateY(-2px)'"
                   onmouseout="this.style.background='#D4AF7A'; this.style.transform='none'">
                🏆 View Competitions
            </a>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section style="background:#eaddcf;">
        <div class="section-header fade-up">
            <h2>READER REVIEWS</h2>
            <div class="line"></div>
        </div>
        <div class="grid">
            <div class="testimonial-card card-stagger">
                <p class="quote">"Book Advisor changed my reading life! The recommendations are spot on."</p>
                <div class="user">
                    <img src="https://picsum.photos/seed/user1/100/100" alt="User">
                    <div class="user-info"><h4>Emily Clark</h4><span>Avid Reader</span></div>
                </div>
            </div>
            <div class="testimonial-card card-stagger">
                <p class="quote">"Fast delivery and the packaging was beautiful. Highly recommended!"</p>
                <div class="user">
                    <img src="https://picsum.photos/seed/user2/100/100" alt="User">
                    <div class="user-info"><h4>Michael Chen</h4><span>Collector</span></div>
                </div>
            </div>
        </div>
    </section>
</main>

<div id="toast">Item Added to Cart!</div>

<?php include("shared1/footer.php"); ?>

<script>
window.addEventListener('load', () => {
    setTimeout(() => {
        document.getElementById('loader').style.opacity = '0';
        setTimeout(() => { document.getElementById('loader').style.display = 'none'; }, 800);
    }, 2000);
    checkAnimations();
});

const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.15 });
function checkAnimations() {
    document.querySelectorAll('.fade-up, .card-stagger').forEach(el => observer.observe(el));
}

// Hero scroll logic
const heroContainer = document.querySelector('.hero-container');
if (heroContainer) {
    const videos = document.querySelectorAll('.video-bg');
    const texts  = document.querySelectorAll('.hero-text');
    window.addEventListener('scroll', () => {
        const top    = heroContainer.offsetTop;
        const height = heroContainer.offsetHeight;
        const scroll = window.scrollY;
        const winH   = window.innerHeight;
        if (scroll >= top && scroll < (top + height - winH)) {
            const progress = (scroll - top) / (height / 3);
            let index = progress < 1 ? 0 : progress < 2 ? 1 : 2;
            videos.forEach((v, i) => {
                v.classList.toggle('active', i === index);
                i === index ? v.play() : v.pause();
            });
            texts.forEach((t, i) => t.classList.toggle('active', i === index));
        }
    });
}
</script>
</body>
</html>
