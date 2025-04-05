<?php
session_start();
include('../includes/db.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $userName = $_POST['username'];
    $passWord = $_POST['password'];
    $role;
    // Chuẩn bị câu lệnh SQL để tránh SQL Injection
    $sql = "SELECT * FROM users WHERE `Username` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Kiểm tra nếu tìm thấy người dùng
    if ($row = mysqli_fetch_assoc($result)) {
        // Kiểm tra mật khẩu
        if ($passWord == $row['Password']) {
            // Mở session và lưu thông tin người dùng
            
            $_SESSION['user_id'] = $row['UserId'];
            $_SESSION['role'] = $row['Role'];
            $_SESSION['user'] = $userName;
            // header('Location: ../index.php');
            // exit();

            // Bonus!!

            echo "<script>
                    window.parent.location.reload(); // Tải lại trang chính
                </script>";
            exit();

            // Bonus!!

        } else {
            echo "<script>alert('Vui lòng nhập lại mật khẩu');</script>";
        }
    } else {
        echo "<script>alert('Tên đăng nhập không chính xác');</script>";
    }
} else {
    // echo "<script>alert('Vui lòng nhập đầy đủ thông tin');</script>";
}

// Kiểm tra xem trang có đang chạy trong iframe không
$isIframe = isset($_GET['iframe']) && $_GET['iframe'] == 'true';

if (!$isIframe) :
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="./assets/css/reset.css">
        <link rel="stylesheet" href="./assets/css/styles.css">
        <link rel="stylesheet" href="./assets/font/fontawesome-free-6.6.0-web/css/all.min.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .container {
                background: #fff;
                padding: 20px 30px;
                border-radius: 10px;
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
                max-width: 450px;
                width: 100%;
                text-align: center;
            }

            h2 {
                text-align: center;
                color: #333;
                margin-bottom: 20px;
            }

            /* Form Group */
            .form-group {
                margin-bottom: 15px;
                text-align: left;
            }

            input {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
                font-size: 14px;
                margin-top: 5px;
            }

            input:focus {
                border-color: #b5b5b5;
                outline: none;
                /* bỏ đường viền */
                box-shadow: 0 0 5px #b5b5b5;
            }

            /* Button Group */
            .btn-group {
                text-align: center;
            }

            .btn {
                display: inline-block;
                padding: 10px 15px;
                margin: 5px;
                background: #333;
                color: white;
                font-size: 14px;
                font-weight: bold;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                border: 2px solid #333;
            }

            .btn:hover {
                background: white;
                color: #333;
            }

            .goHome a {
                color: #024b82;
                text-decoration: none;
            }

            .goHome a:hover {
                text-decoration: underline;
            }

            p {
                margin-top: 15px;
                font-size: 14px;
                color: #4a4a4a;
            }

            a {
                color: #024b82;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>

    <body>
    <?php endif; ?>

    <div class="container">
        <h2>Đăng Nhập</h2>

        <?php if (isset($error)) {
            echo "<p class='error-message'>$error</p>";
        } ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Tài khoản</label>
                <input type="text" id="username" name="username" placeholder="Nhập tài khoản" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="btn-group">
                <button class="btn btn-login" type="submit">Đăng Nhập</button>
                <!-- Nút đăng ký -->
                <!-- <a class="btn btn-register" href="register.php" target="_blank">Đăng Ký</a> -->
            </div>

            <p style="text-align: center;">Chưa có tài khoản? <a href="register.php" target="_blank">Đăng ký</a></p>

            <!-- Nút quay lại trang chủ -->
            <!-- <div class="btn-group">
                <div class="btn-home goHome"><a href="../index.php">..Quay Lại Trang Chủ..</a></div>
            </div> -->
        </form>
    </div>
    <?php if (!$isIframe) : ?>
    </body>

    </html>
<?php endif; ?>