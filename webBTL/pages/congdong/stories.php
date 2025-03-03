<?php
// Kết nối MySQL


///hhhfdsfsd
$conn = new mysqli("localhost", "root", "", "global");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ bảng stories (câu chuyện)
$sql = "SELECT * FROM stories";
$result = $conn->query($sql);

// Lấy dữ liệu từ bảng restoration_projects
$sql_projects = "SELECT * FROM restoration_projects ORDER BY id DESC";
$result_projects = $conn->query($sql_projects);

// Truy vấn dữ liệu từ bảng success_stories (Câu chuyện thành công)
$sql_success = "SELECT * FROM success_stories ORDER BY id DESC";
$result_success = $conn->query($sql_success);
?>

<!DOCTYPE html>
<html lang="vi">
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
        a { text-decoration: none; }
        
        h1, p { text-align: center; max-width: 900px; }

        .carousel-container {
            position: relative;
            width: 900px; 
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

        .card h3 {
            color: #007bff;
            margin-bottom: 10px;
        }

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

        .prev { left: 10px; }
        .next { right: 10px; }
        
        .content {
            display: flex;
            align-items: center;
            max-width: 900px;
            margin: 20px auto;
            gap: 20px;
        }

        /* Mặc định ảnh bên phải */
        .image-right {
            flex-direction: row;
        }

        /* Ảnh bên trái */
        .image-left {
            flex-direction: row-reverse;
        }

        .text {
            flex: 1;
        }

        .image {
            flex-shrink: 0;
            width: 400px;
        }

        .image img {
            width: 100%;
            border-radius: 10px;
        }

        .story-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 1000px;
            margin: auto;
        }
        .story {
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 45%;
            text-align: left;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .story img {
            width: 100%;
            border-radius: 10px;
        }

        .story h3 {
            color: #007bff;
            margin: 10px 0;
        }

        .story p {
            font-size: 14px;
            color: #333;
        }

        /* Gạch chân ngăn cách giữa mỗi nhóm 2 câu chuyện */
        .divider {
            width: 100%;
            height: 2px;
            background: #ccc;
            margin: 20px 0;
        }

        /* Nếu có số lẻ câu chuyện, căn giữa cái cuối */
        .story:last-child:nth-child(odd) {
            width: 100%;
        }

    </style>
</head>
<body>

<section id="stories">
    <h1>Câu chuyện & Dự án cộng đồng</h1>
    <p>Nơi người dùng chia sẻ câu chuyện, hình ảnh, video về các di sản, đồng thời cập nhật các dự án bảo tồn và kêu gọi đóng góp.</p>
    <p>Bằng cách công nhận Giá trị Toàn cầu Nổi bật của một địa điểm, các Quốc gia Bên cam kết bảo tồn địa điểm đó và nỗ lực tìm giải pháp bảo vệ địa điểm đó. Nếu một địa điểm được ghi vào Danh sách Di sản Thế giới đang bị đe dọa, Ủy ban Di sản Thế giới có thể <a href="">hành động ngay lập tức</a> để giải quyết tình hình và điều này đã dẫn đến nhiều <a href="">đợt phục hồi thành công</a>. Công ước Di sản Thế giới cũng là một công cụ rất mạnh mẽ để tập hợp sự chú ý và hành động của quốc tế, thông qua <a href="">các chiến dịch bảo vệ quốc tế</a>.</p>
    <h1>Tìm kiếm giải pháp </h1>
    <p>Thông thường, Ủy ban Di sản Thế giới và các quốc gia thành viên, với sự hỗ trợ của các chuyên gia UNESCO và các đối tác khác, sẽ tìm ra giải pháp trước khi tình hình trở nên xấu đi đến mức có thể gây thiệt hại cho địa điểm.</p>
</section>

<!-- Băng chuyền tìm kiếm giải pháp -->
<div class="carousel-container">
    <button class="carousel-btn prev">&#10094;</button>
    <div class="carousel">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
            <img src="/BTL_chuyende/webBTL/pages/congdong/image_url/<?php echo $row['image_url']; ?>" alt="<?php echo $row['title']; ?>">
                <div class="card-content">
                    <h3><?php echo $row['title']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <a href="<?php echo $row['link']; ?>" target="_blank">Xem chi tiết</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <button class="carousel-btn next">&#10095;</button>
</div>

<h1>Phục hồi thành công</h1>

<!-- Phần phục hồi -->
<?php 
$index = 0; // Đếm số thứ tự câu chuyện phục hồi

if ($result_projects->num_rows > 0) {
    while ($row = $result_projects->fetch_assoc()) {
        // Xác định class để đổi vị trí ảnh trái/phải
        $class = ($index % 2 == 0) ? "image-right" : "image-left";
        ?>
        <div class="content <?php echo $class; ?>">
            <div class="text">
                <h2><?php echo $row["project_name"]; ?></h2>
                <p><?php echo $row["details"]; ?></p>
            </div>
            <div class="image">
                <img src="<?php echo $row["image_url"]; ?>" alt="<?php echo $row["project_name"]; ?>">
            </div>
        </div>
        <!-- Thêm gạch ngang giữa các câu chuyện -->
        <?php if ($index < $result_projects->num_rows - 1): ?>
            <hr style="width: 80%; border: 1px solid #ccc; margin: 20px auto;">
        <?php endif; ?>
        <?php
        $index++; // Tăng số thứ tự
    }
} else {
    echo "<p>Chưa có dự án phục hồi nào.</p>";
}
?>

<h1>Câu chuyện thành công</h1>

<!-- Hiển thị câu chuyện thành công từ bảng success_stories -->
<div class="story-container">
    <?php 
    $index = 0;
    while ($row = $result_success->fetch_assoc()):
    ?>
        <div class="story">
            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['title']; ?>">
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['description']; ?></p>
        </div>

        <?php 
        $index++;
        if ($index % 2 == 0 && $index < $result_success->num_rows) {
            echo '<div class="divider"></div>';
        }
        ?>
    <?php endwhile; ?>
</div>
<h1>Làm việc cùng nhau</h1>
<p>Trong thế giới ngày càng toàn cầu hóa của chúng ta, cộng đồng địa phương đang đóng vai trò ngày càng quan trọng trong việc bảo tồn di sản.</p>
<p>Cùng với nhiều lợi ích có được từ việc ghi danh vào Danh sách Di sản Thế giới, có những thách thức đặc biệt đối với những người sống gần, làm việc tại hoặc đến thăm các địa điểm Di sản Thế giới. Việc tăng lượng khách đến thăm một địa điểm, một trong những lợi ích mong muốn của địa điểm Di sản Thế giới, cũng có thể đòi hỏi sự tham gia ở mọi cấp độ để quản lý chặt chẽ sự tăng trưởng này. Các bên liên quan có cả lợi ích và trách nhiệm và tiếng nói của họ là rất quan trọng.</p>
<script>
    const carousel = document.querySelector('.carousel');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');

    let index = 0;
    const cardWidth = 300; // 280px + 20px gap
    const totalCards = document.querySelectorAll('.card').length;
    const maxIndex = totalCards - 3; // Hiển thị 3 card

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

    setInterval(() => {
        if (index < maxIndex) {
            index++;
        } else {
            index = 0;
        }
        updateCarousel();
    }, 3000);
</script>

</body>
</html>

<?php $conn->close(); ?>
