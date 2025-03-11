<?php
// Hiển thị lỗi (cho mục đích debug)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "global";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

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
