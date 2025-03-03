<?php
session_start();
include '../../includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die("ID không hợp lệ!");
}

$sql = "SELECT * FROM blog_articles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();

if (!$blog) {
    die("Không tìm thấy bài viết!");
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa bài viết</title>
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
        <h2>Chỉnh sửa bài viết</h2>
        <form action="update-blog.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label>Tiêu đề:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>

            <label>Mô tả:</label>
            <textarea name="description" required><?php echo htmlspecialchars($blog['description']); ?></textarea>

            <button type="submit">Cập nhật</button>
        </form>
    </div>
</body>
</html>
