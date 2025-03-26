<?php
session_start();

// Lưu lại trang hiện tại trước khi chuyển đến trang đăng nhập
if (!isset($_SESSION['redirect_url'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];  // Lưu URL của trang hiện tại (ví dụ: blog.php hoặc tintuc.php)
}

include '../../../includes/db.php';

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra trạng thái người dùng
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === 'Admin';

$sql = "SELECT id, title, description FROM blog_articles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="./style.css">
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
        <h1>Blog Về Văn Hoá Việt Nam</h1>
        <p>Chia sẻ trải nghiệm và góc nhìn</p>
    </header>

    <?php include '../news/includes/nav.php'; ?>

    <div class="container">
        <?php if ($isAdmin): ?>
            <a href="add-blog.php" style="display: inline-block; margin: 10px; padding: 10px; background: #27ae60; color: white; text-decoration: none;">+ Đăng bài mới</a>
        <?php endif; ?>

        <?php
        if ($result->num_rows > 0) {
            while ($blog = $result->fetch_assoc()) {
                echo '<div class="article">';
                echo '<h2><a href="view-blog.php?id=' . $blog["id"] . '">' . $blog["title"] . '</a></h2>';
                echo '<p>' . $blog["description"] . '</p>';
                
                if ($isAdmin) {
                    echo '<a href="edit-blog.php?id=' . $blog['id'] . '" style="color: blue; margin-right: 10px;">Sửa</a>';
                    echo '<a href="delete-blog.php?id=' . $blog['id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bài viết này?\')" style="color: red;">Xóa</a>';
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
