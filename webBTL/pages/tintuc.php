
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        a {
            text-decoration: none;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav {
            background: #34495e;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            margin: 0 15px;
            font-weight: bold;
        }

        /* Mặc định bôi màu vàng cho mục active */
        nav a.active {
            font-weight: bold;
            color: #f39c12; /* Màu vàng cho mục active */
        }

        /* Bôi màu xanh dương cho mục "Tin tức" */
        nav a.active[href='./tintuc.php'] {
            color: #3498db;  /* Màu xanh dương cho mục "Tin tức" */
        }

        /* Bôi màu khác cho mục "Blog" */
        nav a.active[href='./blog.php'] {
            color: #9b59b6;  /* Màu tím cho mục "Blog" */
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .article {
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .article h2 {
            color: #2c3e50;
        }

        .article p {
            color: #555;
        }
    </style>
</head>

<body>
    <header>
        <h1>Tin tức về di sản Việt Nam</h1>
        <p>Nơi lưu giữ giá trị văn hóa và lịch sử</p>
    </header>

    <nav>
        <a href="../index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Trang chủ</a>
        <a href="./tintuc.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'tintuc.php' ? 'active' : ''; ?>">Tin tức</a>
        <a href="./blog.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'active' : ''; ?>">Blog</a>
    </nav>

    <div class="container">
        <?php
        // Mảng chứa thông tin về các bài viết
        $articles = [
            ["title" => "Khám phá di sản văn hóa Huế", "desc" => "Huế là cố đô với nhiều di tích lịch sử quan trọng của Việt Nam.", "link" => "./tintuc/hue.php"],
            ["title" => "Chùa Một Cột - Biểu tượng ngàn năm", "desc" => "Ngôi chùa độc đáo với kiến trúc có một không hai.", "link" => "./tintuc/chua-mot-cot.php"],
            ["title" => "Hội An - Phố cổ lung linh", "desc" => "Hội An là điểm đến không thể bỏ qua với vẻ đẹp hoài cổ.", "link" => "./tintuc/hoi-an.php"],
        ];

        // Hiển thị từng bài viết
        foreach ($articles as $article) {
            echo '<div class="article">';
            echo '<h2><a href="' . $article["link"] . '">' . $article["title"] . '</a></h2>';
            echo '<p>' . $article["desc"] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>
