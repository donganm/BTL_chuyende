<?php
session_start();
include '../../includes/db.php'; // Đảm bảo file này kết nối với cơ sở dữ liệu

// Kiểm tra kết nối database
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra nếu người dùng đã đăng nhập
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";

// Kiểm tra nếu có ID bài viết, nếu có thì lấy thông tin bài viết từ cơ sở dữ liệu
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $sql = "SELECT tieude, noidung FROM tintuc WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Nếu bài viết tồn tại, gán giá trị cho biến $article
    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        die("Bài viết không tồn tại.");
    }
} else {
    die("Không có ID bài viết.");
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài viết</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Áp dụng các style giống trang Tin tức */
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin: 0 15px;
        }

        nav a:hover,
        nav a.active {
            color: rgb(166, 255, 0);
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group textarea {
            resize: vertical;
        }

        button {
            padding: 8px 15px;
            background: #2980b9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1f618d;
        }

        .user-info {
            float: right;
            font-size: 14px;
            color: lightblue;
        }
    </style>
</head>
<body>
    <header>
        <h1>Chỉnh sửa bài viết</h1>
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
    <form method="POST" action="save-edits.php">
        <input type="hidden" name="id" value="<?php echo $postId; ?>"> <!-- Thêm id bài viết vào form -->
        <div class="form-group">
            <label for="title">Tiêu đề</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['tieude']); ?>" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea id="content" name="content" rows="6" required><?php echo htmlspecialchars($article['noidung']); ?></textarea>
        </div>

        <button type="submit">Lưu thay đổi</button>
    </form>

    </div>

    <script>
        document.getElementById("logout-btn").addEventListener("click", function(event) {
            event.preventDefault();
            fetch('../logout.php', {
                method: 'POST',
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Lỗi khi đăng xuất:", error);
            });
        });
    </script>
</body>
</html>
