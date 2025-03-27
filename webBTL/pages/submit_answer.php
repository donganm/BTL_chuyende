<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Thông tin kết nối CSDL
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "global";

    // Kết nối đến CSDL
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ form
    $question_id = isset($_POST['question_id']) ? intval($_POST['question_id']) : 0;
    $answer      = $conn->real_escape_string($_POST['answer']);

    // Tạo câu lệnh INSERT vào bảng answers
    $sql = "INSERT INTO answers (question_id, answer, created_at) VALUES ($question_id, '$answer', NOW())";

    if ($conn->query($sql) === TRUE) {
        // Chuyển hướng về trang câu hỏi (ví dụ: qa.php?question_id=1)
        header("Location: qa.php?question_id=" . $question_id);
        exit;
    } else {
        echo "Lỗi khi lưu câu trả lời: " . $conn->error;
    }
    $conn->close();
}
?>
