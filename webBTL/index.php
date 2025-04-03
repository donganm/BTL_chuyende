<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang chủ</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel="stylesheet" href="trangchu.css" />
  <style>
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
      width: 550px;
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
  </style>
</head>

<body>

  <!-- Header -->
  <div class="header_container">
    <div class="header">Welcome to Global Heritage...</div>

    <!-- Navigation Menu -->
    <div class="menu">
      <div class="box1"><a href="index.php">G.H</a></div>
      <div class="box2">
        <ul>
          <li><a href="./pages/gh.php">Global Heritage</a></li>
          <li><a href="./pages/image.php">Photo Gallery</a></li>
          <li><a href="./pages/about.php">About Us</a></li>
          <!-- <li><a href="./pages/contact.php">Contact Us</a></li> -->
          <li style="color: red; font-weight: bold"><a href="./pages/feedback.php">Feedback</a></li>
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
            <a href="#" class="login-btn" onclick="openLoginForm()" style="text-decoration: none; color: #444">Đăng nhập</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="overlay" id="overlay" onclick="closeLoginForm()"></div>
  <div class="login-modal" id="loginModal">
    <span class="close-btn" onclick="closeLoginForm()">&times;</span>
    <iframe src="./pages/login.php" frameborder="0"></iframe>
  </div>

  <!-- End header -->

  <!-- Slideshow -->
  <div class="slider">
    <figure></figure>
    <figure></figure>
    <figure></figure>
    <figure></figure>
    <figure></figure>
  </div>

  <!-- End slideshow -->

  <!-- Body -->
  <div class="trangchu">
    <div class="box2">
      <ul>
        <li>
          <i class="fa-solid fa-tower-broadcast"></i>
          <a>Khám phá</a>
        </li>
        <li>
          <i class="fa-solid fa-globe"></i>
          <a>Trải nghiệm</a>
        </li>
        <li>
          <i class="fa-regular fa-paper-plane"></i>
          <a>Giữ gìn</a>
        </li>
      </ul>
    </div>

    <div>
      <div class="trendstyles">
        <div class="trendstyle">Global Heritage..</div>
        <div class="shop">
          <i class="fas fa-arrow-right"></i>
          <div class="shop-des">Hành trình qua những dấu ấn thời gian</div>
        </div>
      </div>

      <div class="box3">
        <div>
          <img src="./assets/img/trangchu/angkor.jpg" />
          <div>
            <h2>Khám phá những di sản vĩ đại</h2>
            <p>
              Bước vào hành trình khám phá những kỳ quan thế giới và di sản văn hóa nổi tiếng.
              Tìm hiểu về lịch sử, kiến trúc và những câu chuyện bí ẩn đằng sau các công trình vĩ đại của nhân loại.
            </p>
          </div>
          <button><a href="./pages/khampha.php">Khám phá ngay</a></button>
        </div>
        <div>
          <img src="./assets/img/trangchu/vanlytruongthanh.webp" />
          <div>
            <h2>Tin tức & Blog</h2>
            <p>
              Cập nhật những thông tin mới nhất về di sản thế giới, các sự kiện lịch sử quan trọng,
              phát hiện khảo cổ và những nghiên cứu chuyên sâu giúp bạn hiểu rõ hơn về quá khứ của nhân loại.
            </p>
          </div>
          <button><a href="./pages/blog-news/news/index.php">Đọc ngay</a></button>
        </div>
        <div>
          <img src="./assets/img/trangchu/machu.jpg" />
          <div>
            <h2>Cộng đồng đam mê lịch sử</h2>
            <p>
              Tham gia vào cộng đồng những người yêu thích lịch sử và văn hóa trên toàn thế giới.
              Kết nối, chia sẻ kiến thức, kinh nghiệm du lịch và cùng nhau khám phá giá trị di sản nhân loại.
            </p>
          </div>
          <button><a href="./pages/congdong.php">Tham gia ngay</a></button>
        </div>
        <div>
          <img src="./assets/img/trangchu/giza.jpg" />
          <div>
            <h2>Hỏi đáp về di sản thế giới</h2>
            <p>
              Bạn có thắc mắc về một di tích lịch sử hoặc cần tìm hiểu sâu hơn về một nền văn minh?
              Hãy đặt câu hỏi và nhận câu trả lời từ các chuyên gia, nhà nghiên cứu và cộng đồng yêu thích lịch sử.
            </p>
          </div>
          <button><a href="./pages/baidangketnoiq&a.php">Hỏi ngay</a></button>
        </div>
      </div>
    </div>

    <p style="margin-left: 70px; font-size: 30px;"><i class="fas fa-arrow-right"></i> New Articles</p>

    <div class="box4">
      <div class="box4_trai">
        <img src="./assets/img/trangchu/hoian.jpg" />
      </div>
      <div class="box4_phai">
        <div>
          <h2>Phố cổ Hội An</h2>
          <p>
            Phố cổ Hội An là một trong những di sản văn hóa thế giới được
            UNESCO công nhận, nổi bật với kiến trúc cổ kính, đèn lồng rực rỡ
            và nền văn hóa giao thoa độc đáo. Nơi đây từng là thương cảng sầm
            uất từ thế kỷ 15-19, mang đậm dấu ấn lịch sử và nét đẹp truyền
            thống của Việt Nam.
          </p>
        </div>
        <button><a href="./pages/blog-news/news/index.php">Tìm hiểu thêm</a></button>
      </div>
    </div>

    <div class="box5">
      <div class="box5_trai">
        <img src="./assets/img/trangchu/halong.jpg" />
      </div>
      <div class="box5_phai">
        <div>
          <h2>Vịnh Hạ Long - Kỳ quan thiên nhiên thế giới</h2>
          <p>
            Vịnh Hạ Long, một trong bảy kỳ quan thiên nhiên thế giới, nổi
            tiếng với hàng nghìn hòn đảo đá vôi hùng vĩ. Với hệ sinh thái
            phong phú và cảnh quan ngoạn mục, nơi đây là điểm đến lý tưởng cho
            những ai yêu thích khám phá thiên nhiên và tìm hiểu lịch sử văn
            hóa vùng vịnh Bắc Bộ.
          </p>
        </div>
        <button><a href="./pages/blog-news/blog/index.php">Tìm hiểu thêm</a></button>
      </div>
    </div>
  </div>
  <!-- End body -->

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
  <!-- End footer  -->

  <script>
    function openLoginForm() {
      document.getElementById("overlay").style.display = "block";
      document.getElementById("loginModal").style.display = "block";
    }

    function closeLoginForm() {
      document.getElementById("overlay").style.display = "none";
      document.getElementById("loginModal").style.display = "none";
    }

    // Tự động đóng modal sau khi đăng nhập thành công
    window.addEventListener("message", function(event) {
      if (event.data === "closeModal") {
        closeLoginForm();
      }
    });
  </script>
</body>

</html>