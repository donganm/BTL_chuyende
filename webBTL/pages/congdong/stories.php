<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trung tâm Di sản Thế giới - Những câu chuyện thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;
        }

        h1, p {
            text-align: center;
            max-width: 800px;
        }

        .carousel-container {
            position: relative;
            width: 900px; /* Hiển thị 3 card */
            overflow: hidden;
        }

        .carousel {
            display: flex;
            gap: 20px;
            transition: transform 0.5s ease-in-out;
        }

        .card {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 280px;
            text-align: center;
            flex-shrink: 0;
        }

        .card img {
            width: 100%;
            border-radius: 5px;
        }

        .card-content {
            padding: 10px 0;
        }

        .card h3 {
            color: #007bff;
            margin-bottom: 10px;
        }

        /* Nút điều hướng */
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 50%;
            font-size: 18px;
            z-index: 10;
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }
    </style>
</head>
<body>

<section id="stories">
    <h1>Câu chuyện & Dự án cộng đồng</h1>
    <p>Nơi người dùng chia sẻ câu chuyện, hình ảnh, video về các di sản, đồng thời cập nhật các dự án bảo tồn và kêu gọi đóng góp.</p>
    <p>Công ước Di sản Thế giới không chỉ là "văn bản trên giấy tờ" mà trên hết là công cụ hữu ích cho hành động cụ thể nhằm bảo tồn các di sản bị đe dọa và các loài có nguy cơ tuyệt chủng.</p>
    <p>Bằng cách công nhận Giá trị Toàn cầu Nổi bật của một địa điểm, các Quốc gia Bên cam kết bảo tồn địa điểm đó và nỗ lực tìm giải pháp bảo vệ địa điểm đó. Nếu một địa điểm được ghi vào Danh sách Di sản Thế giới đang bị đe dọa, Ủy ban Di sản Thế giới có <a href="">thể hành động ngay lập tức</a> để giải quyết tình hình và điều này đã dẫn đến nhiều đợt <a href="">phục hồi thành công</a> . Công ước Di sản Thế giới cũng là một công cụ rất mạnh mẽ để tập hợp sự chú ý và hành động của quốc tế, thông qua các <a href="">chiến dịch bảo vệ quốc tế</a> .</p>
</section>

<!-- Băng chuyền -->
<div class="carousel-container">
    <button class="carousel-btn prev">&#10094;</button>
    <div class="carousel">
        <div class="card">
            <img src="/webBTL/assets/img/caumosta.jpg" alt="Mosta">
            <div class="card-content">
                <h3>Tạo sự hòa giải: Cầu Mostar</h3>
                <p>Trong cuộc xung đột ở Nam Tư cũ, cầu Mostar đã bị phá hủy hoàn toàn. Việc tái sinh cây cầu là một bước tiến quan trọng.</p>
            </div>
        </div>
        
        <div class="card">
            <img src="https://via.placeholder.com/280x150" alt="Tongariro">
            <div class="card-content">
                <h3>Cùng nhau phát triển: Tongariro</h3>
                <p>Công viên quốc gia Tongariro ở New Zealand đã đạt được đến cân bằng giữa bảo tồn thiên nhiên và văn hóa.</p>
            </div>
        </div>

        <div class="card">
            <img src="https://via.placeholder.com/280x150" alt="Machu Picchu">
            <div class="card-content">
                <h3>Bảo tồn Machu Picchu</h3>
                <p>Các nhà nghiên cứu và cộng đồng địa phương đã nỗ lực bảo tồn Machu Picchu trước nguy cơ xuống cấp.</p>
            </div>
        </div>

        <div class="card">
            <img src="https://via.placeholder.com/280x150" alt="Great Wall">
            <div class="card-content">
                <h3>Bảo vệ Vạn Lý Trường Thành</h3>
                <p>Các sáng kiến bảo vệ và tái tạo Vạn Lý Trường Thành nhằm bảo tồn lịch sử và văn hóa Trung Hoa.</p>
            </div>
        </div>

        <div class="card">
            <img src="https://via.placeholder.com/280x150" alt="Colosseum">
            <div class="card-content">
                <h3>Trùng tu Đấu trường La Mã</h3>
                <p>Các chuyên gia đang làm việc để bảo tồn di tích lịch sử quan trọng này tại Ý.</p>
            </div>
        </div>
    </div>
    <button class="carousel-btn next">&#10095;</button>
</div>

<script>
    const carousel = document.querySelector('.carousel');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');

    let index = 0;
    const cardsToShow = 3;
    const totalCards = document.querySelectorAll('.card').length;
    const cardWidth = 300; // 280px + 20px gap
    const maxIndex = totalCards - cardsToShow;

    function updateCarousel() {
        carousel.style.transform = `translateX(${-index * (cardWidth + 20)}px)`;
    }

    nextBtn.addEventListener('click', () => {
        if (index < maxIndex) {
            index++;
            updateCarousel();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (index > 0) {
            index--;
            updateCarousel();
        }
    });

    // Tự động trượt sau 3 giây
    setInterval(() => {
        if (index < maxIndex) {
            index++;
        } else {
            index = 0; // Quay lại đầu
        }
        updateCarousel();
    }, 3000);
</script>

</body>
</html>

