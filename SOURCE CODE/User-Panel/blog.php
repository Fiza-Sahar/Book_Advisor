<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Advisor Blog - Stories & Inspiration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 80px 0;
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
            background: url('https://picsum.photos/seed/books/1920/400.jpg') center/cover;
            opacity: 0.2;
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

        .featured-post {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
            animation: fadeInUp 0.8s ease-out 0.4s backwards;
        }

        .featured-post h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .featured-post .meta {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .featured-post .excerpt {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .read-more-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--gold-accent);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .read-more-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
        }

        /* Blog Container */
        .blog-container {
            max-width: 1200px;
            margin: 60px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 40px;
        }

        /* Blog Posts */
        .blog-posts {
            display: grid;
            gap: 40px;
        }

        .blog-post {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            animation: fadeIn 0.8s ease-out;
        }

        .blog-post:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .post-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .blog-post:hover .post-image {
            transform: scale(1.05);
        }

        .post-content {
            padding: 30px;
        }

        .post-category {
            display: inline-block;
            background-color: var(--accent-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .post-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: var(--primary-color);
            line-height: 1.3;
        }

        .post-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .post-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .post-excerpt {
            color: var(--text-color);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-name {
            font-weight: 600;
            color: var(--primary-color);
        }

        .post-actions {
            display: flex;
            gap: 15px;
        }

        .post-actions a {
            color: var(--secondary-color);
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        .post-actions a:hover {
            color: var(--primary-color);
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .sidebar-widget {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .widget-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .widget-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--gold-accent);
        }

        /* Search Widget */
        .search-box {
            display: flex;
            gap: 10px;
        }

        .search-box input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 0.9rem;
            transition: border-color 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .search-box button {
            padding: 12px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-box button:hover {
            background-color: var(--secondary-color);
        }

        /* Categories Widget */
        .categories-list {
            list-style: none;
        }

        .categories-list li {
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: padding-left 0.3s;
        }

        .categories-list li:hover {
            padding-left: 10px;
        }

        .categories-list li:last-child {
            border-bottom: none;
        }

        .categories-list a {
            color: var(--text-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .categories-list a:hover {
            color: var(--primary-color);
        }

        .category-count {
            background-color: var(--light-bg);
            color: var(--secondary-color);
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.8rem;
        }

        /* Recent Posts Widget */
        .recent-posts {
            display: grid;
            gap: 15px;
        }

        .recent-post {
            display: flex;
            gap: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .recent-post:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .recent-post-image {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .recent-post-content h4 {
            font-size: 0.95rem;
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .recent-post-content h4 a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .recent-post-content h4 a:hover {
            color: var(--secondary-color);
        }

        .recent-post-date {
            font-size: 0.8rem;
            color: var(--secondary-color);
        }

        /* Tags Widget */
        .tags-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tag {
            padding: 8px 15px;
            background-color: var(--light-bg);
            color: var(--secondary-color);
            border-radius: 20px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .tag:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Newsletter Widget */
        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .newsletter-form input {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 0.9rem;
            transition: border-color 0.3s;
        }

        .newsletter-form input:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .newsletter-form button {
            padding: 12px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.3s;
        }

        .newsletter-form button:hover {
            transform: translateY(-2px);
        }

        /* Load More Button */
        .load-more-container {
            text-align: center;
            margin-top: 50px;
        }

        .load-more-btn {
            padding: 15px 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(74, 48, 37, 0.3);
        }

        .load-more-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(74, 48, 37, 0.4);
        }

        /* Footer */
        footer {
            background-color: var(--dark-bg);
            color: white;
            padding: 50px 0 20px;
            margin-top: 80px;
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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .blog-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .blog-container {
                margin: 40px auto;
            }

            .post-title {
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
                padding: 60px 0;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .featured-post {
                padding: 20px;
            }

            .post-content {
                padding: 20px;
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
                <li><a href="#" class="active">BLOG</a></li>
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
            <h1>Discover Stories That Inspire</h1>
            <p>Immerse yourself in a world of literature, insights, and literary adventures</p>
            
            <div class="featured-post">
                <h2>The Art of Slow Reading: Rediscovering Joy in Pages</h2>
                <div class="meta">
                    <span><i class="far fa-calendar"></i> March 30, 2024</span>
                    <span><i class="far fa-clock"></i> 8 min read</span>
                    <span><i class="far fa-comment"></i> 24 comments</span>
                </div>
                <p class="excerpt">In our fast-paced digital world, the art of slow reading offers a sanctuary for the mind and soul. Discover how taking time with books can transform your reading experience...</p>
                <a href="#" class="read-more-btn">Read Full Story</a>
            </div>
        </div>
    </section>

    <!-- Blog Container -->
    <div class="blog-container">
        <!-- Blog Posts -->
        <main class="blog-posts">
            <article class="blog-post">
                <img src="https://picsum.photos/seed/blog1/800/400.jpg" alt="Blog post image" class="post-image">
                <div class="post-content">
                    <span class="post-category">LITERARY TRENDS</span>
                    <h2 class="post-title">How Book Clubs Are Revolutionizing Modern Reading Culture</h2>
                    <div class="post-meta">
                        <span><i class="far fa-user"></i> Sarah Mitchell</span>
                        <span><i class="far fa-calendar"></i> March 28, 2024</span>
                        <span><i class="far fa-clock"></i> 5 min read</span>
                    </div>
                    <p class="post-excerpt">Book clubs have evolved from casual gatherings to powerful cultural phenomena. Explore how these literary communities are shaping the way we read, discuss, and connect with stories in the digital age...</p>
                    <div class="post-footer">
                        <div class="author-info">
                            <img src="https://picsum.photos/seed/author1/100/100.jpg" alt="Author" class="author-avatar">
                            <span class="author-name">Sarah Mitchell</span>
                        </div>
                        <div class="post-actions">
                            <a href="#"><i class="far fa-heart"></i></a>
                            <a href="#"><i class="far fa-comment"></i></a>
                            <a href="#"><i class="far fa-bookmark"></i></a>
                            <a href="#"><i class="fas fa-share-alt"></i></a>
                        </div>
                    </div>
                </div>
            </article>

            <article class="blog-post">
                <img src="https://picsum.photos/seed/blog2/800/400.jpg" alt="Blog post image" class="post-image">
                <div class="post-content">
                    <span class="post-category">AUTHOR INTERVIEWS</span>
                    <h2 class="post-title">Behind the Pages: A Conversation with Bestselling Author Elena Rodriguez</h2>
                    <div class="post-meta">
                        <span><i class="far fa-user"></i> Michael Chen</span>
                        <span><i class="far fa-calendar"></i> March 25, 2024</span>
                        <span><i class="far fa-clock"></i> 10 min read</span>
                    </div>
                    <p class="post-excerpt">Elena Rodriguez opens up about her creative process, the inspiration behind her latest masterpiece, and what it means to write stories that resonate across generations...</p>
                    <div class="post-footer">
                        <div class="author-info">
                            <img src="https://picsum.photos/seed/author2/100/100.jpg" alt="Author" class="author-avatar">
                            <span class="author-name">Michael Chen</span>
                        </div>
                        <div class="post-actions">
                            <a href="#"><i class="far fa-heart"></i></a>
                            <a href="#"><i class="far fa-comment"></i></a>
                            <a href="#"><i class="far fa-bookmark"></i></a>
                            <a href="#"><i class="fas fa-share-alt"></i></a>
                        </div>
                    </div>
                </div>
            </article>

            <article class="blog-post">
                <img src="https://picsum.photos/seed/blog3/800/400.jpg" alt="Blog post image" class="post-image">
                <div class="post-content">
                    <span class="post-category">READING TIPS</span>
                    <h2 class="post-title">Creating Your Perfect Reading Nook: Design Ideas for Book Lovers</h2>
                    <div class="post-meta">
                        <span><i class="far fa-user"></i> Emma Thompson</span>
                        <span><i class="far fa-calendar"></i> March 22, 2024</span>
                        <span><i class="far fa-clock"></i> 6 min read</span>
                    </div>
                    <p class="post-excerpt">Transform any corner of your home into a magical reading sanctuary. From lighting choices to comfortable seating, discover the essential elements for creating your perfect reading nook...</p>
                    <div class="post-footer">
                        <div class="author-info">
                            <img src="https://picsum.photos/seed/author3/100/100.jpg" alt="Author" class="author-avatar">
                            <span class="author-name">Emma Thompson</span>
                        </div>
                        <div class="post-actions">
                            <a href="#"><i class="far fa-heart"></i></a>
                            <a href="#"><i class="far fa-comment"></i></a>
                            <a href="#"><i class="far fa-bookmark"></i></a>
                            <a href="#"><i class="fas fa-share-alt"></i></a>
                        </div>
                    </div>
                </div>
            </article>

            <div class="load-more-container">
                <button class="load-more-btn">Load More Articles</button>
            </div>
        </main>

        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Search Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Search</h3>
                <div class="search-box">
                    <input type="text" placeholder="Search articles...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <!-- Categories Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Categories</h3>
                <ul class="categories-list">
                    <li>
                        <a href="#">Literary Trends</a>
                        <span class="category-count">12</span>
                    </li>
                    <li>
                        <a href="#">Author Interviews</a>
                        <span class="category-count">8</span>
                    </li>
                    <li>
                        <a href="#">Reading Tips</a>
                        <span class="category-count">15</span>
                    </li>
                    <li>
                        <a href="#">Book Reviews</a>
                        <span class="category-count">23</span>
                    </li>
                    <li>
                        <a href="#">Writing Advice</a>
                        <span class="category-count">9</span>
                    </li>
                </ul>
            </div>

            <!-- Recent Posts Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Recent Posts</h3>
                <div class="recent-posts">
                    <div class="recent-post">
                        <img src="https://picsum.photos/seed/recent1/100/100.jpg" alt="Recent post" class="recent-post-image">
                        <div class="recent-post-content">
                            <h4><a href="#">The Rise of Audiobooks in Digital Age</a></h4>
                            <span class="recent-post-date">March 20, 2024</span>
                        </div>
                    </div>
                    <div class="recent-post">
                        <img src="https://picsum.photos/seed/recent2/100/100.jpg" alt="Recent post" class="recent-post-image">
                        <div class="recent-post-content">
                            <h4><a href="#">Classic Books Worth Revisiting</a></h4>
                            <span class="recent-post-date">March 18, 2024</span>
                        </div>
                    </div>
                    <div class="recent-post">
                        <img src="https://picsum.photos/seed/recent3/100/100.jpg" alt="Recent post" class="recent-post-image">
                        <div class="recent-post-content">
                            <h4><a href="#">How to Build a Personal Library</a></h4>
                            <span class="recent-post-date">March 15, 2024</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tags Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Popular Tags</h3>
                <div class="tags-cloud">
                    <a href="#" class="tag">Fiction</a>
                    <a href="#" class="tag">Mystery</a>
                    <a href="#" class="tag">Romance</a>
                    <a href="#" class="tag">Sci-Fi</a>
                    <a href="#" class="tag">Biography</a>
                    <a href="#" class="tag">Poetry</a>
                    <a href="#" class="tag">History</a>
                    <a href="#" class="tag">Self-Help</a>
                </div>
            </div>

            <!-- Newsletter Widget -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Newsletter</h3>
                <p>Subscribe to get the latest book recommendations and reading tips delivered to your inbox.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </aside>
    </div>

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
        // Load more functionality
        const loadMoreBtn = document.querySelector('.load-more-btn');
        const blogPosts = document.querySelector('.blog-posts');
        let postsLoaded = 3;

        loadMoreBtn.addEventListener('click', function() {
            // Simulate loading more posts
            const newPosts = [
                {
                    image: 'blog4',
                    category: 'BOOK REVIEWS',
                    title: 'The Midnight Library: A Journey Through Infinite Possibilities',
                    author: 'David Park',
                    date: 'March 20, 2024',
                    readTime: '7 min read',
                    excerpt: 'Matt Haig\'s masterpiece explores the concept of parallel lives and the choices that define us. A profound meditation on regret, hope, and the infinite paths our lives could take...',
                    authorImage: 'author4'
                },
                {
                    image: 'blog5',
                    category: 'WRITING ADVICE',
                    title: 'Finding Your Voice: Essential Tips for Aspiring Writers',
                    author: 'Lisa Anderson',
                    date: 'March 18, 2024',
                    readTime: '9 min read',
                    excerpt: 'Every writer struggles with finding their unique voice. Discover practical techniques and exercises to help you develop your authentic writing style and connect with readers...',
                    authorImage: 'author5'
                }
            ];

            newPosts.forEach(post => {
                const article = document.createElement('article');
                article.className = 'blog-post';
                article.style.opacity = '0';
                article.innerHTML = `
                    <img src="https://picsum.photos/seed/${post.image}/800/400.jpg" alt="Blog post image" class="post-image">
                    <div class="post-content">
                        <span class="post-category">${post.category}</span>
                        <h2 class="post-title">${post.title}</h2>
                        <div class="post-meta">
                            <span><i class="far fa-user"></i> ${post.author}</span>
                            <span><i class="far fa-calendar"></i> ${post.date}</span>
                            <span><i class="far fa-clock"></i> ${post.readTime}</span>
                        </div>
                        <p class="post-excerpt">${post.excerpt}</p>
                        <div class="post-footer">
                            <div class="author-info">
                                <img src="https://picsum.photos/seed/${post.authorImage}/100/100.jpg" alt="Author" class="author-avatar">
                                <span class="author-name">${post.author}</span>
                            </div>
                            <div class="post-actions">
                                <a href="#"><i class="far fa-heart"></i></a>
                                <a href="#"><i class="far fa-comment"></i></a>
                                <a href="#"><i class="far fa-bookmark"></i></a>
                                <a href="#"><i class="fas fa-share-alt"></i></a>
                            </div>
                        </div>
                    </div>
                `;
                
                blogPosts.insertBefore(article, loadMoreBtn.parentElement);
                
                // Animate in
                setTimeout(() => {
                    article.style.transition = 'opacity 0.5s';
                    article.style.opacity = '1';
                }, 100);
            });

            postsLoaded += 2;
            
            // Hide button after loading enough posts
            if (postsLoaded >= 7) {
                loadMoreBtn.style.display = 'none';
            }
        });

        // Newsletter subscription
        document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            // Create success message
            const successMsg = document.createElement('div');
            successMsg.style.position = 'fixed';
            successMsg.style.top = '100px';
            successMsg.style.right = '20px';
            successMsg.style.backgroundColor = '#4CAF50';
            successMsg.style.color = 'white';
            successMsg.style.padding = '15px 25px';
            successMsg.style.borderRadius = '5px';
            successMsg.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
            successMsg.style.zIndex = '1000';
            successMsg.style.transform = 'translateX(150%)';
            successMsg.style.transition = 'transform 0.3s ease-out';
            successMsg.textContent = `Successfully subscribed with ${email}!`;
            
            document.body.appendChild(successMsg);
            
            // Animate in
            setTimeout(() => {
                successMsg.style.transform = 'translateX(0)';
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                successMsg.style.transform = 'translateX(150%)';
                setTimeout(() => {
                    document.body.removeChild(successMsg);
                }, 300);
            }, 3000);
            
            // Clear form
            this.reset();
        });

        // Search functionality
        document.querySelector('.search-box button').addEventListener('click', function(e) {
            e.preventDefault();
            const searchTerm = document.querySelector('.search-box input').value;
            if (searchTerm) {
                // Create search notification
                const searchMsg = document.createElement('div');
                searchMsg.style.position = 'fixed';
                searchMsg.style.top = '100px';
                searchMsg.style.right = '20px';
                searchMsg.style.backgroundColor = 'var(--primary-color)';
                searchMsg.style.color = 'white';
                searchMsg.style.padding = '15px 25px';
                searchMsg.style.borderRadius = '5px';
                searchMsg.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
                searchMsg.style.zIndex = '1000';
                searchMsg.style.transform = 'translateX(150%)';
                searchMsg.style.transition = 'transform 0.3s ease-out';
                searchMsg.textContent = `Searching for "${searchTerm}"...`;
                
                document.body.appendChild(searchMsg);
                
                // Animate in
                setTimeout(() => {
                    searchMsg.style.transform = 'translateX(0)';
                }, 100);
                
                // Remove after 2 seconds
                setTimeout(() => {
                    searchMsg.style.transform = 'translateX(150%)';
                    setTimeout(() => {
                        document.body.removeChild(searchMsg);
                    }, 300);
                }, 2000);
            }
        });

        // Post interaction buttons
        document.querySelectorAll('.post-actions a').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const icon = this.querySelector('i');
                
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.style.color = 'var(--primary-color)';
                } else if (icon.classList.contains('fas')) {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.style.color = 'var(--secondary-color)';
                }
            });
        });
    </script>
</body>
</html>