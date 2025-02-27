<?php
// include './db_connect.php';
    include '../../includes/db.php';


// Lấy dữ liệu bài viết từ database
$sql = "SELECT * FROM tintuc WHERE id = 1"; // ID = 1 là bài viết về Chùa Một Cột
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['tieude']; ?></title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <h1><?php echo $row['tieude']; ?></h1>
    </header>
    <nav>
        <a href="./index.php">Trang chủ</a>
        <a href="../tintuc.php">Tin tức</a>
        <a href="../blog/blog.php">Blog</a>
    </nav>
    <div class="container">
        <div class="image-container">
            <img src="../../images/<?php echo $row['hinhanh']; ?>" alt="<?php echo $row['tieude']; ?>">
        </div>
        <div class="content">
            <p><?php echo nl2br($row['noidung']); ?></p>
        </div>
        <div class="back-link">
            <a href="../tintuc.php">← Quay lại Tin tức</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>


<!-- 
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chùa Một Cột - Biểu tượng ngàn năm</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <header>
        <h1>Chùa Một Cột - Biểu tượng ngàn năm</h1>
        <p>Ngôi chùa với kiến trúc độc đáo bậc nhất Việt Nam</p>
    </header>
    <nav>
        <a href="../index.php">Trang chủ</a>
        <a href="../tintuc.php">Tin tức</a>
        <a href="../blog/blog.php">Blog</a>
    </nav>
    <div class="container">
        <div class="image-container">
            <img src="../../images/chua-mot-cot.jpg" alt="Chùa Một Cột">
        </div>
        <div class="content">
            <h2>Giới thiệu về Chùa Một Cột</h2>
            <p>
                Chùa Một Cột là một trong những biểu tượng văn hóa lâu đời của Hà Nội, được xây dựng dưới triều vua Lý Thái Tông (1049). 
                Chùa có kiến trúc độc đáo, được xây dựng trên một trụ đá giữa hồ, tượng trưng cho đóa sen thanh khiết vươn lên từ mặt nước.
            </p>

            <h2>Kiến trúc độc đáo</h2>
            <p>Chùa Một Cột có thiết kế hình vuông, mái ngói cong, đặt trên một trụ đá đường kính 1.25m, cao 4m.</p>

            <h2>Lịch sử và ý nghĩa</h2>
            <p>Chùa được xây dựng để cầu nguyện quốc thái dân an, thể hiện lòng biết ơn của vua Lý Thái Tông.</p>
        </div>
        <div class="back-link">
            <a href="../tintuc.php">← Quay lại Tin tức</a>
        </div>
    </div>
</body>
</html> -->