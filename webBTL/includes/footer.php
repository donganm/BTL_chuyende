<!-- Footer  -->
<hr />
<div class="footer_1">
    <h5>Get Help</h5>
    <p><a href="feedback.php">Feedback</a></p>

    <p><a href="contact.php">Contact Us</a></p>
</div>

<div class="footer_2">
    <div class="VN">
        <img src="../assets/img/VN_Flag.webp" alt="logo" />
        <span>VN</span>
    </div>
    <div class="Conver">
        <span><i class="fa-brands fa-dribbble"></i></span>
        <span>2025 G.H</span>
    </div>
</div>

<div class="footer_3">
    <p>
        COPYRIGHT <i class="fa-brands fa-dribbble"></i> 2025 G.H. ALL RIGHTS
        RESERVED
    </p>
</div>

<!-- End Footer -->

<script>
    function openLoginForm() {
        document.getElementById("overlay").style.display = "block";
        document.getElementById("loginModal").style.display = "block";
    }

    function closeLoginForm() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("loginModal").style.display = "none";
    }

    // Tự động đóng modal sau khi đăng nhập thành công
    window.addEventListener("message", function(event) {
        if (event.data === "closeModal") {
            closeLoginForm();
        }
    });
</script>
</body>

</html>