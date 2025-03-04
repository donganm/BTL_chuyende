<?php
include '../includes/db.php'; // Kết nối database

// Kiểm tra kết nối
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Xử lý tìm kiếm
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT id, tieude, noidung, hinhanh FROM tintuc WHERE tieude LIKE '%$search%'";
} else {
    $sql = "SELECT id, tieude, noidung, hinhanh FROM tintuc";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức</title>
    <link rel="stylesheet" href="style/tintuc.css"> <!-- Gắn CSS -->
</head>

<body>
    <header>
        <h1>Tin tức về di sản Việt Nam</h1>
        <p>Nơi lưu giữ giá trị văn hóa và lịch sử</p>
    </header>

    <nav>
        <a href="../index.php">Trang chủ</a>
        <a href="tintuc.php" class="active">Tin tức</a>
        <a href="blog/blog.php">Blog</a>
    </nav>

    <div class="container">
        <form method="GET">
            <input type="text" name="search" placeholder="Tìm kiếm bài viết..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Tìm kiếm</button>
        </form>

        <?php
        if ($result->num_rows > 0) {
            while ($article = $result->fetch_assoc()) {
                echo '<div class="article">';
                echo '<img src="../images/' . $article["hinhanh"] . '" alt="' . $article["tieude"] . '">';
                echo '<h2><a href="tintuc/heritage.php?id=' . $article["id"] . '">' . $article["tieude"] . '</a></h2>';
                echo '<p>' . mb_substr($article["noidung"], 0, 100, 'UTF-8') . '...</p>';
                echo '</div>';
            }
        } else {
            echo "<p>Không có bài viết nào.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
