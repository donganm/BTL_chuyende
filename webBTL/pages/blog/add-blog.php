<?php
    // include '../tintuc/db_connect.php';
    include '../../includes/db.php';
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
