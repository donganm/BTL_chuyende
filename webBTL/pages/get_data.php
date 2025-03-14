<?php
// Thông tin kết nối
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "global";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
<?php
// Thông tin kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "global";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Hàm hiển thị dữ liệu từ một bảng cụ thể
function hienThiDuLieu($conn, $ten_bang) {
    $sql = "SELECT * FROM $ten_bang";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Dữ liệu từ bảng: $ten_bang</h2>";
        echo "<table border='1'>
                <tr>";

        // Lấy tên các cột trong bảng
        $columns = array_keys($result->fetch_assoc());
        foreach ($columns as $column) {
            echo "<th>$column</th>";
        }
        echo "</tr>";

        // Trả lại con trỏ dữ liệu về đầu bảng
        $result->data_seek(0);

        // Hiển thị dữ liệu của từng hàng
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "<h2>Bảng $ten_bang không có dữ liệu nào.</h2>";
    }
}

// Hiển thị dữ liệu của từng bảng
hienThiDuLieu($conn, "di_tich_lich_su");
hienThiDuLieu($conn, "du_lich");
hienThiDuLieu($conn, "kyquanthiennhien");

// Đóng kết nối
$conn->close();
?>
