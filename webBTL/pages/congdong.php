<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Heritage - Cộng đồng</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Thiết lập thanh điều hướng ngang */
        nav {
            background-color: #333;
            padding: 10px 0;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
        }
        nav ul li a:hover {
            background-color: #575757;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Global Heritage - Cộng đồng</h1>
        <nav>
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="stories.php">Câu chuyện & Dự án</a></li>
                <li><a href="events.php">Sự kiện & Hoạt động</a></li>
                <li><a href="network.php">Mạng lưới kết nối</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section id="stories">
            <h2>Câu chuyện & Dự án cộng đồng</h2>
            <p>Nơi người dùng chia sẻ câu chuyện, hình ảnh, video về các di sản, đồng thời cập nhật các dự án bảo tồn và kêu gọi đóng góp.</p>
            <img src="images/stories.jpg" alt="Câu chuyện về di sản" width="100%">
            <a href="stories.php">Xem thêm</a>
        </section>
        
        <section id="events">
            <h2>Sự kiện & Hoạt động</h2>
            <p>Danh sách các sự kiện liên quan đến di sản, với tính năng đăng ký tham gia.</p>
            <img src="images/events.jpg" alt="Sự kiện di sản" width="100%">
            <a href="events.php">Xem sự kiện</a>
        </section>
        
        <section id="network">
            <h2>Mạng lưới kết nối</h2>
            <p>Diễn đàn hoặc hệ thống kết nối dành cho những người yêu thích di sản để thảo luận và hợp tác.</p>
            <img src="images/network.jpg" alt="Mạng lưới kết nối cộng đồng" width="100%">
            <a href="network.php">Tham gia ngay</a>
        </section>
        
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

