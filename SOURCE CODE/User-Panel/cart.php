<?php
include("connection.php");
if (session_status() === PHP_SESSION_NONE) session_start();

// Cart item remove
if (isset($_GET['remove'])) {
    $rid = (int)$_GET['remove'];
    unset($_SESSION['cart'][$rid]);
    header('Location: cart.php');
    exit;
}

// Cart data
$cart        = $_SESSION['cart'] ?? [];
$grand_total = 0;
foreach ($cart as $item) {
    $grand_total += $item['price'] * $item['quantity'];
}

// Order place karna
$order_error   = '';
$order_success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $fullname = trim($_POST['fullname'] ?? '');
    $address  = trim($_POST['address']  ?? '');
    $city     = trim($_POST['city']     ?? '');
    $state    = trim($_POST['state']    ?? '');
    $pincode  = trim($_POST['pincode']  ?? '');
    $mobile   = trim($_POST['mobile']   ?? '');

    if (empty($fullname) || empty($address) || empty($city) || empty($mobile)) {
        $order_error = 'Please fill in all required fields.';
    } elseif (empty($cart)) {
        $order_error = 'Your cart is empty!';
    } else {
        // Book names list banao
        $book_names = implode(', ', array_column($cart, 'name'));
        $user_id    = $_SESSION['user_id'] ?? 0;

        $fn  = mysqli_real_escape_string($con, $fullname);
        $ad  = mysqli_real_escape_string($con, $address);
        $ct  = mysqli_real_escape_string($con, $city);
        $st  = mysqli_real_escape_string($con, $state);
        $pin = mysqli_real_escape_string($con, $pincode);
        $mob = mysqli_real_escape_string($con, $mobile);
        $bn  = mysqli_real_escape_string($con, $book_names);

        $sql = "INSERT INTO order_table
                    (order_name, order_address, order_city, order_state, order_pincode, order_mobile, order_register_id, order_total_price, order_list_books)
                VALUES
                    ('$fn', '$ad', '$ct', '$st', '$pin', '$mob', $user_id, $grand_total, '$bn')";

        if (mysqli_query($con, $sql)) {
            $order_id = mysqli_insert_id($con);

            // order_items table mein bhi insert karo (agar exist karta hai)
            foreach ($cart as $item) {
                $bid   = (int)$item['book_id'];
                $qty   = (int)$item['quantity'];
                $price = (float)$item['price'];
                @mysqli_query($con, "INSERT INTO order_items (order_id, book_id, quantity, price) VALUES ($order_id, $bid, $qty, $price)");

                // Download count update
                mysqli_query($con, "UPDATE book_table SET download_count = download_count + $qty WHERE book_id = $bid");
            }

            // Cart clear
            $_SESSION['cart'] = [];
            $order_success = "🎉 Order #$order_id placed successfully! Thank you for your purchase.";
            $cart        = [];
            $grand_total = 0;
        } else {
            $order_error = 'Order failed. Please try again.';
        }
    }
}

include("./shared1/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK ADVISOR | Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --black-primary: #000000;
            --brown-hover: #7d5a44;
            --bg-cream: #fdfaf7;
        }
        body { background-color: var(--bg-cream); font-family: 'Segoe UI', sans-serif; }
        .main-wrapper {
            display: grid; grid-template-columns: 1.6fr 1fr; gap: 30px;
            padding: 40px 8%; max-width: 1300px; margin: 0 auto;
        }
        .card {
            background: #fff; padding: 30px; border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            margin-bottom: 25px; border: 1px solid #f0e6dd;
        }
        .cart-item {
            display: flex; align-items: center; gap: 16px;
            padding: 16px 0; border-bottom: 1px solid #f0e6dd;
        }
        .cart-item img {
            width: 60px; height: 80px; object-fit: cover;
            border-radius: 6px; border: 1px solid #eee;
        }
        .cart-item .item-info { flex: 1; }
        .cart-item .item-name { font-weight: 700; font-size: 0.95rem; margin-bottom: 4px; }
        .cart-item .item-price { color: #7d5a44; font-weight: 600; }
        .cart-item .remove-btn {
            color: #c62828; background: none; border: none;
            cursor: pointer; font-size: 1.1rem; padding: 4px 8px;
        }
        .input-box {
            width: 100%; padding: 12px; margin: 8px 0;
            border: 1.5px solid #e0d0c8; border-radius: 10px;
            font-size: 0.9rem; outline: none;
            font-family: 'Segoe UI', sans-serif;
        }
        .input-box:focus { border-color: #5D4037; }
        .input-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .btn-action {
            background: var(--brown-hover); color: white; border: none;
            padding: 15px 30px; border-radius: 12px; font-weight: 800;
            cursor: pointer; transition: 0.3s; width: 100%; margin-top: 10px;
            font-size: 1rem; font-family: 'Segoe UI', sans-serif;
        }
        .btn-action:hover { background: var(--black-primary); }
        .btn-action.dark { background: #3d2b1f; }
        .btn-action.dark:hover { background: #000; }
        .alert-success {
            background: #e8f5e9; border: 1px solid #a5d6a7;
            color: #2e7d32; padding: 16px 20px; border-radius: 10px;
            margin-bottom: 20px; font-weight: 600;
        }
        .alert-error {
            background: #fff0f0; border: 1px solid #ffcdd2;
            color: #c62828; padding: 16px 20px; border-radius: 10px;
            margin-bottom: 20px;
        }
        .empty-cart {
            text-align: center; padding: 60px 20px; color: #999;
        }
        .empty-cart a {
            display: inline-block; margin-top: 16px;
            padding: 12px 28px; background: #5D4037;
            color: #fff; border-radius: 10px; text-decoration: none;
            font-weight: 600;
        }
        @media(max-width:768px) {
            .main-wrapper { grid-template-columns: 1fr; }
            .input-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="main-wrapper">

    <?php if ($order_success): ?>
    <div style="grid-column:1/-1">
        <div class="alert-success"><?= $order_success ?></div>
        <div style="text-align:center; padding:20px">
            <a href="shop.php" style="padding:14px 32px; background:#5D4037; color:#fff; border-radius:10px; text-decoration:none; font-weight:700">
                Continue Shopping →
            </a>
        </div>
    </div>

    <?php else: ?>

    <!-- LEFT: CART ITEMS + SHIPPING -->
    <div class="left-section">

        <!-- CART ITEMS -->
        <div class="card">
            <h3 style="margin-bottom:16px">🛒 Your Cart
                <span style="font-size:0.85rem; color:#999; font-weight:400">
                    (<?= count($cart) ?> item<?= count($cart) != 1 ? 's' : '' ?>)
                </span>
            </h3>

            <?php if (empty($cart)): ?>
            <div class="empty-cart">
                <div style="font-size:3rem">🛒</div>
                <p>Your cart is empty!</p>
                <a href="shop.php">Browse Books</a>
            </div>
            <?php else: ?>
                <?php foreach ($cart as $id => $item): ?>
                <div class="cart-item">
                    <?php if (!empty($item['img'])): ?>
                        <img src="<?= htmlspecialchars($item['img']) ?>"
                             onerror="this.src='https://via.placeholder.com/60x80/5D4037/fff?text=📖'">
                    <?php else: ?>
                        <div style="width:60px; height:80px; background:#f5ede8; border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:1.5rem">📖</div>
                    <?php endif; ?>

                    <div class="item-info">
                        <div class="item-name"><?= htmlspecialchars($item['name']) ?></div>
                        <div class="item-price">
                            <?php if ($item['price'] == 0): ?>
                                <span style="color:#2e7d32">FREE</span>
                            <?php else: ?>
                                $<?= number_format($item['price'], 2) ?>
                                × <?= $item['quantity'] ?>
                                = <strong>$<?= number_format($item['price'] * $item['quantity'], 2) ?></strong>
                            <?php endif; ?>
                        </div>
                    </div>
                    <a href="cart.php?remove=<?= $id ?>" class="remove-btn" title="Remove">✕</a>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if (!empty($cart)): ?>
        <!-- SHIPPING FORM -->
        <div class="card">
            <h3 style="margin-bottom:16px">📍 Shipping Information</h3>

            <?php if ($order_error): ?>
            <div class="alert-error">⚠️ <?= htmlspecialchars($order_error) ?></div>
            <?php endif; ?>

            <form method="POST" action="cart.php">
                <input type="text" name="fullname" class="input-box"
                       placeholder="Full Name *"
                       value="<?= htmlspecialchars($_SESSION['user_fullname'] ?? '') ?>" required>

                <input type="text" name="address" class="input-box"
                       placeholder="Street Address *" required>

                <div class="input-row">
                    <input type="text" name="city"    class="input-box" placeholder="City *" required>
                    <input type="text" name="state"   class="input-box" placeholder="State">
                </div>
                <div class="input-row">
                    <input type="text" name="pincode" class="input-box" placeholder="Pincode / ZIP">
                    <input type="text" name="mobile"  class="input-box"
                           placeholder="Mobile Number *"
                           value="<?= htmlspecialchars($_SESSION['user_phone'] ?? '') ?>" required>
                </div>

                <button type="submit" name="place_order" class="btn-action dark">
                    ✅ Place Order — $<?= number_format($grand_total, 2) ?>
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <!-- RIGHT: ORDER SUMMARY -->
    <div class="right-section">
        <div class="card">
            <h3 style="margin-bottom:20px">Order Summary</h3>

            <?php foreach ($cart as $item): ?>
            <div style="display:flex; justify-content:space-between; margin-bottom:10px; font-size:0.9rem">
                <span><?= htmlspecialchars($item['name']) ?> × <?= $item['quantity'] ?></span>
                <span>
                    <?php if ($item['price'] == 0): ?>
                        <span style="color:#2e7d32">FREE</span>
                    <?php else: ?>
                        $<?= number_format($item['price'] * $item['quantity'], 2) ?>
                    <?php endif; ?>
                </span>
            </div>
            <?php endforeach; ?>

            <hr style="border:none; border-top:1px solid #f0e6dd; margin:16px 0">

            <div style="display:flex; justify-content:space-between; font-size:1.5rem; font-weight:900; color:#000">
                <span>Total:</span>
                <span>$<?= number_format($grand_total, 2) ?></span>
            </div>

            <?php if (!empty($cart)): ?>
            <a href="shop.php" style="display:block; text-align:center; margin-top:16px; color:#7d5a44; text-decoration:none; font-size:0.9rem">
                ← Continue Shopping
            </a>
            <?php endif; ?>
        </div>
    </div>

    <?php endif; ?>
</div>

<?php include("./shared1/footer.php"); ?>
</body>
</html>
