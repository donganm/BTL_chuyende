<?php
include '../../../includes/db.php'; // Kết nối database

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

session_start(); // Đảm bảo session đã khởi động

// Kiểm tra nếu người dùng đã đăng nhập
$userLoggedIn = isset($_SESSION['user']) ? true : false;

// Kiểm tra quyền admin (giả sử session lưu trữ quyền admin)
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;


if (!isset($_SESSION['redirect_url'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}

// Xử lý tìm kiếm bài viết
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


// Kiểm tra ID bài viết
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Thiếu hoặc sai ID bài viết!");
}

$id = intval($_GET['id']);
$sql = "SELECT tieude, noidung, hinhanh FROM tintuc WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Bài viết không tồn tại!");
}
$article = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article["tieude"]); ?></title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="../includes/header.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            width: 100%;
            background-color: #2c3e50;
            padding: 15px 0;
            text-align: center;
        }

        header h1 {
            color: white;
            font-size: 2em;
            margin: 0;
            padding: 10px;
        }


        .container {
            max-width: 800px;
            background: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .single-article img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .single-article p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
            text-align: justify;
            margin-top: 5px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .back-link:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>


    <!-- <nav>
        <a href="../../index.php">Trang chủ</a>
        <a href="./news.php">Tin tức</a>
        <a href="../blog/blog.php">Blog</a>
    </nav> -->
    <?php include '../includes/header.php'; ?>

    <div style="margin-bottom: 0px;">
        <h1><?php echo htmlspecialchars($article["tieude"]); ?></h1>
    </div>

    <div class="container single-article">
        <img src="./images/<?php echo htmlspecialchars($article['hinhanh']); ?>"
            alt="<?php echo htmlspecialchars($article['tieude']); ?>"
            onerror="this.onerror=null;this.src='./images/default.jpg';">

        <p><?php echo nl2br(htmlspecialchars($article["noidung"])); ?></p>
        <a href="./news.php" class="back-link">Quay lại</a>
    </div>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>