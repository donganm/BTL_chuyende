<?php
// Kết nối MySQL
$conn = new mysqli("localhost", "root", "", "global");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id === 0) {
    header("Location: stories.php");
    exit();
}

// Truy vấn dữ liệu dự án phục hồi
$stmt = $conn->prepare("SELECT * FROM restoration_projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

if (!$project) {
    die("Không tìm thấy dự án phục hồi.");
}

$conn->close();

// Kiểm tra đường dẫn ảnh
$image_path = file_exists("image_path/" . $project['image_path']) 
    ? "image_path/" . $project['image_path'] 
    : "image_path/default.jpg";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($project['project_name']); ?></title>
    <link rel="stylesheet" href="stories.css">
    <style>
        /* CSS được điều chỉnh để giống event-detail.php */
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
            background-color: white;
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
            <li><a href="stories.php" class="<?= basename($_SERVER['PHP_SELF']) == 'stories.php' ? 'active' : '' ?>">Câu chuyện & Dự án</a></li>
            <li><a href="events.php" class="<?= basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : '' ?>">Sự kiện & Hoạt động</a></li>
            <li><a href="network.php" class="<?= basename($_SERVER['PHP_SELF']) == 'network.php' ? 'active' : '' ?>">Mạng lưới kết nối</a></li>
        </ul>
    </nav>

    <!-- Nội dung chi tiết dự án -->
    <section class="detail-container">
        <h1><?php echo htmlspecialchars($project['project_name']); ?></h1>
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($project['project_name']); ?>">
        <p><?php echo nl2br(htmlspecialchars($project['details'])); ?></p>
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
