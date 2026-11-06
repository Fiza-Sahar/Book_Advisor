<?php
include("connection.php");
if (session_status() === PHP_SESSION_NONE) session_start();

// Cart mein add karne ka logic
if (isset($_POST['add_to_cart'])) {
    $book_id = (int)$_POST['book_id'];
    $name    = htmlspecialchars($_POST['book_name']);
    $price   = (float)$_POST['book_price'];
    $img     = htmlspecialchars($_POST['book_img']);

    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    if (isset($_SESSION['cart'][$book_id])) {
        $_SESSION['cart'][$book_id]['quantity']++;
    } else {
        $_SESSION['cart'][$book_id] = [
            'book_id'  => $book_id,
            'name'     => $name,
            'price'    => $price,
            'img'      => $img,
            'quantity' => 1,
        ];
    }
    header('Location: shop.php');
    exit;
}

// Search & Filter
$search  = trim($_GET['search'] ?? '');
$type    = $_GET['type'] ?? '';
$where   = ['1=1'];

if ($search) {
    $s       = mysqli_real_escape_string($con, $search);
    $where[] = "(book_name LIKE '%$s%' OR book_author LIKE '%$s%')";
}
if ($type === 'free') $where[] = 'is_free = 1';
if ($type === 'paid') $where[] = 'is_free = 0';

$whereStr = implode(' AND ', $where);
$result   = mysqli_query($con, "SELECT * FROM book_table WHERE $whereStr ORDER BY book_time DESC");
$books    = mysqli_fetch_all($result, MYSQLI_ASSOC);

include("./shared1/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK ADVISOR | Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .filter-bar {
            display: flex; gap: 12px; align-items: center;
            padding: 20px 8%; flex-wrap: wrap;
            background: #fff; border-bottom: 1px solid #f0e6dd;
        }
        .filter-bar input {
            flex: 1; min-width: 200px; padding: 10px 16px;
            border: 1.5px solid #e0d0c8; border-radius: 8px;
            font-size: 0.9rem; outline: none;
        }
        .filter-bar input:focus { border-color: #5D4037; }
        .filter-bar select {
            padding: 10px 14px; border: 1.5px solid #e0d0c8;
            border-radius: 8px; font-size: 0.9rem;
            background: #fff; cursor: pointer; outline: none;
        }
        .filter-bar button {
            padding: 10px 22px; background: #5D4037; color: #fff;
            border: none; border-radius: 8px; cursor: pointer;
            font-weight: 600; transition: 0.2s;
        }
        .filter-bar button:hover { background: #3E2723; }
        .filter-bar a {
            padding: 10px 18px; border: 1.5px solid #e0d0c8;
            border-radius: 8px; text-decoration: none; color: #5D4037;
        }
        .empty-msg {
            text-align: center; padding: 60px 20px;
            color: #999; font-size: 1.1rem; grid-column: 1/-1;
        }
        .card-img-placeholder {
            width: 100%; aspect-ratio: 3/4;
            background: #f5ede8; display: flex;
            align-items: center; justify-content: center;
            font-size: 3rem;
        }
    </style>
</head>
<body>

<div id="loader">
    <div class="loader-book"></div>
    <h2 style="color:var(--accent-gold); margin-top:20px; font-family:'Cinzel'; letter-spacing:5px;">BOOK ADVISOR</h2>
</div>

<main class="fade-in-page">
    <div class="shop-banner fade-up" style="background-image: linear-gradient(rgba(62,39,35,0.4),rgba(62,39,35,0.4)), url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&w=1920&q=80');">
        <div>
            <h1 style="font-size:3.5rem; color:var(--accent-gold); margin-bottom:10px;">THE LIBRARY</h1>
            <p style="color:#fff;">Choose your destiny from thousands of titles.</p>
        </div>
    </div>

    <!-- FILTER BAR -->
    <form method="GET" action="shop.php" class="filter-bar">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
               placeholder="🔍 Search books, authors...">
        <select name="type">
            <option value="">All Books</option>
            <option value="free" <?= $type === 'free' ? 'selected' : '' ?>>Free Only</option>
            <option value="paid" <?= $type === 'paid' ? 'selected' : '' ?>>Paid Only</option>
        </select>
        <button type="submit">Search</button>
        <a href="shop.php">Reset</a>
    </form>

    <section>
        <div class="grid">
        <?php if (empty($books)): ?>
            <div class="empty-msg">📚 No books found. Admin se books add karwao!</div>
        <?php else: ?>
            <?php foreach ($books as $book): ?>
            <div class="card card-stagger">
                <?php if (!empty($book['book_img'])): ?>
                    <img src="<?= strpos($book['book_img'], 'http') === 0 ? htmlspecialchars($book['book_img']) : '../Admin-Panel/' . htmlspecialchars($book['book_img']) ?>" class="card-img"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div class="card-img-placeholder" style="display:none">📖</div>
                <?php else: ?>
                    <div class="card-img-placeholder">📖</div>
                <?php endif; ?>

                <div class="card-title"><?= htmlspecialchars($book['book_name']) ?></div>
                <div class="card-author"><?= htmlspecialchars($book['book_author']) ?></div>

                <div class="card-footer">
                    <?php if ($book['is_free'] == 1): ?>
                        <span class="price" style="color:#2e7d32; font-weight:700">FREE</span>
                    <?php else: ?>
                        <span class="price">$<?= number_format($book['book_price'], 2) ?></span>
                    <?php endif; ?>

                    <form method="POST" action="shop.php" style="display:inline; margin:0">
                        <input type="hidden" name="book_id"     value="<?= $book['book_id'] ?>">
                        <input type="hidden" name="book_name"   value="<?= htmlspecialchars($book['book_name']) ?>">
                        <input type="hidden" name="book_price"  value="<?= $book['is_free'] ? 0 : $book['book_price'] ?>">
                        <input type="hidden" name="book_img"    value="<?= htmlspecialchars($book['book_img'] ?? '') ?>">
                        <input type="hidden" name="add_to_cart" value="1">
                        <button type="submit" class="btn-add">ADD TO CART</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
    </section>
</main>

<div id="toast">Item Added to Cart!</div>

<?php include("shared1/footer.php"); ?>

<script>
window.addEventListener('load', () => {
    setTimeout(() => {
        document.getElementById('loader').style.opacity = '0';
        setTimeout(() => { document.getElementById('loader').style.display = 'none'; }, 800);
    }, 2000);
    checkAnimations();
});
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.15 });
function checkAnimations() {
    document.querySelectorAll('.fade-up, .card-stagger').forEach(el => observer.observe(el));
}
</script>
</body>
</html>
