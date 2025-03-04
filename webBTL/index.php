<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <style>
    /* Global Styles */
    body {
      font-family: "Arial", sans-serif;
      margin: 0;
      padding: 0;
      color: #333;
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

    .container {
      display: flex;
      width: 100%;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
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

    /* BODY  */
    .container img {
      width: 100%;
      margin: 15px 0;
    }

    /* END BODY */

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
        <li><a href="./pages/khampha.php">Khám phá</a></li>

        <li><a href="./pages/tintuc.php">Tin tức & Blog</a></li>
        <li><a href="./pages/congdong.php">Cộng đồng</a></li>
        <li><a href="./pages/about.php">About Us</a></li>
        <li style="color: red; font-weight: bold">
          <a href="./pages/baidangketnoiq&a.php">Q&A</a>
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
          <a href="./pages/login.php" style="text-decoration: none; color: #444">Đăng nhập</a>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container">
    <img src="./assets/img/3.jpg" />
  </div>

  <!-- Footer  -->
  <hr />
  <div class="footer_1">
    <h5>Get Help</h5>
    <p><a href="./pages/feedback.php">Feedback</a></p>

    <p><a href="./pages/contact.php">Contact Us</a></p>
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