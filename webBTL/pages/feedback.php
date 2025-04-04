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
        body {
            background-color: #ecf0f1;
            font-family: Arial, sans-serif;
            color: #333;
            /* line-height: 1.6; */
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        h1,
        h2 {
            color: #2c3e50;
        }

        .feedback-form,
        .feedback-list {
            margin-top: 30px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: #c2977b;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: bold;
            font-size: 16px;
        }

        button:hover {
            background: #8f6f5a;
        }

        .success {
            color: #27ae60;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 5px solid #27ae60;
            background: #eafaf1;
            border-radius: 5px;
        }

        .error {
            color: #e74c3c;
            padding: 10px;
            margin-bottom: 10px;
            border-left: 5px solid #e74c3c;
            background: #fce4e4;
            border-radius: 5px;
        }

        .feedback-item {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            background: white;
            border: 1px solid #ddd;
        }

        .feedback-item p {
            margin: 5px 0;
        }

        .feedback-item strong {
            color: #2c3e50;
        }

        .home-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .home-button:hover {
            background: #2980b9;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include("../includes/header.php"); ?>
    <!-- End header -->

    <div class="container">
        <h1>Phản hồi của bạn</h1>
        <p>Chia sẻ ý kiến để giúp chúng tôi cải thiện</p>

        <div class="feedback-form">
            <h2>Gửi phản hồi</h2>

            <?php if (isset($_SESSION["feedback_success"])): ?>
                <p class="success"><?php echo $_SESSION["feedback_success"];
                                    unset($_SESSION["feedback_success"]); ?></p>
            <?php endif; ?>
            <?php if (isset($_SESSION["feedback_error"])): ?>
                <p class="error"><?php echo $_SESSION["feedback_error"];
                                    unset($_SESSION["feedback_error"]); ?></p>
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

    </div>

    <!-- Footer  -->
    <?php include("../includes/footer.php"); ?>

    <!-- End Footer -->

    <?php $conn->close(); ?>