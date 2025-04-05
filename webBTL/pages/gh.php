<?php

session_start();

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Di sản Thế giới</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #ecf0f1;
        }

        .container {
            width: 65%;
            margin: 50px auto;
            padding: 30px;
            margin-top: 100px;
            color: white;
            line-height: 1.5;
            background: white;
            border-radius: 15px;
            /* box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.2); */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        h3 {
            color: #ffbb08;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .section {
            margin-bottom: 40px;
            padding: 50px;
            /* background: rgba(0, 0, 0, 0.5); */
            background: #333;
            border-radius: 10px;
            text-align: justify;
        }

        .image-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin: 30px 0;
        }

        .image-box {
            width: 350px;
            height: 270px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 10px 30px rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .image-box:hover {
            transform: scale(1.05);
            box-shadow: 0px 15px 35px rgba(255, 255, 255, 0.5);
        }

        .image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .quote {
            text-align: center;
            font-style: italic;
            font-size: 1.2em;
            margin: 20px 0;
            color: #333;
        }

        p {
            /* margin-left: 30px; */
            font-size: 17px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include("../includes/header.php"); ?>
    <!-- End header -->
    <div class="container">
        <h1>Di sản Thế giới</h1>
        <div class="image-container">
            <div class="image-box" , style="width: 300px">
                <img src="../assets/img/gh/World_Heritage_Logo_global.svg.png" alt="Di sản Thế giới">
            </div>
        </div>
        <p class="quote">"Di sản thế giới là những kho báu vô giá của nhân loại, nơi lưu giữ những dấu ấn của thời gian."</p>

        <div class="section">
            <h2>Lịch sử</h2>
            <p>Năm 1954, Ai Cập quyết định xây dựng đập Aswan, đe dọa nhấn chìm nhiều di tích cổ đại. UNESCO đã phát động chiến dịch bảo tồn, di dời các công trình như Abu Simbel và Philae. Dự án tiêu tốn 80 triệu USD, với sự đóng góp từ 50 quốc gia, và tạo tiền đề cho các chiến dịch bảo tồn khác trên thế giới.</p>
            <p>Mỹ là nước đầu tiên đề xuất bảo tồn văn hóa và thiên nhiên. Sau nhiều hội nghị quốc tế, vào năm 1972, UNESCO thông qua Công ước Bảo vệ Di sản Văn hóa và Thiên nhiên Thế giới, yêu cầu các nước ký kết báo cáo định kỳ về tình trạng di sản.</p>
            <div class="image-container">
                <div class="image-box">
                    <img src="../assets/img/gh/UNESCO_World_Heritage_flag.jpg" alt="Đền thờ ở Ai Cập">
                </div>
            </div>
        </div>

        <div class="section">
            <h2>Định nghĩa</h2>
            <h3>Di sản văn hóa</h3>
            <p>Các di tích: Các tác phẩm kiến trúc, tác phẩm điêu khắc và hội họa, các yếu tố hay các cấu trúc có tính chất khảo cổ học, ký tự, nhà ở trong hang đá và các công trình sự kết hợp giữa công trình xây dựng tách biệt hay liên kết lại với nhau mà do kiến trúc của chúng, do tính đồng nhất hoặc vị trí trong cảnh quan, có giá trị nổi bật toàn cầu xét theo quan điểm lịch sử, nghệ thuật và khoa học.</p>
            <p>Các di chỉ: Các tác phẩm do con người tạo nên hoặc các tác phẩm có sự kết hợp giữa thiên nhiên và nhân tạo và các khu vực trong đó có các di chỉ khảo cổ có giá trị nổi bật toàn cầu xét theo quan điểm lịch sử, thẩm mỹ, dân tộc học hoặc nhân học.</p>
            <div class="image-container">
                <div class="image-box">
                    <img src="../assets/img/gh/disanvanhoa.JPG" alt="Di tích cổ">
                </div>
            </div>

            <h3>Di sản thiên nhiên</h3>
            <p>Các đặc điểm tự nhiên bao gồm các hoạt động sáng tạo vật lý hoặc sinh học hoặc các nhóm các hoạt động kiến tạo có giá trị nổi bật toàn cầu xét theo quan điểm thẩm mỹ hoặc khoa học.</p>
            <p>Các hoạt động kiến tạo địa chất hoặc địa lý tự nhiên và các khu vực có ranh giới được xác định chính xác tạo thành một môi trường sống của các loài động thực vật đang bị đe dọa có giá trị nổi bật toàn cầu xét theo quan điểm khoa học hoặc bảo tồn.</p>
            <p>Các địa điểm tự nhiên hoặc các vùng tự nhiên được phân định rõ ràng, có giá trị nổi bật toàn cầu về mặt khoa học, bảo tồn hoặc thẩm mỹ.</p>
            <div class="image-container">
                <div class="image-box">
                    <img src="../assets/img/gh/disanthiennhien.jpg" alt="Cảnh quan thiên nhiên">
                </div>
            </div>

            <h3>Di sản hỗn hợp</h3>
            <p>Năm 1992, Ủy ban Di sản thế giới đưa ra khái niệm di sản hỗn hợp hay còn gọi là di sản kép, cảnh quan văn hóa thế giới để miêu tả các mối quan hệ tương hỗ nổi bật giữa văn hóa và thiên nhiên của một số khu di sản. Một địa danh được công nhận là di sản thế giới hỗn hợp phải thỏa mãn ít nhất là một tiêu chí về di sản văn hóa và một tiêu chí về di sản thiên nhiên.</p>
            <div class="image-container">
                <div class="image-box">
                    <img src="../assets/img/gh/disanhonhop.jpg" alt="Di sản hỗn hợp">
                </div>
            </div>
        </div>
    </div>

</body>

</html>