<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Advisor - Exclusive Bundle Offers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4a3025;
            --secondary-color: #7a5c4e;
            --accent-color: #c8a88f;
            --text-color: #333;
            --light-bg: #f8f4f1;
            --dark-bg: #2c1f1a;
            --nav-bg: #f9f9f9;
            --gold-accent: #d4af37;
            --sale-color: #e63946;
            --gradient-1: linear-gradient(135deg, #4a3025 0%, #7a5c4e 100%);
            --gradient-2: linear-gradient(135deg, #d4af37 0%, #f9e076 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: #fff;
            overflow-x: hidden;
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
            font-family: 'Playfair Display', serif;
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

        /* Hero Section */
        .hero {
            background: var(--gradient-1);
            color: white;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://picsum.photos/seed/booksbundle/1920/400.jpg') center/cover;
            opacity: 0.15;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            text-align: center;
        }

        .hero-badge {
            display: inline-block;
            background-color: var(--sale-color);
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 20px;
            animation: fadeInUp 0.8s ease-out;
        }

        .hero p {
            font-size: 1.3rem;
            max-width: 700px;
            margin: 0 auto 30px;
            opacity: 0.9;
            animation: fadeInUp 0.8s ease-out 0.2s backwards;
        }

        /* Countdown Timer */
        .countdown-container {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto 30px;
            animation: fadeInUp 0.8s ease-out 0.4s backwards;
        }

        .countdown-title {
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .countdown-item {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 15px;
            min-width: 80px;
        }

        .countdown-number {
            font-size: 2rem;
            font-weight: bold;
            display: block;
        }

        .countdown-label {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        /* Bundle Section */
        .bundles-section {
            padding: 60px 0;
            background-color: var(--light-bg);
        }

        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--gold-accent);
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--secondary-color);
            max-width: 700px;
            margin: 20px auto 0;
        }

        /* Bundle Cards */
        .bundles-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
        }

        .bundle-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s;
            position: relative;
        }

        .bundle-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .bundle-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: var(--sale-color);
            color: white;
            padding: 8px 15px;
            border-radius: 30px;
            font-weight: bold;
            z-index: 2;
            font-size: 0.9rem;
        }

        .bundle-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .bundle-card:hover .bundle-image {
            transform: scale(1.05);
        }

        .bundle-content {
            padding: 30px;
        }

        .bundle-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .bundle-description {
            color: var(--secondary-color);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .bundle-books {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .mini-book {
            width: 60px;
            height: 90px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .mini-book:hover {
            transform: scale(1.1);
        }

        .bundle-price {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .original-price {
            font-size: 1.2rem;
            color: #999;
            text-decoration: line-through;
        }

        .sale-price {
            font-size: 2rem;
            font-weight: bold;
            color: var(--sale-color);
        }

        .bundle-btn {
            width: 100%;
            padding: 15px;
            background: var(--gradient-1);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(74, 48, 37, 0.3);
        }

        .bundle-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(74, 48, 37, 0.4);
        }

        /* Features Section */
        .features-section {
            padding: 60px 0;
            background-color: white;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .feature-card {
            text-align: center;
            padding: 30px 20px;
            border-radius: 15px;
            transition: all 0.3s;
        }

        .feature-card:hover {
            background-color: var(--light-bg);
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .feature-title {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }

        .feature-description {
            color: var(--secondary-color);
            line-height: 1.6;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 60px 0;
            background-color: var(--light-bg);
        }

        .testimonials-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .testimonial-slider {
            display: flex;
            gap: 30px;
            overflow-x: auto;
            padding-bottom: 20px;
            scroll-snap-type: x mandatory;
        }

        .testimonial-card {
            min-width: 300px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            scroll-snap-align: start;
            transition: all 0.3s;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .testimonial-stars {
            color: var(--gold-accent);
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .testimonial-text {
            color: var(--secondary-color);
            margin-bottom: 20px;
            line-height: 1.6;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info h4 {
            font-size: 1rem;
            margin-bottom: 5px;
            color: var(--primary-color);
        }

        .author-info p {
            font-size: 0.9rem;
            color: var(--secondary-color);
        }

        /* CTA Section */
        .cta-section {
            padding: 60px 0;
            background: var(--gradient-1);
            color: white;
            text-align: center;
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .cta-description {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .cta-btn {
            display: inline-block;
            padding: 15px 40px;
            background-color: var(--gold-accent);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
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
            font-family: 'Playfair Display', serif;
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
            transition: all 0.3s;
        }

        .social-icons a:hover {
            color: var(--gold-accent);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .bundles-container {
                grid-template-columns: 1fr;
            }

            .countdown {
                gap: 10px;
            }

            .countdown-item {
                min-width: 60px;
                padding: 10px;
            }

            .countdown-number {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .nav-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .hero {
                padding: 40px 0;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .bundle-content {
                padding: 20px;
            }

            .bundle-title {
                font-size: 1.5rem;
            }

            .sale-price {
                font-size: 1.5rem;
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
                <li><a href="#">HOME</a></li>
                <li><a href="#">BLOG</a></li>
                <li><a href="#" class="active">OFFERS</a></li>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <span class="hero-badge">LIMITED TIME OFFER</span>
            <h1>Exclusive Book Bundles - 50% OFF!</h1>
            <p>Curated collections of bestselling titles at unbeatable prices. Don't miss out on these amazing deals!</p>
            
            <!-- Countdown Timer -->
            <div class="countdown-container">
                <h3 class="countdown-title">Offer Ends In:</h3>
                <div class="countdown">
                    <div class="countdown-item">
                        <span class="countdown-number" id="days">05</span>
                        <span class="countdown-label">Days</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="hours">12</span>
                        <span class="countdown-label">Hours</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="minutes">34</span>
                        <span class="countdown-label">Minutes</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="seconds">56</span>
                        <span class="countdown-label">Seconds</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bundle Section -->
    <section class="bundles-section">
        <div class="section-header">
            <h2 class="section-title">Featured Book Bundles</h2>
            <p class="section-subtitle">Handpicked collections that will transport you to different worlds. Each bundle is carefully curated to provide the ultimate reading experience.</p>
        </div>
        
        <div class="bundles-container">
            <!-- Bundle Card 1 -->
            <div class="bundle-card">
                <span class="bundle-badge">50% OFF</span>
                <img src="https://picsum.photos/seed/mysterybundle/400/250.jpg" alt="Mystery Thriller Bundle" class="bundle-image">
                <div class="bundle-content">
                    <h3 class="bundle-title">Mystery Thriller Bundle</h3>
                    <p class="bundle-description">Heart-pounding mysteries that will keep you on the edge of your seat until the very last page.</p>
                    
                    <div class="bundle-books">
                        <img src="https://picsum.photos/seed/book1/60/90.jpg" alt="Book 1" class="mini-book">
                        <img src="https://picsum.photos/seed/book2/60/90.jpg" alt="Book 2" class="mini-book">
                        <img src="https://picsum.photos/seed/book3/60/90.jpg" alt="Book 3" class="mini-book">
                        <img src="https://picsum.photos/seed/book4/60/90.jpg" alt="Book 4" class="mini-book">
                        <img src="https://picsum.photos/seed/book5/60/90.jpg" alt="Book 5" class="mini-book">
                    </div>
                    
                    <div class="bundle-price">
                        <span class="original-price">$89.95</span>
                        <span class="sale-price">$44.98</span>
                    </div>
                    
                    <button class="bundle-btn" data-bundle="Mystery Thriller Bundle">Add to Cart</button>
                </div>
            </div>
            
            <!-- Bundle Card 2 -->
            <div class="bundle-card">
                <span class="bundle-badge">50% OFF</span>
                <img src="https://picsum.photos/seed/romancebundle/400/250.jpg" alt="Romance Collection" class="bundle-image">
                <div class="bundle-content">
                    <h3 class="bundle-title">Romance Collection</h3>
                    <p class="bundle-description">Sweeping love stories that will make your heart flutter and believe in happily ever after.</p>
                    
                    <div class="bundle-books">
                        <img src="https://picsum.photos/seed/book6/60/90.jpg" alt="Book 6" class="mini-book">
                        <img src="https://picsum.photos/seed/book7/60/90.jpg" alt="Book 7" class="mini-book">
                        <img src="https://picsum.photos/seed/book8/60/90.jpg" alt="Book 8" class="mini-book">
                        <img src="https://picsum.photos/seed/book9/60/90.jpg" alt="Book 9" class="mini-book">
                        <img src="https://picsum.photos/seed/book10/60/90.jpg" alt="Book 10" class="mini-book">
                    </div>
                    
                    <div class="bundle-price">
                        <span class="original-price">$79.95</span>
                        <span class="sale-price">$39.98</span>
                    </div>
                    
                    <button class="bundle-btn" data-bundle="Romance Collection">Add to Cart</button>
                </div>
            </div>
            
            <!-- Bundle Card 3 -->
            <div class="bundle-card">
                <span class="bundle-badge">50% OFF</span>
                <img src="https://picsum.photos/seed/scifibundle/400/250.jpg" alt="Sci-Fi Adventure" class="bundle-image">
                <div class="bundle-content">
                    <h3 class="bundle-title">Sci-Fi Adventure</h3>
                    <p class="bundle-description">Mind-bending journeys to distant galaxies and futures that will expand your imagination.</p>
                    
                    <div class="bundle-books">
                        <img src="https://picsum.photos/seed/book11/60/90.jpg" alt="Book 11" class="mini-book">
                        <img src="https://picsum.photos/seed/book12/60/90.jpg" alt="Book 12" class="mini-book">
                        <img src="https://picsum.photos/seed/book13/60/90.jpg" alt="Book 13" class="mini-book">
                        <img src="https://picsum.photos/seed/book14/60/90.jpg" alt="Book 14" class="mini-book">
                        <img src="https://picsum.photos/seed/book15/60/90.jpg" alt="Book 15" class="mini-book">
                    </div>
                    
                    <div class="bundle-price">
                        <span class="original-price">$99.95</span>
                        <span class="sale-price">$49.98</span>
                    </div>
                    
                    <button class="bundle-btn" data-bundle="Sci-Fi Adventure">Add to Cart</button>
                </div>
            </div>
            
            <!-- Bundle Card 4 -->
            <div class="bundle-card">
                <span class="bundle-badge">50% OFF</span>
                <img src="https://picsum.photos/seed/classicbundle/400/250.jpg" alt="Classic Literature" class="bundle-image">
                <div class="bundle-content">
                    <h3 class="bundle-title">Classic Literature</h3>
                    <p class="bundle-description">Timeless masterpieces that have shaped literature and continue to inspire readers worldwide.</p>
                    
                    <div class="bundle-books">
                        <img src="https://picsum.photos/seed/book16/60/90.jpg" alt="Book 16" class="mini-book">
                        <img src="https://picsum.photos/seed/book17/60/90.jpg" alt="Book 17" class="mini-book">
                        <img src="https://picsum.photos/seed/book18/60/90.jpg" alt="Book 18" class="mini-book">
                        <img src="https://picsum.photos/seed/book19/60/90.jpg" alt="Book 19" class="mini-book">
                        <img src="https://picsum.photos/seed/book20/60/90.jpg" alt="Book 20" class="mini-book">
                    </div>
                    
                    <div class="bundle-price">
                        <span class="original-price">$84.95</span>
                        <span class="sale-price">$42.48</span>
                    </div>
                    
                    <button class="bundle-btn" data-bundle="Classic Literature">Add to Cart</button>
                </div>
            </div>
            
            <!-- Bundle Card 5 -->
            <div class="bundle-card">
                <span class="bundle-badge">50% OFF</span>
                <img src="https://picsum.photos/seed/selfhelpbundle/400/250.jpg" alt="Self-Help Collection" class="bundle-image">
                <div class="bundle-content">
                    <h3 class="bundle-title">Self-Help Collection</h3>
                    <p class="bundle-description">Transformative guides to help you unlock your potential and live your best life.</p>
                    
                    <div class="bundle-books">
                        <img src="https://picsum.photos/seed/book21/60/90.jpg" alt="Book 21" class="mini-book">
                        <img src="https://picsum.photos/seed/book22/60/90.jpg" alt="Book 22" class="mini-book">
                        <img src="https://picsum.photos/seed/book23/60/90.jpg" alt="Book 23" class="mini-book">
                        <img src="https://picsum.photos/seed/book24/60/90.jpg" alt="Book 24" class="mini-book">
                        <img src="https://picsum.photos/seed/book25/60/90.jpg" alt="Book 25" class="mini-book">
                    </div>
                    
                    <div class="bundle-price">
                        <span class="original-price">$94.95</span>
                        <span class="sale-price">$47.48</span>
                    </div>
                    
                    <button class="bundle-btn" data-bundle="Self-Help Collection">Add to Cart</button>
                </div>
            </div>
            
            <!-- Bundle Card 6 -->
            <div class="bundle-card">
                <span class="bundle-badge">50% OFF</span>
                <img src="https://picsum.photos/seed/cookbookbundle/400/250.jpg" alt="Cookbook Delights" class="bundle-image">
                <div class="bundle-content">
                    <h3 class="bundle-title">Cookbook Delights</h3>
                    <p class="bundle-description">Culinary adventures from around the world to inspire your inner chef and delight your taste buds.</p>
                    
                    <div class="bundle-books">
                        <img src="https://picsum.photos/seed/book26/60/90.jpg" alt="Book 26" class="mini-book">
                        <img src="https://picsum.photos/seed/book27/60/90.jpg" alt="Book 27" class="mini-book">
                        <img src="https://picsum.photos/seed/book28/60/90.jpg" alt="Book 28" class="mini-book">
                        <img src="https://picsum.photos/seed/book29/60/90.jpg" alt="Book 29" class="mini-book">
                        <img src="https://picsum.photos/seed/book30/60/90.jpg" alt="Book 30" class="mini-book">
                    </div>
                    
                    <div class="bundle-price">
                        <span class="original-price">$89.95</span>
                        <span class="sale-price">$44.98</span>
                    </div>
                    
                    <button class="bundle-btn" data-bundle="Cookbook Delights">Add to Cart</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="section-header">
            <h2 class="section-title">Why Choose Our Bundles?</h2>
        </div>
        
        <div class="features-container">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-percentage"></i>
                </div>
                <h3 class="feature-title">Unbeatable Value</h3>
                <p class="feature-description">Get 50% off on carefully curated bundles that would cost much more when purchased individually.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="feature-title">Free Shipping</h3>
                <p class="feature-description">All bundle purchases come with free shipping to anywhere in the continental US.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="feature-title">Handpicked Selections</h3>
                <p class="feature-description">Our literary experts carefully select each book in our bundles to ensure a cohesive reading experience.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-undo"></i>
                </div>
                <h3 class="feature-title">30-Day Returns</h3>
                <p class="feature-description">Not satisfied with your bundle? Return it within 30 days for a full refund, no questions asked.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="section-header">
            <h2 class="section-title">What Our Readers Say</h2>
        </div>
        
        <div class="testimonials-container">
            <div class="testimonial-slider">
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"The Mystery Thriller Bundle kept me up all night! Each book was better than the last. At 50% off, it was an incredible deal."</p>
                    <div class="testimonial-author">
                        <img src="https://picsum.photos/seed/customer1/100/100.jpg" alt="Customer" class="author-avatar">
                        <div class="author-info">
                            <h4>Sarah Johnson</h4>
                            <p>Mystery Lover</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"I bought the Romance Collection as a gift for my wife and she absolutely loved it! The books were beautifully packaged and the stories were heartwarming."</p>
                    <div class="testimonial-author">
                        <img src="https://picsum.photos/seed/customer2/100/100.jpg" alt="Customer" class="author-avatar">
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <p>Happy Husband</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"As a sci-fi enthusiast, I was impressed with the selection in the Sci-Fi Adventure bundle. These are exactly the kind of mind-bending stories I love!"</p>
                    <div class="testimonial-author">
                        <img src="https://picsum.photos/seed/customer3/100/100.jpg" alt="Customer" class="author-avatar">
                        <div class="author-info">
                            <h4>Alex Rivera</h4>
                            <p>Sci-Fi Fan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Don't Miss Out on These Incredible Deals!</h2>
            <p class="cta-description">These limited-time bundles are flying off the shelves. Grab your favorite collection before the offer expires.</p>
            <a href="#bundles" class="cta-btn">Shop All Bundles</a>
        </div>
    </section>

    <!-- Footer -->
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
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Special Offers</a></li>
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
        // Countdown Timer
        function updateCountdown() {
            const now = new Date();
            const endDate = new Date();
            endDate.setDate(now.getDate() + 5); // 5 days from now
            endDate.setHours(23, 59, 59, 999);
            
            const timeLeft = endDate - now;
            
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
        }
        
        setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call
        
        // Cart functionality
        let cartCount = 0;
        const cartCountElement = document.querySelector('.cart-count');
        
        // Bundle buttons functionality
        document.querySelectorAll('.bundle-btn').forEach(button => {
            button.addEventListener('click', function() {
                const bundleName = this.getAttribute('data-bundle');
                
                // Update cart count
                cartCount++;
                cartCountElement.textContent = cartCount;
                
                // Create a notification element
                const notification = document.createElement('div');
                notification.style.position = 'fixed';
                notification.style.bottom = '20px';
                notification.style.right = '20px';
                notification.style.backgroundColor = 'var(--sale-color)';
                notification.style.color = 'white';
                notification.style.padding = '15px 25px';
                notification.style.borderRadius = '5px';
                notification.style.boxShadow = '0 5px 15px rgba(230, 57, 70, 0.3)';
                notification.style.zIndex = '1000';
                notification.style.transform = 'translateX(150%)';
                notification.style.transition = 'transform 0.3s ease-out';
                notification.textContent = `"${bundleName}" has been added to your cart!`;
                
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
                
                // Button animation
                this.style.transform = 'scale(0.95)';
                this.textContent = 'Added!';
                this.style.backgroundColor = 'var(--sale-color)';
                
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                    this.textContent = 'Add to Cart';
                    this.style.backgroundColor = '';
                }, 1500);
            });
        });
        
        // Smooth scroll for CTA button
        document.querySelector('.cta-btn').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('.bundles-section').scrollIntoView({ behavior: 'smooth' });
        });
        
        // Testimonial slider
        const testimonialSlider = document.querySelector('.testimonial-slider');
        let isDown = false;
        let startX;
        let scrollLeft;
        
        testimonialSlider.addEventListener('mousedown', (e) => {
            isDown = true;
            testimonialSlider.style.cursor = 'grabbing';
            startX = e.pageX - testimonialSlider.offsetLeft;
            scrollLeft = testimonialSlider.scrollLeft;
        });
        
        testimonialSlider.addEventListener('mouseleave', () => {
            isDown = false;
            testimonialSlider.style.cursor = 'grab';
        });
        
        testimonialSlider.addEventListener('mouseup', () => {
            isDown = false;
            testimonialSlider.style.cursor = 'grab';
        });
        
        testimonialSlider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - testimonialSlider.offsetLeft;
            const walk = (x - startX) * 2;
            testimonialSlider.scrollLeft = scrollLeft - walk;
        });
    </script>
</body>
</html>