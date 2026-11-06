<?php
// Include database connection and navigation (if needed)
include("connection.php");
include("shared1/nav.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Premium Packaging</title>
    <style>
        body {
            margin: 0;
            font-family: Georgia, serif;
            background-color: #f5efe9;
            color: #4a3b34;
        }

        /* HERO */
        .hero {
            background: #5a3e36;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }
        .hero h1 {
            font-size: 50px;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }
        .hero p {
            font-size: 18px;
            width: 60%;
            margin: auto;
        }

        /* CONTAINER */
        .container {
            width: 85%;
            margin: 70px auto;
        }

        /* CARD STYLE */
        .card {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 40px;
            text-align: center;
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .card h2 {
            color: #8b5e3c;
            margin-bottom: 20px;
            font-size: 28px;
        }
        .card p {
            line-height: 1.9;
            font-size: 16px;
        }
        .card ul {
            list-style: none;
            padding: 0;
            line-height: 2;
        }

        /* BUTTON */
        .btn-theme {
            display: inline-block;
            background: #8b5e3c;
            color: white;
            padding: 12px 35px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 25px;
            transition: 0.3s;
        }
        .btn-theme:hover {
            background: #6d4630;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<!-- HERO SECTION -->
<div class="hero">
    <h1>PREMIUM PACKAGING</h1>
    <p>High-quality, eco-friendly, and luxury packaging solutions tailored for your brand.</p>
</div>

<!-- CONTENT -->
<div class="container">
    <div class="card">
        <h2>Custom Packaging Solutions</h2>
        <p>We provide packaging designs that perfectly match your brand’s identity and product style.</p>
        <ul>
            <li>✔ Custom box designs</li>
            <li>✔ Eco-friendly materials</li>
            <li>✔ Premium quality printing</li>
            <li>✔ Fast and reliable delivery</li>
        </ul>
    </div>

    <div class="card">
        <h2>Luxury & Secure Packaging</h2>
        <p>Every package is crafted with care to ensure products reach your customers in perfect condition.</p>
        <a href="index.php" class="btn-theme">Return to Home</a>
    </div>
</div>

<?php include("shared1/footer.php"); ?>

</body>
</html>