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
    background-color:rgb(70, 135, 155);
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
    background-color:rgb(59, 105, 103);
    border-radius: 5px;
}

/* Trang hiện tại (active) */
.nav-links a.active {
    background-color: #ff9800;
    border-radius: 5px;
}
.banner {
    position: relative; /* Để phần chữ định vị so với ảnh */
    width: 100%;
    max-height: 500px; /* Điều chỉnh chiều cao theo ảnh */
    overflow: hidden;
}

.banner img {
    width: 100%;
    height: auto;
    display: block;
}

.overlay {
    position: absolute;
    top: 50%; /* Đưa chữ vào giữa */
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    text-align: center;
    
    padding: 20px;
    border-radius: 10px;
}

.overlay h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.overlay button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

    </style>
</head>
<body>
<?php include 'congdong/nav.php'; ?>
<div class="banner">
    <img src="./congdong/image_url/vltt.jpg" alt="Heritage Site">
    <div class="overlay">
        <h2>UNESCO recalls obligation to respect and protect the integrity of heritage sites</h2>
        <button>Read more</button>
    </div>
</div>

    
</body>
</html>

