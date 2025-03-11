<?php
// Kết nối MySQL
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
    <link rel="stylesheet" href="stories.css">
</head>
<body>

<section id="stories">
    <h1>Câu chuyện & Dự án cộng đồng</h1>
    <p>Nơi người dùng chia sẻ câu chuyện, hình ảnh, video về các di sản, đồng thời cập nhật các dự án bảo tồn và kêu gọi đóng góp.</p>
    <p>
    Bằng cách công nhận Giá trị Toàn cầu Nổi bật của một địa điểm, các Quốc gia Bên cam kết bảo tồn địa điểm đó và nỗ lực tìm giải pháp bảo vệ địa điểm đó. 
    Nếu một địa điểm được ghi vào Danh sách Di sản Thế giới đang bị đe dọa, Ủy ban Di sản Thế giới có thể 
    <a href="#solution">hành động ngay lập tức</a> để giải quyết tình hình và điều này đã dẫn đến nhiều 
    <a href="#restoration">đợt phục hồi thành công</a>. 
    Công ước Di sản Thế giới cũng là một công cụ rất mạnh mẽ để tập hợp sự chú ý và hành động của quốc tế, thông qua 
    <a href="#campaigns">các chiến dịch bảo vệ quốc tế</a>.
</p>
    <p>Thông thường, Ủy ban Di sản Thế giới và các quốc gia thành viên, với sự hỗ trợ của các chuyên gia UNESCO và các đối tác khác, sẽ tìm ra giải pháp trước khi tình hình trở nên xấu đi đến mức có thể gây thiệt hại cho địa điểm.</p>
</section>

<!-- Băng chuyền tìm kiếm giải pháp -->
<h1 id="solution">Tìm kiếm giải pháp</h1>
<div class="carousel-container">
    <button class="carousel-btn prev">&#10094;</button>
    <div class="carousel">
    <?php
if ($result->num_rows > 0) {
    while ($article = $result->fetch_assoc()) {
        $image = !empty($article["image_url"]) ? 'image_url/' . $article["image_url"] : 'image_url/default.jpg'; // Dùng ảnh mặc định nếu không có ảnh
        $title = htmlspecialchars($article["title"], ENT_QUOTES, 'UTF-8');
        $description = isset($article["description"]) ? mb_substr($article["description"], 0, 100, 'UTF-8') : "Không có mô tả.";
        echo '<div class="card">';
        echo '<img src="' . $image . '" alt="' . $title . '">';
        echo '<div class="card-content">';
        echo '<h3><a href="tintuc/heritage.php?id=' . $article["id"] . '">' . $title . '</a></h3>';
        echo '<p>' . $description . '...</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "<p>Không có bài viết nào.</p>";
}
?>
    </div>
    <button class="carousel-btn next">&#10095;</button>
</div>


<h1 id="restoration">Phục hồi thành công</h1>

<!-- Phần phục hồi -->
<?php 
$index = 0; // Đếm số thứ tự câu chuyện phục hồi
if ($result_projects->num_rows > 0) {
    while ($row = $result_projects->fetch_assoc()) {
        // Kiểm tra nếu có ảnh, nếu không thì dùng ảnh mặc định
        $image = !empty($row["image_path"]) ? 'image_path/' . $row["image_path"] : 'image_path/default.jpg';
        // Bảo vệ dữ liệu đầu ra
        $project_name = htmlspecialchars($row["project_name"], ENT_QUOTES, 'UTF-8');
        $details = isset($row["details"]) ? htmlspecialchars($row["details"], ENT_QUOTES, 'UTF-8') : "Không có mô tả.";

        // Xác định class để đổi vị trí ảnh trái/phải
        $class = ($index % 2 == 0) ? "image-right" : "image-left";
        ?>
        <div class="content <?php echo $class; ?>">
            <div class="text">
                <h2><?php echo $project_name; ?></h2>
                <p><?php echo $details; ?></p>
            </div>
            <div class="image">
                <img src="<?php echo $image; ?>" alt="<?php echo $project_name; ?>">
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

<h1 id="campaigns">Các chiến dịch bảo vệ quốc tế</h1>

<!-- Hiển thị câu chuyện thành công từ bảng success_stories -->
<div class="story-container">
    <?php 
    $index = 0;
    while ($row = $result_success->fetch_assoc()):
    ?>
        <div class="story">
            <img src="./image_success/<?php echo $row['image_success']; ?>" alt="<?php echo $row['title']; ?>">
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
