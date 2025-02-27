<?php
// include './db_connect.php';
    include '../../includes/db.php';

// Lấy dữ liệu bài viết về Hội An từ database
$sql = "SELECT * FROM tintuc WHERE tieude LIKE '%Hội An%'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['tieude']; ?></title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <h1><?php echo $row['tieude']; ?></h1>
    </header>
    <nav>
        <a href="./index.php">Trang chủ</a>
        <a href="../tintuc.php">Tin tức</a>
        <a href="../blog/blog.php">Blog</a>
    </nav>
    <div class="container">
        <div class="image-container">
            <img src="../../images/<?php echo $row['hinhanh']; ?>" alt="<?php echo $row['tieude']; ?>">
        </div>
        <div class="content">
            <p><?php echo nl2br($row['noidung']); ?></p>
        </div>
        <div class="back-link">
            <a href="../tintuc.php">← Quay lại Tin tức</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
