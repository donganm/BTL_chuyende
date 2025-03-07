<?php
session_start();
include '../../includes/db.php';

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Bạn cần đăng nhập để thực hiện hành động này!'); window.location.href = '../pages/login.php';</script>";
    exit();
}

// Lấy thông tin quyền từ session
$role = $_SESSION['role'] ?? 'User'; // Mặc định là 'User'

// Kiểm tra nếu có ID bài viết hợp lệ
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Chỉ admin mới được xóa bài viết
    if ($role !== 'Admin') {
        echo "<script>alert('Bạn không có quyền xóa bài viết!'); window.history.back();</script>";
        exit();
    }

    // Kiểm tra bài viết có tồn tại không
    $sql_check = "SELECT * FROM tintuc WHERE id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows == 0) {
        echo "<script>alert('Bài viết không tồn tại!'); window.history.back();</script>";
        exit();
    }

    // Tiến hành xóa bài viết
    $sql_delete = "DELETE FROM tintuc WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);

    if ($stmt_delete->execute()) {
        echo "<script>alert('Xóa bài thành công!'); window.location.href = '../tintuc.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa bài!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('ID bài viết không hợp lệ!'); window.history.back();</script>";
}
?>
