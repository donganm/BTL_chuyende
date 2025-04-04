<?php 
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<nav>
    <div class="logo">
      <a href="../index.php">🌍 Global Heritage</a>
    </div>
    <ul class="nav-links">
        <li><a href="../index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Trang chủ</a></li>
        <li><a href="./congdong/stories.php" class="<?= $current_page == 'stories.php' ? 'active' : '' ?>">Câu chuyện & Dự án</a></li>
        <li><a href="./congdong/events.php" class="<?= $current_page == 'events.php' ? 'active' : '' ?>">Sự kiện & Hoạt động</a></li>
        <li><a href="./congdong/network.php" class="<?= $current_page == 'network.php' ? 'active' : '' ?>">Mạng lưới kết nối</a></li>
    </ul>
</nav>
<style>
    nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #007bff;
    padding: 15px 30px;
}

.logo a {
    font-size: 22px;
    font-weight: bold;
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px; /* Khoảng cách giữa icon và chữ */
}

.logo-icon {
    width: 30px; /* Điều chỉnh kích thước icon */
    height: 30px;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 30px;
    padding: 0;
    margin: 0;
}

.nav-links li {
    display: inline;
}

.nav-links a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    font-weight: bold;
    padding: 8px 12px;
    transition: 0.3s;
}

.nav-links a:hover,
.nav-links a.active {
    background: white;
    color: #007bff;
    border-radius: 5px;
}

/* Responsive: Không cần menu ☰ */
@media screen and (max-width: 768px) {
    .nav-links {
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }
}

</style>
