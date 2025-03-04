<?php
    include '../includes/db.php';

// Kết nối database
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
<html>
    <head>
        <title>Câu hỏi và câu trả lời di sản toàn cầu</title>
        <style>
            body{
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                padding: 0;
                margin: 0;
            }
            .bentrai{       
                flex-basis: 70%;
            }
            .benphai{
                flex-basis: 30%;
            }
            .chiabocuc{
                display: flex;
                
            }
            .hop{
                margin: 20px auto;
                max-width: 960px;
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
            a {
                padding: 10px;
                text-decoration: none;
                color: black;
            }
        
            .hop {
                max-width: 960px;
                margin: 20 auto;
            }
            .thanhcongcu {
                display: flex;
                align-items: center;
                background-color: white;
                padding: 10px;
                border-radius: 8px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                
            }
            .thanhcongcu input {
                flex-grow: 1;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 20px;
                margin: 0 10px;
            }
            .thanhcongcu button {
                background: none;
                border: none;
                cursor: pointer;
                font-size: 14px;
                color: gray;
                padding: 5px 10px;
            }
            .thanhcongcu button:hover {
                color: black;
            }
            .posts-container {
                max-width: 700px;
                margin: 0 auto;
            }
            .post {
                background-color: white;
                padding: 15px;
                margin: 10px 0;
                border-radius: 8px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            }
            .user-info {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
            }
            .post-content {
                margin: 10px 0;
            }
            .post-content a {
            font-weight: bold;
            text-decoration: none;
            color: black;
            }
            .post-content a:hover {
            text-decoration: underline;
            }
            .anhto{
            width: 100%; /* Ảnh sẽ rộng đúng bằng bài đăng */
            border-radius: 8px; /* Bo góc nhẹ cho đẹp */
            margin-top: 10px; /* Khoảng cách với nội dung phía trên */
            object-fit: cover;
            }
            
    </style>
    </head>
    <body>
        <div class="header">
            <div class="logo">Q&A</div>
            <div class="menu">
                <ul class="menungang">
                    <li><a href="../index.php">Trang chủ</a></li>
                    <li><a href="">Theo dõi</a></li>
                    <li><a href="traloi.php">Trả lời</a></li>
                    <li><a href="">Thông báo</a></li>
                    <li><a href="">Về Q&A</a></li>
                </ul>
            </div>
            <div class="header-icons">
                <input type="text" class="search-bar" placeholder="Tìm kiếm...">
                <button class="taobaidang">Tạo bài đăng</button>
            </div>
        </div>
        <div class="hop">
            <div class="thanhcongcu">
                <img src="..//assets/img/avata1.jpg" alt="Avatar" class="avatar">
                <input type="text" placeholder="Bạn muốn hỏi hoặc chia sẻ điều gì?">
                <button>📝 Ask</button>
                <button>✏️ Answer</button>
                <button>📢 Post</button>
            </div>
            <div class="posts-container">
                <div class="post">
                    <div class="user-info">
                        <img src="..//assets/img/avata1.jpg" alt="" class="avatar">
                        <div>
                            <strong>Huy Nguyễn</strong> <span class="bot-tag"> • online</span>
                        </div>
                    </div>
                    <p class="post-content">
                        <b><a href="qa.php">Tại sao Quần thể di tích Cố đô Huế lại được UNESCO công nhận là Di sản Thế giới?
                        </a></b>
                    </p>
                    <p>Quần thể Di tích Cố đô Huế được UNESCO công nhận là Di sản Thế giới vào năm 1993 nhờ vào những giá trị nổi bật về lịch sử, văn hóa, kiến trúc và cảnh quan.</p>
                <img class="anhto" src="..//assets/img/codohue.jpg" alt="">
                <p>1. Giá trị lịch sử và văn hóa
                    Kinh đô triều Nguyễn (1802-1945): Huế từng là trung tâm chính trị, văn hóa và tôn giáo của Việt Nam dưới triều Nguyễn – triều đại phong kiến cuối cùng của đất nước. Đây là nơi diễn ra nhiều sự kiện quan trọng trong lịch sử dân tộc.
                    Bảo tồn văn hóa cung đình: Cố đô Huế lưu giữ nhiều giá trị văn hóa, từ hệ thống tổ chức triều chính đến phong tục, nghi lễ, y phục và nghệ thuật cung đình.
                    Di sản văn hóa phi vật thể: Nhã nhạc cung đình Huế, một loại hình âm nhạc trang trọng được biểu diễn trong các nghi lễ hoàng gia, đã được UNESCO công nhận là Di sản Văn hóa Phi vật thể và Truyền khẩu của Nhân loại vào năm 2003. <br>
                    2. Giá trị kiến trúc độc đáo
                    Hệ thống cung điện, lăng tẩm và đền đài: Quần thể bao gồm nhiều công trình tiêu biểu như Hoàng thành, Tử Cấm Thành, các miếu thờ, phủ đệ và lăng tẩm của các vị vua triều Nguyễn. Mỗi công trình đều mang nét kiến trúc riêng biệt, phản ánh sự tinh tế và quyền uy của triều đại.
                    Sự kết hợp giữa kiến trúc và thiên nhiên: Các công trình ở Huế được xây dựng theo nguyên tắc phong thủy phương Đông, hài hòa với cảnh quan thiên nhiên, sông núi, tạo nên một tổng thể tuyệt đẹp và trang nghiêm. <br>
                    3. Giá trị nghệ thuật và kỹ thuật xây dựng
                    Sự tinh xảo trong trang trí: Các công trình ở Huế được trang trí bằng nghệ thuật chạm khắc gỗ, khảm sành sứ, vẽ tranh tường với kỹ thuật tinh vi, thể hiện trình độ mỹ thuật cao của nghệ nhân thời Nguyễn.
                    Kỹ thuật xây dựng bền vững: Những công trình này được thiết kế để chống lại thời tiết khắc nghiệt và lũ lụt miền Trung, giúp chúng tồn tại qua hàng trăm năm. <br>
                    4. Giá trị cảnh quan và môi trường
                    Vị trí đắc địa bên dòng sông Hương: Quần thể di tích nằm dọc theo dòng sông Hương thơ mộng, kết hợp hài hòa với thiên nhiên, tạo nên một không gian lịch sử đầy chất thơ.
                    Bảo tồn hệ sinh thái và môi trường: Cảnh quan thiên nhiên quanh khu di tích vẫn được giữ gìn gần như nguyên vẹn, tạo điều kiện để phát triển du lịch bền vững.</p>
                    <img class="anhto" src="..//assets/img/giatrivanhoalichsu.jpg" alt="">
                    
                
            </div>
        </div>
    </body>
</html>