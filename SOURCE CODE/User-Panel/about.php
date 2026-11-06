<?php
// Notice fix: Taaki double session start ka error na aaye
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK ADVISOR | About</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div id="loader">
        <div class="loader-book"></div>
        <h2 style="color:var(--accent-gold); margin-top:20px; font-family:'Cinzel'; letter-spacing:5px;">BOOK ADVISOR</h2>
    </div>

    <?php
include("./shared1/nav.php");
?>

    <main class="fade-in-page">
        <div class="shop-banner fade-up" style="background-image: linear-gradient(rgba(62, 39, 35, 0.4), rgba(62, 39, 35, 0.4)), url('https://picsum.photos/seed/aboutbanner/1920/600');">
            <div>
                <h1 style="font-size:3.5rem; color:var(--accent-gold);">OUR STORY</h1>
                <p style="color:#fff;">Passionate readers, curating best for you.</p>
            </div>
        </div>

        <section>
            <div class="about-container">
                <div class="about-img-wrapper fade-up">
                    <img src="aboutpic.jpg" class="about-img" alt="About Us">
                </div>
                <div class="about-text fade-up" style="transition-delay: 0.2s;">
                    <h2 style="color:var(--accent-gold); margin-bottom:20px; font-size:2.5rem;">The Book Advisor Story</h2>
                    <p>Founded in 2023, Book Advisor started with a simple idea: help people find books they will truly love. We believe that a book is not just paper and ink, but a portal to another dimension.</p>
                    <p>Our team of literary experts reads hundreds of books every month to curate a collection that spans across genres and eras. Whether you are looking for a timeless classic or the latest bestseller, we have got you covered.</p>
                    <a href="contact.php" class="btn-main" style="margin-top:20px;">Contact Us</a>
                </div>
            </div>

            <div class="services-grid fade-up" style="transition-delay: 0.4s;">
                 <div class="service-item">
                    <h3 style="color:var(--accent-gold); font-size:2rem;">10k+</h3>
                    <p style="color:var(--text-gray);">Books Sold</p>
                </div>
                 <div class="service-item">
                    <h3 style="color:var(--accent-gold); font-size:2rem;">500+</h3>
                    <p style="color:var(--text-gray);">Happy Authors</p>
                </div>
                 <div class="service-item">
                    <h3 style="color:var(--accent-gold); font-size:2rem;">50+</h3>
                    <p style="color:var(--text-gray);">Literary Awards</p>
                </div>
            </div>
        </section>
    </main>

    <?php include("shared1/footer.php"); ?>

    <script>
        // Standard Loader and Animation Script
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('loader').style.opacity = '0';
                setTimeout(() => { document.getElementById('loader').style.display = 'none'; }, 800);
            }, 2000);
            checkAnimations();
        });
        const observer = new IntersectionObserver((entries) => { 
            entries.forEach(entry => { 
                if (entry.isIntersecting) entry.target.classList.add('visible'); 
            }); 
        }, { threshold: 0.15 });
        function checkAnimations() { 
            document.querySelectorAll('.fade-up').forEach(el => observer.observe(el)); 
        }
    </script>
</body>
</php>