<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f4f4f4; */
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: color 0.3s ease;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        /* Header */

        .header_container {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100000;
        }

        .header {
            background-color: #ebebeb;
            /* color: white; */
            padding: 5px 0;
            text-align: center;
            font-size: 10px;
            letter-spacing: 2px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
        }

        /* Navigation Menu */
        .menu {
            background-color: #f8f6f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menu .box1 {
            font-size: 22px;
            font-weight: bold;
        }

        .menu .box2 ul {
            display: flex;
            gap: 20px;
        }

        .menu .box2 ul li {
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .menu .box2 ul li:hover {
            color: #fdd835;
        }

        .menu .box3 {
            display: flex;
            gap: 40px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        /* END HEADER */
        /* Hiệu ứng làm mờ */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9;
        }

        /* Cửa sổ đăng nhập */
        .login-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 400px;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }

        .login-modal iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }

        /* Footer  */
        .footer_1 {
            width: 100%;
            max-width: 1350px;
            margin-left: auto;
        }

        .footer_1 p {
            color: gray;
        }

        .footer_2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: black;
            color: white;
            padding: 10px;
        }

        .footer_2 .VN {
            display: flex;
            align-items: center;
        }

        .footer_2 .VN img {
            height: 15px;
            width: auto;
            margin-right: 10px;
        }

        .footer_3 {
            color: gray;
            padding: 6px;
            font-size: 12px;
            text-align: center;
        }

        /* End Footer */
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header_container">
        <div class="header">Welcome to Global Heritage...</div>

        <!-- Navigation Menu -->
        <div class="menu">
            <div class="box1"><a href="../index.php">G.H</a></div>
            <div class="box2">
                <ul>
                    <li><a href="gh.php">Global Heritage</a></li>
                    <li><a href="image.php">Photo Gallery</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <!-- <li><a href="contact.php">Contact Us</a></li> -->
                    <li style="color: red; font-weight: bold"><a href="feedback.php">Feedback</a></li>
                </ul>
            </div>
            <div class="box3">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="header__search-signin-des" id="user" onclick="">
                        <a
                            href="profile.php"
                            style="text-decoration: none; color: #444"><?php echo $_SESSION['user']; // Hiển thị tên người dùng 
                                                                        ?></a>
                    </div>
                    <div>
                        <a
                            href="logout.php"
                            style="text-decoration: none; color: #444"
                            class="header__search-signout">Đăng xuất</a>
                    </div>
                <?php else: ?>
                    <div class="header__search-signin-des" id="signin">
                        <a href="#" class="login-btn" onclick="openLoginForm()" style="text-decoration: none; color: #444">Đăng nhập</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- End header -->
    <div class="overlay" id="overlay" onclick="closeLoginForm()"></div>
    <div class="login-modal" id="loginModal">
        <span class="close-btn" onclick="closeLoginForm()">&times;</span>
        <iframe src="login.php" frameborder="0"></iframe>
    </div>