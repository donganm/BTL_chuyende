<?php
// Kết nối MySQL
$conn = new mysqli("localhost", "root", "", "global");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id === 0) {
    die("Dự án không tồn tại.");
}

// Truy vấn dữ liệu dự án phục hồi
$sql = "SELECT * FROM restoration_projects WHERE id = $id";
$result = $conn->query($sql);
$project = $result->fetch_assoc();

if (!$project) {
    die("Không tìm thấy dự án phục hồi.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($project['project_name']); ?></title>
    <link rel="stylesheet" href="stories.css">
</head>
<body>

<div class="back-button">
    <a href="javascript:history.back()">⬅ Quay lại</a>
</div>

<section class="detail-container">
    <h1><?php echo htmlspecialchars($project['project_name']); ?></h1>
    <img src="image_path/<?php echo $project['image_path']; ?>" alt="<?php echo htmlspecialchars($project['project_name']); ?>">
    <p><?php echo nl2br(htmlspecialchars($project['details'])); ?></p>
</section>

</body>
</html>
