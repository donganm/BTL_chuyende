<?php
session_start();

if (!isset($_SESSION['redirect_url'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}

include '../../../includes/db.php'; 

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

$role = $_SESSION['role'] ?? 'User';
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && $role === "Admin";

// Xử lý tìm kiếm bài viết
$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$sql = "SELECT id, tieude, noidung, hinhanh, ngay_dang FROM tintuc WHERE tieude LIKE ? ORDER BY ngay_dang DESC";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Lỗi SQL: " . $conn->error);
}

$searchTerm = "%$search%";
$stmt->bind_param("s", $searchTerm);

if (!$stmt->execute()) {
    die("Lỗi thực thi truy vấn: " . $stmt->error);
}

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức Di Sản</title>
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="../includes/nav.css">
    <style>
        .btn-primary {
            display: inline-block;
            margin: 10px;
            padding: 10px;
            background: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background: #219150;
        }
    </style>
</head>

<body>
    <header>
        <h1>Tin tức về di sản Việt Nam</h1>
        <p>Cập nhật nhanh nhất về các sự kiện, chính sách, và hoạt động bảo tồn di sản</p>
    </header>

    <?php include '../includes/nav.php'; ?>

    <div class="container">
        <!-- Thanh tìm kiếm -->
        <form method="GET">
            <input type="text" name="search" placeholder="Tìm kiếm tin tức..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Tìm kiếm</button>
        </form>

        <!-- Nút đăng bài (Chỉ hiển thị nếu là Admin) -->
        <?php if ($isAdmin): ?>
            <a href="./dangbai.php" class="btn btn-primary">+ Đăng bài</a>
        <?php endif; ?>

        <!-- Hiển thị danh sách tin tức -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($article = $result->fetch_assoc()): ?>
                <div class="article">
                    <img src="./images/<?php echo htmlspecialchars($article["hinhanh"]); ?>" 
                         alt="<?php echo htmlspecialchars($article["tieude"]); ?>" 
                         onerror="this.onerror=null;this.src='../images/default.jpg';">

                    <h2>
                        <a href="./heritage.php?id=<?php echo $article['id']; ?>">
                            <?php echo htmlspecialchars($article["tieude"]); ?>
                        </a>
                    </h2>

                    <p class="date-category">
                        🗓 <?php echo date("d/m/Y", strtotime($article["ngay_dang"])); ?>  
                        <!-- | 📂 <?php echo htmlspecialchars($article["danh_muc"] ?? "Chưa phân loại"); ?> -->
                    </p>

                    <p><?php echo mb_substr(strip_tags($article["noidung"]), 0, 150, 'UTF-8'); ?>...</p>
                    
                    <!-- Chỉ hiển thị nút Sửa/Xóa nếu là Admin -->
                    <?php if ($isAdmin): ?>
                        <a href="./edit.php?id=<?php echo $article['id']; ?>" class="btn btn-warning" style="color: blue">Sửa</a>
                        <a href="./delete.php?id=<?php echo $article['id']; ?>" class="btn btn-danger" style="color: red" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?');">Xóa</a>
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
