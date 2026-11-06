# 📖 eBooks Admin Panel

A full-featured PHP admin panel for your eBooks project.

---

## 📁 File Structure

```
ebooks-admin/
├── config.php              ← DB config & helper functions
├── database.sql            ← Full database schema + sample data
├── login.php               ← Admin login
├── logout.php              ← Logout & session destroy
├── dashboard.php           ← Overview stats & activity
├── manage_books.php        ← Books list with search/filter/sort
├── add_book.php            ← Add new book form
├── edit_book.php           ← Edit existing book
├── manage_orders.php       ← Orders with inline status update
├── manage_users.php        ← User management (activate/suspend/delete)
├── competitions.php        ← Create & manage writing competitions
├── view_submissions.php    ← Review competition submissions
├── includes/
│   ├── header.php          ← Shared layout, nav, CSS design system
│   └── footer.php          ← Shared scripts & closing tags
└── uploads/
    ├── covers/             ← Book cover images
    ├── books/              ← Book files (PDF/EPUB/MOBI)
    └── submissions/        ← Competition submission files
```

---

## ⚙️ Setup Instructions

### 1. Database
```sql
-- Import in phpMyAdmin or run in MySQL:
source database.sql;
```

### 2. Configure DB credentials
Open `config.php` and update:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'ebooks_db');
```

### 3. Upload the folder
Place the `ebooks-admin/` folder in your web root:
- **XAMPP**: `C:/xampp/htdocs/ebooks-admin/`
- **WAMP**: `C:/wamp/www/ebooks-admin/`
- **Linux**: `/var/www/html/ebooks-admin/`

### 4. Set upload permissions
```bash
chmod 755 uploads/ uploads/covers/ uploads/books/ uploads/submissions/
```

### 5. Login
Visit: `http://localhost/ebooks-admin/login.php`

**Default credentials:**
- Username: `admin`
- Password: `password`

> ⚠️ Change the default password immediately in production!

---

## 🔐 Security Notes for Production

1. **Change default admin password** — hash via `password_hash('newpass', PASSWORD_DEFAULT)`
2. **Enable HTTPS** — set `'secure' => true` in config.php session settings
3. **Move uploads outside web root** for sensitive book files
4. **Use environment variables** for DB credentials instead of hardcoding
5. **Add CSRF tokens** to all forms for extra protection

---

## ✨ Features

| Feature | Details |
|---------|---------|
| Dashboard | Stats, recent orders, top books |
| Books | Full CRUD, cover upload, file upload, search, filter, sort, paginate |
| Orders | View orders, update order & payment status via modal |
| Users | View user stats, suspend/activate, delete |
| Competitions | Create, edit, delete writing competitions |
| Submissions | Review with approve/reject/winner decisions + judge notes |
| Auth | Secure login/logout with PHP sessions |

---

## 🛠 Tech Stack
- **Frontend**: Vanilla HTML, CSS, JavaScript (no frameworks)
- **Backend**: PHP 8.0+ with PDO
- **Database**: MySQL 5.7+ / MariaDB
