<?php
include '../../includes/db.php'; // Kết nối database

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra ID trên URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT tieude, noidung, hinhanh FROM tintuc WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        die("Bài viết không tồn tại!");
    }
} else {
    die("Thiếu ID bài viết!");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article["tieude"]; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><?php echo $article["tieude"]; ?></h1>
    </header>

    <nav>
        <a href="../../index.php">Trang chủ</a>
        <a href="tintuc.php">Tin tức</a>
        <a href="../blog/blog.php">Blog</a>
    </nav>

    <div class="container single-article">
        <img src="../images/<?php echo $article["hinhanh"]; ?>" alt="<?php echo $article["tieude"]; ?>">
        <p><?php echo nl2br($article["noidung"]); ?></p>
        <a href="tintuc.php" class="back-link">Quay lại</a>
    </div>
</body>
</html>
