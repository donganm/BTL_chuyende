

<?php
// Kết nối MySQL
$conn = new mysqli("localhost", "root", "", "global");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id === 0) {
    die("Câu chuyện không tồn tại.");
}

// Truy vấn dữ liệu từ bảng stories
$sql = "SELECT * FROM stories WHERE id = $id";
$result = $conn->query($sql);
$story = $result->fetch_assoc();

if (!$story) {
    die("Không tìm thấy câu chuyện.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($story['title']); ?></title>
    <link rel="stylesheet" href="stories.css">
</head>
<body>

<div class="back-button">
    <a href="javascript:history.back()">⬅ Quay lại</a>
</div>

<section class="detail-container">
    <h1><?php echo htmlspecialchars($story['title']); ?></h1>
    <img src="image_url/<?php echo $story['image_url']; ?>" alt="<?php echo htmlspecialchars($story['title']); ?>">
    <p><?php echo nl2br(htmlspecialchars($story['description'])); ?></p>
</section>

</body>
</html>
