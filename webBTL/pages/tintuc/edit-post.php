<?php
session_start();
include '../../includes/db.php'; // Đảm bảo file này có kết nối CSDL

// Kiểm tra đăng nhập
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Bạn cần đăng nhập!'); window.location.href = '../pages/login.php';</script>";
    exit();
}

// Kiểm tra quyền
$role = $_SESSION['role'] ?? 'User';
if ($role !== 'Admin') {
    echo "<script>alert('Bạn không có quyền chỉnh sửa bài viết!'); window.history.back();</script>";
    exit();
}

// Kiểm tra ID bài viết
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ID bài viết không hợp lệ!'); window.history.back();</script>";
    exit();
}

$id = $_GET['id'];

// Lấy bài viết từ DB
$sql = "SELECT * FROM tintuc WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// Kiểm tra bài viết có tồn tại không
if (!$post) {
    echo "<script>alert('Bài viết không tồn tại!'); window.history.back();</script>";
    exit();
}

// Xử lý cập nhật bài viết
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['tieude'] ?? '';
    $content = $_POST['noidung'] ?? '';
    
    if (empty($title) || empty($content)) {
        echo "<script>alert('Vui lòng nhập đủ thông tin!');</script>";
    } else {
        $sql_update = "UPDATE tintuc SET tieude = ?, noidung = ? WHERE id = ?";

        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssi", $title, $content, $id);

        if ($stmt_update->execute()) {
            echo "<script>alert('Cập nhật bài viết thành công!'); window.location.href = '../tintuc.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi cập nhật bài viết!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài viết</title>
    <link rel="stylesheet" href="../style/tintuc.css">
</head>
<body>
    <h2>Chỉnh sửa bài viết</h2>

    <form method="POST">
      <label for="tieude">Tiêu đề:</label>
      <input type="text" name="tieude" id="tieude" value="<?php echo isset($row['tieude']) ? htmlspecialchars($row['tieude']) : ''; ?>" required>

      <label for="noidung">Nội dung:</label>
      <textarea name="noidung" id="noidung" required><?php echo isset($row['noidung']) ? htmlspecialchars($row['noidung']) : ''; ?></textarea>

      <button type="submit">Lưu thay đổi</button>

        <a href="tintuc.php">Hủy</a>
    </form>
</body>
</html>
