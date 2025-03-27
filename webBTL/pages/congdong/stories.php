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
<nav class="navbar">
    <button class="back-btn">
        <a href="../congdong.php">⬅ Quay lại Cộng Đồng</a>
    </button>
    <ul class="nav-links">
        <li><a href="./stories.php" class="<?= $current_page == 'stories.php' ? 'active' : '' ?>">Câu chuyện & Dự án</a></li>
        <li><a href="./events.php" class="<?= $current_page == 'events.php' ? 'active' : '' ?>">Sự kiện & Hoạt động</a></li>
        <li><a href="./network.php" class="<?= $current_page == 'network.php' ? 'active' : '' ?>">Mạng lưới kết nối</a></li>
        
    </ul>
</nav>

<style>
.navbar {
    display: flex;
    justify-content: space-between; /* Giữ căn chỉnh giữa các phần tử */
    align-items: center;
    background-color: #0078D4;
    padding: 15px 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    position: sticky;
    top: 0;
    z-index: 1000;
}
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0;
    padding: 0;
}

.back-btn {
    background-color: white;
    border: none;
    padding: 10px 10px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    margin-left: 15px;
}

.back-btn a {
    color: #0078D4;
    text-decoration: none;
    font-weight: bold;
}

.back-btn:hover {
    background-color: #e0e0e0;
}

.nav-links {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex; /* Sử dụng Flexbox để các liên kết nằm ngang */
    justify-content: center; /* Căn giữa các liên kết */
}

.nav-links li a {
    color: white;
    font-size: 20px;
    font-weight: bold;
    margin: 0 20px;
    padding: 10px 15px;
}

.nav-links a:hover,
.nav-links a.active {
    background: white;
    color: #007bff;
    border-radius: 5px;
}

/* Định dạng icon */
.nav-links i {
    margin-right: 10px; /* Tạo khoảng cách giữa icon và chữ */
}

footer {
      background-color: #f8f8f8;
      padding: 20px 0;
      font-family: Arial, sans-serif;
      border-top: 1px solid #ddd;
      width: 100%;
    }

    .footer-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      
      margin: 0 auto;
      padding: 0 20px;
      flex-wrap: wrap;
    }

    .footer-section {
      flex: 1;
      min-width: 200px;
      margin: 10px 0;
    }

    .footer-section h5 {
      margin-bottom: 10px;
      font-size: 16px;
      color: #333;
    }

    .footer-section p {
      margin: 5px 0;
    }

    .footer-section a {
      text-decoration: none;
      color: #555;
      font-size: 14px;
    }

    .footer-section a:hover {
      color: #007bff;
    }

    .footer-center {
      text-align: center;
    }

    .footer-center img {
      width: 24px;
      vertical-align: middle;
      margin-right: 5px;
    }

    .footer-right {
      text-align: right;
      font-size: 14px;
      color: #555;
    }

    @media (max-width: 768px) {
      .footer-container {
        flex-direction: column;
        text-align: center;
      }

      .footer-right {
        text-align: center;
      }}
</style>

   
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

<h1 id="solution">Tìm kiếm giải pháp</h1>
<div class="carousel-container">
    <button class="carousel-btn prev">&#10094;</button>
    <div class="carousel">
    <?php
if ($result->num_rows > 0) {
    while ($article = $result->fetch_assoc()) {
        $image = !empty($article["image_url"]) ? 'image_url/' . $article["image_url"] : 'image_url/default.jpg';
        $title = htmlspecialchars($article["title"], ENT_QUOTES, 'UTF-8');
        $description = isset($article["description"]) ? mb_substr($article["description"], 0, 100, 'UTF-8') : "Không có mô tả.";
        echo '<div class="card">';
        echo '<a href="stories_detail.php?id=' . $article["id"] . '&type=stories"><img src="' . $image . '" alt="' . $title . '"></a>';
        echo '<div class="card-content">';
        echo '<h3><a href="stories_detail.php?id=' . $article["id"] . '&type=stories">' . $title . '</a></h3>';
        echo '<p>' . $description . '...</p>';
        echo '</div>';
        echo '</div>';
    }
}
?>
    </div>
    <button class="carousel-btn next">&#10095;</button>
</div>

<h1 id="restoration">Phục hồi thành công</h1>
<?php 
$index = 0; 
if ($result_projects->num_rows > 0) {
    while ($row = $result_projects->fetch_assoc()) {
        $image = !empty($row["image_path"]) ? 'image_path/' . $row["image_path"] : 'image_path/default.jpg';
        $project_name = htmlspecialchars($row["project_name"], ENT_QUOTES, 'UTF-8');
        $details = isset($row["details"]) ? htmlspecialchars($row["details"], ENT_QUOTES, 'UTF-8') : "Không có mô tả.";
        $class = ($index % 2 == 0) ? "image-right" : "image-left";
        ?>
        <div class="content <?php echo $class; ?>">
            <div class="text">
                <h2><a href="project_detail.php?id=<?php echo $row['id']; ?>&type=restoration"><?php echo $project_name; ?></a></h2>
                <p><?php echo $details; ?></p>
            </div>
            <div class="image">
                <a href="project_detail.php?id=<?php echo $row['id']; ?>&type=restoration">
                    <img src="<?php echo $image; ?>" alt="<?php echo $project_name; ?>">
                </a>
            </div>
        </div>
        <?php $index++;
    }
} else {
    echo "<p>Chưa có dự án phục hồi nào.</p>";
}
?>

<h1 id="campaigns">Các chiến dịch bảo vệ quốc tế</h1>
<div class="story-container">
    <?php 
    $index = 0;
    while ($row = $result_success->fetch_assoc()):
    ?>
        <div class="story">
            <a href="success_detail.php?id=<?php echo $row['id']; ?>&type=success">
                <img src="./image_success/<?php echo $row['image_success']; ?>" alt="<?php echo $row['title']; ?>">
            </a>
            <h3><a href="success_detail.php?id=<?php echo $row['id']; ?>&type=success"><?php echo $row['title']; ?></a></h3>
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

<footer>
    <div class="footer-container">
      <!-- Phần 1: Get Help -->
      <div class="footer-section">
        <h5>Get Help</h5>
        <p><a href="../feedback.php">Feedback</a></p>
        <p><a href="../contact.php">Contact Us</a></p>
      </div>

      <!-- Phần 2: VIE VN -->
      <div class="footer-section footer-center">
        <div>
          <img src="./image_path/VN_Flag.webp" alt="Vietnam Flag" />
          <span>VIE VN</span>
        </div>
        <p>© 2025 G.H</p>
      </div>

      <!-- Phần 3: Copyright -->
      <div class="footer-section footer-right">
        <p>© 2025 G.H. ALL RIGHTS RESERVED</p>
      </div>
    </div>
  </footer>

<script>
    const carousel = document.querySelector('.carousel');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    let index = 0;
    const cardWidth = 300;
    const totalCards = document.querySelectorAll('.card').length;
    const maxIndex = totalCards - 3;
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
