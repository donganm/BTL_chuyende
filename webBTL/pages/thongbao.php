<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông báo</title>
    <style>
        /* ======= CSS CƠ BẢN ======= */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        /* ======= HEADER GIỐNG CÁC TRANG TRƯỚC ======= */
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

        /* ======= NỘI DUNG CHÍNH - CHIA HAI CỘT ======= */
        .chiabocuc {
            display: flex;
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .bentrai {
            flex-basis: 30%;
            padding: 20px;
            border-right: 1px solid #ccc;
        }
        .benphai {
            flex-basis: 70%;
            padding: 20px;
        }
        h2 {
            margin-top: 0;
        }

        /* ======= PHẦN THÔNG BÁO (BÊN TRÁI) ======= */
        .notification-item {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .notification-date {
            font-size: 14px;
            color: #777;
        }
        .notification-title {
            font-weight: bold;
            margin: 5px 0;
        }
        .notification-content {
            margin-left: 10px;
        }

        /* ======= PHẦN CÂU HỎI TRẢ LỜI (BÊN PHẢI) ======= */
        .questions-container {
            margin-top: 20px;
        }
        .question-item {
            margin-bottom: 15px;
        }
        .question-item a {
            text-decoration: none;
            color: #0073e6;
        }
        .question-item a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- HEADER GIỐNG VỚI CÁC TRANG TRƯỚC -->
    <div class="header">
        <div class="logo">Q&A</div>
        <div class="menu">
            <ul class="menungang">
                <li><a href="baidangketnoiq&a.php">Về Q&A</a></li>
                <li><a href="">Theo dõi</a></li>
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

    <!-- KHU VỰC HIỂN THỊ THÔNG BÁO (TRÁI) VÀ CÂU HỎI TRẢ LỜI (PHẢI) -->
    <div class="chiabocuc">
        <!-- CỘT BÊN TRÁI: THÔNG BÁO -->
        <div class="bentrai">
            <h2>Thông báo</h2>
            <div class="notification-item">
                <div class="notification-date">1 phút trước</div>
                <div class="notification-title">Những câu trả lời của bạn</div>
                <div class="notification-content">
                    Hãy xem lại những câu trả lời của bạn.
                </div>
            </div>
            <div class="notification-item">
                <div class="notification-date">Ngày 25 tháng 2</div>
                <div class="notification-title">Tham gia cộng đồng Q&A</div>
                <div class="notification-content">
                    Tìm những bạn đồng hành có cùng sở thích với bạn. 
                </div>
            </div>
            <!-- Thêm các thông báo khác tại đây -->
        </div>

        <!-- CỘT BÊN PHẢI: DANH SÁCH CÂU HỎI ĐỂ TRẢ LỜI -->
        <div class="benphai">
            <h2>Không có thông báo mới </h2>
            </div>
        </div>
    </div>
</body>
</html>
