<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Global Heritage</title>
  <style>
    /* Biến CSS */
    :root {
      --primary-color: #4caf50;
      --secondary-color: #f1f1f1;
      --text-color: #333;
      --font-family: "Roboto", sans-serif;
    }

    /* Reset mặc định */
    body {
      font-family: var(--font-family);
      margin: 0;
      padding: 0;
      background-color: var(--secondary-color);
      color: var(--text-color);
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    a {
      text-decoration: none;
    }

    ul {
      list-style: none;
    }

    /* Header */
    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      background-color: #fff;
      border-bottom: 2px solid #4caf50;
    }

    .header_phai {
      display: flex;
      align-items: center;
      gap: 15px;
      /* Khoảng cách giữa các phần tử */
    }

    /* Phần hiển thị tên người dùng */
    .header__search-signin-des {
      font-size: 16px;
      font-weight: bold;
      color: var(--text-color);
      padding: 8px 12px;
      border-radius: 5px;
      border: 2px solid var(--primary-color);
      transition: background 0.3s ease;
    }

    .header__search-signin-des:hover {
      background: var(--primary-color);
      color: white;
    }

    /* Nút đăng nhập & đăng xuất */
    .header__search-signout {
      display: inline-block;
      font-size: 14px;
      color: var(--text-color);
      padding: 8px 12px;
      border: 2px solid var(--primary-color);
      border-radius: 5px;
      transition: all 0.3s ease;
    }

    .header__search-signout:hover {
      background-color: var(--primary-color);
      color: #fff;
    }

    /* Main Content */
    .main {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin: 40px 0;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .main ul {
      display: flex;
      justify-content: space-around;
      /* Căn đều */
      align-items: center;
      flex-wrap: wrap;
      /* Đảm bảo xuống hàng nếu không đủ chỗ */
      list-style: none;
      /* Xóa dấu chấm của danh sách */
      padding: 0;
      margin: 0;
    }

    .main li {
      text-align: center;
      flex: 1;
      min-width: 150px;
      /* Đảm bảo không quá nhỏ */
    }

    .main li:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .main img {
      width: 100%;
      max-width: 180px;
      height: 180px;
      object-fit: cover;
      border-radius: 50%;
      margin: 0 auto;
    }

    .main p {
      margin-top: 15px;
      font-size: 16px;
      font-weight: 500;
      color: #333;
    }

    /* Footer */
    .footer ul {
      display: flex;
      justify-content: center;
      gap: 30px;
      padding: 20px 0;
      background-color: #fff;
      border-top: 2px solid var(--primary-color);
      margin-top: 40px;
    }

    .footer a {
      text-decoration: none;
      font-size: 16px;
      color: var(--text-color);
      transition: color 0.3s ease;
    }

    .footer a:hover {
      color: var(--primary-color);
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Header -->
    <div class="header">
      <h1 style="margin: 0; color: var(--primary-color); font-size: 24px">
        Global Heritage
      </h1>

      <div class="header_phai">
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
            <a
              href="./pages/login.php"
              style="text-decoration: none; color: #444">Đăng nhập</a>
          </div>
        <?php endif; ?>
      </div>

    </div>

    <!-- Main Content -->
    <div class="main">
      <ul>
        <li>
          <a href="./pages/khampha.php"><img src="assets/img/4.jpg" alt="Khám phá" />
            <p>Khám phá</p>
          </a>
        </li>
        <!-- <li>
          <a href="./pages/bando.php">
            <img src="assets/img/5.jpg" alt="Bản đồ" />
            <p>Bản đồ</p>
          </a>
        </li> -->
        <li>
          <a href="./pages/tintuc.php" target="_blank">
            <img src="./assets/img/6.jpg" alt="Tin tức và Blog" />
            <p>Tin tức và Blog</p>
          </a>
        </li>
        <li>
          <a href="./pages/congdong.php">
            <img src="./assets/img/7.jpg" alt="Cộng đồng" />
            <p>Cộng đồng</p>
          </a>
        </li>
        <li>
          <a href="./pages/baidangketnoiq&a.php">
            <img src="./assets/img/8.jpg" alt="Q&A" />
            <p>Q&A</p>
          </a>
        </li>
      </ul>
    </div>

    <!-- Footer -->
    <div class="footer">
      <ul>
        <li>
          <a href="./pages/about.php" target="_blank">About Us</a>
        </li>
        <li>
          <a href="./pages/contact.php" target="_blank">Contact Us</a>
        </li>
        <li>
          <a href="./pages/feedback.php" target="_blank">Feedback</a>
        </li>
      </ul>
    </div>
  </div>
</body>

</html>