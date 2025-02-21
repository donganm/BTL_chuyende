<?php
$dataFile = 'data.json';

// Đọc dữ liệu cũ
$posts = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];

// Lấy dữ liệu từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (!empty($title) && !empty($content)) {
        $newPost = [
            "id" => count($posts) + 1,
            "title" => $title,
            "content" => $content
        ];
        $posts[] = $newPost;

        // Lưu lại vào file JSON
        file_put_contents($dataFile, json_encode($posts, JSON_PRETTY_PRINT));

        // Chuyển hướng về trang blog
        header("Location: blog.php");
        exit;
    }
}
