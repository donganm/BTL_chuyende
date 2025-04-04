<?php
session_start();
include('../includes/db.php');

// Truy vấn lấy danh sách ảnh
$sql = "SELECT image_path, description FROM images";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư viện ảnh - Pinterest Style</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        } */

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #ecf0f1;
        }

        .back {
            position: absolute;
            top: 30px;
            left: 30px;
            text-decoration: none;
            /* font-weight: bold; */
            font-size: 20px;
            color: #333;
        }

        .back:hover {
            text-decoration: underline;
        }

        .carousel-content {
            margin-top: 50px;
        }

        .carousel {
            overflow: hidden;
            width: 700px;
            background-color: #1e272e;
            padding: 30px 0;
            /* margin-top: 60px; */
            border-radius: 5px;
            box-shadow: 20px 35px 35px rgba(0, 0, 0, 0.5);

        }

        .image-container {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: 250px;
            justify-items: stretch;
            animation: animation 12s linear infinite;
        }

        .image-container img {
            width: 200px;
            height: 270px;
            border-radius: 12px;
            object-fit: cover;
            border: 1px solid #a5b1c2;
        }

        @keyframes animation {
            to {
                translate: calc(-4*250px);
            }
        }

        .gallery-container {
            column-count: 4;
            column-gap: 40px;
            /* padding: 20px; */
            max-width: 1200px;
            margin: auto;
        }

        .gallery-item {
            display: inline-block;
            width: 100%;
            margin-bottom: 15px;
            break-inside: avoid;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        @media (max-width: 1024px) {
            .gallery-container {
                column-count: 3;
            }
        }

        @media (max-width: 768px) {
            .gallery-container {
                column-count: 2;
            }
        }

        @media (max-width: 480px) {
            .gallery-container {
                column-count: 1;
            }
        }

        h2 {
            /* color: #f5f6fa; */
            font-size: 40px;
            text-align: center;
            margin-top: 60px;
            color: #2c3e50;
        }

        /* SLide  */
        .slider {
            width: 70vw;
            height: 500px;
            position: relative;
            overflow: hidden;
            margin-top: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slider figure {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-size: cover;
            background-position: center;
            animation: fade 20s infinite;
            opacity: 0;
            margin: 0;
            padding: 0;

        }

        /* Add image  */
        .slider figure:nth-child(1) {
            background-image: url('../assets/img/trangimage/background.png');
            animation-delay: 0s;
        }

        .slider figure:nth-child(2) {
            background-image: url('../assets/img/trangimage/background2.jpg');
            animation-delay: -4s;
        }

        .slider figure:nth-child(3) {
            background-image: url('../assets/img/trangimage/background3.jpg');
            animation-delay: -8s;
        }

        .slider figure:nth-child(4) {
            background-image: url('../assets/img/trangimage/background4.webp');
            animation-delay: -12s;
        }

        .slider figure:nth-child(5) {
            background-image: url('../assets/img/trangimage/background5.jpg');
            animation-delay: -16s;
        }

        @keyframes fade {
            0% {
                opacity: 0;
            }

            5% {
                opacity: 1;
            }

            25% {
                opacity: 1;
            }

            30% {
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        /* End slide */

        footer {
            all: unset;
            /* không ăn css body */
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- <a href="javascript:history.back()" class="back">
        ← Quay lại
    </a> -->

    <!-- Header -->
    <?php include("../includes/header.php"); ?>
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

    <div class="carousel-content">
        <h1>TRANH VẼ SƯU TẦM</h1>
    </div>
    <div class="carousel">
        <div class="image-container">
            <img src="../assets/img/trangimage/kyoto.jpg" alt="" />
            <img src="../assets/img/trangimage/nuthantudo.jpg" alt="" />
            <img src="../assets/img/trangimage/thapeiffel.jpg" alt="" />
            <img src="../assets/img/trangimage/tajmahal.jpg" alt="" />
            <img src="../assets/img/trangimage/anglorwat.jpg" alt="" />
            <img src="../assets/img/trangimage/vanlytruongthanh.jpg" alt="" />
            <img src="../assets/img/trangimage/hue.jpg" alt="" />
            <img src="../assets/img/trangimage/dautruongcolosseum.jpg" alt="" />
        </div>
    </div>

    <main>
        <h2>THƯ VIỆN ẢNH</h2>
        <div class="gallery-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="gallery-item">';
                    echo '<img src="' . $row['image_path'] . '" alt="' . htmlspecialchars($row['description']) . '">';
                    echo '</div>';
                }
            } else {
                echo "<p>Không có ảnh nào trong thư viện.</p>";
            }
            ?>
        </div>
    </main>
    <!-- Footer  -->
    <footer>
        <?php include("../includes/footer.php"); ?>
    </footer>

    <!-- End Footer -->

</body>

</html>