<?php
session_start();
include '../../../includes/db.php'; // Kết nối database

// Kiểm tra nếu người dùng đã đăng nhập
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die("ID không hợp lệ!");
}

// Lấy bài viết từ database
$sql = "SELECT * FROM blog_articles WHERE id = ? LIMIT 1";
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
    <title><?php echo htmlspecialchars($blog['title']); ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../styles/blog.css">
    <link rel="stylesheet" href="../includes/header.css">
    <style>
        .container { max-width: 800px; margin: auto; padding: 20px; background: white; }
        .meta { color: gray; font-size: 14px; margin-bottom: 10px; }
        .comment-section { margin-top: 20px; padding: 15px; background: #f9f9f9; border-radius: 5px; }
        .comment { border-bottom: 1px solid #ddd; padding: 10px 0; }
        .comment strong { color: #333; }
        textarea { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #27ae60; color: white; padding: 10px; border: none; cursor: pointer; }
        button:hover { background: #219150; }
        .edit-btn { background: #f39c12; padding: 8px 15px; color: white; text-decoration: none; margin-right: 10px; }
        .edit-btn:hover { background: #e67e22; }
        .blog-image { width: 100%; max-height: 100%; object-fit: cover; margin-bottom: 15px; }
    </style>
</head>
<body>

    <?php include '../includes/header-blog.php'; ?>

    <div class="container">
        <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
        <p class="meta">Ngày đăng: 
            <?php echo !empty($blog['ngay_dang']) ? date('d/m/Y', strtotime($blog['ngay_dang'])) : 'Không xác định'; ?>
        </p>

        <?php 
        $imgPath = "./images/" . htmlspecialchars($blog['hinhanh']);
        if (!empty($blog['hinhanh']) && file_exists($imgPath)): ?>
            <img class="blog-image" src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>">
        <?php else: ?>
            <p style="color: red;">Không có ảnh hoặc ảnh bị lỗi.</p>
        <?php endif; ?>

        <p><?php echo nl2br(htmlspecialchars($blog['description'] ?? 'Không có nội dung')); ?></p>

        <!-- Kiểm tra nếu người dùng là chủ bài viết hoặc admin -->
        <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $blog['tac_gia'] || $_SESSION['role'] == 'admin')): ?>
            <a href="edit-blog.php?id=<?php echo $blog['id']; ?>" class="edit-btn">Sửa bài viết</a>
            <a href="delete-blog.php?id=<?php echo $blog['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')" class="edit-btn" style="background: red;">Xóa bài viết</a>
        <?php endif; ?>

        <a href="blog.php">← Quay lại Blog</a>

        <!-- Bình luận -->
        <div class="comment-section">
            <h3>Bình luận</h3>

            <!-- Form thêm bình luận -->
            <form action="process-comment.php" method="POST">
                <input type="hidden" name="article_id" value="<?php echo $id; ?>">
                <textarea name="comment" required placeholder="Viết bình luận..."></textarea>
                <button type="submit">Gửi</button>
            </form>

            <?php
            // Lấy bình luận từ database
            $commentSql = "SELECT id, username, content, created_at FROM comments WHERE article_id = ? ORDER BY created_at DESC";
            $stmt = $conn->prepare($commentSql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $comments = $stmt->get_result();

            while ($comment = $comments->fetch_assoc()) {
                echo '<div class="comment">';
                echo '<strong>' . (isset($comment['username']) && !empty($comment['username']) ? htmlspecialchars($comment['username']) : 'Ẩn danh') . ':</strong> ';
                echo nl2br(htmlspecialchars($comment['content'] ?? 'Không có nội dung'));
                echo '<br><span style="color:gray; font-size:12px;">' . (!empty($comment['created_at']) ? date('d/m/Y H:i', strtotime($comment['created_at'])) : 'Không rõ thời gian') . '</span>';

                // Nếu là admin hoặc chủ bình luận thì có thể sửa/xóa
                // if (isset($_SESSION['user_id']) && ($_SESSION['username'] == $comment['username'] || $_SESSION['role'] == 'admin')) {
                //     echo '<br><a href="edit-comment.php?id=' . $comment['id'] . '" style="color: blue; font-size: 12px;">Sửa</a> | ';
                //     echo '<a href="delete-comment.php?id=' . $comment['id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bình luận này?\')" style="color: red; font-size: 12px;">Xóa</a>';
                // }

                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
