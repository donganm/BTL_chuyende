<?php
session_start();
include '../../includes/db.php';

// Kiểm tra nếu không phải Admin thì đá về trang chủ
if (!isset($_SESSION['role']) || $_SESSION['role'] !== "Admin") {
    header("Location: ../index.php");
    exit();
}

// Xử lý đăng bài
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tieude = trim($_POST['tieude']);
    $noidung = trim($_POST['noidung']);

    // Kiểm tra xem có file ảnh được tải lên không
    if (!empty($_FILES['hinhanh']['name'])) {
        $hinhanh = basename($_FILES['hinhanh']['name']);
        $targetDir = "../images/";
        $targetFile = $targetDir . $hinhanh;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        // Kiểm tra định dạng file hợp lệ
        if (!in_array($fileType, $allowedTypes)) {
            echo "<p>Chỉ chấp nhận các tệp ảnh JPG, JPEG, PNG, GIF.</p>";
            exit();
        }

        // Di chuyển file tải lên thư mục đích
        if (!move_uploaded_file($_FILES['hinhanh']['tmp_name'], $targetFile)) {
            echo "<p>Lỗi khi tải ảnh lên.</p>";
            exit();
        }
    } else {
        $hinhanh = "default.jpg"; // Ảnh mặc định nếu không chọn ảnh
    }

    // Kiểm tra tiêu đề và nội dung có giá trị không
    if ($tieude && $noidung) {
        $sql = "INSERT INTO tintuc (tieude, noidung, hinhanh) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $tieude, $noidung, $hinhanh);

        if ($stmt->execute()) {
            echo "<p>Bài viết đã được đăng thành công!</p>";
        } else {
            echo "<p>Lỗi khi lưu vào database.</p>";
        }
    } else {
        echo "<p>Vui lòng nhập đầy đủ tiêu đề và nội dung.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Bài</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }
        button:hover {
            background-color: #218838;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Đăng Bài Viết Mới</h1>
        <form method="POST" enctype="multipart/form-data">
            <label>Tiêu đề:</label>
            <input type="text" name="tieude" required>
            
            <label>Nội dung:</label>
            <textarea name="noidung" required rows="5"></textarea>

                <button type="submit">
                    Đăng bài
                </button>
            
        </form>
        <a href="../tintuc.php" class="back-link">🔙 Quay lại Tin Tức</a>
    </div>
</body>
</html>
