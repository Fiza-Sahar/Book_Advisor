<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@300;400;500&display=swap');

    .custom-footer {
        background-color: #4a2c21; /* Rich Dark Brown */
        color: #d2b48c; 
        padding: 60px 0 30px 0;
        font-family: 'Montserrat', sans-serif;
        border-top: 4px solid #b08d57;
        margin-top: 50px;
        width: 100%;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.5fr 1fr 1.2fr;
        gap: 50px;
        padding: 0 40px;
    }

    .footer-col h3 {
        color: #b08d57;
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        margin-bottom: 25px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Fixed Social Icons - Alignment Fix */
    .social-row {
        display: flex;
        gap: 15px;
        margin-top: 25px;
        align-items: center;
        justify-content: flex-start;
    }

    .social-circle {
        width: 42px; /* Fixed Size */
        height: 42px; /* Fixed Size */
        background: rgba(255, 255, 255, 0.1); 
        display: flex; /* Flexbox centering */
        align-items: center; /* Vertical Center */
        justify-content: center; /* Horizontal Center */
        border-radius: 50%; /* Perfect Circle */
        color: #fff;
        text-decoration: none;
        font-size: 1.1rem;
        transition: 0.4s ease;
        flex-shrink: 0; /* Isse circle oval nahi banega */
        border: 1px solid transparent;
    }

    .social-circle:hover {
        background: #b08d57;
        color: #4a2c21;
        transform: translateY(-5px);
        border-color: #d2b48c;
    }

    /* Icon centering specific fix */
    .social-circle i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .footer-bottom-line {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 50px;
        padding-top: 25px;
        text-align: center;
        font-size: 0.85rem;
        color: #a38d7a;
    }
</style>

<footer class="custom-footer">
    <div class="footer-container">
        <div class="footer-col">
            <h3>BOOK ADVISOR</h3>
            <p>Curating the finest stories for the modern reader. Step into a world of imagination and luxury reading.</p>
        </div>

        <div class="footer-col">
            <h3>QUICK LINKS</h3>
            <ul style="list-style:none; padding:0; margin:0;">
                <li style="margin-bottom:12px;"><a href="index.php" style="color:#c9af98; text-decoration:none;">Home</a></li>
                <li style="margin-bottom:12px;"><a href="shop.php" style="color:#c9af98; text-decoration:none;">Shop Collection</a></li>
                <li style="margin-bottom:12px;"><a href="about.php" style="color:#c9af98; text-decoration:none;">About Us</a></li>
                <li style="margin-bottom:12px;"><a href="contact.php" style="color:#c9af98; text-decoration:none;">Contact Support</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>CONNECT</h3>
            <p>support@bookadvisor.com</p>
            <p>+1 234 567 890</p>
            <div class="social-row">
                <a href="#" class="social-circle"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-circle"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-circle"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-circle"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom-line">
        &copy; 2026 Book Advisor. All Rights Reserved. Designed with Love.
    </div>
</footer>

</body>
</html>