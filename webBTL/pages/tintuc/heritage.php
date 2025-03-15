<?php
include '../../includes/db.php'; // Kết nối database

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra ID bài viết
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Thiếu hoặc sai ID bài viết!");
}

$id = intval($_GET['id']);
$sql = "SELECT tieude, noidung, hinhanh FROM tintuc WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Bài viết không tồn tại!");
}
$article = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article["tieude"]); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($article["tieude"]); ?></h1>
    </header>

    <nav>
        <a href="../../index.php">Trang chủ</a>
        <a href="./tintuc.php">Tin tức</a>
        <a href="../blog/blog.php">Blog</a>
    </nav>

    <div class="container single-article">
    <img src="../tintuc/images/<?php echo htmlspecialchars($article['hinhanh']); ?>" 
     alt="<?php echo htmlspecialchars($article['tieude']); ?>" 
     onerror="this.onerror=null;this.src='../tintuc/images/default.jpg';">

        <p><?php echo nl2br(htmlspecialchars($article["noidung"])); ?></p>
        <a href="./tintuc.php" class="back-link">Quay lại</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>