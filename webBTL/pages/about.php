<?php
// Bắt đầu phiên làm việc
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us</title>
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
        .container1 {
            width: 100%;
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 100px;
        }

        /* BODY  */
        .body_main {
            display: flex;
            gap: 40px;
            align-items: center;
            justify-content: space-between;
        }

        .content {
            width: 55%;
            color: #333;
        }

        .content p {
            margin-bottom: 20px;
            font-size: 17px;
            color: #444;
            text-align: justify;
            /* căn, tạo cạnh đều ở 2 bên */
        }

        /* .images {
            width: 45%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .images img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        } */

        h2 {
            font-size: 28px;
            font-weight: bold;
            color: #222;
            text-align: center;
            margin-bottom: 20px;
        }

        /* END BODY */
        .image-container {
            /* width: 45%; */
            display: flex;
            justify-content: center;
            align-items: center;
            perspective: 1000px;
            margin: 20px 0;
        }

        .image-box {
            max-width: 100%;
            height: auto;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.5s, box-shadow 0.5s;
        }

        .image-box:hover {
            transform: rotateY(30deg) rotateX(15deg) scale(1.1);
            box-shadow: 0px 20px 40px rgba(255, 255, 255, 0.5);
        }

        .image-box img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            box-shadow: 0px 10px 30px rgba(255, 255, 255, 0.3);
            transition: transform 0.5s ease;
        }

        .image-box:hover img {
            transform: translateZ(50px);
        }
    </style>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-6.6.0-web/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <?php include("../includes/header.php"); ?>
    <!-- End header -->

    <!-- Body  -->
    <div class="body">
        <div class="container1">

            <div class="body_main">
                <div class="content">
                    <h2>GLOBAL HERITAGE</h2>
                    <p>
                        Chào mừng bạn đến với Global Heritage, nơi mỗi hành trình là một cánh cửa mở ra quá khứ, và mỗi di tích kể một câu chuyện vượt thời gian. Được xây dựng với niềm đam mê bảo tồn lịch sử, Global Heritage không chỉ là một kho tư liệu số mà còn là cầu nối giữa những nhà thám hiểm, nhà nghiên cứu và những người yêu văn hóa trên toàn thế giới.</p>
                    <p></p>
                    <p>
                        Chúng tôi là một nền tảng cộng đồng, nơi tôn vinh và chia sẻ những di sản quý giá của nhân loại. Từ những tàn tích cổ xưa đến những kỳ quan kiến trúc vĩ đại, sứ mệnh của chúng tôi là tái hiện lịch sử qua những góc nhìn sâu sắc, giúp bạn khám phá nền văn minh và truyền thống đã định hình thế giới ngày nay.</p>
                    <p></p>
                    <p>
                        Tại Global Heritage, kiến thức không có ranh giới. Chúng tôi chào đón sự đóng góp từ các nhà nghiên cứu, du khách và những người đam mê lịch sử, tạo ra một không gian tương tác, nơi những câu chuyện của quá khứ tiếp tục truyền cảm hứng cho thế hệ tương lai. Thông qua các bài viết chất lượng, chuyến tham quan ảo và các cuộc thảo luận chuyên sâu, chúng tôi mong muốn mang lịch sử đến gần hơn với mọi người, giúp nó trở nên sống động và ý nghĩa hơn.</p>
                    <p></p>
                    <p>
                        Được xây dựng trên nền tảng giáo dục và khám phá, Global Heritage cam kết nâng cao nhận thức, gìn giữ và phát huy giá trị của các di sản văn hóa. Dù bạn là một nhà nghiên cứu, một người yêu thích du lịch hay đơn giản chỉ là một tâm hồn đam mê lịch sử, nền tảng của chúng tôi sẽ mang đến cho bạn một cánh cửa rộng mở để bước vào những chương sử thi kỳ diệu của nhân loại.</p>
                    <p></p>
                    <p>
                        Tại Global Heritage, chúng tôi không chỉ lưu giữ quá khứ mà còn đưa di sản ấy vươn xa vào tương lai.</p>
                </div>
                <div class="image-container">
                    <div class="image-box">
                        <img src="../assets/img/about.png" alt="Di sản hỗn hợp">
                    </div>
                </div>
                <!-- <div class="images">
                    <img src="../assets/img/about.png">
                </div> -->
            </div>
        </div>
    </div>
    <!-- End Body -->

    <!-- Footer  -->
    <?php include("../includes/footer.php"); ?>
    <!-- End Footer -->