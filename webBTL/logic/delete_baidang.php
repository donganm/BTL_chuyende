<?php
include '../includes/db.php';

// Kiểm tra xem ID người dùng có tồn tại trong URL không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Bắt đầu giao dịch để đảm bảo các thao tác xóa đồng bộ
    mysqli_begin_transaction($conn);


    // 1. Xóa các bài viết, thông tin có liên quan đến người dùng (chua co CSDL)

    // 2. Xóa người dùng
    $sql_delete_user = "DELETE FROM `posts` WHERE `id` = ?";
    $stmt_delete_user = $conn->prepare($sql_delete_user);
    $stmt_delete_user->bind_param("i", $id);
    $stmt_delete_user->execute();
    $stmt_delete_user->close();

    // Commit giao dịch nếu tất cả các thao tác thành công
    mysqli_commit($conn);

    // Chuyển hướng về trang profile sau khi xóa thành công
    header('Location: ../pages/profile.php');
    exit();
} else {
    echo "ID người dùng không hợp lệ!";
}

$conn->close();
