<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

<style>

nav {
    display: flex;
    justify-content: center; /* Căn giữa toàn bộ nội dung */
    align-items: center;
    background-color: #2C3E50;
    width: 100%;
    padding: 15px 50px;
    box-sizing: border-box;
    position: relative; /* Để user-info không ảnh hưởng đến căn giữa */
}

body, html {
    margin: 0;
    padding: 0;
}

.nav-container {
    display: flex;
    justify-content: center; /* Căn giữa nội dung menu */
    align-items: center;
    flex: 1;
}

.nav-links {
    display: flex;
    gap: 50px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-links a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    padding: 10px 15px;
}

.nav-links a.active {
    color: #27ae60;
}

.user-info {
    position: absolute;
    right: 50px; /* Đặt cố định về bên phải */
    top: 50%;
    transform: translateY(-50%); /* Giữ căn giữa theo chiều dọc */
    color: white;
    display: flex;
    align-items: center;
}

.user-info a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
    font-weight: bold;
}

.user-info a:hover {
    text-decoration: underline;
}

</style>
</head>
<body>
  
</body>
</html>

<?php
// session_start();
$userLoggedIn = isset($_SESSION['user']);
$isAdmin = $userLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] === "Admin";
?>

<nav>
    <div class="nav-container">
        <ul class="nav-links">
            <li><a href="../../index.php">Trang chủ</a></li>
            <li><a href="../tintuc/tintuc.php">Tin tức</a></li>
            <li><a href="../blog/blog.php">Blog</a></li>
        </ul>
    </div>

    <div class="user-info">
        <?php if ($userLoggedIn): ?>
            <span>Xin chào, <strong><?php echo $_SESSION['user']; ?></strong> (<?php echo $isAdmin ? "Admin" : "User"; ?>)</span>
            <a href="../profile.php">Hồ sơ</a> |
            <a href="#" id="logout-btn">Đăng xuất</a>
        <?php else: ?>
            <a href="../login.php">Đăng nhập</a>
        <?php endif; ?>
    </div>
</nav>


<script>
document.getElementById("logout-btn")?.addEventListener("click", function(event) {
    event.preventDefault();
    fetch('../logout.php', { method: 'POST' })
    .then(response => {
        if (response.ok) location.reload();
    })
    .catch(error => console.error("Lỗi khi đăng xuất:", error));
});
</script>