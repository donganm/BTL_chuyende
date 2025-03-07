<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "global"; // Đúng với tên DB bạn đã tạo

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$title   = $_POST['title'];
$content = $_POST['content'];

// Chèn vào bảng "posts"
$sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
if ($conn->query($sql) === TRUE) {
    // Nếu thành công, quay lại trang index
    header("Location: baidangketnoiq&a.php");
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>