<?php
session_start();
include '../includes/db.php'; // Kết nối database

// Xử lý khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $sql = "INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $message);
        if ($stmt->execute()) {
            $_SESSION["feedback_success"] = "Cảm ơn bạn đã gửi phản hồi!";
        } else {
            $_SESSION["feedback_error"] = "Đã có lỗi xảy ra, vui lòng thử lại!";
        }
        $stmt->close();
    } else {
        $_SESSION["feedback_error"] = "Vui lòng điền đầy đủ thông tin!";
    }
    header("Location: feedback.php");
    exit();
}

// Lấy danh sách phản hồi
$feedbacks = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phản hồi của bạn</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .container { max-width: 800px; margin: auto; padding: 20px; background: white; text-align: center; }
        .feedback-form, .feedback-list { margin-top: 20px; padding: 15px; background: #f9f9f9; border-radius: 5px; text-align: left; }
        textarea { width: 100%; height: 100px; padding: 10px; margin: 10px 0; }
        input, button { width: 100%; padding: 10px; margin: 5px 0; }
        button { background: #27ae60; color: white; border: none; cursor: pointer; }
        button:hover { background: #219150; }
        .success { color: green; }
        .error { color: red; }
        .home-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .home-button:hover { background: #2980b9; }
    </style>
</head>
<body>
    <header>
        <h1>Phản hồi của bạn</h1>
        <p>Chia sẻ ý kiến để giúp chúng tôi cải thiện</p>
    </header>

    <div class="container">
        <a href="../index.php" class="home-button">🏠 Quay về Trang chủ</a>

        <div class="feedback-form">
            <h2>Gửi phản hồi</h2>

            <?php if (isset($_SESSION["feedback_success"])): ?>
                <p class="success"><?php echo $_SESSION["feedback_success"]; unset($_SESSION["feedback_success"]); ?></p>
            <?php endif; ?>
            <?php if (isset($_SESSION["feedback_error"])): ?>
                <p class="error"><?php echo $_SESSION["feedback_error"]; unset($_SESSION["feedback_error"]); ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="name" placeholder="Họ và tên" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="message" placeholder="Nhập nội dung phản hồi..." required></textarea>
                <button type="submit">Gửi phản hồi</button>
            </form>
        </div>

        <div class="feedback-list">
            <h2>Phản hồi gần đây</h2>
            <?php while ($row = $feedbacks->fetch_assoc()): ?>
                <div class="feedback-item">
                    <p><strong><?php echo htmlspecialchars($row["name"]); ?></strong> - <?php echo date("d/m/Y H:i", strtotime($row["created_at"])); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($row["message"])); ?></p>
                    <hr>
                </div>
            <?php endwhile; ?>
        </div>

        <a href="../index.php" class="home-button">🏠 Quay về Trang chủ</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
