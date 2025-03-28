<?php
    // include '../tintuc/db_connect.php';
    include '../../includes/db.php';

    // Xử lý thêm bài viết
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    
    if (empty($title) || empty($content)) {
        echo "<script>alert('Tiêu đề và nội dung không được để trống.'); history.back();</script>";
        exit;
    }
    
    $sql = "INSERT INTO blogs (title, content, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $content);
    if ($stmt->execute()) {
        header("Location: blog.php");
        exit;
    } else {
        echo "<script>alert('Lỗi khi thêm bài viết.'); history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng bài mới</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { background: #2c3e50; color: white; padding: 10px; border: none; cursor: pointer; }
        button:hover { background: #34495e; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng bài mới</h2>
        <form action="process-blog.php" method="POST" enctype="multipart/form-data">
            <label>Tiêu đề:</label>
            <input type="text" name="title" required>

            <label>Mô tả:</label>
            <textarea name="description" required></textarea>

            <!-- <label>Nội dung:</label>
            <textarea name="content" rows="5" required></textarea> -->

            <!-- <label>Hình ảnh:</label>
            <input type="file" name="image"> -->

            <button type="submit">Đăng bài</button>
        </form>
    </div>
</body>
</html>
