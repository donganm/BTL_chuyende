<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm Di Tích</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: blue;
            text-align: center;
            padding: 50px;
        }
        .search-container {
            max-width: 500px;
            margin: auto;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 2px solid blue;
            border-radius: 5px;
            font-size: 16px;
        }
        .suggestions {
            margin-top: 10px;
            text-align: left;
        }
        .suggestions p {
            background: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .suggestions p:hover {
            background: lightblue;
        }
        .history-container, .quiz-container {
            margin-top: 20px;
        }
        .history-list {
            display: none;
            text-align: left;
        }
        .info-box {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background: #ffeeba;
            border: 1px solid #ffc107;
            border-radius: 5px;
            text-align: left;
        }
    </style>
    <script>
        const places = ["Hoa Lư", "Chùa Một Cột", "Lăng Chủ tịch Hồ Chí Minh", "Hoàng thành Thăng Long", "Văn Miếu Quốc Tử Giám"];
        let searchHistory = [];

        function showSuggestions() {
            let input = document.getElementById("search").value.toLowerCase();
            let suggestionsDiv = document.getElementById("suggestions");
            suggestionsDiv.innerHTML = "";
            if (input) {
                let filtered = places.filter(place => place.toLowerCase().includes(input));
                filtered.forEach(place => {
                    let p = document.createElement("p");
                    p.innerText = place;
                    p.onclick = () => {
                        document.getElementById("search").value = place;
                        saveToHistory(place);
                    };
                    suggestionsDiv.appendChild(p);
                });
            }
        }

        function saveToHistory(place) {
            if (!searchHistory.includes(place)) {
                searchHistory.push(place);
                let historyDiv = document.getElementById("history-list");
                let p = document.createElement("p");
                p.innerText = place;
                historyDiv.appendChild(p);
            }
        }

        function toggleHistory() {
            let historyDiv = document.getElementById("history-list");
            historyDiv.style.display = historyDiv.style.display === "none" ? "block" : "none";
        }

        function normalizeText(text) {
            return text.normalize("NFD").replace(/\p{Diacritic}/gu, "").toLowerCase();
        }

        const questions = [
            [
  {"name": "Hoa Lư", "location": "Ninh Bình", "description": "Kinh đô đầu tiên của Việt Nam thời Đinh - Tiền Lê."},
  {"name": "Chùa Một Cột", "location": "Hà Nội", "description": "Ngôi chùa có kiến trúc độc đáo, biểu tượng của thủ đô Hà Nội."},
  {"name": "Lăng Chủ tịch Hồ Chí Minh", "location": "Hà Nội", "description": "Nơi an nghỉ của Chủ tịch Hồ Chí Minh."},
  {"name": "Hoàng Thành Thăng Long", "location": "Hà Nội", "description": "Di sản thế giới, trung tâm chính trị của nhiều triều đại."},
  {"name": "Văn Miếu Quốc Tử Giám", "location": "Hà Nội", "description": "Trường đại học đầu tiên của Việt Nam."},
  {"name": "Thành Nhà Hồ", "location": "Thanh Hóa", "description": "Di sản thế giới được xây dựng vào thời Hồ Quý Ly."},
  {"name": "Chùa Bái Đính", "location": "Ninh Bình", "description": "Ngôi chùa lớn nhất Đông Nam Á, nổi tiếng với kiến trúc đồ sộ."},
  {"name": "Vịnh Hạ Long", "location": "Quảng Ninh", "description": "Kỳ quan thiên nhiên thế giới với hàng nghìn đảo đá vôi."},
  {"name": "Cố đô Huế", "location": "Thừa Thiên Huế", "description": "Trung tâm văn hóa của triều đại nhà Nguyễn."},
  {"name": "Chùa Hương", "location": "Hà Nội", "description": "Nơi diễn ra lễ hội chùa Hương lớn nhất Việt Nam."},
  {"name": "Chợ Bến Thành", "location": "TP. Hồ Chí Minh", "description": "Biểu tượng nổi bật của TP. Hồ Chí Minh."},
  {"name": "Đền Hùng", "location": "Phú Thọ", "description": "Nơi thờ các vua Hùng, tổ tiên của dân tộc Việt Nam."},
  {"name": "Thánh địa Mỹ Sơn", "location": "Quảng Nam", "description": "Khu di tích của nền văn hóa Chăm Pa cổ đại."},
  {"name": "Cột cờ Hà Nội", "location": "Hà Nội", "description": "Công trình lịch sử gắn liền với Hoàng thành Thăng Long."},
  {"name": "Nhà tù Côn Đảo", "location": "Bà Rịa - Vũng Tàu", "description": "Nơi từng giam giữ các chiến sĩ cách mạng."},
  {"name": "Cầu Rồng", "location": "Đà Nẵng", "description": "Cây cầu nổi tiếng với thiết kế hình rồng phun lửa."},
  {"name": "Tháp Nhạn", "location": "Phú Yên", "description": "Ngọn tháp Chăm cổ nổi tiếng ở miền Trung."},
  {"name": "Lễ hội Gióng", "location": "Hà Nội", "description": "Lễ hội tưởng nhớ Thánh Gióng, vị anh hùng dân tộc."},
  {"name": "Bảo tàng Chứng tích Chiến tranh", "location": "TP. Hồ Chí Minh", "description": "Trưng bày hiện vật về chiến tranh Việt Nam."},
  {"name": "Cầu Hiền Lương", "location": "Quảng Trị", "description": "Nơi chia cắt hai miền Nam - Bắc trong giai đoạn 1954-1975."},
  {"name": "Phố cổ Hội An", "location": "Quảng Nam", "description": "Di sản thế giới với nét kiến trúc cổ kính."},
  {"name": "Ruộng bậc thang Mù Cang Chải", "location": "Yên Bái", "description": "Danh thắng nổi tiếng với ruộng bậc thang đẹp nhất Việt Nam."},
  {"name": "Nhà thờ Đức Bà", "location": "TP. Hồ Chí Minh", "description": "Kiến trúc Gothic cổ kính, biểu tượng của thành phố."},
  {"name": "Thác Bản Giốc", "location": "Cao Bằng", "description": "Thác nước hùng vĩ nằm giữa biên giới Việt - Trung."},
  {"name": "Chùa Thiên Mụ", "location": "Huế", "description": "Ngôi chùa cổ gắn liền với lịch sử triều Nguyễn."},
  {"name": "Hang Sơn Đoòng", "location": "Quảng Bình", "description": "Hang động lớn nhất thế giới với hệ sinh thái độc đáo."},
  {"name": "Núi Bà Đen", "location": "Tây Ninh", "description": "Ngọn núi linh thiêng, thu hút nhiều khách du lịch."},
  {"name": "Cổng Trời Sa Pa", "location": "Lào Cai", "description": "Nơi ngắm cảnh tuyệt đẹp ở độ cao hơn 2.000m."},
  {"name": "Thành cổ Quảng Trị", "location": "Quảng Trị", "description": "Gắn liền với chiến dịch 81 ngày đêm khốc liệt."}
]
        ];

        let currentQuestionIndex = 0;
        let selectedQuestions = [];

        function startQuiz() {
            currentQuestionIndex = 0;
            selectedQuestions = questions.sort(() => 0.5 - Math.random()).slice(0, 5);
            document.getElementById("quiz-box").style.display = "block";
            showQuestion();
        }

        function showQuestion() {
            if (currentQuestionIndex < selectedQuestions.length) {
                document.getElementById("question").innerText = selectedQuestions[currentQuestionIndex].q;
                document.getElementById("quiz-answer").value = "";
            } else {
                alert("Bạn đã hoàn thành 5 câu hỏi!");
                document.getElementById("quiz-box").style.display = "none";
            }
        }

        function checkAnswer() {
            let userAnswer = normalizeText(document.getElementById("quiz-answer").value.trim());
            let correctAnswer = normalizeText(selectedQuestions[currentQuestionIndex].a);
            if (userAnswer === correctAnswer) {
                alert("Chính xác!");
                currentQuestionIndex++;
                showQuestion();
            } else {
                alert("Sai! Thông tin: " + selectedQuestions[currentQuestionIndex].info);
            }
        }
    </script>
</head>
<body>
    <div class="search-container">
        <h2>Tìm Kiếm Địa Điểm Lịch Sử</h2>
        <input type="text" id="search" onkeyup="showSuggestions()" placeholder="Nhập địa danh...">
        <div id="suggestions" class="suggestions"></div>
    </div>
    
    <div class="history-container">
        <button onclick="toggleHistory()">Xem Lịch Sử Tìm Kiếm</button>
        <div id="history-list" class="history-list"></div>
    </div>

    <div class="quiz-container">
        <button onclick="startQuiz()">Chơi Mini Game</button>
        <div id="quiz-box" style="display:none;">
            <p id="question"></p>
            <input type="text" id="quiz-answer">
            <button onclick="checkAnswer()">Trả lời</button>
        </div>
    </div>
</body>
</html>
