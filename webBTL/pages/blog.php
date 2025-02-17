<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog về di sản Việt Nam</title>
    <link rel="stylesheet" href="./tintuc/style.css"> <!-- Liên kết đến file CSS của bạn -->
</head>

<body>
    <header>
        <h1>Blog về di sản Việt Nam</h1>
        <p>Chia sẻ câu chuyện và kinh nghiệm du lịch các di sản nổi tiếng</p>
    </header>

    <nav>
        <a href="../index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Trang chủ</a>
        <a href="./tintuc.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'tintuc.php' ? 'active' : ''; ?>">Tin tức</a>
        <a href="./blog.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">Blog</a>
    </nav>

    <div class="container">
        <!-- Nội dung bài viết blog -->
        <div class="image-container">
            <img src="tp-hue.jpg" alt="Di sản văn hóa Huế">
        </div>

        <div class="content">
            <h2>Khám phá các ngôi chùa cổ tại Huế</h2>
            <p>Huế, thành phố mộng mơ nằm ở miền Trung Việt Nam, không chỉ nổi tiếng với những di tích lịch sử mà còn là nơi lưu giữ nhiều ngôi chùa cổ kính mang đậm giá trị văn hóa và tâm linh. Dưới đây là một số ngôi chùa nổi bật mà bạn không thể bỏ qua khi đến Huế.</p>
            
            <h3>1. Chùa Thiên Mụ</h3>
            <p>Chùa Thiên Mụ, tọa lạc trên đồi Hà Kê, cách trung tâm thành phố Huế khoảng 5 km về phía Tây, là một trong những ngôi chùa nổi tiếng và lâu đời nhất ở Huế. Với kiến trúc độc đáo và lịch sử gắn liền với các triều đại phong kiến, chùa Thiên Mụ đã trở thành biểu tượng không thể thiếu của cố đô Huế.</p>
            <ul>
                <li>Chùa Thiên Mụ được xây dựng vào năm 1601 dưới triều đại Nguyễn, với tên gọi ban đầu là Linh Mụ.</li>
                <li>Đây là ngôi chùa nổi bật với tháp Phước Duyên cao 21 mét, được coi là tháp chuông cao nhất ở Việt Nam.</li>
                <li>Chùa không chỉ là một điểm du lịch mà còn là nơi linh thiêng được nhiều tín đồ Phật giáo đến cầu nguyện và lễ bái.</li>
            </ul>

            <h3>2. Chùa Từ Hiếu</h3>
            <p>Chùa Từ Hiếu là một trong những ngôi chùa nổi tiếng ở Huế, không chỉ vì vẻ đẹp của nó mà còn bởi sự gắn kết với các sự kiện lịch sử của đất nước. Nằm trong một khu rừng thông yên tĩnh, chùa Từ Hiếu được xây dựng vào năm 1843 dưới triều đại Minh Mạng.</p>
            <ul>
                <li>Chùa Từ Hiếu có không gian thanh tịnh, thích hợp cho các phật tử tu hành, và là nơi cư trú của rất nhiều tăng ni.</li>
                <li>Chùa được biết đến là nơi Đức Tăng thống Thích Quảng Đức đã sống và tu hành trước khi nổi tiếng vì hành động tự thiêu phản đối chiến tranh.</li>
                <li>Đặc biệt, chùa Từ Hiếu cũng có các lễ hội Phật giáo lớn, thu hút hàng nghìn du khách đến tham gia mỗi năm.</li>
            </ul>

            <h3>3. Chùa Diệu Đế</h3>
            <p>Chùa Diệu Đế, được xây dựng vào năm 1843 dưới thời vua Thiệu Trị, là một trong những ngôi chùa quan trọng của Huế. Chùa không chỉ là nơi thờ Phật mà còn là trung tâm văn hóa, giáo dục tôn giáo của thành phố Huế.</p>
            <ul>
                <li>Với kiến trúc hài hòa, chùa Diệu Đế có nhiều công trình đẹp mắt, từ cổng vào cho đến các đền thờ Phật.</li>
                <li>Chùa còn là nơi tổ chức các lễ hội Phật giáo lớn, có nhiều sinh hoạt cộng đồng, thu hút đông đảo phật tử và du khách.</li>
            </ul>

            <p>Những ngôi chùa này không chỉ đẹp về mặt kiến trúc mà còn chứa đựng những giá trị văn hóa sâu sắc, là minh chứng cho một phần lịch sử lâu dài của đất nước. Nếu có dịp đến Huế, đừng quên ghé thăm những ngôi chùa cổ kính này để hiểu thêm về văn hóa và lịch sử của vùng đất cố đô.</p>
        </div>

        <div class="back-link">
            <a href="./tintuc.php">Quay lại Tin tức</a>
        </div>
    </div>
</body>

</html>
