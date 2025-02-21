<?php
// Đường dẫn file dữ liệu
$dataFile = 'data.json';

// Đọc dữ liệu từ file JSON (nếu có)
$posts = [];
if (file_exists($dataFile)) {
    $jsonData = file_get_contents($dataFile);
    $posts = json_decode($jsonData, true);
    if (!is_array($posts)) {
        $posts = []; // Tránh lỗi nếu file JSON bị hỏng
    }
}

// Nếu dữ liệu trống, tạo bài viết mẫu
if (empty($posts)) {
    $posts = [
        ["id" => 1, "title" => "Khám phá chùa Thiên Mụ", "content" => "Chùa Thiên Mụ là một trong những địa điểm nổi tiếng nhất của Huế..."],
        ["id" => 2, "title" => "Cố đô Huế - Di sản văn hóa thế giới", "content" => "Cố đô Huế với quần thể kiến trúc hoàng gia tuyệt đẹp..."],
        ["id" => 3, "title" => "Hội An - Phố cổ lung linh", "content" => "Hội An là điểm đến không thể bỏ qua..."]
    ];
    file_put_contents($dataFile, json_encode($posts, JSON_PRETTY_PRINT));
}

// Xử lý đăng bài mới
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (!empty($title) && !empty($content)) {
        $newPost = [
            "id" => count($posts) + 1,
            "title" => htmlspecialchars($title), 
            "content" => htmlspecialchars($content)
        ];
        $posts[] = $newPost;
        file_put_contents($dataFile, json_encode($posts, JSON_PRETTY_PRINT));
        header("Location: blog.php"); // Reload trang
        exit();
    }
}

// Kiểm tra xem có tham số "id" để hiển thị chi tiết bài viết không
$postDetail = null;
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $postId = intval($_GET['id']);
    foreach ($posts as $post) {
        if ($post['id'] === $postId) {
            $postDetail = $post;
            break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Du Lịch Việt Nam</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .post {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .post h2 {
            color: #0275d8;
            cursor: pointer;
        }
        .post h2 a {
            text-decoration: none;
            color: #0275d8;
        }
        .post h2 a:hover {
            text-decoration: underline;
        }
        form {
            margin-bottom: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #0275d8;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #0256a2;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            color: white;
            background: #777;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-btn:hover {
            background: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Blog Du Lịch Việt Nam</h1>

    <!-- Hiển thị bài viết chi tiết nếu có -->
    <?php if ($postDetail) : ?>
        <a href="blog.php" class="back-btn">← Quay lại danh sách bài viết</a>
        <div class="post">
            <h2><?= htmlspecialchars($postDetail['title']) ?></h2>
            <p><?= nl2br(htmlspecialchars($postDetail['content'])) ?></p>
        </div>
    <?php else : ?>
        <!-- Form đăng bài -->
        <form action="" method="POST">
            <h2>Đăng bài mới</h2>
            <input type="text" name="title" placeholder="Tiêu đề bài viết" required>
            <textarea name="content" placeholder="Nội dung bài viết" required></textarea>
            <button type="submit">Đăng bài</button>
        </form>

        <!-- Danh sách bài viết -->
        <?php foreach ($posts as $post) : ?>
            <div class="post">
                <h2>
                <a href="blog.php?id=<?= urlencode($post['id']) ?>">
                    <?= htmlspecialchars($post['title']) ?>
                </a>

                </h2>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
