<?php
session_start();
$role = $_SESSION['role'] ?? 'User';
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
    <link rel="stylesheet" href="./style/tintuc.css">
    <style>
        .user-info {
            float: right;
            margin-right: 20px;
            font-size: 14px;
            color:lightblue;
        }

        .user-info a {
            margin-left: 10px;
            text-decoration: none;
            font-weight: bold;
            color: white;
        }

        .user-info a:hover {
            color: #007bff;
        }

    </style>
</head>

<body>
    <header>
        <h1>Tin tức về di sản Việt Nam</h1>
        <p>Nơi lưu giữ giá trị văn hóa và lịch sử</p>
    </header>

    <nav style="height: 70px">
        <div class="nav-links">
            <a href="../index.php">Trang chủ</a>
            <a href="tintuc.php" class="active">Tin tức</a>
            <a href="./blog/blog.php">Blog</a>
        </div>
        
        
        <div class="user-info">
            <?php if ($userLoggedIn): ?>
                <span>Xin chào, <strong><?php echo $_SESSION['user']; ?></strong> (<?php echo $isAdmin ? "Admin" : "User"; ?>)</span>
                <a href="../pages/profile.php">Hồ sơ</a> |
                <a href="#" id="logout-btn" style="color: red; cursor: pointer;">Đăng xuất</a>
            <?php else: ?>
                <a href="../pages/login.php">Đăng nhập</a>
            <?php endif; ?>
        </div>

    <script>
        document.getElementById("logout-btn").addEventListener("click", function(event) {
            event.preventDefault(); // Ngăn chặn chuyển trang
            fetch("../pages/logout.php", {
                method: "POST"
            }).then(response => {
                if (response.ok) {
                    location.reload(); // Tải lại trang sau khi đăng xuất
                }
            });
        });
    </script>



    </nav>



    <div class="container">
        <!-- Thanh tìm kiếm -->
        <form method="GET">
            <input type="text" name="search" placeholder="Tìm kiếm bài viết..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Tìm kiếm</button>
        </form>

        <!-- ✅ Chỉ hiển thị nút Đăng bài nếu là Admin -->
        <?php if ($isAdmin): ?>
            <a href="tintuc/dangbai.php" class="btn btn-primary" style="display: inline-block; margin: 10px; padding: 10px; background: #27ae60; color: white; text-decoration: none;">+ Đăng bài</a>
        <?php endif; ?>

        <!-- Hiển thị bài viết -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($article = $result->fetch_assoc()): ?>
                <div class="article">
                    <img src="../images/<?php echo htmlspecialchars($article["hinhanh"]); ?>" 
                         alt="<?php echo htmlspecialchars($article["tieude"]); ?>" 
                         onerror="this.onerror=null;this.src='../images/default.jpg';">
                    <h2>
                        <a href="./tintuc/heritage.php?id=<?php echo $article['id']; ?>">
                            <?php echo htmlspecialchars($article["tieude"]); ?>
                        </a>
                    </h2>
                    <p><?php echo mb_substr(strip_tags($article["noidung"]), 0, 150, 'UTF-8'); ?>...</p>
                    
                    <!-- ✅ Chỉ Admin mới có quyền Sửa/Xóa -->
                    <?php if ($isAdmin): ?>
                        <a href="./tintuc/edit-post.php?id=<?php echo $article['id']; ?>" class="btn btn-warning">Sửa</a>
                        <a href="./tintuc/delete.php?id=<?php echo $article['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?');">Xóa</a>
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
