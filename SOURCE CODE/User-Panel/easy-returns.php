<?php
// Include database connection and navigation
include("connection.php");
include("shared1/nav.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Easy Returns - Premium Packaging</title>
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
    

<div class="hero">
    <h1>EASY RETURNS</h1>
    <p>30-day return policy for your peace of mind — hassle-free and convenient.</p>
</div>

<div class="container">
    <div class="card">
        <h2>Simple Return Process</h2>
        <p>Returning your packaging products is straightforward — we make it easy and quick.</p>
        <ul>
            <li>✔ 30-day return window</li>
            <li>✔ Easy request through our system</li>
            <li>✔ Clear instructions for packaging returns</li>
        </ul>
    </div>

    <div class="card">
        <h2>Fast Refunds</h2>
        <p>Once we receive your returned items, we process your refund quickly so you’re not waiting.</p>
        <ul>
            <li>✔ Refund in original payment method</li>
            <li>✔ Transparent refund tracking</li>
            <li>✔ No hidden fees or delays</li>
        </ul>
    </div>

    <div class="card">
        <h2>Customer Support</h2>
        <p>Our support team is ready to assist you with any return questions or concerns.</p>
        <a href="contact.php" class="btn-theme">Contact Support</a>
    </div>
</div>

<?php include("shared1/footer.php"); ?>

</body>
</html>