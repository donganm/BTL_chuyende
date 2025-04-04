<?php
session_start();

if (!isset($_SESSION['redirect_url'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}

include '../../../includes/db.php';

if (!$conn) {
    die("Lỗi kết nối database: " . mysqli_connect_error());
}

$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === 'Admin';

// Tìm kiếm
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$searchSql = "";

if (!empty($search)) {
    $searchSafe = mysqli_real_escape_string($conn, $search);
    $searchSql = "WHERE title LIKE '%$searchSafe%' OR tac_gia LIKE '%$searchSafe%' OR description LIKE '%$searchSafe%'";
}

// Bộ lọc sắp xếp
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'latest';
$orderBy = $sort === 'popular' ? 'luot_xem DESC' : 'ngay_dang DESC';

$sql = "SELECT id, title, tac_gia, description, hinhanh, ngay_dang, luot_xem, luot_thich 
        FROM blog_articles 
        $searchSql 
        ORDER BY $orderBy";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" href="../styles/blog.css">
    <link rel="stylesheet" href="../includes/nav.css">
    <style>
        .blog-container {
            max-width: 800px;
            margin: auto;
            padding: 2rem;
        }

        .blog-post-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
        }

        .blog-post-img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .blog-post-body {
            padding: 1.5rem;
        }

        .blog-post-title {
            font-size: 1.5rem;
            margin-top: 0.5rem;
        }

        .blog-post-title a {
            text-decoration: none;
            font-size: 28px;
        }

        .blog-post-meta {
            font-size: 0.9rem;
            color: #666;
        }

        .blog-post-summary {
            margin: 1rem 0;
            line-height: 1.6;
        }

        .blog-post-tag {
            font-size: 0.8rem;
            background: #eef6f7;
            color: #036;
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
            display: inline-block;
            margin-bottom: 0.3rem;
        }

        .blog-post-quote {
            font-style: italic;
            color: #444;
            border-left: 4px solid #ccc;
            padding-left: 1rem;
            margin: 1rem 0;
        }

        .btn-blog-read {
            display: inline-block;
            margin-top: 0.5rem;
            color: #fff;
            background: #007BFF;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <header>
        <h1>Blog Về Văn Hoá Việt Nam</h1>
        <p>Chia sẻ trải nghiệm và góc nhìn</p>
    </header>

    <?php include '../includes/nav.php'; ?>

    <div class="blog-container">

        <!-- Thanh tìm kiếm -->
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Tìm kiếm nhanh về tin tức..."
                value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Tìm Kiếm</button>
            <!-- Nút đăng bài (Chỉ hiển thị nếu là Admin) -->
            <?php if ($isAdmin): ?>
                <a href="./add.php" class="btn btn-primary">+ Đăng bài</a>
            <?php endif; ?>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($blog = $result->fetch_assoc()): ?>
                <?php
                $imgPath = "./images/" . htmlspecialchars($blog["hinhanh"]);
                if (!file_exists($imgPath) || empty($blog["hinhanh"])) {
                    $imgPath = "./images/default.jpg";
                }
                $summary = mb_substr(strip_tags($blog["description"]), 0, 200, 'UTF-8') . '...';
                $randomView = rand(20, 50);
                $randomLike = rand(10, 15);
                $randomComment = rand(3, 10);
                $tags = ['🌄 Trải nghiệm', '🧭 Góc nhìn', '📜 Câu chuyện'][array_rand([1, 2, 3])]; // Random tag vui
                ?>

                <article class="blog-post-card">
                    <img src="<?= $imgPath ?>" alt="Ảnh blog" class="blog-post-img">
                    <div class="blog-post-body">
                        <div class="blog-post-tag"><?= $tags ?></div>
                        <h2 class="blog-post-title">
                            <a href="view-blog.php?id=<?= $blog["id"] ?>"><?= htmlspecialchars($blog["title"]) ?></a>
                        </h2>
                        <p class="blog-post-meta">
                            Viết bởi <strong><?= htmlspecialchars($blog["tac_gia"]) ?></strong> • <?= date("d/m/Y", strtotime($blog["ngay_dang"])) ?>
                        </p>
                        <blockquote class="blog-post-quote">
                            “<?= mb_substr(strip_tags($blog["description"]), 0, 100, 'UTF-8') ?>...”
                        </blockquote>
                        <p class="blog-post-summary"><?= $summary ?></p>
                        <p class="blog-post-stats">
                            👁️ <?= $randomView ?> lượt xem • ❤️ <?= $randomLike ?> thích • 💬 <?= $randomComment ?> bình luận
                        </p>
                        <a href="view-blog.php?id=<?= $blog["id"] ?>" class="btn btn-blog-read">Đọc tiếp →</a>

                        <?php if ($isAdmin): ?>
                            <div class="admin-actions">
                                <a href="edit.php?id=<?= $blog['id'] ?>" class="btn btn-warning">Sửa</a>
                                <a href="delete.php?id=<?= $blog['id'] ?>" class="btn btn-danger" onclick="return confirm('Xoá bài viết này?')">Xoá</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-articles">
                <h2>Chưa có bài blog nào</h2>
                <p>Bạn có thể bắt đầu bằng một bài viết chia sẻ hành trình của mình.</p>
            </div>
        <?php endif; ?>
    </div>


</body>

</html>