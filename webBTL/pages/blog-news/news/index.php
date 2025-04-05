<?php
session_start();

if (!isset($_SESSION['redirect_url'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}

include '../../../includes/db.php';

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$searchTerm = "%$search%";

// Phân trang
$perPage = 3; // Số bài viết trên mỗi trang
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Lấy tổng số bài viết để tính số trang
$countSql = "SELECT COUNT(*) as total FROM tintuc WHERE tieude LIKE ?";
$countStmt = $conn->prepare($countSql);
$countStmt->bind_param("s", $searchTerm);
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $perPage);
$countStmt->close();

// Lấy danh sách bài viết cho trang hiện tại
$sql = "SELECT id, tieude, noidung, hinhanh, ngay_dang FROM tintuc 
        WHERE tieude LIKE ? 
        ORDER BY ngay_dang DESC 
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $searchTerm, $perPage, $offset);
$stmt->execute();
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

    </style>
</head>

<body>
    <header>
        <h1>TIN TỨC VỀ DI SẢN VIỆT NAM</h1>
        <p>Cập nhật nhanh nhất, ngắn gọn về các sự kiện, chính sách, và hoạt động bảo tồn di sản</p>
    </header>

    <?php include '../includes/nav.php'; ?>

    <div class="container">
        <!-- Thanh tìm kiếm -->
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Tìm kiếm nhanh về tin tức..."
                value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Tìm Kiếm</button>
                    <!-- Nút đăng bài (Chỉ hiển thị nếu là Admin) -->
            <?php if ($isAdmin): ?>
                <a href="./dangbai.php" class="btn btn-primary">+ Đăng bài</a>
            <?php endif; ?>
        </form>




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

                    <p class="content"><?php echo mb_substr(strip_tags($article["noidung"]), 0, 152, 'UTF-8'); ?>...</p>

                    <!-- Chỉ hiển thị nút Sửa/Xóa nếu là Admin -->
                    <?php if ($isAdmin): ?>
                        <a class="update-link" href="./edit.php?id=<?php echo $article['id']; ?>" class="btn btn-warning" style="color: blue">Sửa</a>
                        <a class="delete-link" href="./delete.php?id=<?php echo $article['id']; ?>" class="btn btn-danger" style="color: red" onclick="return confirm('Bạn có chắc muốn xóa bài viết này?');">Xóa</a>
                    <?php endif; ?>

                    <div class="date-category">
                        Ngày đăng <?php echo date("d/m/Y", strtotime($article["ngay_dang"])); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Không có bài viết nào.</p>
        <?php endif; ?>

        <!-- Thanh phân trang -->
        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?search=<?php echo urlencode($search); ?>&page=1">Đầu</a>
                    <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page - 1; ?>">« Trước</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>"
                        class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page + 1; ?>">Tiếp »</a>
                    <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $totalPages; ?>">Cuối</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>