<?php
    session_start();
    include '../../../includes/db.php'; // Kết nối database

    if (!$conn) {
        die("Lỗi kết nối database: " . mysqli_connect_error());
    }

    // Kiểm tra xem có `id` trên URL không
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Chuẩn bị truy vấn DELETE
        $stmt = $conn->prepare("DELETE FROM blog_articles WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Xóa thành công -> chuyển về blog.php với thông báo
            header("Location: index.php?message=deleted");
            exit();
        } else {
            echo "Lỗi khi xóa bài viết!";
        }

        $stmt->close();
    } else {
        echo "ID bài viết không hợp lệ!";
    }

    $conn->close();
?>
