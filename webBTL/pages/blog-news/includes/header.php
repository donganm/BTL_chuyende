<header>
    <div class="header">
        <!-- Tiêu đề và mô tả -->
        <div class="header-content">
            <h1>TIN TỨC VỀ DI SẢN VIỆT NAM</h1>
            <p style="color: white">Cập nhật nhanh nhất, ngắn gọn về các sự kiện, chính sách, và hoạt động bảo tồn di sản</p>
        </div>

        <!-- Thanh điều hướng -->
        <nav>
            <ul class="nav-links">
                <li><a href="../../../index.php">Trang chủ</a></li>
                <li><a href="../news/index.php">Tin tức</a></li>
                <li><a href="../blog/index.php">Blog</a></li>
            </ul>
            <!-- Thông tin người dùng -->
            <div class="user-info">
                <?php if (!empty($userLoggedIn)): ?>
                    <span>Xin chào, <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>
                        (<?php echo $isAdmin ? "Admin" : "User"; ?>)</span>

                    <a href="../../profile.php">Hồ sơ</a> |
                    <a href="../../logout.php" id="logout-btn">Đăng xuất</a>
                <?php else: ?>
                    <a href="../../login.php">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </nav>


    </div>
</header>

<script>
    document.getElementById("logout-btn")?.addEventListener("click", function(event) {
        event.preventDefault();
        fetch('../../logout.php', {
                method: 'POST'
            })
            .then(response => {
                if (response.ok) location.reload();
            })
            .catch(error => console.error("Lỗi khi đăng xuất:", error));
    });
</script>