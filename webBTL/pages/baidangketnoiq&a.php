    <html>
        <head>
            <title>Câu hỏi và câu trả lời di sản toàn cầu</title>
            <style>
                body{
                    font-family: Arial, sans-serif;
                    background-color: #f5f5f5;
                    padding: 0;
                    margin: 0;
                }
                .bentrai{       
                    flex-basis: 70%;
                }
                .benphai{
                    flex-basis: 30%;
                }
                .chiabocuc{
                    display: flex;
                }
                .hop{
                    margin: 20px auto;
                    max-width: 960px;
                }
                /* Giữ nguyên giao diện heading cũ của bạn */
                .header {
                    display: flex;
                    align-items: center;
                    justify-content: space-around;
                    background-color: white;
                    padding: 0px 200px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }
                .logo {
                    font-size: 30px;
                    font-weight: bold;
                    color: #b92b27;
                }
                .header-icons {
                    display: flex;
                    align-items: center;
                    gap: 15px;
                }
                .search-bar {
                    padding: 5px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    width: 300px;
                }
                .taobaidang {
                    background-color: #b92b27;
                    color: white;
                    border: none;
                    padding: 8px 16px;
                    border-radius: 5px;
                    cursor: pointer;
                }
                .taobaidang:hover {
                    background-color: #a1201e;
                }
                .menu {
                    background-color: white;
                }
                .menungang {
                    list-style: none;
                    display: flex;
                    justify-content: center;
                    flex-wrap: nowrap;
                    white-space: nowrap;
                }
                .menungang li {
                    display: inline;
                }
                .menungang a {
                    padding: 10px;
                    text-decoration: none;
                    color: black;
                }
                /* Thanh công cụ dưới header */
                .thanhcongcu {
                /* Bỏ hoặc thay thế max-width cũ, đặt lại như post */
                max-width: 700px;
                height: 50;
                margin: 10px auto; /* canh giữa trang */
                
                /* Thêm các thuộc tính giống .post */
                background-color: white;
                border-radius: 8px;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);

                /* Giữ lại hoặc chỉnh sửa phần nội dung, căn chỉnh */
                display: flex;
                align-items: center;
                gap: 10px; /* khoảng cách giữa các phần tử */
                }
                
                .thanhcongcu input {
                    flex-grow: 1;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 20px;
                    margin: 0 10px;
                    cursor: pointer;
                    background-attachment:  #f5f5f5;
                }

                .posts-container {
                    max-width: 700px;
                    margin: 0 auto; 
                }
                .post {
                    background-color: white;
                    padding: 15px;
                    margin: 10px 0;
                    border-radius: 8px;
                    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                }
                .user-info {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                .avatar {
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                }
                .post-content {
                    margin: 10px 0;
                   
                }
                .post-content a,.post h3 a {
                    font-weight: bold;
                    text-decoration: none;
                    color: black;
                }
                .post-content a:hover, .post h3 a:hover {
                    text-decoration: underline;
                }
                .anhto{
                    width: 100%;
                    border-radius: 8px;
                    margin-top: 10px;
                    object-fit: cover;
                }
                /* CSS cho Modal đăng bài */
                .modal {
                    display: none;
                    position: fixed;
                    top: 10%;
                    left: 50%;
                    transform: translate(-50%, 0);
                    width: 50%;
                    max-width: 500px;
                    background: white;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                    z-index: 1000;
                }
                .overlay {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                }
                .close-btn {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    font-size: 18px;
                    cursor: pointer;
                }
                .form-input {
                    width: 100%;
                    margin-bottom: 10px;
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                }
                .btn{
                    background-color: #b92b27;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;       
                }
                .btn:hover {
                    background-color: #a1201e;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">Q&A</div>
                <div class="menu">
                    <ul class="menungang">
                        <li><a href="../index.php">Trang chủ</a></li>
                        <li><a href="">Theo dõi</a></li>
                        <li><a href="traloi.php">Trả lời</a></li>
                        <li><a href="">Thông báo</a></li>
                        <li><a href="baidangketnoiq&a.php">Về Q&A</a></li>
                    </ul>
                </div>
                <div class="header-icons">
                    <input type="text" class="search-bar" placeholder="Tìm kiếm...">
                    <button class="taobaidang">Tạo bài đăng</button>
                </div>
            </div>
            
            <!-- Thanh công cụ để kích hoạt đăng bài -->
            <div class="thanhcongcu">
                <img src="../assets/img/avata1.jpg" alt="Avatar" class="avatar">
                <input type="text" placeholder="Bạn muốn hỏi hoặc chia sẻ điều gì?" id="triggerInput" readonly>
            </div>
            
            <!-- Danh sách bài đăng -->
            <div class="posts-container" id="postsContainer">
                <div class="post">
                    <div class="user-info">
                        <img src="../assets/img/avata1.jpg" alt="" class="avatar">
                        <div>
                            <strong>Huy Nguyễn</strong> <span class="bot-tag"> • online</span>
                        </div>
                    </div>
                    <p class="post-content">
                        <b><a href="qa.php">Tại sao Quần thể di tích Cố đô Huế lại được UNESCO công nhận là Di sản Thế giới?</a></b>
                    </p>
                    <p>Quần thể Di tích Cố đô Huế được UNESCO công nhận là Di sản Thế giới vào năm 1993 nhờ vào những giá trị nổi bật về lịch sử, văn hóa, kiến trúc và cảnh quan.</p>
                    <img class="anhto" src="..//assets/img/codohue.jpg" alt="">
                    <p>
                        1. Giá trị lịch sử và văn hóa<br>
                        Kinh đô triều Nguyễn (1802-1945): Huế từng là trung tâm chính trị, văn hóa và tôn giáo của Việt Nam dưới triều Nguyễn.<br>
                        Bảo tồn văn hóa cung đình: Cố đô Huế lưu giữ nhiều giá trị văn hóa từ tổ chức triều chính đến nghi lễ và nghệ thuật cung đình.<br>
                        Di sản văn hóa phi vật thể: Nhã nhạc cung đình Huế được UNESCO công nhận vào năm 2003.<br>
                        2. Giá trị kiến trúc độc đáo<br>
                        Hệ thống cung điện, lăng tẩm và đền đài với sự hài hòa giữa kiến trúc và thiên nhiên.<br>
                        3. Giá trị nghệ thuật và kỹ thuật xây dựng<br>
                        Trang trí tinh xảo và kỹ thuật xây dựng bền vững.<br>
                        4. Giá trị cảnh quan và môi trường<br>
                        Vị trí bên dòng sông Hương và bảo tồn hệ sinh thái tự nhiên.
                    </p>
                    <img class="anhto" src="..//assets//img/giatrivanhoalichsu.jpg" alt="">
                </div>
            </div>
            
            <div class="modal" id="postModal">
                <span class="close-btn" id="closeModal">&times;</span>
                <h3>Tạo bài đăng mới</h3>
                <form id="postForm">
                    <input type="text" id="post-title" class="form-input" placeholder="Nhập tiêu đề" required>
                    <textarea id="post-content" class="form-input" rows="3" placeholder="Nhập nội dung bài viết" required></textarea>
                    <button type="submit" class="btn">Đăng bài</button>
                </form>
            </div>
            <div class="overlay" id="overlay"></div>
            
            <script>
                const triggerInput = document.getElementById("triggerInput");
                const taoBaiDangBtn = document.querySelector(".taobaidang");
                const modal = document.getElementById("postModal");
                const overlay = document.getElementById("overlay");
                const closeModalBtn = document.getElementById("closeModal");
                const postForm = document.getElementById("postForm");
                const postsContainer = document.getElementById("postsContainer");
                
                // Hàm mở modal
                function openModal() {
                    modal.style.display = "block";
                    overlay.style.display = "block";
                }
                
                // Hàm đóng modal
                function closeModal() {
                    modal.style.display = "none";
                    overlay.style.display = "none";
                }
                
                // Gắn sự kiện mở modal cho input và nút Tạo bài đăng
                triggerInput.addEventListener("click", openModal);
                taoBaiDangBtn.addEventListener("click", openModal);
                
                // Sự kiện đóng modal khi click vào nút đóng hoặc overlay
                closeModalBtn.addEventListener("click", closeModal);
                overlay.addEventListener("click", closeModal);
                
                // Xử lý sự kiện đăng bài
                postForm.addEventListener("submit", function(event) {
                    event.preventDefault();
                    const title = document.getElementById("post-title").value.trim();
                    const content = document.getElementById("post-content").value.trim();
                    
                    if(title && content) {
                        // Tạo phần tử bài đăng mới
                        const post = document.createElement("div");
                        post.classList.add("post");
                        post.innerHTML = `
                            <div class="user-info">
                                <img src="../assets/img/avata1.jpg" alt="Avatar" class="avatar">
                                <div><strong>Huy Nguyễn</strong></div>
                            </div>
                            <h3><a href="#">${title}</a></h3>
                            <p>${content}</p>
                        `;
                        // Thêm bài đăng mới lên đầu danh sách
                        postsContainer.prepend(post);
                         
                        // Xóa dữ liệu nhập và đóng modal
                        document.getElementById("post-title").value = "";
                        document.getElementById("post-content").value = "";
                        closeModal();
                    } else {
                        alert("Vui lòng nhập đầy đủ tiêu đề và nội dung!");
                    }
                });
            </script>
        </body>
    </html>
