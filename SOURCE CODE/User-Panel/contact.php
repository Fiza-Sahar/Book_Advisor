<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK ADVISOR | Contact</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- LOADER -->
    <div id="loader">
        <div class="loader-book"></div>
        <h2 style="color:var(--accent-gold); margin-top:20px; font-family:'Cinzel'; letter-spacing:5px;">BOOK ADVISOR</h2>
    </div>

    <!-- NAVIGATION -->
    <nav>
        <a href="index.php" class="logo">BOOK ADVISOR</a>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="shop.php">Shop</a>
            <a href="about.php">About</a>
            <a href="contact.php" class="active-link">Contact</a>
        </div>
        <div class="cart-btn">
            <i class="fas fa-shopping-bag"></i>
            <span class="cart-count" id="cartCount">0</span>
        </div>
    </nav>

    <main class="fade-in-page">
        <!-- Banner with Simple Fade Up -->
        <div class="contact-banner fade-up" style="background-image: linear-gradient(rgba(62, 39, 35, 0.4), rgba(62, 39, 35, 0.4)), url('https://picsum.photos/seed/writing/1920/600');">
            <div>
                <h1 style="font-size:3.5rem; color:var(--accent-gold);">GET IN TOUCH</h1>
                <p style="color:#fff;">We'd love to hear from you.</p>
            </div>
        </div>
        <section>
            <!-- Form with Simple Fade Up and Delay -->
            <div style="max-width: 800px; margin: 0 auto; background: #fff; padding: 50px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);" class="fade-up" style="transition-delay: 0.3s;">
                <form onsubmit="event.preventDefault(); showToast('Message Sent Successfully!');">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea rows="5" placeholder="How can we help?" required></textarea>
                    </div>
                    <button type="submit" class="btn-main" style="width:100%">Send Message</button>
                </form>
            </div>
        </section>
    </main>

    <div id="toast">Message Sent!</div>
    <!-- FOOTER (Slide Up Animation) -->
    <footer class="fade-up">
        <div class="footer-content">
            <!-- Column 1: About -->
            <div class="footer-section">
                <h3 class="footer-logo">BOOK ADVISOR</h3>
                <p>Curating the finest stories for the modern reader. Step into a world of imagination and luxury reading.</p>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="footer-section">
                <h3>QUICK LINKS</h3>
                <div class="footer-links">
                    <a href="index.php">Home</a>
                    <a href="shop.php">Shop Collection</a>
                    <a href="about.php">About Us</a>
                    <a href="contact.php">Contact Support</a>
                </div>
            </div>

            <!-- Column 3: Contact & Social -->
            <div class="footer-section">
                <h3>CONNECT</h3>
                <p>support@bookadvisor.com<br>+1 234 567 890</p>
                <div class="social-icons">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-linkedin-in"></i>
                </div>
            </div>
        </div>

        <div class="copyright">
            &copy; 2026 Book Advisor. All Rights Reserved. Designed with Love.
        </div>
    </footer>
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
        function showToast(msg) { 
            const toast = document.getElementById('toast'); 
            toast.innerText = msg; 
            toast.classList.add('show'); 
            setTimeout(() => toast.classList.remove('show'), 3000); 
        }
    </script>
</body>
</php>