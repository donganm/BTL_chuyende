<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            color: #333;
        }

        .contact-info {
            margin-bottom: 30px;
        }

        iframe {
            border: 0;
            width: 100%;
            height: 400px;
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

        /*Phần thông tin liên hệ (Contact Info)*/
        .contact-info {
            margin-bottom: 30px;
            text-align: center;
        }

        .contact-info h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-info p {
            font-size: 18px;
            color: #7f8c8d;
        }

        .contact-info a {
            font-size: 18px;
            color: #2980b9;
            text-decoration: underline;
        }


        /*Social Media*/
        .social-media {
            text-align: center;
            margin-top: 20px;
        }

        .social-media a {
            font-size: 18px;
            color: #2980b9;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-media a:hover {
            color: #1abc9c;
        }

        /*So dien thoai va thoi gian lam viec*/
        .contact-info p a {
            font-weight: bold;
            color: #e74c3c;
        }

        .contact-info p {
            margin: 5px 0;
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
    <div class="header">Welcome to Global Heritage...</div>

    <!-- Navigation Menu -->
    <div class="menu">
        <div class="box1"><a href="../index.php">G.H</a></div>
        <div class="box2">
            <ul>
                <li><a href="khampha.php">Khám phá</a></li>

                <li><a href="tintuc.php">Tin tức & Blog</a></li>
                <li><a href="congdong.php">Cộng đồng</a></li>
                <li><a href="about.php">About Us</a></li>
                <li style="color: red; font-weight: bold">
                    <a href="baidangketnoiq&a.php">Q&A</a>
                </li>

            </ul>
        </div>
        <div class="box3">
            <?php if (isset($_SESSION['user'])): ?>
                <div class="header__search-signin-des" id="user" onclick="">
                    <a
                        href="./pages/profile.php"
                        style="text-decoration: none; color: #444"><?php echo $_SESSION['user']; // Hiển thị tên người dùng 
                                                                    ?></a>
                </div>
                <div>
                    <a
                        href="./pages/logout.php"
                        style="text-decoration: none; color: #444"
                        class="header__search-signout">Đăng xuất</a>
                </div>
            <?php else: ?>
                <div class="header__search-signin-des" id="signin">
                    <a href="login.php" style="text-decoration: none; color: #444">Đăng nhập</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <h1>Contact Us</h1>
        <!-- Địa chỉ công ty -->
        <div class="contact-info">
            <h2>Our Office</h2>
            <p>285 Đội Cấn, Ba Đình, Hà Nội</p>

            <!-- Google Maps Iframe -->
            <iframe
                src="https://maps.google.com/maps?q=Aptech%20Computer%20Education&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>

        <!-- Liên kết Email -->
        <div class="contact-info">
            <h2>Email Us</h2>
            <p>If you have any questions, feel free to send us an email at:
                <a href="mailto:khanhnh309@gmail.com">nhom09@gmail.com</a>
            </p>
        </div>

        <!--So dien thoai lien he -->
        <div class="contact-info">
            <h2>Call Us</h2>
            <p>Phone: <a href="tel:+84987654321">+84 987654322</a></p>
        </div>

        <!--Mang xa hoi-->
        <div class="social-media">
            <h2>Follow Us</h2>
            <a href="#">Facebook</a>
            <a href="#">LinkedIn</a>
            <a href="#">Twitter</a>
        </div>

        <!--Thoi gian lam viec-->
        <div class="contact-info">
            <h2>Working Hours</h2>
            <p>Monday - Friday: 9 AM - 6 PM</p>
            <p>Saturday: 9 AM - 12 PM</p>
            <p>Sunday: Closed</p>
        </div>
    </div>

    <!-- Footer  -->
    <hr />
    <div class="footer_1">
        <h5>Get Help</h5>
        <p><a href="feedback.php">Feedback</a></p>

        <p><a href="contact.php">Contact Us</a></p>
    </div>

    <div class="footer_2">
        <div class="VN">
            <img src="./assets/img/VN_Flag.webp" alt="logo" />
            <span>VN</span>
        </div>
        <div class="Conver">
            <span><i class="fa-brands fa-dribbble"></i></span>
            <span>2025 G.H</span>
        </div>
    </div>

    <div class="footer_3">
        <p>
            COPYRIGHT <i class="fa-brands fa-dribbble"></i> 2025 G.H. ALL RIGHTS
            RESERVED
        </p>
    </div>

    <!-- End Footer -->
</body>

</html>