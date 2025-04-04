<?php
session_start();
include '../../../includes/db.php';

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra đăng nhập và quyền admin
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";

// Kiểm tra nếu có bài viết
if (isset($_POST['id'])) {
    $postId = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (empty($title) || empty($content)) {
        echo "<script>alert('Tiêu đề và nội dung không được để trống.'); history.back();</script>";
        exit;
    }

    // Kiểm tra nếu người dùng có chọn ảnh mới
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $targetDir = '../../../uploads/';
        $imageName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $imageName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Chỉ chấp nhận một số định dạng ảnh
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileType, $allowedTypes)) {
            echo "<script>alert('Chỉ chấp nhận các định dạng ảnh: JPG, JPEG, PNG, GIF'); history.back();</script>";
            exit;
        }

        // Di chuyển ảnh vào thư mục uploads
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            // Lưu vào DB bao gồm ảnh mới
            $sql = "UPDATE tintuc SET tieude = ?, noidung = ?, hinhanh = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $title, $content, $imageName, $postId);
        } else {
            echo "<script>alert('Không thể tải ảnh lên.'); history.back();</script>";
            exit;
        }
    } else {
        // Không có ảnh mới, chỉ cập nhật tiêu đề và nội dung
        $sql = "UPDATE tintuc SET tieude = ?, noidung = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $content, $postId);
    }

    if ($stmt->execute()) {
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
