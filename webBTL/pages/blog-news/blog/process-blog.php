<?php
include '../../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    // Kiểm tra tiêu đề và mô tả
    if (empty($title) || empty($description)) {
        echo "<script>alert('Tiêu đề và mô tả không được để trống.'); history.back();</script>";
        exit;
    }

    // Xử lý hình ảnh
    $imageName = ''; // Tên file ảnh sẽ lưu trong CSDL

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = './images/'; // Thư mục lưu ảnh
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageOriginalName = basename($_FILES['image']['name']);
        $imageExt = strtolower(pathinfo($imageOriginalName, PATHINFO_EXTENSION));

        // Kiểm tra định dạng hợp lệ
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageExt, $allowedExts)) {
            $newImageName = uniqid('img_') . '.' . $imageExt;
            $uploadPath = $uploadDir . $newImageName;

            // Di chuyển file vào thư mục lưu trữ
            if (move_uploaded_file($imageTmp, $uploadPath)) {
                $imageName = $newImageName;
            } else {
                echo "<script>alert('Lỗi khi tải ảnh lên máy chủ.'); history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Chỉ chấp nhận định dạng ảnh JPG, PNG, GIF.'); history.back();</script>";
            exit;
        }
    }

    // Lưu vào CSDL (Bỏ `tac_gia`)
    $sql = "INSERT INTO blog_articles (title, description, ngay_dang, hinhanh, luot_xem, luot_thich, link) 
            VALUES (?, ?, NOW(), ?, 0, 0, '')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $imageName);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Lỗi khi thêm bài viết.'); history.back();</script>";
    }
}
?>
