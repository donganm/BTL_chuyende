<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news_db";

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "Kết nối thành công!"; // Thử in ra để kiểm tra
}
?>
