<?php
include '../includes/db.php'; // Kết nối CSDL
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ form
    $id = $_POST['UserId'];
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];

    // Kiểm tra dữ liệu đầu vào
    if (empty($fullname) || empty($email)) {
        die("Vui lòng điền đầy đủ thông tin.");
    }

    // Kiểm tra định dạng email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email không hợp lệ.");
    }

    // Xử lý upload avatar (nếu có)
    $avatar = null;
    if (!empty($_FILES["fileToUpload"]["name"])) {
        $targetDir = "../uploads/";
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Kiểm tra loại file ảnh hợp lệ
        $allowTypes = array("jpg", "jpeg", "png", "gif");
        if (in_array($fileType, $allowTypes)) {
            // Tạo tên file ngẫu nhiên để tránh trùng lặp
            $newFileName = "avatar_" . time() . "_" . rand(1000, 9999) . "." . $fileType;
            $targetFilePath = $targetDir . $newFileName;

            // Di chuyển file upload vào thư mục lưu trữ
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
                $avatar = $targetFilePath; // Lưu đường dẫn vào CSDL
            } else {
                die("Lỗi khi tải ảnh lên.");
            }
        } else {
            die("Chỉ chấp nhận file ảnh (JPG, PNG, GIF).");
        }
    }

    // Câu lệnh SQL cập nhật thông tin người dùng
    if ($avatar) {
        $sql = "UPDATE users SET Username=?, FullName=?, Email=?, Address=?, Gender=?, DateOfBirth=?, Avatar=? WHERE UserId=?";
    } else {
        $sql = "UPDATE users SET Username=?, FullName=?, Email=?, Address=?, Gender=?, DateOfBirth=? WHERE UserId=?";
    }

    // Chuẩn bị câu lệnh SQL
    if ($stmt = mysqli_prepare($conn, $sql)) {
        if ($avatar) {
            mysqli_stmt_bind_param($stmt, "sssssssi", $username, $fullname, $email, $address, $gender, $date_of_birth, $avatar, $id);
        } else {
            mysqli_stmt_bind_param($stmt, "ssssssi", $username, $fullname, $email, $address, $gender, $date_of_birth, $id);
        }

        // Thực thi câu lệnh SQL
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../pages/profile.php?status=success");
            exit();
        } else {
            echo "Lỗi khi cập nhật hồ sơ: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Lỗi khi chuẩn bị câu lệnh SQL.";
    }

    mysqli_close($conn);
}
