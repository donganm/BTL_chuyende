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

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);

        }

        .modal-content {
            display: flex;
            flex-direction: column;
            background: white;
            margin: 3% auto;
            padding: 0;
            border-radius: 20px;
            width: 60%;
            max-width: 900px;
            overflow: hidden;
            margin-top: 100px;
        }

        .modal-body {
            display: flex;
        }

        .modal-image {
            flex: 1;
            padding: 20px;
        }

        .modal-image img {
            width: 100%;
            border-radius: 16px;
        }

        .modal-details {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn.save {
            background-color: #e60023;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
        }

        .actions span {
            margin-left: 15px;
            cursor: pointer;
        }

        .description {
            margin-top: 20px;
            padding: 10px;
            border-top: 1px solid #ddd;
            font-size: 14px;
        }

        .comments {
            margin-top: 20px;
        }

        .comment-input input {
            width: 90%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            margin-top: 10px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #ff6b81;
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
                    echo '<div class="gallery-item" data-image="' . $row['image_path'] . '" data-description="' . htmlspecialchars($row['description']) . '">';
                    echo '<img src="' . $row['image_path'] . '" alt="' . htmlspecialchars($row['description']) . '">';
                    echo '</div>';
                }
            } else {
                echo "<p>Không có ảnh nào trong thư viện.</p>";
            }
            ?>
        </div>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div class="modal-body">
                    <!-- Bên trái: Hình ảnh -->
                    <div class="modal-image">
                        <img id="modalImage" src="" alt="Selected Image">
                    </div>

                    <!-- Bên phải: Mô tả và bình luận -->
                    <div class="modal-details">
                        <div class="modal-header">
                            <button class="btn save">Lưu</button>
                            <div class="actions">
                                <span><i class="fas fa-heart"></i></span>
                                <span><i class="fas fa-download"></i></span>
                                <!-- <span><i class="fas fa-ellipsis-h"></i></span> -->
                                <span><i class="fa-solid fa-share"></i></span>
                            </div>
                        </div>
                        <div class="description" id="modalDescription"></div>
                        <div class="comments">
                            <h3>12 Nhận xét</h3>
                            <div class="comment-input">
                                <input type="text" placeholder="Thêm nhận xét">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer  -->
    <footer>
        <?php include("../includes/footer.php"); ?>
    </footer>

    <!-- End Footer -->
    <script>
        const modal = document.getElementById("myModal");
        const modalImage = document.getElementById("modalImage");
        const modalDescription = document.getElementById("modalDescription");
        const closeBtn = document.getElementsByClassName("close")[0];

        // Hiển thị modal khi bấm vào ảnh
        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function() {
                const imagePath = this.getAttribute('data-image');
                const imageDescription = this.getAttribute('data-description');

                modalImage.src = imagePath;
                modalDescription.innerText = imageDescription;
                modal.style.display = "block";
            });
        });

        // Đóng modal khi nhấn vào nút X
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        // Đóng modal khi nhấn ra ngoài vùng modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Tải xuống
        const downloadIcon = document.querySelector('.actions span:nth-child(2)'); // Chọn icon thứ 2 (biểu tượng download)

        downloadIcon.onclick = function() {
            const imagePath = modalImage.src;

            // Tạo một thẻ <a> ẩn để tải xuống
            const link = document.createElement('a');
            link.href = imagePath;
            link.download = imagePath.substring(imagePath.lastIndexOf('/') + 1); // Lấy tên file từ đường dẫn
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        //Chia sẻ
        const shareIcon = document.querySelector('.actions span:nth-child(3)'); // Chọn icon thứ 3 (biểu tượng chia sẻ)

        shareIcon.onclick = function() {
            const imagePath = modalImage.src;

            if (navigator.share) { // Kiểm tra nếu trình duyệt hỗ trợ API chia sẻ web
                navigator.share({
                    title: 'Chia sẻ hình ảnh',
                    text: 'Xem hình ảnh này!',
                    url: imagePath
                }).then(() => {
                    alert('Chia sẻ thành công!');
                }).catch((error) => {
                    alert('Chia sẻ thất bại: ' + error);
                });
            } else {
                // Nếu trình duyệt không hỗ trợ Web Share API, thông báo lỗi
                alert('Trình duyệt của bạn không hỗ trợ chức năng chia sẻ.');
            }
        }
    </script>

</body>

</html>