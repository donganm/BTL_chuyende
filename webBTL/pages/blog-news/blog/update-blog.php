<?php
session_start();
include '../../../includes/db.php';

// Kiểm tra phương thức POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $newImage = $_FILES['new_image'];

    if ($id <= 0 || empty($title) || empty($description)) {
        die("Dữ liệu không hợp lệ!");
    }

    // Lấy thông tin bài viết hiện tại để kiểm tra ảnh cũ
    $sql = "SELECT hinhanh FROM blog_articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    if (!$blog) {
        die("Bài viết không tồn tại!");
    }

    // Nếu có ảnh mới được tải lên
    if (!empty($newImage['name'])) {
        $uploadDir = "./images/"; // Đảm bảo đúng thư mục lưu ảnh
        $imageName = time() . "_" . basename($newImage['name']);
        $imagePath = $uploadDir . $imageName;

        // Kiểm tra ảnh hợp lệ và tải lên
        if (move_uploaded_file($newImage['tmp_name'], $imagePath)) {
            // Xóa ảnh cũ nếu có
            if (!empty($blog['hinhanh']) && file_exists($uploadDir . $blog['hinhanh'])) {
                unlink($uploadDir . $blog['hinhanh']);
            }
        } else {
            die("Lỗi khi tải ảnh lên.");
        }
    } else {
        $imageName = $blog['hinhanh']; // Giữ lại ảnh cũ nếu không có ảnh mới
    }

    // Cập nhật bài viết với tiêu đề, mô tả và ảnh (nếu có)
    $sql = "UPDATE blog_articles SET title = ?, description = ?, hinhanh = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $description, $imageName, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        die("Lỗi cập nhật bài viết: " . $conn->error);
    }
}

$conn->close();
?>
