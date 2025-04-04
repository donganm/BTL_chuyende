<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Heritage - Cộng đồng</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgb(70, 135, 155);
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav .logo a {
            color: #fff;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin: 0 15px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-size: 18px;
            padding: 10px 15px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .nav-links a:hover {
            background-color: rgb(59, 105, 103);
            border-radius: 5px;
        }

        .nav-links a.active {
            background-color: #ff9800;
            border-radius: 5px;
        }

        .banner {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            transition: background-image 1s ease-in-out;
        }

        .overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
        }

        .overlay h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .overlay button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-weight: bold;
        }
        /* Footer  */
        footer {
      background-color: #f8f8f8;
      padding: 20px 0;
      font-family: Arial, sans-serif;
      border-top: 1px solid #ddd;
      width: 100%;
    }

    .footer-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      
      margin: 0 auto;
      padding: 0 20px;
      flex-wrap: wrap;
    }

    .footer-section {
      flex: 1;
      min-width: 200px;
      margin: 10px 0;
    }

    .footer-section h5 {
      margin-bottom: 10px;
      font-size: 16px;
      color: #333;
    }

    .footer-section p {
      margin: 5px 0;
    }

    .footer-section a {
      text-decoration: none;
      color: #555;
      font-size: 14px;
    }

    .footer-section a:hover {
      color: #007bff;
    }

    .footer-center {
      text-align: center;
    }

    .footer-center img {
      width: 24px;
      vertical-align: middle;
      margin-right: 5px;
    }

    .footer-right {
      text-align: right;
      font-size: 14px;
      color: #555;
    }

    @media (max-width: 768px) {
      .footer-container {
        flex-direction: column;
        text-align: center;
      }

      .footer-right {
        text-align: center;
      }}
        /* End Footer */

    </style>
</head>
<body>
    <?php include 'congdong/nav.php'; ?>
    
    <div class="banner" id="banner">
        <div class="overlay">
            <h2>UNESCO recalls obligation to respect and protect the integrity of heritage sites</h2>
            <button><a href="./about.php" style="text-decoration: none; color:white">About World Heritage</a></button>
        </div>
    </div>

    <!-- Footer  -->
  <hr/>
  <footer>
    <div class="footer-container">
      <!-- Phần 1: Get Help -->
      <div class="footer-section">
        <h5>Get Help</h5>
        <p><a href="./feedback.php">Feedback</a></p>
        <p><a href="./contact.php">Contact Us</a></p>
      </div>

      <!-- Phần 2: VIE VN -->
      <div class="footer-section footer-center">
        <div>
          <img src="../pages/congdong/image_path/VN_Flag.webp" alt="Vietnam Flag" />
          <span>VIE VN</span>
        </div>
        <p>© 2025 G.H</p>
      </div>

      <!-- Phần 3: Copyright -->
      <div class="footer-section footer-right">
        <p>© 2025 G.H. ALL RIGHTS RESERVED</p>
      </div>
    </div>
  </footer>
  <!-- End footer  -->

    <script>
        const images = [
            "./congdong/image_url/vanlitt.jpg",
            "./congdong/image_url/mosta.jpg",
            "./congdong/image_url/colosseo.jpg",
            "./congdong/image_url/machupichu.jpg"
        ];
        
        let currentIndex = 0;
        const banner = document.getElementById("banner");

        function changeBackground() {
            banner.style.backgroundImage = `url('${images[currentIndex]}')`;
            currentIndex = (currentIndex + 1) % images.length;
        }

        changeBackground();
        setInterval(changeBackground, 5000);
    </script>
</body>
</html>

