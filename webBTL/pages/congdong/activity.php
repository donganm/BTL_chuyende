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
    background-color: #0078d4; /* Màu xanh UNESCO */
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

</body>
</html>
