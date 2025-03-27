<?php
include '../../../includes/db.php'; // Kết nối database

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

// Kiểm tra ID bài viết
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Thiếu hoặc sai ID bài viết!");
}

$id = intval($_GET['id']);
$sql = "SELECT tieude, noidung, hinhanh FROM tintuc WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Bài viết không tồn tại!");
}
$article = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article["tieude"]); ?></title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="../includes/nav.css">
    <style>
      body {
          font-family: Arial, sans-serif;
          background-color: #f4f4f4;
          margin: 0;
          padding: 0;
      }

      header {
          width: 100%;
          background-color: #2c3e50;
          padding: 15px 0;
          text-align: center;
      }

      header h1 {
          color: white;
          font-size: 2em;
          margin: 0;
          padding: 10px;
      }


      .container {
          max-width: 800px;
          background: #fff;
          margin: 50px auto;
          padding: 20px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      h1 {
          text-align: center;
          color: #333;
          margin-bottom: 20px;
      }

      .single-article img {
          width: 100%;
          height: auto;
          border-radius: 10px;
          margin-bottom: 20px;
      }

      .single-article p {
          font-size: 18px;
          line-height: 1.6;
          color: #555;
          text-align: justify;
      }

      .back-link {
          display: block;
          text-align: center;
          margin-top: 20px;
          padding: 10px;
          background: #007BFF;
          color: white;
          text-decoration: none;
          font-size: 16px;
          border-radius: 5px;
          transition: background 0.3s;
      }

      .back-link:hover {
          background: #0056b3;
      }
    </style>
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($article["tieude"]); ?></h1>
    </header>

    <!-- <nav>
        <a href="../../index.php">Trang chủ</a>
        <a href="./news.php">Tin tức</a>
        <a href="../blog/blog.php">Blog</a>
    </nav> -->
    <?php include '../includes/nav.php'; ?>

    <div class="container single-article">
    <img src="./images/<?php echo htmlspecialchars($article['hinhanh']); ?>" 
     alt="<?php echo htmlspecialchars($article['tieude']); ?>" 
     onerror="this.onerror=null;this.src='./images/default.jpg';">

        <p><?php echo nl2br(htmlspecialchars($article["noidung"])); ?></p>
        <a href="./news.php" class="back-link">Quay lại</a>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>