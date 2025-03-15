<?php
session_start();

// Lưu lại trang trước khi đăng xuất (nếu có)
if (!isset($_SESSION['redirect_url'])) {
    $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];  // Lưu URL của trang trước
}

// Xóa tất cả các session
session_unset();

// Hủy phiên làm việc
session_destroy();

// Chuyển hướng về trang trước nếu có, nếu không thì quay về trang chủ
if (isset($_SESSION['redirect_url'])) {
    $redirectUrl = $_SESSION['redirect_url'];
    unset($_SESSION['redirect_url']);  // Xóa URL sau khi đã sử dụng
    header('Location: ' . $redirectUrl);  // Chuyển hướng về trang trước
} else {
    // Nếu không có URL trước đó, quay về trang chính
    header('Location: ../index.php');
}
exit();
?>
