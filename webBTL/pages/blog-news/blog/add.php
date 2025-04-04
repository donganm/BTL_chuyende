<?php
session_start();
include '../../../includes/db.php';

// Kiểm tra nếu người dùng đã đăng nhập
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";

// Xử lý thêm bài viết
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image = trim($_POST['image']);

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
    <link rel="stylesheet" href="../styles/blog.css">
    <link rel="stylesheet" href="../includes/header.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        /* Cải tiến phần tiêu đề và mô tả */
        label {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 2px;
            display: block;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 80%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #2c3e50;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        /* Căn giữa form và điều chỉnh độ rộng */
        .container {
            max-width: 70%;
            margin: auto;
            background: white;
            padding: 30px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30px;
            text-align: center;
        }

        /* Thêm phần margin và padding cho các thẻ <input> và <textarea> */
        input,
        textarea {
            font-size: 16px;
            width: 80%;
            margin: 10px auto;
        }

        /* Cải thiện button */
        button {
            background: #2c3e50;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            width: 80%;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #34495e;
        }

        /* Điều chỉnh độ rộng form trên các màn hình nhỏ */
        @media (max-width: 768px) {
            .container {
                max-width: 90%;
            }

            input,
            textarea,
            button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include '../includes/header-blog.php'; ?>

    <div class="container">
        <h2>Đăng bài mới</h2>
        <form action="process-blog.php" method="POST" enctype="multipart/form-data">
            <label>Tiêu đề:</label>
            <input type="text" name="title" required>

            <label>Mô tả:</label>
            <textarea name="description" required></textarea>

            <!-- <label>Nội dung:</label>
            <textarea name="content" rows="5" required></textarea> -->

            <label>Hình ảnh:</label>
            <input type="file" name="image">

            <button type="submit">Đăng bài</button>
        </form>
    </div>
</body>

</html>