<?php
// Include database connection and navigation
include("connection.php");
include("shared1/nav.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expert Advice - Premium Packaging</title>
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
    <h1>EXPERT ADVICE</h1>
    <p>Not sure which packaging fits your product best? Our experts are ready to guide you with personalized solutions.</p>
</div>

<!-- CONTENT -->
<div class="container">
    <div class="card">
        <h2>Consult with Specialists</h2>
        <p>Our packaging specialists can provide one-on-one advice tailored to your brand and products.</p>
        <ul>
            <li>✔ Personalized recommendations</li>
            <li>✔ Design guidance</li>
            <li>✔ Material selection</li>
            <li>✔ Sustainability advice</li>
        </ul>
    </div>

    <div class="card">
        <h2>Brand & Product Strategy</h2>
        <p>We help you choose packaging that enhances your product’s presentation and strengthens your brand identity.</p>
        <ul>
            <li>✔ Luxury packaging ideas</li>
            <li>✔ Eco-friendly options</li>
            <li>✔ Cost-effective solutions</li>
            <li>✔ Market trend insights</li>
        </ul>
    </div>

    <div class="card">
        <h2>Schedule a Consultation</h2>
        <p>Reach out to our experts to discuss your packaging needs and get professional guidance for your business.</p>
        <a href="contact.php" class="btn-theme">Contact an Expert</a>
    </div>
</div>

<?php include("shared1/footer.php"); ?>

</body>
</html>