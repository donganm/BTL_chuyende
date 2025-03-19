<?php
// Kết nối đến database
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "global";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có từ khóa tìm kiếm được truyền vào
if (isset($_GET['q'])) {
    $q = $conn->real_escape_string($_GET['q']);
    // Truy vấn tìm kiếm trong tiêu đề hoặc nội dung bài đăng
    $sql = "SELECT * FROM posts WHERE title LIKE '%$q%' OR content LIKE '%$q%' ORDER BY created_at DESC";
    $result = $conn->query($sql);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Kết quả tìm kiếm</title>
        <style>
            body{
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                padding: 20px;
            }
            .post {
                background-color: white;
                padding: 15px;
                margin: 10px 0;
                border-radius: 8px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body>
        <h2>Kết quả tìm kiếm cho: "<?php echo htmlspecialchars($q); ?>"</h2>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                ?>
                <div class="post">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><?php echo $row['content']; ?></p>
                </div>
                <?php
            }
        } else {
            echo "<p>Không tìm thấy bài đăng nào phù hợp.</p>";
        }
        ?>
    </body>
    </html>
    <?php
}
$conn->close();
?>