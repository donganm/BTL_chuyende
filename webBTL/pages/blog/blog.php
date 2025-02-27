<?php
    // Sửa đường dẫn đúng
    // include '../tintuc/db_connect.php';
    include '../../includes/db.php';

    // Kiểm tra kết nối
    if (!$conn) {
        die("Lỗi kết nối database: " . mysqli_connect_error());
    }

    // Truy vấn lấy dữ liệu từ bảng `blog_articles`
    $sql = "SELECT title, description, link FROM blog_articles";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Blog về Văn hóa Việt Nam</h1>
        <p>Chia sẻ trải nghiệm và góc nhìn</p>
    </header>

    <nav>
        <a href="../index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Trang chủ</a>
        <a href="../tintuc.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'tintuc.php' ? 'active' : ''; ?>">Tin tức</a>
        <a href="./blog.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">Blog</a>
    </nav>

    <div class="container">

    <a href="add-blog.php" style="display: inline-block; margin: 10px; padding: 10px; background: #27ae60; color: white; text-decoration: none;">+ Đăng bài mới</a>


        <?php
        if ($result->num_rows > 0) {
            while ($blog = $result->fetch_assoc()) {
                echo '<div class="article">';
                echo '<h2><a href="' . $blog["link"] . '">' . $blog["title"] . '</a></h2>';
                echo '<p>' . $blog["description"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>Không có bài viết nào.</p>";
        }

        // Đóng kết nối
        $conn->close();
        ?>
    </div>
</body>
</html>
