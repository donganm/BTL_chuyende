<?php
// Bắt đầu phiên làm việc
session_start();
include('../includes/db.php');
if (!isset($_SESSION['user'])) {
    // Nếu người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: login.php");
    exit();
}

// Lấy thông tin role từ session
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hồ Sơ Của Tôi</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Arial", sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .body {
            display: flex;
            width: 90%;
            max-width: 1200px;
            min-height: 80vh;
            background: #ffffff;
            overflow: hidden;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar bên trái */
        .trai {
            background: #2c3e50;
            width: 25%;
            padding: 25px;
            color: #fff;
        }

        .profile-section {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #fff;
            margin-right: 15px;
        }

        .details .name {
            font-size: 20px;
            font-weight: bold;
            color: #f1f1f1;
        }

        .menu {
            margin-top: 20px;
        }

        .menu li {
            list-style: none;
            padding: 12px 0;
            font-size: 16px;
            cursor: pointer;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: 0.3s ease;
        }

        .menu li:hover {
            color: #1abc9c;
        }

        /* Phần nội dung bên phải */
        .phai {
            width: 75%;
            padding: 40px;
            background-color: #fff;
        }

        .content-section {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        }

        .content-section p:first-child {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }

        .content-section p:nth-child(2) {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        /* Form */
        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: 0.3s ease;
        }

        input:focus {
            border-color: #1abc9c;
            outline: none;
        }

        .gender {
            display: flex;
            align-items: center;
        }

        .gender input[type="radio"] {
            margin-right: 10px;
        }

        .gender label {
            margin-right: 30px;
            font-size: 14px;
        }

        /* Button */
        .save-btn {
            background: #1abc9c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s ease;
            display: block;
            width: 100%;
            text-align: center;
        }

        .save-btn:hover {
            background: #16a085;
        }
    </style>
</head>

<body>
    <div class="body">
        <!-- Menu Bên Trái -->
        <div class="trai">
            <div class="profile-section">
                <img class="avatar" alt="Avatar" src="../assets/img/4.jpg" />
                <div class="details">
                    <div class="name">Dong Anh</div>
                </div>
            </div>
            <div>
                <h3 style="font-size: 18px; color: yellow; margin: 10px 0">
                    Tài Khoản Của Tôi
                </h3>
                <ul class="menu">
                    <li id="profile">Hồ Sơ</li>
                    <li id="change-password">Đổi Mật Khẩu</li>
                    <li id="heritage-list">Danh Sách Di Sản</li>
                    <li id="post-management">Quản Lý Bài Đăng</li>
                    <li id="user-management">Quản Lý Người Dùng</li>
                    <li id="favorites">Danh sách yêu thích</li>
                    <li id="statistics">Thống Kê</li>
                    <li><a href="../index.php" style="text-decoration: none;color: yellow;">Trở lại</a></li>
                </ul>

            </div>
        </div>

        <!-- Nội Dung Bên Phải -->
        <div class="phai">
            <!-- Hồ sơ của tôi -->
            <div id="profile-content" class="content-section">
                <p>Hồ Sơ Của Tôi</p>
                <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                <hr />
                <form>
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" />
                    </div>
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" id="name" name="fullname" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" />
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" name="address" />
                    </div>
                    <div class="form-group">
                        <label>Giới tính</label>
                        <div class="gender">
                            <input type="radio" name="gender" id="male" value="Nam" />
                            <label for="male">Nam</label>
                            <input type="radio" name="gender" id="female" value="Nữ" />
                            <label for="female">Nữ</label>
                            <input type="radio" name="gender" id="other" value="Khác" />
                            <label for="other">Khác</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="date" name="date_of_birth" />
                    </div>
                    <button type="submit" class="save-btn">Lưu</button>
                </form>
            </div>

            <!-- Đổi mật khẩu -->
            <div id="change-password-content" class="content-section" style="display: none;">
                <p>Đổi Mật Khẩu</p>
                <p>Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</p>

            </div>

            <!-- Danh sách di sản -->
            <div id="heritage-list-content" class="content-section" style="display: none;">
                <p>Danh Sách Di Sản</p>
                <p>Quản lý danh sách di sản đã lưu</p>
            </div>

            <!-- Quản lý bài đăng -->
            <div id="post-management-content" class="content-section" style="display: none;">
                <p>Quản Lý Bài Đăng</p>
                <p>Danh sách các bài đăng của bạn</p>
            </div>

            <!-- Quản lý người dùng -->
            <div id="user-management-content" class="content-section" style="display: none;">
                <p>Quản Lý Người Dùng</p>
                <p>Danh sách người dùng trong hệ thống</p>
            </div>

            <!-- Danh sách yêu thích -->
            <div id="favorites-content" class="content-section" style="display: none;">
                <p>Danh sách yêu thích</p>
                <p>Danh sách di sản bạn yêu thích</p>
            </div>

            <!-- Thống kê -->
            <div id="statistics-content" class="content-section" style="display: none;">
                <p>Thống Kê</p>
                <p>Thống kê số lượng người dùng, bài đăng...</p>
            </div>


        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy tất cả các phần nội dung
            const sections = {
                "profile": document.getElementById("profile-content"),
                "change-password": document.getElementById("change-password-content"),
                "heritage-list": document.getElementById("heritage-list-content"),
                "post-management": document.getElementById("post-management-content"),
                "user-management": document.getElementById("user-management-content"),
                "favorites": document.getElementById("favorites-content"),
                "statistics": document.getElementById("statistics-content"),
            };

            // Ẩn tất cả nội dung
            function hideAllSections() {
                Object.values(sections).forEach(section => {
                    section.style.display = "none";
                });
            }

            // Thêm sự kiện click cho từng mục menu
            Object.keys(sections).forEach(menuId => {
                const menuItem = document.getElementById(menuId);
                if (menuItem) {
                    menuItem.addEventListener("click", function() {
                        hideAllSections(); // Ẩn tất cả nội dung
                        sections[menuId].style.display = "block"; // Hiển thị nội dung tương ứng
                    });
                }
            });
        });
    </script>

</body>


</html>