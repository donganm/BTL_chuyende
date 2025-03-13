<?php
session_start();
include '../../includes/db.php';

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
    <link rel="stylesheet" href="style.css">
    <style>
        .nav-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            gap: 15px;
        }

        .menu {
            display: flex;
            gap: 15px;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .article {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

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
        <h1>Blog Về Văn Hoá Việt Nam</h1>
        <p>Chia sẻ trải nghiệm và góc nhìn</p>
    </header>

    <nav style="height: 50px">
        <div class="nav-links">
            <a href="../../index.php">Trang chủ</a>
            <a href="../tintuc/tintuc.php">Tin tức</a>
            <a href="./blog.php" class="active">Blog</a>
        </div>
        
        
        <div class="user-info">
            <?php if ($userLoggedIn): ?>
                <span>Xin chào, <strong><?php echo $_SESSION['user']; ?></strong> (<?php echo $isAdmin ? "Admin" : "User"; ?>)</span>
                <a href="../profile.php">Hồ sơ</a> |
                <a href="#" id="logout-btn" style="color: red; cursor: pointer;">Đăng xuất</a>
            <?php else: ?>
                <a href="../login.php">Đăng nhập</a>
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