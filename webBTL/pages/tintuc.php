<?php
session_start();
include '../includes/db.php'; // Kết nối database

// Kiểm tra kết nối database
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra người dùng đã đăng nhập chưa
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";

// Xử lý tìm kiếm bài viết
$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$sql = "SELECT id, tieude, noidung, hinhanh FROM tintuc WHERE tieude LIKE ? ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức</title>
    <link rel="stylesheet" href="style/tintuc.css">
</head>

<body>
    <header>
        <h1>Tin tức về di sản Việt Nam</h1>
        <p>Nơi lưu giữ giá trị văn hóa và lịch sử</p>
    </header>

    <nav>
        <a href="../index.php">Trang chủ</a>
        <a href="tintuc.php" class="active">Tin tức</a>
        <a href="../blog/blog.php">Blog</a>
    </nav>

    <div class="container">
        <!-- Thanh tìm kiếm -->
        <form method="GET">
            <input type="text" name="search" placeholder="Tìm kiếm bài viết..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Tìm kiếm</button>
        </form>

        <!-- ✅ Chỉ hiển thị nút Đăng bài nếu là Admin -->
        <?php if ($isAdmin): ?>
            <a href="tintuc/dangbai.php" class="btn btn-primary">+ Đăng bài</a>
        <?php endif; ?>

        <!-- Hiển thị bài viết -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($article = $result->fetch_assoc()): ?>
                <div class="article">
                    <img src="../images/<?php echo htmlspecialchars($article["hinhanh"]); ?>" 
                         alt="<?php echo htmlspecialchars($article["tieude"]); ?>" 
                         onerror="this.onerror=null;this.src='../images/default.jpg';">
                    <h2>
                        <a href="chitiet.php?id=<?php echo $article['id']; ?>">
                            <?php echo htmlspecialchars($article["tieude"]); ?>
                        </a>
                    </h2>
                    <p><?php echo mb_substr(strip_tags($article["noidung"]), 0, 150, 'UTF-8'); ?>...</p>
                    
                    <!-- ✅ Chỉ Admin mới có quyền Sửa/Xóa -->
                    <?php if ($isAdmin): ?>
                        <a href="edit.php?id=<?php echo $article['id']; ?>" class="btn btn-warning">Sửa</a>
                        <a href="delete.php?id=<?php echo $article['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?');">Xóa</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Không có bài viết nào.</p>
        <?php endif; ?>

    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
