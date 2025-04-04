<?php
include(__DIR__ . "/../includes/db.php"); // Kết nối CSDL

// Kiểm tra xem có file được tải lên không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $target_dir = "../assets/img/trangimage/"; // Thư mục lưu ảnh
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra nếu file có thực sự là ảnh
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        echo "File không phải là ảnh.";
        $uploadOk = 0;
    }

    // Kiểm tra định dạng file (chỉ cho phép JPG, JPEG, PNG, GIF)
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Chỉ chấp nhận file JPG, JPEG, PNG & GIF.";
        $uploadOk = 0;
    }

    // Kiểm tra nếu file đã tồn tại
    if (file_exists($target_file)) {
        echo "File đã tồn tại.";
        $uploadOk = 0;
    }

    // Kiểm tra dung lượng file (giới hạn 5MB)
    if ($_FILES["fileToUpload"]["size"] > 5 * 1024 * 1024) {
        echo "File quá lớn. Giới hạn 5MB.";
        $uploadOk = 0;
    }

    // Nếu không có lỗi, tiến hành upload
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Lưu đường dẫn vào CSDL
            $full_path = "../assets/img/trangimage/" . $file_name;
            $sql = "INSERT INTO images (image_path, description) VALUES ('$full_path', 'Hình ảnh mới')";

            if (mysqli_query($conn, $sql)) {
                echo "Tải lên thành công!";
                header("Location: ../pages/image.php"); // Quay về trang quản lý ảnh
                exit();
            } else {
                echo "Lỗi khi lưu vào database: " . mysqli_error($conn);
            }
        } else {
            echo "Lỗi khi tải file lên.";
        }
    }
}

// Đóng kết nối
mysqli_close($conn);
