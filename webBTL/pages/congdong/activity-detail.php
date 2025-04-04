<?php
// Kết nối MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "global";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id === 0) {
    die("ID sự kiện không hợp lệ. ID nhận được: " . htmlspecialchars($_GET['id'] ?? 'Không có ID'));
}

// Truy vấn dữ liệu sự kiện
$stmt = $conn->prepare("SELECT id, title, created_at, description, image FROM activity WHERE id = ?");
if (!$stmt) {
    die("Lỗi chuẩn bị truy vấn: " . $conn->error);
}
$stmt->bind_param("i", $id);
if (!$stmt->execute()) {
    die("Lỗi thực thi truy vấn: " . $stmt->error);
}
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    die("Không tìm thấy sự kiện với ID: " . $id);
}

// Xử lý đường dẫn ảnh
$image_path = !empty($event['image']) && file_exists("image_activity/" . $event['image']) 
    ? "image_activity/" . $event['image'] 
    : "image_activity/default.jpg";

// Đóng kết nối
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($event['title'] ?? 'Sự kiện không tên'); ?></title>
    <link rel="stylesheet" href="sukien.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #007bff;
            color: white;
            padding: 15px 20px;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .nav-links li a {
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin: 0 20px;
            padding: 10px 15px;
            text-decoration: none;
        }
        .nav-links a:hover,
        .nav-links a.active {
            background: white;
            color: #007bff;
            border-radius: 5px;
        }
        .back-button {
            color: #007bff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .detail-container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .detail-container h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }
        .detail-container img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .detail-container p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .event-date {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 15px;
        }
        footer {
            background-color: #f8f8f8;
            padding: 20px 0;
            font-family: Arial, sans-serif;
            border-top: 1px solid #ddd;
            width: 100%;
        }
        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            margin: 0 auto;
            flex-wrap: wrap;
        }
        .footer-section {
            flex: 1;
            min-width: 200px;
            margin: 10px 0;
        }
        .footer-section h5 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }
        .footer-section p {
            margin: 5px 0;
        }
        .footer-section a {
            text-decoration: none;
            color: #555;
            font-size: 14px;
        }
        .footer-section a:hover {
            color: #007bff;
        }
        .footer-center {
            text-align: center;
        }
        .footer-center img {
            width: 24px;
            vertical-align: middle;
            margin-right: 5px;
        }
        .footer-right {
            text-align: right;
            font-size: 14px;
            color: #555;
        }
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                text-align: center;
            }
            .footer-right {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="../congdong.php" class="back-button">← Cộng đồng</a></li>
            <li><a href="events.php" class="<?= basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : '' ?>">Sự Kiện</a></li>
            <li><a href="activity.php" class="<?= basename($_SERVER['PHP_SELF']) == 'activity.php' ? 'active' : '' ?>">Hoạt Động</a></li>
        </ul>
    </nav>

    <!-- Nội dung chi tiết sự kiện -->
    <section class="detail-container">
        <h1><?php echo htmlspecialchars($event['title'] ?? 'Sự kiện không tên'); ?></h1>
        <p class="event-date"><?php echo date("d/m/Y", strtotime($event['created_at'])); ?></p>
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($event['title'] ?? 'Sự kiện'); ?>">
        <p><?php echo nl2br(htmlspecialchars($event['description'] ?? 'Không có mô tả.')); ?></p>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h5>Get Help</h5>
                <p><a href="../feedback.php">Feedback</a></p>
                <p><a href="../contact.php">Contact Us</a></p>
            </div>
            <div class="footer-section footer-center">
                <div>
                    <img src="./image_path/VN_Flag.webp" alt="Vietnam Flag" />
                    <span>VIE VN</span>
                </div>
                <p>© 2025 G.H</p>
            </div>
            <div class="footer-section footer-right">
                <p>© 2025 G.H. ALL RIGHTS RESERVED</p>
            </div>
        </div>
    </footer>
</body>
</html>