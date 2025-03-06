<?php

session_start();

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu Di sản | Global Heritage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }

        .heritage-img {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            margin-top: 30px;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include("../includes/header.php"); ?>
    <!-- End header -->

    <div class="container">
        <div class="row">
            <!-- Hình ảnh -->
            <div class="col-md-6">
                <img src="../assets/about/thumbnail.webp" alt="Di sản Văn hóa" class="heritage-img">
            </div>
            <!-- Nội dung -->
            <div class="col-md-6">
                <h2 class="section-title">Di sản Văn hóa là gì?</h2>
                <p>Di sản văn hóa bao gồm những giá trị tinh thần, kiến trúc, lịch sử và thiên nhiên được truyền qua nhiều thế hệ. Đây có thể là các di tích, đền đài, phong tục tập quán hoặc các di sản thiên nhiên đặc biệt.</p>
                <p><b>Global Heritage</b> là nơi giúp bạn tìm hiểu và khám phá những di sản quan trọng trên thế giới.</p>
                <ul>
                    <li>Thông tin chi tiết về từng di sản.</li>
                    <li>Bản đồ và hướng dẫn du lịch.</li>
                    <li>Các bài viết chuyên sâu về lịch sử, văn hóa.</li>
                    <li>Cộng đồng giao lưu, chia sẻ kiến thức.</li>
                </ul>
            </div>
        </div>

        <!-- Lịch sử Di sản -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Lịch sử hình thành</h2>
                <p>Di sản văn hóa đã tồn tại hàng ngàn năm, bắt nguồn từ nền văn minh cổ đại như Ai Cập, Hy Lạp, Trung Quốc, và Lưỡng Hà. Những công trình kiến trúc vĩ đại như Kim tự tháp Giza, Vạn Lý Trường Thành và Đền Parthenon là minh chứng cho sự phát triển rực rỡ của nhân loại.</p>
                <p>Ngày nay, UNESCO đã công nhận hàng ngàn di sản trên thế giới nhằm bảo vệ và duy trì giá trị của chúng.</p>
            </div>
        </div>

        <!-- Các loại di sản -->
        <div class="row">
            <div class="col-md-6">
                <h2 class="section-title">Các loại Di sản</h2>
                <ul>
                    <li><b>Di sản Văn hóa:</b> Công trình kiến trúc, nghệ thuật, di tích lịch sử.</li>
                    <li><b>Di sản Thiên nhiên:</b> Kỳ quan thiên nhiên, công viên quốc gia.</li>
                    <li><b>Di sản Phi vật thể:</b> Nghệ thuật, âm nhạc, truyền thống văn hóa.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2 class="section-title">Ý nghĩa của Di sản</h2>
                <p>Di sản không chỉ là những công trình vật chất mà còn là ký ức và giá trị văn hóa của một dân tộc. Chúng giúp kết nối con người với quá khứ, bảo tồn bản sắc dân tộc và truyền cảm hứng cho thế hệ mai sau.</p>
            </div>
        </div>

        <!-- Dữ liệu động từ database -->
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Di sản Nổi bật</h2>
                <!-- <?php if ($heritage): ?>
                    <h3><?php echo $heritage['name']; ?></h3>
                    <p><b>Vị trí:</b> <?php echo $heritage['location']; ?></p>
                    <p><b>Mô tả:</b> <?php echo $heritage['description']; ?></p>
                <?php else: ?>
                    <p>Chưa có dữ liệu di sản trong hệ thống.</p>
                <?php endif; ?> -->
            </div>
        </div>

    </div>

    <!-- Footer  -->
    <?php include("../includes/footer.php"); ?>
    <!-- End Footer -->

</body>

</html>