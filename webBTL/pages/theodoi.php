<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Theo dõi</title>
    <style>
        /* ======= RESET & CƠ BẢN ======= */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-around;
            background-color: white;
            padding: 0px 200px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .logo {
            font-size: 30px;
            font-weight: bold;
            color: #b92b27;
        }
        .header-icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .search-bar {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 300px;
        }
        .taobaidang {
            background-color: #b92b27;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .taobaidang:hover {
            background-color: #a1201e;
        }
        .menu {
            background-color: white;
        }
        .menungang {
            list-style: none;
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
            white-space: nowrap;
        }
        .menungang li {
            display: inline;
        }
        .menungang a {
            padding: 10px;
            text-decoration: none;
            color: black;
        }
        /* ======= KHU VỰC CHÍNH ======= */
        .container {
            max-width: 960px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        }
        .container h2 {
            margin-top: 0;
        }
        /* ======= DANH SÁCH THEO DÕI ======= */
        .follow-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .follow-item {
            display: flex;
            align-items: center; /* căn giữa các phần */
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .follow-item:last-child {
            border-bottom: none;
        }
        .follow-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }
        .space-info {
            flex-grow: 1;
        }
        .space-info h3 {
            margin: 0;
            font-size: 16px; /* giảm một chút */
            color: #333;
        }
        .space-info h3 a {
            text-decoration: none;
            color: #333;
        }
        .space-info h3 a:hover {
            text-decoration: underline;
        }
        .space-info p {
            margin: 5px 0;
            color: #666;
            font-size: 13px; /* chữ nhỏ hơn */
            line-height: 1.4;
        }
        .follow-count {
            font-size: 13px; /* chữ nhỏ hơn */
            color: #999;
        }
        /* ======= NÚT THEO DÕI ======= */
        .follow-btn {
            margin-left: auto; 
            align-self: center;
            background-color: #0073e6;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.2s;
            font-size: 14px;
        }
        .follow-btn:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Q&A</div>
        <div class="menu">
            <ul class="menungang">
                <li><a href="baidangketnoiq&a.php">Về Q&A</a></li>
                <li><a href="theodoi.php">Theo dõi</a></li>
                <li><a href="traloi.php">Trả lời</a></li>
                <li><a href="thongbao.php">Thông báo</a></li>
                <li><a href="../index.php">Home</a></li>
            </ul>
        </div>
        <div class="header-icons">
            <input type="text" class="search-bar" placeholder="Tìm kiếm...">
            <button class="taobaidang">Tạo bài đăng</button>
        </div>
    </div>

    <!-- KHU VỰC HIỂN THỊ DANH SÁCH CHỦ ĐỀ/ KHÔNG GIAN -->
    <div class="container">
        <h2>Theo dõi cộng đồng</h2>
        <p>Cộng đồng bạn có thể thích</p>
        <ul class="follow-list">
            <li class="follow-item">
                <img src="../assets/img/kientructhegioi.jpg" alt="Di sản Kiến trúc Thế giới" class="follow-avatar">
                <div class="space-info">
                    <h3><a href="#">Di sản Kiến trúc Thế giới</a></h3>
                    <p class="follow-count">169,5 nghìn người theo dõi</p>
                    <p>Khám phá những công trình kiến trúc mang tính biểu tượng và độc đáo từ khắp nơi trên thế giới.</p>
                </div>
                <button class="follow-btn">Theo dõi</button>
            </li>
            <li class="follow-item">
                <img src="../assets/img/hanhtrinhdisan.jpg" alt="Hành trình Di sản" class="follow-avatar">
                <div class="space-info">
                    <h3><a href="#">Hành trình Di sản</a></h3>
                    <p class="follow-count">137,8 nghìn người theo dõi</p>
                    <p>Cùng nhau chia sẻ những trải nghiệm, hình ảnh và câu chuyện về các di tích lịch sử và di sản văn hóa.</p>
                </div>
                <button class="follow-btn">Theo dõi</button>
            </li>
            <li class="follow-item">
                <img src="../assets/img/disanphivatthe.webp" alt="Văn hóa Di sản Phi vật thể" class="follow-avatar">
                <div class="space-info">
                    <h3><a href="#">Văn hóa Di sản Phi vật thể</a></h3>
                    <p class="follow-count">89,2 nghìn người theo dõi</p>
                    <p>Nơi giao lưu và trao đổi về các nét văn hóa truyền thống, lễ hội và phong tục tập quán được UNESCO công nhận.</p>
                </div>
                <button class="follow-btn">Theo dõi</button>
            </li>
            <li class="follow-item">
                <img src="../assets/img/disancodai.webp" alt="Di sản Cổ đại" class="follow-avatar">
                <div class="space-info">
                    <h3><a href="#">Di sản Cổ đại </a></h3>
                    <p class="follow-count">67,5 nghìn người theo dõi</p>
                    <p>Tìm hiểu và chia sẻ kiến thức về những di tích cổ đại, những dấu ấn lịch sử để lại dấu hỏi của quá khứ.</p>
                </div>
                <button class="follow-btn">Theo dõi</button>
            </li>
            <li class="follow-item">
                <img src="../assets/img/disanthiennhienkyvy.jpg" alt="Di sản Thiên nhiên Kỳ vĩ" class="follow-avatar">
                <div class="space-info">
                    <h3><a href="#">Di sản Thiên nhiên Kỳ vĩ</a></h3>
                    <p class="follow-count">98,2 nghìn người theo dõi</p>
                    <p>Cộng đồng dành cho những người yêu thiên nhiên, nơi khám phá các danh lam thắng cảnh và công viên quốc gia độc đáo.</p>
                </div>
                <button class="follow-btn">Theo dõi</button>
            </li>
            <li class="follow-item">
                <img src="../assets/img/disanamthuc.jpeg" alt="Ẩm thực Di sản Thế giới" class="follow-avatar">
                <div class="space-info">
                    <h3><a href="#">Ẩm thực Di sản Thế giới</a></h3>
                    <p class="follow-count">90,2 nghìn người theo dõi</p>
                    <p>Khám phá hương vị và truyền thống ẩm thực độc đáo từ các nền văn hóa trên toàn cầu.</p>
                </div>
                <button class="follow-btn">Theo dõi</button>
            </li>
            <li class="follow-item">
                <img src="../assets/img/disanduongdai.jpg" alt="Nghệ thuật Di sản Đương đại" class="follow-avatar">
                <div class="space-info">
                    <h3><a href="#">Nghệ thuật Di sản Đương đại</a></h3>
                    <p class="follow-count">198,7 nghìn người theo dõi</p>
                    <p>Chia sẻ và tìm hiểu về nghệ thuật đương đại gắn liền với di sản văn hóa và lịch sử.</p>
                </div>
                <button class="follow-btn">Theo dõi</button>
            </li>
        </ul>
    </div>
</body>
</html>
