<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .search-container {
            position: relative;
            width: 300px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .suggestions {
            position: absolute;
            width: 100%;
            background: white;
            border: 1px solid #ccc;
            border-top: none;
            max-height: 150px;
            overflow-y: auto;
            display: none;
        }
        .suggestions div {
            padding: 10px;
            cursor: pointer;
        }
        .suggestions div:hover {
            background: #ddd;
        }
    </style>
</head>


<body>
<div class="search-container">
        <input type="text" id="search" placeholder="Tìm kiếm..." onkeyup="searchFunction()">
        <div class="suggestions" id="suggestions"></div>
    </div>

    <script>
        const historicalSites = ["Hoàng thành Thăng Long", "Văn Miếu Quốc Tử Giám", "Cố đô Huế", "Chùa Một Cột", "Đền Hùng", "Tháp Chàm Po Nagar", "Lăng Bác"];
        
        function searchFunction() {
            let input = document.getElementById('search').value.toLowerCase();
            let suggestionsDiv = document.getElementById('suggestions');
            suggestionsDiv.innerHTML = '';
            
            if (input) {
                let filtered = historicalSites.filter(site => site.toLowerCase().includes(input));
                if (filtered.length > 0) {
                    suggestionsDiv.style.display = 'block';
                    filtered.forEach(site => {
                        let div = document.createElement('div');
                        div.innerHTML = site;
                        div.onclick = function() {
                            document.getElementById('search').value = site;
                            suggestionsDiv.style.display = 'none';
                        };
                        suggestionsDiv.appendChild(div);
                    });
                } else {
                    suggestionsDiv.style.display = 'none';
                }
            } else {
                suggestionsDiv.style.display = 'none';
            }
        }
    </script>

</body>

</html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lưu lịch sử tìm kiếm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }
        .search-container {
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 300px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            margin-left: 10px;
            cursor: pointer;
        }
        .history {
            width: 320px;
            border: 1px solid #ccc;
            padding: 10px;
            background: #f9f9f9;
        }
        .history div {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h2>Lưu lịch sử tìm kiếm</h2>
    <div class="search-container">
        <input type="text" id="search" placeholder="Tìm kiếm...">
        <button onclick="saveSearch()">Tìm</button>
    </div>
    <div class="history">
        <h3>Lịch sử tìm kiếm:</h3>
        <div id="searchHistory"></div>
    </div>

    <script>
        function saveSearch() {
            let query = document.getElementById("search").value;
            if (!query) return;
            
            let history = JSON.parse(localStorage.getItem("searchHistory")) || [];
            history.unshift(query);
            if (history.length > 10) history.pop(); // Giới hạn 10 mục gần nhất
            localStorage.setItem("searchHistory", JSON.stringify(history));
            displayHistory();
        }
        
        function displayHistory() {
            let history = JSON.parse(localStorage.getItem("searchHistory")) || [];
            let historyContainer = document.getElementById("searchHistory");
            historyContainer.innerHTML = "";
            history.forEach(item => {
                let div = document.createElement("div");
                div.textContent = item;
                historyContainer.appendChild(div);
            });
        }
        
        document.addEventListener("DOMContentLoaded", displayHistory);
    </script>
</body>
</html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gợi Ý Địa Điểm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .sort-buttons button {
            margin: 5px;
            padding: 10px;
            cursor: pointer;
        }
        .location-list {
            max-width: 500px;
            margin: auto;
            text-align: left;
        }
        .location {
            padding: 10px;
            border: 1px solid #ccc;
            margin: 5px 0;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h2>Gợi Ý Địa Điểm</h2>
    <div class="sort-buttons">
        <button onclick="sortLocations('visitors')">Sắp xếp theo tổng lượng khách</button>
        <button onclick="sortLocations('likes')">Sắp xếp theo lượt thích</button>
        <button onclick="sortLocations('comments')">Sắp xếp theo bình luận tích cực</button>
    </div>
    <div class="location-list" id="locationList"></div>

    <script>
        let locations = [
            { name: "Văn Miếu Quốc Tử Giám", visitors: 50000, likes: 1200, positiveComments: 300 },
            { name: "Hoàng thành Thăng Long", visitors: 75000, likes: 2500, positiveComments: 500 },
            { name: "Chùa Một Cột", visitors: 60000, likes: 1800, positiveComments: 400 },
            { name: "Cố đô Huế", visitors: 90000, likes: 3000, positiveComments: 700 },
            { name: "Đền Hùng", visitors: 80000, likes: 2200, positiveComments: 450 }
        ];

        function displayLocations() {
            let locationList = document.getElementById("locationList");
            locationList.innerHTML = "";
            locations.forEach(loc => {
                let div = document.createElement("div");
                div.className = "location";
                div.innerHTML = `<strong>${loc.name}</strong><br>
                                 Lượng khách: ${loc.visitors} | Lượt thích: ${loc.likes} | Bình luận tích cực: ${loc.positiveComments}`;
                locationList.appendChild(div);
            });
        }

        function sortLocations(criteria) {
            locations.sort((a, b) => b[criteria] - a[criteria]);
            displayLocations();
        }

        document.addEventListener("DOMContentLoaded", displayLocations);
    </script>
</body>
</html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-game Lịch Sử</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f4f4f4; }
        .hidden { display: none; }
        .container { max-width: 600px; margin: auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        button, input { margin: 10px; padding: 10px 15px; border: none; border-radius: 5px; }
        button { background: #007BFF; color: white; cursor: pointer; }
        button:hover { background: #0056b3; }
        input { width: 80%; }
    </style>
</head>
<body>
    <div id="login-container" class="container">
        <h2>Đăng nhập để chơi</h2>
        <input type="text" id="username" placeholder="Nhập tên của bạn" required>
        <button onclick="startGame()">Bắt đầu</button>
    </div>
    
    <div id="quiz-container" class="container hidden">
        <h2>Trả lời câu hỏi</h2>
        <p id="question"></p>
        <input type="text" id="answer" placeholder="Nhập câu trả lời">
        <button onclick="checkAnswer()">Trả lời</button>
        <button onclick="quitGame()">Thoát</button>
        <p id="result"></p>
    </div>
    
    <script>
        const questions = [
            { q: "Kinh thành Huế được xây dựng dưới triều đại nào?", a: "Nguyễn" },
            { q: "Văn Miếu – Quốc Tử Giám được xây dựng vào thời nào?", a: "Nhà Lý" },
            { q: "Thành Cổ Quảng Trị gắn liền với sự kiện nào?", a: "Trận chiến 81 ngày đêm năm 1972" },
            { q: "Hoàng Thành Thăng Long được UNESCO công nhận năm nào?", a: "2010" },
            { q: "Ai đã xây dựng chùa Một Cột?", a: "Lý Thái Tông" },
            { q: "Đền Hùng nằm ở tỉnh nào?", a: "Phú Thọ" },
            { q: "Nhà tù Côn Đảo từng được gọi là gì?", a: "Địa ngục trần gian" },
            { q: "Chiến thắng Điện Biên Phủ đánh bại thực dân nào?", a: "Pháp" },
            { q: "Khu di tích Mỹ Sơn thuộc nền văn hóa nào?", a: "Chăm Pa" },
            { q: "Tượng đài chiến thắng Điện Biên Phủ đặt ở đâu?", a: "Điện Biên" },
            { q: "Vịnh Hạ Long thuộc tỉnh nào?", a: "Quảng Ninh" },
            { q: "Hang Sơn Đoòng thuộc tỉnh nào?", a: "Quảng Bình" },
            { q: "Đỉnh Fansipan cao bao nhiêu mét?", a: "3.143m" },
            { q: "Hồ Gươm gắn với truyền thuyết nào?", a: "Trả gươm báu cho Rùa Thần" },
            { q: "Ruộng bậc thang Mù Cang Chải ở đâu?", a: "Yên Bái" },
            { q: "Phong Nha – Kẻ Bàng được UNESCO công nhận năm nào?", a: "2003" },
            { q: "Chợ nổi Cái Răng thuộc vùng nào?", a: "Miền Tây Nam Bộ" },
            { q: "Chùa Thiên Mụ nằm bên dòng sông nào?", a: "Sông Hương" },
            { q: "Đèo Hải Vân được mệnh danh là gì?", a: "Thiên hạ đệ nhất hùng quan" },
            { q: "Biển nào được gọi là 'Maldives của Việt Nam'?", a: "Phú Quốc" }
        ];

        let selectedQuestions = [], currentQuestionIndex = 0, score = 0;

        function startGame() {
            if (!document.getElementById("username").value.trim()) {
                alert("Vui lòng nhập tên để bắt đầu!");
                return;
            }
            document.getElementById("login-container").classList.add("hidden");
            document.getElementById("quiz-container").classList.remove("hidden");
            selectedQuestions = questions.sort(() => 0.5 - Math.random()).slice(0, 5);
            loadQuestion();
        }

        function loadQuestion() {
            if (currentQuestionIndex < selectedQuestions.length) {
                document.getElementById("question").innerText = selectedQuestions[currentQuestionIndex].q;
                document.getElementById("answer").value = "";
            } else {
                document.getElementById("quiz-container").innerHTML = `<h2>Bạn đã hoàn thành!</h2><p>Điểm số: ${score}/5</p><button onclick='location.reload()'>Chơi lại</button>`;
            }
        }

        function checkAnswer() {
            const userAnswer = document.getElementById("answer").value.trim().toLowerCase();
            const correctAnswer = selectedQuestions[currentQuestionIndex].a.toLowerCase();
            document.getElementById("result").innerText = userAnswer === correctAnswer 
                ? "✅ Đúng!" 
                : `❌ Sai! Đáp án: ${selectedQuestions[currentQuestionIndex].a}`;
            if (userAnswer === correctAnswer) score++;
            currentQuestionIndex++;
            setTimeout(() => { document.getElementById("result").innerText = ""; loadQuestion(); }, 1000);
        }

        function quitGame() {
            if (confirm("Bạn có chắc chắn muốn thoát không?")) location.reload();
        }
    </script>
</body>
</html>
</html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu Trang Web</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f4f4f4; }
        .container { max-width: 800px; margin: auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h1 { color: #007BFF; }
        .section { margin: 20px 0; }
        .comment-section { text-align: left; }
        textarea { width: 100%; padding: 10px; margin-top: 10px; }
        button { margin-top: 10px; padding: 10px 15px; border: none; background: #007BFF; color: white; cursor: pointer; border-radius: 5px; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chào mừng đến với trang khám phá lịch sử!</h1>
        <p>Tìm hiểu về các danh lam thắng cảnh và di tích lịch sử nổi tiếng.</p>
        
        <div class="section">
            <h2>Khám phá các di tích</h2>
            <p>Trang web cung cấp thông tin chi tiết về các địa danh lịch sử nổi tiếng.</p>
        </div>

        <div class="section">
            <h2>Đánh giá và bình luận</h2>
            <p>Bạn có thể chia sẻ suy nghĩ của mình về từng địa danh.</p>
            <div class="comment-section">
                <h3>Viết bình luận của bạn:</h3>
                <textarea id="comment" rows="4" placeholder="Nhập bình luận..."></textarea>
                <button onclick="submitComment()">Gửi</button>
                <div id="comments"></div>
            </div>
        </div>
    </div>

    <script>
        function submitComment() {
            const commentText = document.getElementById("comment").value.trim();
            if (commentText) {
                const commentDiv = document.createElement("div");
                commentDiv.innerHTML = `<p><strong>Người dùng:</strong> ${commentText}</p>`;
                document.getElementById("comments").appendChild(commentDiv);
                document.getElementById("comment").value = "";
            } else {
                alert("Vui lòng nhập nội dung bình luận!");
            }
        }
    </script>
</body>
</html>
