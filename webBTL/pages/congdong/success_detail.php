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

// Truy vấn dữ liệu câu chuyện thành công
$sql = "SELECT * FROM success_stories WHERE id = $id";
$result = $conn->query($sql);
$success_story = $result->fetch_assoc();

if (!$success_story) {
    die("Không tìm thấy câu chuyện thành công.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($success_story['title']); ?></title>
    <link rel="stylesheet" href="stories.css">
</head>
<body>

<div class="back-button">
    <a href="javascript:history.back()">⬅ Quay lại</a>
</div>

<section class="detail-container">
    <h1><?php echo htmlspecialchars($success_story['title']); ?></h1>
    <img src="image_success/<?php echo $success_story['image_success']; ?>" alt="<?php echo htmlspecialchars($success_story['title']); ?>">
    <p><?php echo nl2br(htmlspecialchars($success_story['description'])); ?></p>
</section>

</body>
</html>
