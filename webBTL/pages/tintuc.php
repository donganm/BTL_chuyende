<?php
// Đúng đường dẫn file kết nối DB
// include './tintuc/db_connect.php';
    include '../includes/db.php';
// Kiểm tra kết nối
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Truy vấn lấy dữ liệu từ bảng `articles`
$sql = "SELECT title, description, link, image FROM articles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        a {
            text-decoration: none;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav {
            background: #34495e;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            margin: 0 15px;
            font-weight: bold;
        }

        nav a.active {
            font-weight: bold;
            color:rgb(166, 255, 0); 
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .article {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .article h2 {
            color: #2c3e50;
        }

        .article p {
            color: #555;
        }

        .article img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <header>
        <h1>Tin tức về di sản Việt Nam</h1>
        <p>Nơi lưu giữ giá trị văn hóa và lịch sử</p>
    </header>

    <nav>
        <a href="../index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Trang chủ</a>
        <a href="./tintuc.php" class="active">Tin tức</a>
        <a href="./blog/blog.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">Blog</a>
    </nav>

    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($article = $result->fetch_assoc()) {
                // Xử lý đường dẫn bài viết
                $link = $article["link"];
                if (strpos($link, 'tintuc/') === false) {
                    $link = 'tintuc/' . $link;
                }

                // Xử lý đường dẫn ảnh
                $imagePath = '../images/' . $article["image"];

                echo '<div class="article">';
                echo '<img src="' . $imagePath . '" alt="' . $article["title"] . '">';
                echo '<h2><a href="' . $link . '">' . $article["title"] . '</a></h2>';
                echo '<p>' . $article["description"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>Không có bài viết nào.</p>";
        }

        // Đóng kết nối database
        $conn->close();
        ?>
    </div>
</body>
</html>