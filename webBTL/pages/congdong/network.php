<?php
session_start();

// Kiểm tra session để debug
if (isset($_SESSION['user_id'])) {
    echo "User ID: " . $_SESSION['user_id'] . "<br>";
    echo "Username: " . (isset($_SESSION['username']) ? $_SESSION['username'] : 'Không có username') . "<br>";
    echo "Role: " . (isset($_SESSION['role']) ? $_SESSION['role'] : 'Không có role') . "<br>";
} else {
    echo "Chưa đăng nhập.<br>";
}

// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "global");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý đăng bài (chỉ dành cho admin)
if (isset($_POST['submit_post'])) {
    // Kiểm tra xem người dùng có phải là admin hay không
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
        $_SESSION['message'] = "Chỉ admin mới có thể đăng bài!";
        $_SESSION['message_type'] = "error";
        header("Location: network.php");
        exit();
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];
    $image = '';

    // Xử lý tải lên hình ảnh
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "image_post/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = uniqid() . "_" . basename($_FILES['image']['name']);
        $image = $target_dir . $file_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
            $_SESSION['message'] = "Lỗi khi tải lên hình ảnh.";
            $_SESSION['message_type'] = "error";
            header("Location: network.php");
            exit();
        }
    }

    // Lưu bài đăng vào cơ sở dữ liệu
    $sql = "INSERT INTO posts (user_id, title, content, image, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $title, $content, $image);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Đăng bài thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Lỗi khi đăng bài: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
    $stmt->close();
    header("Location: network.php");
    exit();
}

// Xử lý đăng bình luận (cho cả người dùng và người xem)
if (isset($_POST['submit_comment'])) {
    $post_id = (int)$_POST['post_id'];
    $article_type = 'post';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Ẩn danh'; // Lấy username từ session
    $content = trim($_POST['comment_content']);

    // Kiểm tra xem post_id có tồn tại trong bảng posts hay không
    $check_sql = "SELECT id FROM posts WHERE id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $post_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows === 0) {
        $_SESSION['message'] = "Bài đăng không tồn tại!";
        $_SESSION['message_type'] = "error";
        $check_stmt->close();
        header("Location: network.php");
        exit();
    }
    $check_stmt->close();

    // Thêm bình luận với post_id, article_type, user_id, username, và content
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
    header("Location: network.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mạng lưới kết nối</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="network.css?v=1">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="../congdong.php" class="back-button">← Cộng đồng</a></li>
            <li><a href="events.php" class="<?= basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : '' ?>">Sự Kiện</a></li>
            <li><a href="activity.php" class="<?= basename($_SERVER['PHP_SELF']) == 'activity.php' ? 'active' : '' ?>">Hoạt Động</a></li>
            <li><a href="network.php" class="<?= basename($_SERVER['PHP_SELF']) == 'network.php' ? 'active' : '' ?>">Mạng lưới kết nối</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <li><a href="admin_approve.php">Quản lý bài đăng</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="header">
            <h1>Mạng lưới kết nối</h1>
            <p>Điền danh hoặc hệ thống kết nối dành cho những nguồn yêu thích di sản để thảo luận và hợp tác.</p>
        </div>

        <!-- Thông báo -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message_type']; ?>">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
            </div>
        <?php endif; ?>

        <!-- Form đăng bài (chỉ hiển thị cho admin) -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <div class="post-form">
                <h3>Đăng bài mới</h3>
                <form action="network.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Tiêu đề bài viết" required>
                    <textarea name="content" placeholder="Nội dung bài viết" required></textarea>
                    <input type="file" name="image" accept="image/*">
                    <button type="submit" name="submit_post">Đăng bài</button>
                </form>
            </div>
        <?php else: ?>
            <p>Chỉ admin mới có thể đăng bài. Bạn có thể bình luận bên dưới các bài đăng.</p>
        <?php endif; ?>

        <!-- Danh sách bài đăng -->
        <div class="post-list">
            <?php
            // Truy vấn danh sách bài đăng
            $sql = "SELECT posts.*, users.username FROM posts LEFT JOIN users ON posts.user_id = users.UserId ORDER BY posts.created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($post = $result->fetch_assoc()) {
                    $display_username = $post['username'] ?: 'Ẩn danh'; // Hiển thị "Ẩn danh" nếu không có username
                    echo '<div class="post">';
                    echo '<div class="post-header">';
                    echo '<h3>' . htmlspecialchars($post['title']) . '</h3>';
                    echo '<span>Đăng bởi ' . htmlspecialchars($display_username) . ' vào ' . $post['created_at'] . '</span>';
                    echo '</div>';
                    echo '<div class="post-content">';
                    echo '<p>' . htmlspecialchars($post['content']) . '</p>';
                    if (!empty($post['image'])) {
                        echo '<img src="' . htmlspecialchars($post['image']) . '" alt="Post Image">';
                    }
                    echo '</div>';

                    // Hiển thị bình luận
                    echo '<div class="comments">';
                    echo '<h4>Bình luận</h4>';
                    $post_id = $post['id'];
                    $comment_sql = "SELECT comments.* FROM comments WHERE comments.article_type = 'post' AND comments.post_id = ? ORDER BY comments.created_at ASC";
                    $stmt = $conn->prepare($comment_sql);
                    $stmt->bind_param("i", $post_id);
                    $stmt->execute();
                    $comment_result = $stmt->get_result();

                    if ($comment_result->num_rows > 0) {
                        while ($comment = $comment_result->fetch_assoc()) {
                            $comment_username = $comment['username'] ?: 'Ẩn danh'; // Sử dụng username từ bảng comments
                            echo '<div class="comment">';
                            echo '<div class="comment-header">';
                            echo '<span>' . htmlspecialchars($comment_username) . '</span>';
                            echo '<span>' . $comment['created_at'] . '</span>';
                            echo '</div>';
                            echo '<div class="comment-content">';
                            echo '<p>' . htmlspecialchars($comment['content']) . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Chưa có bình luận nào.</p>';
                    }
                    $stmt->close();

                    // Form thêm bình luận (cho cả người dùng và người xem)
                    echo '<div class="comment-form">';
                    echo '<form action="network.php" method="POST">';
                    echo '<textarea name="comment_content" placeholder="Viết bình luận..." required></textarea>';
                    echo '<input type="hidden" name="post_id" value="' . $post_id . '">';
                    echo '<button type="submit" name="submit_comment">Gửi</button>';
                    echo '</form>';
                    echo '</div>';

                    echo '</div>'; // Kết thúc comments
                    echo '</div>'; // Kết thúc post
                }
            } else {
                echo '<p>Chưa có bài đăng nào.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h5>Get Help</h5>
                <p><a href="/webBTL/pages/feedback.php">Feedback</a></p>
                <p><a href="/webBTL/pages/contact.php">Contact Us</a></p>
            </div>
            <div class="footer-section footer-center">
                <div>
                    <img src="./assets/img/VN_Flag.webp" alt="Vietnam Flag" />
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