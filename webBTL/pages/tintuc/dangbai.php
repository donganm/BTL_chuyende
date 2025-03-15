<?php
session_start();
include '../../includes/db.php';

// Kiểm tra nếu không phải Admin thì chuyển về trang chủ
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "Admin") {
    header("Location: ../../index.php");
    exit();
}

// Kiểm tra kết nối database
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra người dùng đã đăng nhập chưa
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";

// Xử lý đăng bài
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tieude = trim($_POST['tieude']);
    $noidung = trim($_POST['noidung']);

    // Kiểm tra xem có file ảnh được tải lên không
    if (!empty($_FILES['hinhanh']['name'])) {
        $hinhanh = basename($_FILES['hinhanh']['name']);
        $targetDir = "./images/";
        $targetFile = $targetDir . $hinhanh;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        // Kiểm tra định dạng file hợp lệ
        if (!in_array($fileType, $allowedTypes)) {
            echo "<p>Chỉ chấp nhận các tệp ảnh JPG, JPEG, PNG, GIF.</p>";
            exit();
        }

        // Di chuyển file tải lên thư mục đích
        if (!move_uploaded_file($_FILES['hinhanh']['tmp_name'], $targetFile)) {
            echo "<p>Lỗi khi tải ảnh lên. Vui lòng thử lại.</p>";
            exit();
        }
    } else {
        $hinhanh = "default.jpg"; // Ảnh mặc định nếu không chọn ảnh
    }

    // Kiểm tra tiêu đề và nội dung có giá trị không
    if ($tieude && $noidung) {
        $sql = "INSERT INTO tintuc (tieude, noidung, hinhanh) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $tieude, $noidung, $hinhanh);

        if ($stmt->execute()) {
            echo "<p>Bài viết đã được đăng thành công!</p>";
        } else {
            echo "<p>Lỗi khi lưu vào database.</p>";
        }
    } else {
        echo "<p>Vui lòng nhập đầy đủ tiêu đề và nội dung.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Bài</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

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
        <h1>Đăng Bài Viết Mới</h1>
        <form method="POST" enctype="multipart/form-data">
            <label>Tiêu đề:</label>
            <input type="text" name="tieude" required>
            
            <label>Nội dung:</label>
            <textarea name="noidung" required rows="5"></textarea>
            
            <label>Ảnh minh họa:</label>
            <input type="file" name="hinhanh" accept="image/*">
            
            <button type="submit">Đăng bài</button>
        </form>
        <a href="./tintuc.php" class="back-link">🔙 Quay lại Tin Tức</a>
    </div>
</body>
</html>
