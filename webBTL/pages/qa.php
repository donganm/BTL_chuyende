<!DOCTYPE html>
<html>
    <head>
        <title>Câu hỏi và câu trả lời di sản toàn cầu.</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                padding: 0;
                margin: 0;
            }
            .hop {
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
            .chiabocuc {
                display: flex;
            }
            .bentrai {
                flex-basis: 70%;
            }
            .benphai {
                flex-basis: 30%;
                padding-left: 20px;
            }
            .post {
                background-color: white;
                padding: 15px;
                margin: 10px auto;
                border-radius: 8px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                max-width: 600px;
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
            .bot-tag, .user-tag {
                color: gray;
                font-size: 12px;
            }
            .post-content {
                margin: 10px 0;
            }
            .related-header {
                display: flex;
                align-items: center;
                gap: 15px;
            }
            .answer-btn {
                border: 2px solid #1a73e8;
                background: none;
                color: #1a73e8;
                font-size: 14px;
                font-weight: bold;
                padding: 8px 16px;
                border-radius: 20px;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 5px;
                transition: 0.2s;
            }
            .answer-btn:hover {
                background: #1a73e8;
                color: white;
            }
            .follow-btn {
                border: none;
                background: none;
                color: gray;
                font-size: 14px;
                cursor: pointer;
                transition: color 0.2s;
            }
            .follow-btn:hover {
                color: black;
            }
            .related-questions {
                background-color: white;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                margin-top: 10px;
            }
            .related-questions h3 {
                font-size: 16px;
                font-weight: bold;
                margin-bottom: 10px;
                padding-bottom: 8px;
                border-bottom: 2px solid #ddd;  
            }
            .related-questions ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .related-questions ul li {
                margin-bottom: 8px;
            }
            .related-questions ul li a {
                text-decoration: none;
                color: #0073e6;
                font-size: 14px;
            }
            .related-questions ul li a:hover {
                text-decoration: underline;
            }
            /* Modal cho trả lời */
            .modal {
                display: none;
                position: fixed;
                top: 10%;
                left: 50%;
                transform: translate(-50%, 0);
                width: 50%;
                max-width: 500px;
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                z-index: 1000;
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }
            .close-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 18px;
                cursor: pointer;
            }
            .form-input {
                width: 100%;
                margin-bottom: 10px;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            .btn {
                background-color: #b92b27;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }
            .btn:hover {
                background-color: #a1201e;
            }
        </style>
    </head>
    <body>
        <!-- Header -->
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
        <div class="hop">
            <div class="chiabocuc">
                <div class="bentrai">
                    <!-- Hiển thị câu hỏi -->
                    <span style="display:block; font-weight:bold; margin-bottom:10px;">
                        Tại sao Quần thể di tích Cố đô Huế lại được UNESCO công nhận là Di sản Thế giới?
                    </span>
                    <div class="container">
                        <!-- 1. Hiển thị các câu trả lời mới lấy từ DB (nếu có) -->
                        <?php
                        // Kết nối đến DB
                        $servername = "localhost";
                        $username   = "root";
                        $password   = "";
                        $dbname     = "global";
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Kết nối thất bại: " . $conn->connect_error);
                        }
                        
                        // Giả sử câu hỏi hiện tại có id = 1
                        $question_id = 1;
                        // Lấy các câu trả lời từ bảng answers, sắp xếp mới nhất lên đầu
                        $sql = "SELECT * FROM answers WHERE question_id = $question_id ORDER BY created_at DESC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                ?>
                                <div class="post">
                                    <div class="user-info">
                                        <!-- Ảnh đại diện cố định (có thể thay đổi theo user) -->
                                        <img src="../assets/img/avata1.jpg" alt="Avatar" class="avatar">
                                        <div>
                                            <!-- Giả sử người trả lời là Huy Nguyễn -->
                                            <strong>Huy Nguyễn</strong>
                                            <span class="user-tag"><?php echo date("d/m/Y H:i", strtotime($row['created_at'])); ?></span>
                                        </div>
                                    </div>
                                    <p class="post-content">
                                        <?php echo $row['answer']; ?>
                                    </p>
                                </div>
                                <?php
                            }
                        }
                        // Đóng kết nối cho phần lấy câu trả lời mới (nếu cần)
                        $conn->close();
                        ?>

                        <!-- 2. Giữ nguyên 2 câu trả lời mặc định -->
                        <div class="post">
                            <div class="user-info">
                                <img src="../assets/img/avata3.jpeg" alt="User Avatar" class="avatar">
                                <div>
                                    <strong>Quân Phạm</strong>
                                    <span class="user-tag">Di tích Cố Đô Huế Việt Nam • 1y</span>
                                </div>
                            </div>
                            <p class="post-content">
                                Trả lời câu hỏi: Tại sao Quần thể di tích Cố đô Huế lại được UNESCO công nhận là Di sản Thế giới?
                            </p>
                            <p>
                                Cố đô Huế còn lưu giữ nhiều giá trị văn hóa phi vật thể như Nhã nhạc cung đình, các lễ hội truyền thống và di sản chữ viết của triều Nguyễn.
                            </p>
                        </div>

                        <div class="post">
                            <div class="user-info">
                                <img src="../assets/img/avata1.jpg" alt="User Avatar" class="avatar">  
                                <div>
                                    <strong>Huy Nguyễn</strong>
                                    <span class="user-tag">Di tích Cố Đô Huế Việt Nam • 2y</span>
                                </div>
                            </div>
                            <p class="post-content">
                                Trả lời câu hỏi: Tại sao Quần thể di tích Cố đô Huế lại được UNESCO công nhận là Di sản Thế giới?
                            </p>
                            <p>
                                Vì đây từng là kinh đô của triều Nguyễn, nơi gắn liền với nhiều sự kiện lịch sử quan trọng của Việt Nam.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="benphai">
                    <div class="related-header">
                        <!-- Nút mở modal trả lời -->
                        <button class="answer-btn" id="openAnswerModal">
                            ✏️ Trả lời  <span class="answer-count">2</span>
                        </button>
                        <button class="follow-btn">
                            📡 Theo dõi
                        </button>
                    </div>
                    <div class="related-questions">
                        <h3>Câu hỏi liên quan</h3>
                        <ul>
                            <li><a href="#">Di sản thế giới là gì? Tiêu chí nào để một địa điểm được UNESCO công nhận?</a></li>
                            <li><a href="#">Hiện nay trên thế giới có bao nhiêu di sản được UNESCO công nhận?</a></li>
                            <li><a href="#">Vịnh Hạ Long có những giá trị gì để trở thành di sản thế giới?</a></li>
                            <li><a href="#">Tôi có thể đặt câu hỏi và nhận câu trả lời trực tuyến ở đâu?</a></li>
                            <li><a href="#">Vì sao Vạn Lý Trường Thành được UNESCO công nhận là di sản thế giới?</a></li>
                            <li><a href="#">Kim tự tháp Ai Cập có phải là di sản thế giới không?</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cuoi trang">
                <!-- Chân trang nếu có -->
            </div>
        </div>

        <!-- Modal nhập câu trả lời -->
        <div class="modal" id="answerModal">
            <span class="close-btn" id="closeAnswerModal">&times;</span>
            <h3>Trả lời câu hỏi</h3>
            <!-- Form gửi dữ liệu POST đến submit_answer.php -->
            <form action="submit_answer.php" method="POST">
                <!-- Truyền question_id (ví dụ: 1) qua hidden input -->
                <input type="hidden" name="question_id" value="1">
                <textarea name="answer" class="form-input" rows="5" placeholder="Nhập câu trả lời của bạn..." required></textarea>
                <button type="submit" class="btn">Gửi câu trả lời</button>
            </form>
        </div>
        <div class="overlay" id="overlayAnswer"></div>

        <script>
            // Xử lý modal trả lời
            const openAnswerModal = document.getElementById("openAnswerModal");
            const answerModal = document.getElementById("answerModal");
            const closeAnswerModal = document.getElementById("closeAnswerModal");
            const overlayAnswer = document.getElementById("overlayAnswer");

            openAnswerModal.addEventListener("click", function() {
                answerModal.style.display = "block";
                overlayAnswer.style.display = "block";
            });
            closeAnswerModal.addEventListener("click", function() {
                answerModal.style.display = "none";
                overlayAnswer.style.display = "none";
            });
            overlayAnswer.addEventListener("click", function() {
                answerModal.style.display = "none";
                overlayAnswer.style.display = "none";
            });
        </script>
    </body>
</html>
