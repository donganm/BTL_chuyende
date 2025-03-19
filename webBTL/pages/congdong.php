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
.footer_1 {
  width: 100%;
  max-width: 1350px;
  margin-left: auto;
}

.footer_1 p a {
  color: gray;
  text-decoration: none;
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
    <?php include 'congdong/nav.php'; ?>
    
    <div class="banner" id="banner">
        <div class="overlay">
            <h2>UNESCO recalls obligation to respect and protect the integrity of heritage sites</h2>
            <button><a href="./about.php" style="text-decoration: none; color:white">About World Heritage</a></button>
        </div>
    </div>

    <!-- Footer  -->
  <hr/>
  <div class="footer_1">
    <h5>Get Help</h5>
    <p><a href="./feedback.php">Feedback</a></p>
    <p><a href="./contact.php">Contact Us</a></p>
  </div>

  <div class="footer_2">
    <div class="VN">
      <img src="./congdong/image_path/VN_Flag.webp" alt="logo" />
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
        const images = [
            "./congdong/image_url/vltt.jpg",
            "./congdong/image_url/caumosta.jpg",
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

