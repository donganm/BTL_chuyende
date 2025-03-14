<?php
session_start();

// Lưu lại trang hiện tại trước khi chuyển đến trang đăng nhập
if (!isset($_SESSION['redirect_url'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];  // Lưu URL của trang hiện tại (ví dụ: blog.php hoặc tintuc.php)
}
include '../../includes/db.php'; // Kết nối database

// Kiểm tra kết nối database
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

$role = $_SESSION['role'] ?? 'User';

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
    <link rel="stylesheet" href="../style.css">
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

                /* Reset CSS */
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
        }

        /* Body */
        body {
        background-color: #f4f4f4;
        color: #333;
        line-height: 1.6;
        }

        /* Header */
        header {
        background: #2c3e50;
        color: white;
        padding: 15px;
        text-align: center;
        }

        /* Navigation */
        nav {
        background: #34495e;
        text-align: center;
        padding: 10px;
        }

        nav a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        margin: 0 15px;
        transition: color 0.3s;
        }

        nav a:hover,
        nav a.active {
        color: rgb(166, 255, 0);
        }

        /* Container */
        .container {
        max-width: 900px;
        margin: 20px auto;
        padding: 20px;
        background: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        }

        /* Bài viết */
        .article {
        border-bottom: 1px solid #ddd;
        padding: 20px 0;
        }

        .article:last-child {
        border-bottom: none;
        }

        .article h2 {
        color: #2c3e50;
        font-size: 22px;
        }

        .article a {
        text-decoration: none;
        color: #2c3e50;
        }

        .article a:hover {
        color: #2980b9;
        }

        .article p {
        color: #555;
        font-size: 16px;
        }

        .article img {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 5px;
        }

        /* Form tìm kiếm */
        form {
        text-align: center;
        margin-bottom: 20px;
        }

        input[type="text"] {
        padding: 8px;
        width: 60%;
        border: 1px solid #ccc;
        border-radius: 5px;
        }

        button {
        padding: 8px 15px;
        background: #2980b9;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
        }

        button:hover {
        background: #1f618d;
        }

        /* Chi tiết bài viết */
        .single-article img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 5px;
        }

        .single-article p {
        font-size: 18px;
        color: #444;
        line-height: 1.8;
        }

        /* Nút quay lại */
        .back-link {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 15px;
        background: #34495e;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
        }

        .back-link:hover {
        background: #2c3e50;
        }

        /* Navigation */
        nav {
        background: #34495e;
        padding: 10px;
        display: flex;
        justify-content: space-between; /* Canh đều hai bên */
        align-items: center;
        }

        .nav-links {
        display: flex;
        gap: 15px;
        }

        .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: white;
        }

        .user-info a {
        color: white;
        text-decoration: none;
        font-weight: bold;
        }

        .user-info a:hover {
        color: rgb(166, 255, 0);
        }

        .btn-warning {
            color: lightcoral;
        }

        .btn-danger {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <h1>Tin tức về di sản Việt Nam</h1>
        <p>Nơi lưu giữ giá trị văn hóa và lịch sử</p>
    </header>

    <nav>
        <a href="../../index.php">Trang chủ</a>
        <a href="tintuc.php" class="active">Tin tức</a>
        <a href="../blog/blog.php">Blog</a>
        <div class="user-info">
            <?php if ($userLoggedIn): ?>
                <span>Xin chào, <strong><?php echo $_SESSION['user']; ?></strong> (<?php echo $isAdmin ? "Admin" : "User"; ?>)</span>
                <a href="../profile.php">Hồ sơ</a> |
                <a href="#" id="logout-btn">Đăng xuất</a>
            <?php else: ?>
                <a href="../login.php">Đăng nhập</a>
            <?php endif; ?>
        </div>
        <script>
            document.getElementById("logout-btn").addEventListener("click", function(event) {
                event.preventDefault(); // Ngừng hành động mặc định (chuyển hướng)

                fetch('../logout.php', {
                    method: 'POST',
                })
                .then(response => {
                    if (response.ok) { // Kiểm tra xem yêu cầu có thành công
                        location.reload(); // Làm mới trang sau khi đăng xuất
                    }
                })
                .catch(error => {
                    console.error("Lỗi khi đăng xuất:", error);
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
            <a href="./dangbai.php" class="btn btn-primary" style="display: inline-block; margin: 10px; padding: 10px; background: #27ae60; color: white; text-decoration: none;">+ Đăng bài</a>
        <?php endif; ?>

        <!-- Hiển thị bài viết -->
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
                    <p><?php echo mb_substr(strip_tags($article["noidung"]), 0, 150, 'UTF-8'); ?>...</p>
                    
                    <!-- ✅ Chỉ Admin mới có quyền Sửa/Xóa -->
                    <?php if ($isAdmin): ?>
                        <a href="./edit-post.php?id=<?php echo $article['id']; ?>" class="btn btn-warning" style="color: blue">Sửa</a>
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
