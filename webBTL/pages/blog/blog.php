<?php
    session_start();
    include '../../includes/db.php'; // Đảm bảo kết nối database

    if (!$conn) {
        die("Lỗi kết nối database: " . mysqli_connect_error());
    }

    // Truy vấn lấy dữ liệu từ bảng `blog_articles`
    $sql = "SELECT id, title, description FROM blog_articles";
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
        <a href="../index.php">Trang chủ</a>
        <a href="../tintuc.php">Tin tức</a>
        <a href="./blog.php" class="active">Blog</a>
    </nav>

    <div class="container">
        <a href="add-blog.php" style="display: inline-block; margin: 10px; padding: 10px; background: #27ae60; color: white; text-decoration: none;">+ Đăng bài mới</a>

        <?php
        if ($result->num_rows > 0) {
            while ($blog = $result->fetch_assoc()) {
                echo '<div class="article">';
                // Thay đổi tiêu đề thành link đến `view-blog.php`
                echo '<h2><a href="view-blog.php?id=' . $blog["id"] . '">' . $blog["title"] . '</a></h2>';
                echo '<p>' . $blog["description"] . '</p>';
                
                // Nút xóa bài viết
                echo '<a href="delete-blog.php?id=' . $blog['id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bài viết này?\')" style="color: red;">Xóa</a>';
                echo '</div>';
            }
        } else {
                // Hiển thị bài viết mặc định nếu không có bài viết nào
                echo '<div class="article">';
                echo '<h2>Chào mừng bạn đến với Blog Văn hóa!</h2>';
                echo '<p>Chưa có bài viết nào. Hãy là người đầu tiên đăng bài!</p>';
                echo '</div>';
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
