<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Heritage - Cộng đồng</title>
    <style>
        /* Reset mặc định */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Thanh điều hướng */
nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color:#317873;
    padding: 15px 20px;
    position: sticky;
    top: 0;
    z-index: 1000;
}

/* Logo */
nav .logo a {
    color: #fff;
    font-size: 22px;
    font-weight: bold;
    text-decoration: none;
}

/* Danh sách menu */
.nav-links {
    list-style: none;
    display: flex;
}

.nav-links li {
    margin: 0 15px;
}

.nav-links a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    padding: 10px 15px;
    transition: background 0.3s ease, color 0.3s ease;
}

/* Hiệu ứng hover */
.nav-links a:hover {
    background-color:rgb(81, 150, 135);
    border-radius: 5px;
}

/* Trang hiện tại (active) */
.nav-links a.active {
    background-color: #ff9800;
    border-radius: 5px;
}

/* Nút menu cho mobile */
.menu-toggle {
    display: none;
    font-size: 30px;
    color: white;
    cursor: pointer;
}

/* Responsive: Hiển thị dạng menu dropdown trên màn hình nhỏ */
@media screen and (max-width: 768px) {
    .nav-links {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        right: 0;
        background: #333;
        width: 100%;
        text-align: center;
    }

    .nav-links li {
        padding: 15px;
        border-bottom: 1px solid #444;
    }

    .nav-links a {
        display: block;
    }

    .menu-toggle {
        display: block;
    }
}
/* Nội dung chính */
.content1 {
    padding: 40px 20px;
    text-align: center;
}

.intro {
    max-width: 800px;
    margin: 0 auto;
}

.highlights {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}

.cart {
    width: 30%;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.cart h3 {
    margin-bottom: 10px;
}

.cart a {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 12px;
    background: black;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

/* Footer */
footer {
    text-align: center;
    padding: 20px;
    background: black;
    color: white;
    margin-top: 40px;
}
    </style>
</head>
<body>
<?php include 'congdong/nav.php'; ?>
    <!-- Nội dung chính -->
    <main class="content1">
        <section class="intro">
            <h2>Chào mừng đến với Cộng đồng Di sản</h2>
            <p>Khám phá, kết nối và đóng góp vào việc bảo tồn di sản văn hóa trên khắp thế giới.</p>
        </section>

        <section class="highlights">
            <div class="cart">
                <h3>Bài viết mới nhất</h3>
                <p>Những câu chuyện chân thực từ cộng đồng về di sản văn hóa.</p>
                <a href="#">Xem thêm</a>
            </div>
            <div class="cart">
                <h3>Sự kiện sắp diễn ra</h3>
                <p>Các sự kiện kết nối những người yêu thích di sản.</p>
                <a href="#">Xem sự kiện</a>
            </div>
            <div class="cart">
                <h3>Dự án bảo tồn</h3>
                <p>Các sáng kiến từ cộng đồng nhằm bảo vệ di sản.</p>
                <a href="#">Xem dự án</a>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Global Heritage. All rights reserved.</p>
    </footer>
</body>
</html>

