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
        <li><a href="map.php" class="<?= $current_page == 'map.php' ? 'active' : '' ?>">Bản đồ</a></li>
    </ul>
    <div class="menu-toggle">&#9776;</div>
</nav>
