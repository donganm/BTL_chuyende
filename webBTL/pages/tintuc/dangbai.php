<?php
session_start();

include '../../includes/db.php';

// Kiểm tra nếu không phải Admin thì đá về trang chủ
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "Admin") {
    header("Location: ../index.php");
    exit();
}

// Xử lý đăng bài
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tieude = trim($_POST['tieude']);
    $noidung = trim($_POST['noidung']);
    // $hinhanh = $_FILES['hinhanh']['name'];

    if ($tieude && $noidung && $hinhanh) {
        $targetDir = "../images/";
        $targetFile = $targetDir . basename($hinhanh);
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], $targetFile);

        $sql = "INSERT INTO tintuc (tieude, noidung, hinhanh) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $tieude, $noidung, $hinhanh);
        $stmt->execute();

        echo "<p>Bài viết đã được đăng!</p>";
    } else {
        echo "<p>Vui lòng điền đầy đủ thông tin.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Bài</title>
</head>
<body>
    <h1>Đăng Bài Viết Mới</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Tiêu đề:</label>
        <input type="text" name="tieude" required><br>
        
        <label>Nội dung:</label>
        <textarea name="noidung" required></textarea><br>

        <!-- <label>Hình ảnh:</label>
        <input type="file" name="hinhanh" required><br> -->

        <button type="submit">Đăng bài</button>
    </form>
    <a href="../tintuc.php">🔙 Quay lại Tin Tức</a>
</body>
</html>
