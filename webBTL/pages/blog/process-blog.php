<?php
include '../tintuc/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $image = "";

    // Xử lý upload ảnh
    if ($_FILES["image"]["name"] != "") {
        $target_dir = "../../images/";
        $image = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    // Tạo link bài viết
    $link = "view-blog.php?id=" . time(); 

    // Lưu vào database
    $sql = "INSERT INTO blog_articles (title, description, link) VALUES ('$title', '$description', '$link')";

    
    if ($conn->query($sql) === TRUE) {
        echo "Bài viết đã được đăng!";
        header("Location: blog.php"); // Quay lại trang blog
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

$conn->close();
?>
