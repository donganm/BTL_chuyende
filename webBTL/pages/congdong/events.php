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
* navbar */
.navbar {
    display: flex;
    justify-content: space-between; /* Căn đều các phần tử */
    align-items: center;
    background: #007bff; /* Màu xanh */
    color: white;
    padding: 15px 30px;
    width: 100%; /* Đảm bảo chiếm toàn bộ chiều rộng */
    position: sticky; /* Dính khi cuộn */
    top: 0; /* Dính vào đầu trang khi cuộn đến */
    z-index: 1000; /* Đảm bảo navbar nằm trên các phần tử khác */
}

    .event-header {
    width: 100%;
    background:rgb(47, 148, 255); /* Màu xanh giống navbar */
    color: white;
    text-align: center;
    padding: 15px 0;
    font-size: 18px;
    font-weight: bold;
}

.event-header h2 {
    margin: 0;
    font-size: 24px;
}

.event-header p {
    margin: 5px 0 0;
    font-size: 18px;
    font-weight: normal;
}
/*thanh tìm kiếm*/
.search-container {
    text-align: center;
    margin: 20px 0;
}

.search-container form {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.search-container input {
    width: 50%;
    padding: 10px;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 5px;
}

.search-container button {
    background: #0078d4;
    color: white;
    padding: 10px 12px;
    border: none;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.search-container button:hover {
    background: #005bb5;
}

/* Footer  */
.footer_1 {
  width: 100%;
  max-width: 1350px;
  margin-left: auto;
}

.footer_1 p a {
  color: gray;
  text-decoration: none;
}

.footer_2 {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: black;
  color: white;
  padding: 10px;
}

.footer_2 .VN {
  display: flex;
  align-items: center;
}

.footer_2 .VN img {
  height: 15px;
  width: auto;
  margin-right: 10px;
}

.footer_3 {
  color: gray;
  padding: 6px;
  font-size: 12px;
  text-align: center;
}

/* End Footer */


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
    <div class="event-header">
    <h2>🌍 Giới thiệu về Sự kiện</h2>
    <p>Trang này cung cấp thông tin về các sự kiện di sản văn hóa trên toàn thế giới. 
       Khám phá và tham gia các sự kiện quan trọng liên quan đến bảo tồn di sản!</p>
</div>

    <!-- Thanh tìm kiếm -->
    <div class="search-container">
        <form action="activity.php" method="GET">
            <input type="text" name="search" id="search" placeholder="Tìm kiếm sự kiện..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit">Tìm kiếm</button>
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

