<?php
session_start();

if (!isset($_SESSION['redirect_url'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}

include '../../../includes/db.php';

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra trạng thái người dùng
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === 'Admin';

// Xử lý bộ lọc bài viết
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'latest';
$orderBy = $sort === 'popular' ? 'luot_xem DESC' : 'ngay_dang DESC';

$sql = "SELECT id, title, tac_gia, description, hinhanh, ngay_dang, luot_xem, luot_thich FROM blog_articles ORDER BY $orderBy";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="../styles/blog.css">
    <link rel="stylesheet" href="../includes/nav.css">
</head>
<body>
    <header>
        <h1>Blog Về Văn Hoá Việt Nam</h1>
        <p>Chia sẻ trải nghiệm và góc nhìn</p>
    </header>

    <?php include '../includes/nav.php'; ?>

    <div class="container">
        <?php if ($isAdmin): ?>
            <a href="add.php" class="btn btn-success">+ Đăng bài mới</a>
        <?php endif; ?>

        <!-- Bộ lọc bài viết -->
        <form method="GET">
            <select name="sort" onchange="this.form.submit()">
                <option value="latest" <?= ($sort == 'latest') ? 'selected' : '' ?>>Mới nhất</option>
                <option value="popular" <?= ($sort == 'popular') ? 'selected' : '' ?>>Phổ biến</option>
            </select>
        </form>

        <?php
        if ($result->num_rows > 0) {
            while ($blog = $result->fetch_assoc()) {
                $imgPath = "../images/" . htmlspecialchars($blog["hinhanh"]);
                if (!file_exists($imgPath) || empty($blog["hinhanh"])) {
                    $imgPath = "../images/default.jpg"; // Ảnh mặc định nếu không có ảnh
                }

                echo '<div class="article">';
                // echo '<img src="' . $imgPath . '" alt="Ảnh Blog" class="blog-thumbnail">';
                echo '<h2><a href="view-blog.php?id=' . $blog["id"] . '">' . htmlspecialchars($blog["title"]) . '</a></h2>';
                echo '<p><small><b>' . htmlspecialchars($blog["tac_gia"]) . '</b> - ' . date("d/m/Y", strtotime($blog["ngay_dang"])) . '</small></p>';
                echo '<p>' . mb_substr(strip_tags($blog["description"]), 0, 150, 'UTF-8') . '...</p>';
                echo '<p><small>👀 ' . $blog["luot_xem"] . ' | ❤️ ' . $blog["luot_thich"] . '</small></p>';
                
                if ($isAdmin) {
                    echo '<a href="edit.php?id=' . $blog['id'] . '" class="btn btn-warning">Sửa</a>';
                    echo '<a href="delete.php?id=' . $blog['id'] . '" class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bài viết này?\')">Xóa</a>';
                }
                
                echo '</div>';
            }
        } else {
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
