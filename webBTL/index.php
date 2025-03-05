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
  <link rel="stylesheet" href="./assets/css/trangchu.css" />
</head>

<body>

  <!-- Header -->
  <div class="header">Welcome to Global Heritage...</div>

  <!-- Navigation Menu -->
  <div class="menu">
    <div class="box1"><a href="index.php">G.H</a></div>
    <div class="box2">
      <ul>
        <li><a href="./pages/gh.php">Global Heritage</a></li>
        <li><a href="./pages/about.php">About Us</a></li>
        <li><a href="./pages/contact.php">Contact Us</a></li>
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
          <a href="./pages/login.php" style="text-decoration: none; color: #444">Đăng nhập</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <!-- End header -->

  <!-- Body -->
  <div class="trangchu">
    <!-- Slideshow -->
    <div class="slideshow-container">
      <img class="slides fade" src="./assets/img/trang chủ/1.jpg" alt="Slide 1" />
      <img class="slides fade" src="./assets/img/trang chủ/2.png" alt="Slide 2" />
      <img class="slides fade" src="./assets/img/trang chủ/3.jpg" alt="Slide 3" />
    </div>
    <div class="controls">
      <i class="fa-solid fa-chevron-left" onclick="changeSlide(-1)"></i>
      <i
        class="fa-solid fa-circle-pause"
        id="pausePlay"
        onclick="toggleSlideshow()"></i>
      <i class="fa-solid fa-chevron-right" onclick="changeSlide(1)"></i>
    </div>
    <div class="dots">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    <!-- End slideshow -->

    <div class="box2">
      <ul>
        <li>
          <i class="fa-solid fa-tower-broadcast"></i>
          <a>Khám phá</a>
        </li>
        <li>
          <i class="fa-solid fa-globe"></i>
          <a> Trải nghiệm</a>
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
          <img src="./assets/img/trang chủ/angkor.jpg" />
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
          <img src="./assets/img/trang chủ/vanlytruongthanh.webp" />
          <div>
            <h2>Tin tức & Blog</h2>
            <p>
              Cập nhật những thông tin mới nhất về di sản thế giới, các sự kiện lịch sử quan trọng,
              phát hiện khảo cổ và những nghiên cứu chuyên sâu giúp bạn hiểu rõ hơn về quá khứ của nhân loại.
            </p>
          </div>
          <button><a href="./pages/tintuc.php">Đọc ngay</a></button>
        </div>
        <div>
          <img src="./assets/img/trang chủ/machu.jpg" />
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
          <img src="./assets/img/trang chủ/giza.jpg" />
          <div>
            <h2>Hỏi đáp về di sản thế giới</h2>
            <p>
              Bạn có thắc mắc về một di tích lịch sử hoặc cần tìm hiểu sâu hơn về một nền văn minh?
              Hãy đặt câu hỏi và nhận câu trả lời từ các chuyên gia, nhà nghiên cứu và cộng đồng yêu thích lịch sử.
            </p>
          </div>
          <button><a href="./pages/qa.php">Hỏi ngay</a></button>
        </div>
      </div>
    </div>


    <div class="box4">
      <div class="box4_trai">
        <img src="./assets/img/trang chủ/hoian.jpg" />
      </div>
      <div class="box4_phai">
        <div>
          <h2>Khám phá Phố cổ Hội An</h2>
          <p>
            Phố cổ Hội An là một trong những di sản văn hóa thế giới được
            UNESCO công nhận, nổi bật với kiến trúc cổ kính, đèn lồng rực rỡ
            và nền văn hóa giao thoa độc đáo. Nơi đây từng là thương cảng sầm
            uất từ thế kỷ 15-19, mang đậm dấu ấn lịch sử và nét đẹp truyền
            thống của Việt Nam.
          </p>
        </div>
        <button>Tìm hiểu thêm</button>
      </div>
    </div>

    <div class="box5">
      <div class="box5_trai">
        <img src="./assets/img/trang chủ/halong.jpg" />
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
        <button>Tìm hiểu thêm</button>
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
    let slideIndex = 0;
    let autoPlay = true;
    let slideInterval;

    function showSlides() {
      let slides = document.getElementsByClassName("slides");
      let dots = document.getElementsByClassName("dot");
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {
        slideIndex = 1;
      }
      for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].classList.add("active");
      if (autoPlay) {
        slideInterval = setTimeout(showSlides, 3000);
      }
    }

    function changeSlide(n) {
      slideIndex += n - 1;
      clearTimeout(slideInterval);
      showSlides();
    }

    function currentSlide(n) {
      slideIndex = n - 1;
      clearTimeout(slideInterval);
      showSlides();
    }

    function toggleSlideshow() {
      autoPlay = !autoPlay;
      let icon = document.getElementById("pausePlay");
      icon.classList.toggle("fa-circle-play", !autoPlay);
      icon.classList.toggle("fa-circle-pause", autoPlay);
      if (autoPlay) showSlides();
    }
    showSlides();
  </script>
</body>

</html>