<?php
session_start();
include '../../includes/db.php';

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Xử lý khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_id = isset($_POST['article_id']) ? (int)$_POST['article_id'] : 0;
    $content = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Ẩn danh';

    if ($article_id > 0 && !empty($content)) {
        $sql = "INSERT INTO comments (article_id, username, content) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $article_id, $username, $content);

        if ($stmt->execute()) {
            header("Location: view-blog.php?id=" . $article_id);
            exit();
        } else {
            echo "Lỗi khi thêm bình luận!";
        }
    } else {
        echo "Dữ liệu không hợp lệ!";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['title']); ?></title>
    <style>
        .container { max-width: 800px; margin: auto; padding: 20px; background: white; }
        img { max-width: 100%; border-radius: 5px; }
        .meta { color: gray; font-size: 14px; margin-bottom: 10px; }
        .comment-section { margin-top: 20px; padding: 15px; background: #f9f9f9; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($row['title']); ?></h1>
        <p class="meta">Ngày đăng: 
            <?php echo isset($row['created_at']) ? date('d/m/Y', strtotime($row['created_at'])) : 'Không có dữ liệu'; ?>
        </p>

        <?php if (!empty($row['image'])): ?>
            <img src="../../images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
        <?php endif; ?>

        <p><strong><?php echo nl2br(htmlspecialchars($row['description'])); ?></strong></p>
        <p><?php echo isset($row['content']) ? nl2br(htmlspecialchars($row['content'])) : 'Chưa có nội dung'; ?></p>

        <a href="blog.php">← Quay lại Blog</a>

        <!-- Hiển thị bình luận -->
        <div class="comment-section">
            <h3>Bình luận</h3>
            <form action="process-comment.php" method="POST">
              <input type="hidden" name="article_id" value="<?php echo isset($row['id']) ? $row['id'] : 0; ?>">
              <textarea name="comment" required placeholder="Viết bình luận..."></textarea>
              <button type="submit">Gửi</button>
          </form>


            <?php
            // Lấy bình luận từ database
            $commentSql = "SELECT * FROM comments WHERE article_id = ? ORDER BY created_at DESC";
            $stmt = $conn->prepare($commentSql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $comments = $stmt->get_result();

            while ($comment = $comments->fetch_assoc()) {
                echo "<p><strong>{$comment['username']}</strong>: " . htmlspecialchars($comment['content']) . " <br><span style='color:gray;'>{$comment['created_at']}</span></p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
