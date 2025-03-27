<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "global";

// Kết nối database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy từ khóa tìm kiếm từ request (nếu có)
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Câu lệnh SQL tìm kiếm theo tiêu đề hoạt động
$sql = "SELECT * FROM activity WHERE title LIKE ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$search_param = "%" . $search . "%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();

$activities = [];
while ($row = $result->fetch_assoc()) {
    $activities[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoạt Động</title>
    <link rel="stylesheet" href="activity.css">

</head>
<style>
    .navbar {
    background: #007bff; /* Màu xanh UNESCO */
    padding: 10px 0;
    display: flex;
    justify-content: center; /* Căn giữa nội dung */
    max-width: 100vw; /* Đảm bảo chiếm toàn bộ chiều rộng viewport */
    width: 100%; /* Đảm bảo chiều rộng đầy đủ */
    position: sticky; /* Dính khi cuộn */
    top: 0; /* Dính vào đầu trang khi cuộn đến */
    z-index: 1000; /* Đảm bảo navbar nằm trên các phần tử khác */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Thêm bóng để nổi bật */
}
.nav-links a.active,
.nav-links a:hover {
    background: white;
    color: #007bff;
}

/* Footer  */
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
      padding: 0 20px;
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
      }}
/* End Footer */

</style>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="../congdong.php" class="back-button">← Cộng đồng</a></li>
            <li><a href="events.php" class="<?= basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : '' ?>">Sự Kiện</a></li>
            <li><a href="activity.php" class="<?= basename($_SERVER['PHP_SELF']) == 'activity.php' ? 'active' : '' ?>">Hoạt Động</a></li>
        </ul>
    </nav>

    <!-- Header -->
    <div class="activity-header">
        <h2>🌍 Giới thiệu về Hoạt động </h2>
        <p>Trung tâm Di sản Thế giới đi đầu trong những nỗ lực bảo vệ và bảo tồn của cộng đồng quốc tế.</p>
    </div>

    <!-- Thanh tìm kiếm -->
    <div class="search-container">
        <form action="activity.php" method="GET">
            <input type="text" name="search" id="search" placeholder="Tìm kiếm hoạt động..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>

    <!-- Danh sách hoạt động -->
    <div class="container">
        <?php if (!empty($activities)): ?>
            <?php foreach ($activities as $activity): ?>
                <div class="activity-card">
                    <img src="./image_activity/<?= $activity['image'] ?>" alt="<?= htmlspecialchars($activity['title']) ?>">
                    <div class="activity-content">
                        <h3><?= htmlspecialchars($activity['title']) ?></h3>
                        <p><?= substr(htmlspecialchars($activity['description']), 0, 100) ?>...</p>
                        <a href="activity_detail.php?id=<?= $activity['id'] ?>" class="btn">Xem thêm</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">Không tìm thấy hoạt động nào.</p>
        <?php endif; ?>
    </div>

    <footer>
    <div class="footer-container">
      <!-- Phần 1: Get Help -->
      <div class="footer-section">
        <h5>Get Help</h5>
        <p><a href="../feedback.php">Feedback</a></p>
        <p><a href="../contact.php">Contact Us</a></p>
      </div>

      <!-- Phần 2: VIE VN -->
      <div class="footer-section footer-center">
        <div>
          <img src="./image_path/VN_Flag.webp" alt="Vietnam Flag" />
          <span>VIE VN</span>
        </div>
        <p>© 2025 G.H</p>
      </div>

      <!-- Phần 3: Copyright -->
      <div class="footer-section footer-right">
        <p>© 2025 G.H. ALL RIGHTS RESERVED</p>
      </div>
    </div>
  </footer>
</body>
</html>
