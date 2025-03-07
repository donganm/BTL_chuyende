<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "global";

// Kiểm tra tham số id có tồn tại không
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ép về số nguyên để an toàn

    // Kết nối đến MySQL
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Thực hiện câu lệnh xóa
    $sql = "DELETE FROM posts WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: baidangketnoiq&a.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: baidangketnoiq&a.php");

    exit();
}
?>