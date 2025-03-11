<?php
// Hiển thị lỗi (cho mục đích debug)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "global";

// Tạo kết nối MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$title   = $_POST['title'];
$content = $_POST['content'];

// Xử lý upload ảnh nếu có
$imagePath = NULL;
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    $uploadDir = "uploads/";
    // Tạo tên file duy nhất để tránh trùng lặp
    $fileName = uniqid() . "_" . basename($_FILES['image']['name']);
    $targetFile = $uploadDir . $fileName;
    
    // Di chuyển file từ thư mục tạm sang thư mục uploads
    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)){
        $imagePath = $targetFile;
    } else {
        echo "Lỗi khi tải ảnh lên.";
        exit();
    }
}

// Chèn dữ liệu (bao gồm ảnh nếu có) vào bảng posts
$sql = "INSERT INTO posts (title, content, image) VALUES ('$title', '$content', " . ($imagePath ? "'$imagePath'" : "NULL") . ")";
if ($conn->query($sql) === TRUE) {
    header("Location: baidangketnoiq&a.php");
    exit();
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
