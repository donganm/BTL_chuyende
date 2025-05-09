<?php
session_start();

// Kết nối cơ sở dữ liệu
include '../../includes/db.php';

// Xử lý đăng bài (chỉ dành cho admin đã đăng nhập)
if (isset($_POST['submit_post'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "Bạn cần đăng nhập để đăng bài!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/network.php");
        exit();
    }

    if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
        $_SESSION['message'] = "Chỉ admin mới có thể đăng bài!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/network.php");
        exit();
    }

    $user_id = (int)$_SESSION['user_id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
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
            header("Location: ../congdong/network.php");
            exit();
        }
    }

    // Lưu bài đăng vào cơ sở dữ liệu
    $sql = "INSERT INTO post (user_id, title, content, image, created_at) VALUES (?, ?, ?, ?, NOW())";
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
    header("Location: ../congdong/network.php");
    exit();
}

// Xử lý chỉnh sửa bài đăng
if (isset($_POST['edit_post'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "Bạn cần đăng nhập để chỉnh sửa bài đăng!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/network.php");
        exit();
    }

    if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
        $_SESSION['message'] = "Chỉ admin mới có thể chỉnh sửa bài đăng!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/network.php");
        exit();
    }

    $post_id = (int)$_POST['post_id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image = $_POST['existing_image'];

    // Xử lý tải lên hình ảnh mới (nếu có)
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "image_post/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = uniqid() . "_" . basename($_FILES['image']['name']);
        $image = $target_dir . $file_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
            // Xóa hình ảnh cũ nếu có
            if (!empty($_POST['existing_image']) && file_exists($_POST['existing_image'])) {
                unlink($_POST['existing_image']);
            }
        } else {
            $_SESSION['message'] = "Lỗi khi tải lên hình ảnh.";
            $_SESSION['message_type'] = "error";
            header("Location: ../congdong/network.php");
            exit();
        }
    }

    // Cập nhật bài đăng
    $sql = "UPDATE post SET title = ?, content = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $content, $image, $post_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Chỉnh sửa bài đăng thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Lỗi khi chỉnh sửa bài đăng: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
    $stmt->close();
    header("Location: ../congdong/network.php");
    exit();
}

// Xử lý xóa bài đăng
if (isset($_GET['delete_post'])) {
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "Bạn cần đăng nhập để xóa bài đăng!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/network.php");
        exit();
    }

    if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
        $_SESSION['message'] = "Chỉ admin mới có thể xóa bài đăng!";
        $_SESSION['message_type'] = "error";
        header("Location: ../congdong/network.php");
        exit();
    }

    $post_id = (int)$_GET['delete_post'];

    // Lấy thông tin bài đăng để xóa hình ảnh (nếu có)
    $sql = "SELECT image FROM post WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (!empty($row['image']) && file_exists($row['image'])) {
            unlink($row['image']);
        }
    }
    $stmt->close();

    // Xóa tất cả bình luận liên quan
    $sql = "DELETE FROM comments WHERE post_id = ? AND article_type = 'post'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->close();

    // Xóa bài đăng
    $sql = "DELETE FROM post WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Xóa bài đăng thành công!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Lỗi khi xóa bài đăng: " . $conn->error;
        $_SESSION['message_type'] = "error";
    }
    $stmt->close();
    header("Location: ../congdong/network.php");
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

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            color: #333;
        }

        .header p {
            font-size: 16px;
            color: #555;
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

        .post-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .post-form h3 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #333;
        }

        .post-form input[type="text"],
        .post-form textarea,
        .post-form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .post-form textarea {
            height: 100px;
            resize: vertical;
        }

        .post-form button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .post-form button:hover {
            background: #0056b3;
        }

        .post-list .post {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .post-header h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 5px;
        }

        .post-header h3 a {
            color: #007bff;
            text-decoration: none;
        }

        .post-header h3 a:hover {
            text-decoration: underline;
        }

        .post-header span {
            font-size: 14px;
            color: #777;
        }

        .post-actions a {
            margin-left: 10px;
            text-decoration: none;
            font-size: 14px;
        }

        .post-actions .edit {
            color: #007bff;
        }

        .post-actions .delete {
            color: #dc3545;
        }

        .post-content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin: 10px 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Giới hạn hiển thị 3 dòng */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
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
        <div class="header">
            <h1>Mạng lưới kết nối</h1>
            <p>Điền danh hoặc hệ thống kết nối dành cho những nguồn yêu thích di sản để thảo luận và hợp tác.</p>
        </div>

        <!-- Thông báo -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?php echo $_SESSION['message_type']; ?>">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']);
                unset($_SESSION['message_type']); ?>
            </div>
        <?php endif; ?>

        <!-- Form đăng bài (chỉ hiển thị cho admin đã đăng nhập) -->
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && strtolower($_SESSION['role']) == 'admin'): ?>
            <div class="post-form">
                <h3>Đăng bài mới</h3>
                <form action="../congdong/network.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Tiêu đề bài viết" required>
                    <textarea name="content" placeholder="Nội dung bài viết" required></textarea>
                    <input type="file" name="image" accept="image/*">
                    <button type="submit" name="submit_post">Đăng bài</button>
                </form>
            </div>
        <?php else: ?>
        <?php endif; ?>

        <!-- Form chỉnh sửa bài đăng (hiển thị khi admin bấm "Sửa") -->
        <?php
        if (isset($_GET['edit_post']) && isset($_SESSION['user_id']) && isset($_SESSION['role']) && strtolower($_SESSION['role']) == 'admin') {
            $post_id = (int)$_GET['edit_post'];
            $sql = "SELECT * FROM post WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $post_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($post = $result->fetch_assoc()) {
        ?>
                <div class="post-form">
                    <h3>Chỉnh sửa bài đăng</h3>
                    <form action="../congdong/network.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <input type="hidden" name="existing_image" value="<?php echo $post['image']; ?>">
                        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                        <?php if (!empty($post['image'])): ?>
                            <p>Hình ảnh hiện tại: <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image" style="max-width: 200px;"></p>
                        <?php endif; ?>
                        <input type="file" name="image" accept="image/*">
                        <button type="submit" name="edit_post">Cập nhật</button>
                    </form>
                </div>
        <?php
            }
            $stmt->close();
        }
        ?>

        <!-- Danh sách bài đăng -->
        <div class="post-list">
            <?php
            $sql = "SELECT post.*, users.Username FROM post LEFT JOIN users ON post.user_id = users.UserId ORDER BY post.created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($post = $result->fetch_assoc()) {
                    $display_username = $post['Username'] ?: 'Ẩn danh';
                    echo '<div class="post">';
                    echo '<div class="post-header">';
                    echo '<div>';
                    // Thêm liên kết vào tiêu đề
                    echo '<h3><a href="post_detail.php?post_id=' . $post['id'] . '">' . htmlspecialchars($post['title']) . '</a></h3>';
                    echo '<span>Đăng bởi ' . htmlspecialchars($display_username) . ' vào ' . $post['created_at'] . '</span>';
                    echo '</div>';
                    // Hiển thị nút Sửa/Xóa cho admin đã đăng nhập
                    if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && strtolower($_SESSION['role']) == 'admin') {
                        echo '<div class="post-actions">';
                        echo '<a href="?edit_post=' . $post['id'] . '" class="edit">Sửa</a>';
                        echo '<a href="?delete_post=' . $post['id'] . '" class="delete" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bài đăng này?\')">Xóa</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '<div class="post-content">';
                    echo '<p>' . htmlspecialchars($post['content']) . '</p>';
                    if (!empty($post['image'])) {
                        echo '<img src="' . htmlspecialchars($post['image']) . '" alt="Post Image">';
                    }
                    echo '</div>';
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