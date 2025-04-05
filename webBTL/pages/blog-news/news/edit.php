<?php
session_start();
include '../../../includes/db.php';

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra nếu người dùng đã đăng nhập
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";

// Kiểm tra nếu có ID bài viết, nếu có thì lấy thông tin bài viết từ cơ sở dữ liệu
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $sql = "SELECT tieude, noidung, hinhanh FROM tintuc WHERE id = ?";
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
    <link rel="stylesheet" href="../includes/header.css">
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 1px;
            text-align: center;
            margin: 0;
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
            padding-left: 25px;
            font-weight: bold;
            font-size: 25px;
        }

        .form-group input,
        .form-group textarea {
            width: 80%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 70%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
        }

        .form-group textarea {
            resize: none;
            overflow: auto;
            height: 100%;
            font-size: 16px;
        }

        .save-button {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        button {
            padding: 14px 20px;
            font-size: 16px;
            background: #2980b9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 30px;
            font-weight: bold;
        }

        button:hover {
            background: #1f618d;
        }
    </style>
</head>

<body>
    <header>
        <h1>Chỉnh sửa bài viết</h1>
    </header>

    <!-- <nav>
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
    </nav> -->

    <?php include '../includes/header.php'; ?>

    <div class="container">
        <form method="POST" action="save-edits.php" enctype="multipart/form-data">
            <input class="save-button" type="hidden" name="id" value="<?php echo $postId; ?>"> <!-- Thêm id bài viết vào form -->
            <div class="form-group save-button">
                <label for="title">Tiêu đề</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['tieude']); ?>" required>
            </div>

            <div class="form-group save-button">
                <label for="content">Nội dung</label>
                <textarea class="save-button" id="content" name="content" rows="6" required><?php echo htmlspecialchars($article['noidung']); ?></textarea>

            <div class="form-group save-button">
                    <label>Ảnh hiện tại</label><br>
                    <img src="./images/<?php echo $article["hinhanh"]; ?>" alt="Ảnh bài viết" style="max-width: 80%; height: auto;">
                </div>

            <div class="form-group save-button">
                    <label for="image">Chọn ảnh mới (nếu muốn thay đổi)</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>

                <div class="save-button">
                    <button type="submit">Lưu thay đổi</button>
                </div>
            </div>


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

        const textarea = document.getElementById("content");

        function autoResize() {
            textarea.style.height = "auto"; // Reset height
            textarea.style.height = textarea.scrollHeight + "px"; // Set to scroll height
        }

        // Gọi khi tải trang
        window.addEventListener("load", autoResize);
        // Gọi mỗi khi gõ phím
        textarea.addEventListener("input", autoResize);
    </script>
</body>

</html>