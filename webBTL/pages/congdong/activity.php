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

// Câu lệnh SQL tìm kiếm theo tiêu đề sự kiện
$sql = "SELECT * FROM events WHERE title LIKE ? ORDER BY date ASC";
$stmt = $conn->prepare($sql);
$search_param = "%" . $search . "%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="sukien.css">
</head>
<style>
    .activity-header {
    width: 100%;
    background:rgb(47, 148, 255); /* Màu xanh giống navbar */
    color: white;
    text-align: center;
    padding: 20px 0;
    font-size: 18px;
    font-weight: bold;
    display: flex;
    flex-direction: column;
    align-items: center; /* Căn giữa nội dung */
    justify-content: center;
    box-sizing: border-box;
}

.activity-header h2 {
    margin: 0;
    font-size: 26px;
    font-weight: bold;
}

.activity-header p {
    margin: 5px auto;
    font-size: 18px;
    font-weight: normal;
    max-width: 80%; /* Giới hạn chiều rộng để không quá dài */
    text-align: center; /* Căn giữa đoạn mô tả */
}

</style>
<body>
    <!-- Navbar với hai phần Events & Activities -->
    <nav class="navbar">
    <ul class="nav-links">
        <li><a href="../congdong.php" class="back-button">← Cộng đồng</a></li>
        <li><a href="events.php" class="<?= basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : '' ?>">Sự Kiện</a></li>
        <li><a href="activity.php" class="<?= basename($_SERVER['PHP_SELF']) == 'activity.php' ? 'active' : '' ?>">Hoạt Động</a></li>
    </ul>
    </nav>
      
    <!-- navbar giới thiệu eventevent -->
    <div class="activity-header">
    <h2>🌍 Giới thiệu về Hoạt động </h2>
    <p>Trung tâm Di sản Thế giới đi đầu trong những nỗ lực bảo vệ và bảo tồn của cộng đồng quốc tế.</p>
    </div>

    <!-- Thanh tìm kiếm -->
    <div class="search-container">
        <form action="events.php" method="GET">
            <input type="text" name="search" id="search" placeholder="Search Activity" value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="container">
        <main class="events-list">
            <ul id="event-list">
                <?php if (empty($events)): ?>
                    <p>No events found.</p>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <li class="event-item">
                            <img src="./image_events/<?= htmlspecialchars($event['image']) ?>" 
                                 alt="Event Image" 
                                 onerror="this.src='default.jpg'">
                            <div class="event-info">
                                <h3><?= htmlspecialchars($event['title']) ?></h3>
                                <p><strong><?= date("d/m/Y", strtotime($event['date'])) ?></strong> - 
                                   <?= htmlspecialchars(mb_substr($event['description'], 0, 100, 'UTF-8')) ?>...</p>
                                <a href="event-detail.php?id=<?= $event['id'] ?>" class="read-more">Read</a>
                            </div>
                        </li>
                        <hr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </main>
    </div>
</body>
</html>
