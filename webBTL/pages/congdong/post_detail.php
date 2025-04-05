<?php
session_start();

// Kết nối cơ sở dữ liệu
include '../../includes/db.php';

// Kiểm tra xem post_id có được truyền qua URL không
if (!isset($_GET['post_id'])) {
    $_SESSION['message'] = "Không tìm thấy bài đăng!";
    $_SESSION['message_type'] = "error";
    header("Location: ../congdong/network.php");
    exit();
}

$post_id = (int)$_GET['post_id'];

// Lấy thông tin bài đăng
$sql = "SELECT post.*, users.Username FROM post LEFT JOIN users ON post.user_id = users.UserId WHERE post.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    $_SESSION['message'] = "Bài đăng không tồn tại!";
    $_SESSION['message_type'] = "error";
    header("Location: ../congdong/network.php");
    exit();
}
$post = $result->fetch_assoc();
$stmt->close();

// Xử lý đăng bình luận
if (isset($_POST['submit_comment'])) {
    $article_type = 'post';
    $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : NULL;
    $username = isset($_SESSION['user']) ? $_SESSION['user'] : 'Ẩn danh';
    $content = trim($_POST['comment_content'] ?? '');

    if (empty($content)) {
        $_SESSION['message'] = "Nội dung bình luận không được để trống!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/post_detail.php?post_id=$post_id");
        exit();
    }

    $check_sql = "SELECT id FROM post WHERE id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $post_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows === 0) {
        $_SESSION['message'] = "Bài đăng không tồn tại!";
        $_SESSION['message_type'] = "error";
        $check_stmt->close();
        header("Location: ../congdong/network.php");
        exit();
    }
    $check_stmt->close();

    $sql = "INSERT INTO comments (post_id, article_type, user_id, username, content, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiss", $post_id, $article_type, $user_id, $username, $content);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Bình luận thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Lỗi khi đăng bình luận: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
    $stmt->close();
    header("Location: ../congdong/post_detail.php?post_id=$post_id");
    exit();
}

// Xử lý chỉnh sửa bình luận
if (isset($_POST['edit_comment'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "Bạn cần đăng nhập để chỉnh sửa bình luận!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/post_detail.php?post_id=$post_id");
        exit();
    }

    $comment_id = (int)$_POST['comment_id'];
    $content = trim($_POST['comment_content'] ?? '');

    if (empty($content)) {
        $_SESSION['message'] = "Nội dung bình luận không được để trống!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/post_detail.php?post_id=$post_id");
        exit();
    }

    // Kiểm tra quyền chỉnh sửa
    $sql = "SELECT user_id FROM comments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comment = $result->fetch_assoc();
    $stmt->close();

    $is_admin = isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin';
    $is_owner = $comment['user_id'] && $comment['user_id'] == $_SESSION['user_id'];

    if (!$is_admin && !$is_owner) {
        $_SESSION['message'] = "Bạn không có quyền chỉnh sửa bình luận này!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/post_detail.php?post_id=$post_id");
        exit();
    }

    // Cập nhật bình luận
    $sql = "UPDATE comments SET content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $content, $comment_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Chỉnh sửa bình luận thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Lỗi khi chỉnh sửa bình luận: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
    $stmt->close();
    header("Location: ../congdong/post_detail.php?post_id=$post_id");
    exit();
}

// Xử lý xóa bình luận
if (isset($_GET['delete_comment'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "Bạn cần đăng nhập để xóa bình luận!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/post_detail.php?post_id=$post_id");
        exit();
    }

    $comment_id = (int)$_GET['delete_comment'];

    // Kiểm tra quyền xóa
    $sql = "SELECT user_id FROM comments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comment = $result->fetch_assoc();
    $stmt->close();

    $is_admin = isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin';
    $is_owner = $comment['user_id'] && $comment['user_id'] == $_SESSION['user_id'];

    if (!$is_admin && !$is_owner) {
        $_SESSION['message'] = "Bạn không có quyền xóa bình luận này!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/post_detail.php?post_id=$post_id");
        exit();
    }

    // Xóa bình luận
    $sql = "DELETE FROM comments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Xóa bình luận thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Lỗi khi xóa bình luận: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
    $stmt->close();
    header("Location: ../congdong/post_detail.php?post_id=$post_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bài đăng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="network.css?v=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #007bff;
            color: white;
            padding: 15px 20px;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-grow: 1;
            justify-content: center;
        }

        .nav-links li a {
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin: 0 20px;
            padding: 10px 15px;
            text-decoration: none;
        }

        .nav-links a:hover,
        .nav-links a.active {
            background: white;
            color: #007bff;
            border-radius: 5px;
        }

        .back-button {
            color: #007bff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .post-detail {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .post-header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .post-header span {
            font-size: 14px;
            color: #777;
        }

        .post-content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin: 10px 0;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
        }

        .comments {
            margin-top: 20px;
        }

        .comments h4 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .comment {
            background: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #777;
            margin-bottom: 5px;
        }

        .comment-actions a {
            margin-left: 10px;
            text-decoration: none;
            font-size: 14px;
        }

        .comment-actions .edit {
            color: #007bff;
        }

        .comment-actions .delete {
            color: #dc3545;
        }

        .comment-content p {
            font-size: 16px;
            color: #555;
        }

        .comment-form {
            margin-top: 10px;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            height: 60px;
            resize: vertical;
        }

        .comment-form button {
            background: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 5px;
        }

        .comment-form button:hover {
            background: #0056b3;
        }

        footer {
            background-color: #f8f8f8;
            padding: 20px 0;
            font-family: Arial, sans-serif;
            border-top: 1px solid #ddd;
            width: 100%;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            margin: 0 auto;
            flex-wrap: wrap;
        }

        .footer-section {
            flex: 1;
            min-width: 200px;
            margin: 10px 0;
        }

        .footer-section h5 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }

        .footer-section p {
            margin: 5px 0;
        }

        .footer-section a {
            text-decoration: none;
            color: #555;
            font-size: 14px;
        }

        .footer-section a:hover {
            color: #007bff;
        }

        .footer-center {
            text-align: center;
        }

        .footer-center img {
            width: 24px;
            vertical-align: middle;
            margin-right: 5px;
        }

        .footer-right {
            text-align: right;
            font-size: 14px;
            color: #555;
        }

        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                text-align: center;
            }

            .footer-right {
                text-align: center;
            }

            .nav-links {
                flex-direction: column;
                align-items: center;
            }

            .nav-links li a {
                margin: 10px 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="../congdong.php" class="back-button">← Cộng đồng</a></li>
            <li><a href="stories.php" class="<?= basename($_SERVER['PHP_SELF']) == 'stories.php' ? 'active' : '' ?>">Câu chuyện & Dự án</a></li>
            <li><a href="events.php" class="<?= basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : '' ?>">Sự kiện & Hoạt động</a></li>
            <li><a href="network.php" class="<?= basename($_SERVER['PHP_SELF']) == 'network.php' ? 'active' : '' ?>">Mạng lưới kết nối</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Thông báo -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message_type']; ?>">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']);
                unset($_SESSION['message_type']); ?>
            </div>
        <?php endif; ?>

        <!-- Chi tiết bài đăng -->
        <div class="post-detail">
            <div class="post-header">
                <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                <span>Đăng bởi <?php echo htmlspecialchars($post['Username'] ?: 'Ẩn danh'); ?> vào <?php echo $post['created_at']; ?></span>
            </div>
            <div class="post-content">
                <p><?php echo htmlspecialchars($post['content']); ?></p>
                <?php if (!empty($post['image'])): ?>
                    <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image">
                <?php endif; ?>
            </div>
        </div>

        <!-- Phần bình luận -->
        <div class="comments">
            <h4>Bình luận</h4>
            <?php
            $comment_sql = "SELECT comments.* FROM comments WHERE comments.article_type = 'post' AND comments.post_id = ? ORDER BY comments.created_at ASC";
            $stmt = $conn->prepare($comment_sql);
            $stmt->bind_param("i", $post_id);
            $stmt->execute();
            $comment_result = $stmt->get_result();

            if ($comment_result->num_rows > 0) {
                while ($comment = $comment_result->fetch_assoc()) {
                    $comment_username = $comment['username'] ?: 'Ẩn danh';
                    echo '<div class="comment">';
                    echo '<div class="comment-header">';
                    echo '<span>' . htmlspecialchars($comment_username) . '</span>';
                    echo '<span>' . $comment['created_at'] . '</span>';
                    echo '</div>';
                    echo '<div class="comment-content">';
                    echo '<p>' . htmlspecialchars($comment['content']) . '</p>';
                    // Hiển thị nút Sửa/Xóa cho admin hoặc người dùng đã đăng bình luận
                    $is_admin = isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin';
                    $is_owner = $comment['user_id'] && isset($_SESSION['user_id']) && $comment['user_id'] == $_SESSION['user_id'];
                    if ($is_admin || $is_owner) {
                        echo '<div class="comment-actions">';
                        echo '<a href="?post_id=' . $post_id . '&edit_comment=' . $comment['id'] . '" class="edit">Sửa</a>';
                        echo '<a href="?post_id=' . $post_id . '&delete_comment=' . $comment['id'] . '" class="delete" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bình luận này?\')">Xóa</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';

                    // Form chỉnh sửa bình luận (hiển thị khi bấm "Sửa")
                    if (isset($_GET['edit_comment']) && (int)$_GET['edit_comment'] == $comment['id'] && ($is_admin || $is_owner)) {
            ?>
                        <div class="comment-form">
                            <h4>Chỉnh sửa bình luận</h4>
                            <form action="../congdong/post_detail.php?post_id=<?php echo $post_id; ?>" method="POST">
                                <textarea name="comment_content" required><?php echo htmlspecialchars($comment['content']); ?></textarea>
                                <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                <button type="submit" name="edit_comment">Cập nhật</button>
                            </form>
                        </div>
            <?php
                    }
                }
            } else {
                echo '<p>Chưa có bình luận nào.</p>';
            }
            $stmt->close();
            ?>

            <!-- Form thêm bình luận (hiển thị cho tất cả người dùng) -->
            <div class="comment-form">
                <form action="../congdong/post_detail.php?post_id=<?php echo $post_id; ?>" method="POST">
                    <textarea name="comment_content" placeholder="Viết bình luận..." required></textarea>
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <button type="submit" name="submit_comment">Gửi</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h5>Get Help</h5>
                <p><a href="../feedback.php">Feedback</a></p>
                <p><a href="../contact.php">Contact Us</a></p>
            </div>
            <div class="footer-section footer-center">
                <div>
                    <img src="../../assets/img/VN_Flag.webp" alt="Vietnam Flag" />
                    <span>VIE VN</span>
                </div>
                <p>© 2025 G.H</p>
            </div>
            <div class="footer-section footer-right">
                <p>© 2025 G.H. ALL RIGHTS RESERVED</p>
            </div>
        </div>
    </footer>
</body>

</html>