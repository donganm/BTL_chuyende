<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về Chúng Tôi | Global Heritage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .back-button {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 26px;
            font-weight: bold;
        }
        .container {
            margin-top: 20px;
        }
        .section-title {
            margin-top: 30px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 30px;
        }
        .contact-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 3px 3px 10px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
/* 
        body {
            background-color: blue;
        } */
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">

        <a href="../index.php">
            <button onclick="window.history.back()" class="btn btn-secondary back-button">Quay lại trang chủ</button>
        </a>

        <h1>Về Chúng Tôi</h1>
    </div>

    <div class="container">
        <h2 class="section-title">Giới thiệu về Global Heritage</h2>
        <p>Global Heritage là tổ chức phi lợi nhuận với sứ mệnh bảo tồn và phát huy các giá trị di sản văn hóa trên toàn thế giới. Chúng tôi kết nối cộng đồng, nghiên cứu và nâng cao nhận thức về những di sản quan trọng.</p>
        
        <h2 class="section-title">Sứ mệnh của chúng tôi</h2>
        <ul>
            <li>Bảo tồn di sản văn hóa và thiên nhiên.</li>
            <li>Tổ chức các chương trình giáo dục về lịch sử và văn hóa.</li>
            <li>Hợp tác với các tổ chức quốc tế để bảo vệ di sản.</li>
            <li>Phát triển các dự án nghiên cứu và phục hồi di sản.</li>
        </ul>

        <!-- Contact Us Section -->
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="section-title">Liên hệ với chúng tôi</h2>
                <div class="contact-form">
                    <form action="#" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Global Heritage</p>
    </div>

</body>
</html>
