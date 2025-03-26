<?php
session_start();
include '../../../includes/db.php'; // Đảm bảo kết nối với cơ sở dữ liệu

// Kiểm tra kết nối database
if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra nếu người dùng đã đăng nhập và là Admin
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";

// Kiểm tra nếu có ID bài viết
if (isset($_POST['id'])) {
    $postId = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Kiểm tra nếu tiêu đề và nội dung không để trống
    if (empty($title) || empty($content)) {
        echo "<script>alert('Tiêu đề và nội dung không được để trống.'); history.back();</script>";
        exit;
    }

    // Cập nhật bài viết vào cơ sở dữ liệu
    $sql = "UPDATE tintuc SET tieude = ?, noidung = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $postId);

    if ($stmt->execute()) {
        // Nếu thành công, chuyển hướng về trang tin tức
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Lỗi khi cập nhật bài viết.'); history.back();</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Không có bài viết để cập nhật.'); history.back();</script>";
}

$conn->close();
?>
