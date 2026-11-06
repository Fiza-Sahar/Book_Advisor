<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Advisor - Curating the finest stories</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4a3025;
            --secondary-color: #7a5c4e;
            --accent-color: #c8a88f;
            --text-color: #333;
            --light-bg: #f8f4f1;
            --dark-bg: #2c1f1a;
            --nav-bg: #f9f9f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: #fff;
        }

        /* Navigation Bar */
        .navbar {
            background-color: var(--nav-bg);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: 1px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 35px;
        }

        .nav-menu a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            position: relative;
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: var(--primary-color);
        }

        .nav-menu a.active {
            color: var(--primary-color);
        }

        .nav-menu a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-color);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .nav-actions a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-actions a:hover {
            color: var(--primary-color);
        }

        .cart-icon {
            position: relative;
            cursor: pointer;
            transition: color 0.3s;
        }

        .cart-icon:hover {
            color: var(--primary-color);
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -12px;
            background-color: var(--primary-color);
            color: white;
            font-size: 0.7rem;
            font-weight: bold;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Latest Articles Section */
        .latest-articles {
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 30px;
            text-align: center;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 15px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--accent-color);
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .article-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .article-card:hover {
            transform: translateY(-5px);
        }

        .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .article-content {
            padding: 20px;
            background-color: white;
        }

        .article-date {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .article-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .article-category {
            display: inline-block;
            background-color: var(--accent-color);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-bottom: 15px;
        }

        .article-social {
            display: flex;
            gap: 15px;
        }

        .article-social a {
            color: var(--secondary-color);
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        .article-social a:hover {
            color: var(--primary-color);
        }

        .read-all-btn {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 12px 20px;
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .read-all-btn:hover {
            background-color: var(--secondary-color);
        }

        /* Book Products Section */
        .book-products {
            margin-bottom: 60px;
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 25px;
        }

        .book-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-cover {
            width: 100%;
            height: 280px;
            object-fit: cover;
        }

        .book-info {
            padding: 15px;
        }

        .book-title {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--primary-color);
        }

        .book-author {
            font-size: 0.9rem;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        .book-price {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .add-to-cart {
            width: 100%;
            padding: 8px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .add-to-cart:hover {
            background-color: var(--secondary-color);
        }

        /* Footer */
        footer {
            background-color: var(--dark-bg);
            color: white;
            padding: 50px 0 20px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }

        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: var(--accent-color);
        }

        .footer-column p {
            margin-bottom: 15px;
            line-height: 1.7;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-column ul li a:hover {
            color: var(--accent-color);
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .contact-item i {
            margin-right: 10px;
            color: var(--accent-color);
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icons a {
            color: white;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: var(--accent-color);
        }

        .copyright {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .articles-grid {
                grid-template-columns: 1fr;
            }

            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .nav-menu {
                gap: 15px;
            }

            .nav-menu a {
                font-size: 0.9rem;
            }

            .nav-actions {
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">BOOK ADVISOR</a>
            
            <ul class="nav-menu">
                <li><a href="#" class="active">HOME</a></li>
                <li><a href="#">SHOP</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">CONTACT</a></li>
            </ul>
            
            <div class="nav-actions">
                <a href="#">Account</a>
                <div class="cart-icon">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    <span class="cart-count">0</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Latest Articles Section -->
        <section class="latest-articles">
            <h2 class="section-title">Latest Articles</h2>
            <div class="articles-grid">
                <article class="article-card">
                    <img src="https://picsum.photos/seed/reading1/400/300.jpg" alt="Person reading book" class="article-image">
                    <div class="article-content">
                        <div class="article-date">Mar 30, 2021</div>
                        <h3 class="article-title">Reading Books Always Makes The Moments Happy</h3>
                        <span class="article-category">INSPIRATION</span>
                        <div class="article-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </article>
                <article class="article-card">
                    <img src="https://picsum.photos/seed/reading2/400/300.jpg" alt="Person reading book" class="article-image">
                    <div class="article-content">
                        <div class="article-date">Mar 29, 2021</div>
                        <h3 class="article-title">Reading Books Always Makes The Moments Happy</h3>
                        <span class="article-category">INSPIRATION</span>
                        <div class="article-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </article>
                <article class="article-card">
                    <img src="https://picsum.photos/seed/reading3/400/300.jpg" alt="Person reading book" class="article-image">
                    <div class="article-content">
                        <div class="article-date">Feb 27, 2021</div>
                        <h3 class="article-title">Reading Books Always Makes The Moments Happy</h3>
                        <span class="article-category">INSPIRATION</span>
                        <div class="article-social">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </article>
            </div>
            <a href="#" class="read-all-btn">READ ALL ARTICLES →</a>
        </section>

        <!-- Book Products Section -->
        <section class="book-products">
            <h2 class="section-title">Featured Books</h2>
            <div class="books-grid">
                <div class="book-card">
                    <img src="https://picsum.photos/seed/bully/200/280.jpg" alt="BULLY Book Cover" class="book-cover">
                    <div class="book-info">
                        <h3 class="book-title">BULLY</h3>
                        <p class="book-author">E. DOUGLAS</p>
                        <p class="book-price">$15.99</p>
                        <button class="add-to-cart">ADD TO CART</button>
                    </div>
                </div>
                <div class="book-card">
                    <img src="https://picsum.photos/seed/godofvengeance/200/280.jpg" alt="GOD OF VENGEANCE Book Cover" class="book-cover">
                    <div class="book-info">
                        <h3 class="book-title">GOD OF VENGEANCE</h3>
                        <p class="book-author">MICHELLE HEARD</p>
                        <p class="book-price">$15.99</p>
                        <button class="add-to-cart">ADD TO CART</button>
                    </div>
                </div>
                <div class="book-card">
                    <img src="https://picsum.photos/seed/itsendwithus/200/280.jpg" alt="ITS END WITH US Book Cover" class="book-cover">
                    <div class="book-info">
                        <h3 class="book-title">ITS END WITH US</h3>
                        <p class="book-author">COLLEEN HOOVER</p>
                        <p class="book-price">$19.50</p>
                        <button class="add-to-cart">ADD TO CART</button>
                    </div>
                </div>
                <div class="book-card">
                    <img src="https://picsum.photos/seed/lombreadline/200/280.jpg" alt="L'OMBRE D'ADLINE Book Cover" class="book-cover">
                    <div class="book-info">
                        <h3 class="book-title">L'OMBRE D'ADLINE</h3>
                        <p class="book-author">H.D CARLTON</p>
                        <p class="book-price">$28.00</p>
                        <button class="add-to-cart">ADD TO CART</button>
                    </div>
                </div>
                <div class="book-card">
                    <img src="https://picsum.photos/seed/twistedlove/200/280.jpg" alt="TWISTED LOVE Book Cover" class="book-cover">
                    <div class="book-info">
                        <h3 class="book-title">TWISTED LOVE</h3>
                        <p class="book-author">ANA HUANG</p>
                        <p class="book-price">$14.00</p>
                        <button class="add-to-cart">ADD TO CART</button>
                    </div>
                </div>
                <div class="book-card">
                    <img src="https://picsum.photos/seed/fearless/200/280.jpg" alt="FEARLESS Book Cover" class="book-cover">
                    <div class="book-info">
                        <h3 class="book-title">FEARLESS</h3>
                        <p class="book-author">LAUREN ROBERTS</p>
                        <p class="book-price">$26.00</p>
                        <button class="add-to-cart">ADD TO CART</button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>BOOK ADVISOR</h3>
                <p>Curating the finest stories for the modern reader. Step into a world of imagination and luxury reading.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>QUICK LINKS</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Shop Collection</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Support</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>CONNECT</h3>
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>support@bookadvisor.com</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>+1 234 567 890</span>
                </div>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            © 2026 Book Advisor. All Rights Reserved. Designed with Love
        </div>
    </footer>

    <script>
        // Cart counter functionality
        let cartCount = 0;
        const cartCountElement = document.querySelector('.cart-count');
        
        // Add to cart functionality
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const bookTitle = this.parentElement.querySelector('.book-title').textContent;
                
                // Update cart count
                cartCount++;
                cartCountElement.textContent = cartCount;
                
                // Create a notification element
                const notification = document.createElement('div');
                notification.style.position = 'fixed';
                notification.style.bottom = '20px';
                notification.style.right = '20px';
                notification.style.backgroundColor = 'var(--primary-color)';
                notification.style.color = 'white';
                notification.style.padding = '15px 25px';
                notification.style.borderRadius = '5px';
                notification.style.boxShadow = '0 5px 15px rgba(0,0,0,0.3)';
                notification.style.zIndex = '1000';
                notification.style.transform = 'translateX(150%)';
                notification.style.transition = 'transform 0.3s ease-out';
                notification.textContent = `"${bookTitle}" has been added to your cart!`;
                
                document.body.appendChild(notification);
                
                // Animate in
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);
                
                // Remove after 3 seconds
                setTimeout(() => {
                    notification.style.transform = 'translateX(150%)';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 3000);
            });
        });

        // Navigation active state
        document.querySelectorAll('.nav-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links
                document.querySelectorAll('.nav-menu a').forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>