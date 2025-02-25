<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Heritage - Cộng đồng</title>
    <link rel="stylesheet" href="styless.css">
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
    background-color: #222;
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
    background-color: #575757;
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

    </style>
</head>
<body>
<?php include 'congdong/nav.php'; ?>
    <main>
        <section id="map">
            <h2>Bản đồ & Hướng dẫn viên cộng đồng</h2>
            <p>Khám phá bản đồ di sản với hướng dẫn viên và đánh giá từ cộng đồng.</p>
            <img src="images/map.jpg" alt="Bản đồ di sản" width="100%">
            <a href="map.php">Xem bản đồ</a>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2025 Global Heritage. All rights reserved.</p>
    </footer>
</body>
</html>

