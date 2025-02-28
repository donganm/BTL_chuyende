<?php
$servername = "localhost";
$username = "root"; // Tài khoản MySQL của bạn
$password = ""; // Mật khẩu (để trống nếu dùng XAMPP)
$dbname = "heritage_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
