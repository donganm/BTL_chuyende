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
            /* display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; */
        }

        .body {
            display: flex;
            /* width: 90%;
            max-width: 1200px; */
            min-height: 100vh;
            /* background: #ffffff;
            overflow: hidden;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1); */
        }

        /* Sidebar bên trái */
        .trai {
            background: #2c3e50;
            width: 20%;
            padding: 25px;
            color: #fff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
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
            width: 80%;
            padding: 40px;
            background-color: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
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

        /* Đổi mật khẩu */
        .change-password-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .change-password-form h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }

        .change {
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Quản lý người dùng */
        .content-section {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            max-width: 800px;
            margin: 20px auto;
        }

        .content-section h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            /* gộp đường biên table  */
            margin: 0 auto;
        }

        .product-table th,
        .product-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .product-table th {
            background-color: #f4f4f4;
            color: #555;
        }

        .product-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .product-table tr:hover {
            background-color: #f1f1f1;
        }

        /* Thư viện ảnh */
        .add_image {
            margin-bottom: 50px;
        }
    </style>
</head>

<body>
    <div class="body">
        <!-- Menu Bên Trái -->
        <div class="trai">
            <?php
            $ten = $_SESSION['user'];
            $sql = "Select * from users where `Username` = '$ten' ";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $idd = $row['UserId'];

            ?>
                <div class="profile-section">
                    <img class="avatar" src="<?php echo !empty($row['Avatar']) ? $row['Avatar'] : '../uploads/default-avatar.png'; ?>" alt="Avatar" />

                    <div class="details">
                        <div class="name"><?php echo $row['FullName']; ?></div>

                    </div>
                </div>

                <div>
                    <h3 style="font-size: 18px; color: yellow; margin: 10px 0">
                        Tài Khoản Của Tôi
                    </h3>
                    <ul class="menu">
                        <li>Hồ Sơ</li>
                        <li>Đổi Mật Khẩu</li>
                        <?php if ($role == 'User'): ?>
                            <li>Quản Lý Bài Đăng</li>
                            <!-- <li>Danh Sách Yêu Thích</li> -->

                        <?php endif; ?>


                        <?php if ($role == 'Admin'): ?>
                            <li>Quản Lý Người Dùng</li>
                            <li>Danh Sách Di Sản</li>
                            <li>Danh Sách Các Bình Luận</li>
                            <li>Thư Viện Ảnh</li>
                            <li>Phản Hồi Từ Người Dùng</li>
                        <?php endif; ?>
                        <li><a href="../index.php" style="text-decoration: none;color:yellow;">Trở lại</a></li>
                    </ul>
                </div>
        </div>

        <!-- Nội Dung Bên Phải -->
        <div class="phai">
            <div id="profile-content" class="content-section">
                <p>Hồ Sơ Của Tôi</p>
                <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                <hr />
                <form action="../logic/process_user_update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="UserId" value="<?php echo $row['UserId']; ?>" />
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" value="<?php echo $row['Username']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" id="name" name="fullname" value="<?php echo $row['FullName']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $row['Email']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" name="address" value="<?php echo $row['Address']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Giới tính</label>
                        <div class="gender">
                            <input type="radio" name="gender" id="male" value="Nam" <?php echo ($row['Gender'] == 'Nam') ? 'checked' : ''; ?> />
                            <label for="male">Nam</label>
                            <input type="radio" name="gender" id="female" value="Nữ" <?php echo ($row['Gender'] == 'Nữ') ? 'checked' : ''; ?> />
                            <label for="female">Nữ</label>
                            <input type="radio" name="gender" id="other" value="Khác" <?php echo ($row['Gender'] == 'Khác') ? 'checked' : ''; ?> />
                            <label for="other">Khác</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="date" name="date_of_birth" value="<?php echo $row['DateOfBirth']; ?>" />
                    </div>

                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>

                    <button type="submit" class="save-btn">Lưu</button>
                </form>

            </div>

            <!-- Đổi mật khẩu -->
            <div id="change-password-content" class="content-section" style="display: none;">
                <p>Đổi Mật Khẩu</p>
                <p>Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</p>
                <form class="change-password-form" action="../logic/resetPass.php" method="POST">

                    <input type="hidden" name="UserId" value="<?php echo $row['UserId']; ?>" />

                    <div class="change">
                        <label for="current-password">Mật khẩu hiện tại</label>
                        <input
                            type="password"
                            id="current-password"
                            name="current-password"
                            placeholder="Nhập mật khẩu hiện tại"
                            required />
                    </div>

                    <div class="change">
                        <label for="new-password">Mật khẩu mới</label>
                        <input
                            type="password"
                            id="new-password"
                            name="new-password"
                            placeholder="Nhập mật khẩu mới"
                            required />
                    </div>

                    <div class="change">
                        <label for="confirm-password">Xác nhận mật khẩu mới</label>
                        <input
                            type="password"
                            id="confirm-password"
                            name="confirm-password"
                            placeholder="Xác nhận mật khẩu mới"
                            required />
                    </div>

                    <button type="submit" class="save-btn">Lưu thay đổi</button>
                </form>
            </div>

            <!-- Danh sách di sản -->
            <div id="heritage-list-content" class="content-section" style="display: none;">
                <p>Danh Sách Di Sản</p>
                <p>Quản lý danh sách di sản đã lưu</p>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Di Sản</th>
                            <th>Mô Tả</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "Select * from articles";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];

                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td>
                                    <a class="update" href="../logic/delete_disan.php?id=<?php echo $id; ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                </table>
            </div>

            <!-- Quản lý bài đăng -->
            <div id="post-management-content" class="content-section" style="display: none;">
                <p>Quản Lý Bài Đăng</p>
                <p>Danh sách các bài đăng của bạn</p>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Bài Viết</th>
                            <th>Mô Tả</th>
                            <th>Thời Gian Tạo</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "Select * from posts";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];

                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['content']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>

                                <td>
                                    <a class="update" href="../logic/delete_baidang.php?id=<?php echo $id; ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                </table>
            </div>

            <!-- Quản lý người dùng -->
            <div id="user-management-content" class="content-section" style="display: none;">
                <p>Quản Lý Người Dùng</p>
                <p>Danh sách người dùng trong hệ thống</p>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Tên Đăng Nhập</th>
                            <th>Tên Người Dùng</th>
                            <th>Vai Trò</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "Select * from users";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['UserId'];

                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['Username']; ?></td>
                                <td><?php echo $row['FullName']; ?></td>
                                <td><?php echo $row['Role']; ?></td>
                                <td>
                                    <a class="update" href="../logic/delete_user.php?id=<?php echo $id; ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                </table>
            </div>

            <!-- Danh sách yêu thích -->
            <!-- <div id="favorites-content" class="content-section" style="display: none;">
                <p>Danh sách yêu thích</p>
                <p>Danh sách các di tích yêu thích</p>
                
            </div> -->

            <!-- Quản lý bình luận -->
            <div id="statistics-content" class="content-section" style="display: none;">
                <p>Comments</p>
                <p>Quản lý, xóa bình luận tiêu cực..</p>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Tên Người Dùng</th>
                            <th>Bình Luận</th>
                            <th>Ngày Tạo</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "Select * from comments";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];

                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['content']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <a class="update" href="../logic/delete_binhluan.php?id=<?php echo $id; ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                </table>
            </div>

            <!-- Quản lý thư viện ảnh -->
            <div id="manage_images" class="content-section" style="display: none;">
                <div class="add_image">
                    <p>Thư viện ảnh</p>
                    <p>Thêm ảnh</p>
                    <form action="../logic/uploads_image.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <button type="submit" style="padding: 5px;">Lưu</button>
                    </form>

                </div>


                <p>Quản lý ảnh, cập nhật, xóa ảnh..</p>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Mô Tả</th>

                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "Select * from images";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];

                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['image_path']; ?></td>
                                <td><?php echo $row['description']; ?></td>

                                <td>
                                    <a class="update" href="../logic/update_image.php?id=<?php echo $id; ?>">Cập nhật</a>
                                    <a class="update" href="../logic/delete_image.php?id=<?php echo $id; ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                </table>
            </div>

            <!-- Feedback -->
            <div id="manage_feedback" class="content-section" style="display: none;">
                <p>Quản lý feedback</p>
                <p>Xem phản hồi từ người dùng để cải thiện hệ thống..</p>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>Tên Người Dùng</th>
                            <th>Email</th>
                            <th>Phản Hồi</th>
                            <th>Thời Gian</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "Select * from feedback";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];

                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['message']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <a class="update" href="../logic/delete_feedback.php?id=<?php echo $id; ?>">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
    </div>

    <script>
        // Danh sách các menu và nội dung liên kết
        // Lấy danh sách menu và nội dung tương ứng
        const menus = [{
                menu: ".menu li:nth-child(1)",
                content: "profile-content"
            },
            {
                menu: ".menu li:nth-child(2)",
                content: "change-password-content"
            },
            {
                menu: ".menu li:nth-child(3)",
                content: "post-management-content", // Quản lý bài đăng
                condition: "User" // Chỉ hiển thị nếu vai trò là User
            },
            {
                menu: ".menu li:nth-child(4)",
                content: "favorites-content", // Danh sách yêu thích
                condition: "User"
            },
            {
                menu: ".menu li:nth-child(3)",
                content: "user-management-content", // Quản Lý Người dùng
                condition: "Admin"
            },
            {
                menu: ".menu li:nth-child(4)",
                content: "heritage-list-content", // Danh sách di sản
                condition: "Admin" // Chỉ hiển thị nếu vai trò là Admin
            },
            {
                menu: ".menu li:nth-child(5)",
                content: "statistics-content", // Bình luận
                condition: "Admin" // Chỉ hiển thị nếu vai trò là Admin
            },
            {
                menu: ".menu li:nth-child(6)",
                content: "manage_images", // thư viện ảnh
                condition: "Admin" // Chỉ hiển thị nếu vai trò là Admin
            },
            {
                menu: ".menu li:nth-child(7)",
                content: "manage_feedback", // thư viện ảnh
                condition: "Admin" // Chỉ hiển thị nếu vai trò là Admin
            }
        ];

        // Vai trò của người dùng (lấy từ PHP)
        const userRole = "<?php echo $role; ?>";

        // Hàm ẩn tất cả nội dung
        function hideAllContent() {
            menus.forEach(item => {
                const contentElement = document.getElementById(item.content);
                if (contentElement) {
                    contentElement.style.display = "none";
                }
            });
        }

        // Gắn sự kiện cho từng menu
        menus.forEach((item, index) => {
            // Chỉ gắn sự kiện nếu menu phù hợp với vai trò người dùng
            if (!item.condition || item.condition === userRole) {
                const menuElement = document.querySelector(item.menu);
                const contentElement = document.getElementById(item.content);
                if (menuElement && contentElement) {
                    menuElement.addEventListener("click", () => {
                        hideAllContent(); // Ẩn tất cả nội dung
                        contentElement.style.display = "block"; // Hiển thị nội dung được chọn
                    });
                }
            }
        });
    </script>
</body>



</html>