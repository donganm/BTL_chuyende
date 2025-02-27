<?php
    // include '../tintuc/db_connect.php';
    include '../../includes/db.php';

// Kiểm tra xem 'id' có trong URL không và đảm bảo nó là số nguyên
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $sql = "SELECT * FROM blog_articles WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // Nếu không có bài viết nào được tìm thấy
        die("Không tìm thấy bài viết!");
    }
} else {
    // Nếu không có ID hợp lệ trong URL
    die("ID không hợp lệ!");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['title']); ?></title>
    <style>
        .container { max-width: 800px; margin: auto; padding: 20px; background: white; }
        img { max-width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($row['title']); ?></h1>
        <?php if (!empty($row['image'])): ?>
            <img src="../../images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
        <?php endif; ?>
        <p><strong><?php echo nl2br(htmlspecialchars($row['description'])); ?></strong></p>
        <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
        <a href="blog.php">← Quay lại Blog</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
