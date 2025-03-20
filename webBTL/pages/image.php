<?php

session_start();

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
            background-color: #a5b1c2;
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
            max-width: 1400px;
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
            font-size: 2rem;
            text-align: center;
            margin-top: 60px;
        }
    </style>
</head>

<body>
    <a href="javascript:history.back()" class="back">
        ← Quay lại
    </a>

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
            <div class="gallery-item">
                <img src="../assets/img/3.jpg" alt="Di sản 1">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/4.jpg" alt="Di sản 2">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/5.jpg" alt="Di sản 3">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/6.jpg" alt="Di sản 4">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/7.jpg" alt="Di sản 5">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/8.jpg" alt="Di sản 6">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/3.jpg" alt="Di sản 7">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/7.jpg" alt="Di sản 8">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/3.jpg" alt="Di sản 1">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/trangimage/nuthantudo.jpg" alt="Di sản 2">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/5.jpg" alt="Di sản 3">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/trangimage/thapeiffel.jpg" alt="Di sản 4">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/trangimage/tajmahal.jpg" alt="Di sản 5">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/8.jpg" alt="Di sản 6">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/trangimage/anglorwat.jpg" alt="Di sản 7">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/trangimage/vanlytruongthanh.jpg" alt="Di sản 8">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/6.jpg" alt="Di sản 4">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/7.jpg" alt="Di sản 5">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/trangimage/hue.jpg" alt="Di sản 6">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/trangimage/dautruongcolosseum.jpg" alt="Di sản 7">
            </div>
            <div class="gallery-item">
                <img src="../assets/img/trangimage/kyoto.jpg" alt="Di sản 8">
            </div>
        </div>
    </main>


</body>

</html>