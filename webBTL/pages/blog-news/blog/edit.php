<?php
session_start();
include '../../../includes/db.php';


// Kiểm tra nếu người dùng đã đăng nhập
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $newImage = $_FILES['new_image'];

    if (empty($title) || empty($description)) {
        echo "<script>alert('Tiêu đề và mô tả không được để trống.'); history.back();</script>";
        exit;
    }

    // Kiểm tra nếu có ảnh mới được tải lên
    if (!empty($newImage['name'])) {
        $uploadDir = "./images/"; // Đảm bảo đúng thư mục lưu ảnh, nếu 'images' nằm cùng thư mục với edit.php
        $imageName = time() . "_" . basename($newImage['name']); // Đổi tên file để tránh trùng lặp
        $imagePath = $uploadDir . $imageName;

        // Kiểm tra xem ảnh tải lên có hợp lệ không
        if (move_uploaded_file($newImage['tmp_name'], $imagePath)) {
            // Xóa ảnh cũ nếu có
            if (!empty($blog['hinhanh']) && file_exists($uploadDir . $blog['hinhanh'])) {
                unlink($uploadDir . $blog['hinhanh']);
            }

            // Cập nhật cả hình ảnh
            $update_stmt = $conn->prepare("UPDATE blog_articles SET title = ?, description = ?, hinhanh = ? WHERE id = ?");
            $update_stmt->bind_param("sssi", $title, $description, $imageName, $id);
        } else {
            echo "<script>alert('Lỗi khi tải ảnh lên.'); history.back();</script>";
            exit;
        }
    } else {
        // Không có ảnh mới, chỉ cập nhật tiêu đề và mô tả
        $update_stmt = $conn->prepare("UPDATE blog_articles SET title = ?, description = ? WHERE id = ?");
        $update_stmt->bind_param("ssi", $title, $description, $id);
    }

    if ($update_stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Lỗi khi cập nhật bài viết.'); history.back();</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa bài viết</title>
    <link rel="stylesheet" href="../styles/blog.css">
    <link rel="stylesheet" href="../includes/header.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 0px;
        }

        .container {
            max-width: 60%;
            margin: auto;
            margin-top: 25px;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        textarea {
            height: 400px;
            resize: vertical;
        }

        button {
            background: #2c3e50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background: #34495e;
        }
    </style>
</head>

<body>
    <?php include '../includes/header-blog.php'; ?>

    <div class="container">
        <h2>Chỉnh sửa bài viết</h2>
        <form action="update-blog.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <label>Tiêu đề:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>

    <label>Mô tả:</label>
    <textarea name="description" required><?php echo htmlspecialchars($blog['description']); ?></textarea>

    <label>Ảnh hiện tại:</label>
    <?php if (!empty($blog['hinhanh'])): ?>
        <img src="./images/<?php echo htmlspecialchars($blog['hinhanh']); ?>" alt="Ảnh bài viết" style="width: 100%; max-height: 300px; object-fit: cover; margin-bottom: 10px;">
    <?php else: ?>
        <p style="color: gray;">Không có ảnh</p>
    <?php endif; ?>

    <label>Chọn ảnh mới:</label>
    <input type="file" name="new_image" accept="image/*">

    <button type="submit">Cập nhật</button>
</form>

    </div>
</body>

</html>