<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

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
            <li><a href="../../../index.php">Trang chủ</a></li>
            <li><a href="../news/index.php">Tin tức</a></li>
            <li><a href="../blog/index.php">Blog</a></li>
        </ul>
    </div>

    <div class="user-info">
        <?php if ($userLoggedIn): ?>
            <span>Xin chào, <strong><?php echo $_SESSION['user']; ?></strong> (<?php echo $isAdmin ? "Admin" : "User"; ?>)</span>
            <a href="../profile.php">Hồ sơ</a> |
            <a href="../../../logout.php" id="logout-btn">Đăng xuất</a>
        <?php else: ?>
            <a href="../../login.php">Đăng nhập</a>
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