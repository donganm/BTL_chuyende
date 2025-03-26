<?php
session_start();
include '../../../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';

    if ($id <= 0 || empty($title) || empty($description)) {
        die("Dữ liệu không hợp lệ!");
    }

    $sql = "UPDATE blog_articles SET title = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        die("Lỗi cập nhật bài viết: " . $conn->error);
    }
}

$conn->close();
?>
