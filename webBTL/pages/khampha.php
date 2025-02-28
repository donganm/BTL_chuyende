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
            { q: "Kinh đô đầu tiên của Việt Nam thời Đinh - Tiền Lê là gì?", a: "hoa lu" },
            { q: "Ngôi chùa nào được coi là chùa Một Cột của Việt Nam?", a: "chua mot cot" },
            { q: "Lăng Chủ tịch Hồ Chí Minh nằm ở thành phố nào?", a: "ha noi" },
            { q: "Di tích Hoàng thành Thăng Long được công nhận là di sản thế giới vào năm nào?", a: "2010" },
            { q: "Văn Miếu Quốc Tử Giám là trường đại học đầu tiên của Việt Nam đúng hay sai?", a: "dung" },
            { q: "Thành nhà Hồ được xây dựng vào thời vua nào?", a: "ho quy ly" },
            { q: "Chùa Bái Đính thuộc tỉnh nào?", a: "ninh binh" },
            { q: "Vịnh Hạ Long thuộc tỉnh nào?", a: "quang ninh" },
            { q: "Cố đô Huế thuộc triều đại nào?", a: "nguyen" },
            { q: "Ngôi chùa nào nổi tiếng với lễ hội chùa Hương?", a: "chua huong" },
            { q: "Địa điểm nào được coi là biểu tượng của TP. Hồ Chí Minh?", a: "cho ben thanh" },
            { q: "Khu di tích đền Hùng nằm ở tỉnh nào?", a: "phu tho" },
            { q: "Thánh địa Mỹ Sơn thuộc nền văn hóa nào?", a: "cham pa" },
            { q: "Cột cờ Hà Nội nằm trong khu vực nào?", a: "hoang thanh thang long" },
            { q: "Nhà tù Côn Đảo từng giam giữ những ai?", a: "tu nhan chinh tri" },
            { q: "Cầu Rồng nằm ở thành phố nào?", a: "da nang" },
            { q: "Tháp Nhạn là di tích nổi tiếng của tỉnh nào?", a: "phu yen" },
            { q: "Lễ hội Gióng gắn liền với vị anh hùng nào?", a: "thanh giong" },
            { q: "Bảo tàng Chứng tích Chiến tranh nằm ở đâu?", a: "tp ho chi minh" },
            { q: "Cầu Hiền Lương chia cắt hai miền đất nước trong giai đoạn nào?", a: "1954-1975" },
            { q: "Phố cổ Hội An thuộc tỉnh nào?", a: "quang nam" },
            { q: "Ruộng bậc thang Mù Cang Chải thuộc tỉnh nào?", a: "yen bai" },
            { q: "Nhà thờ Đức Bà là biểu tượng của thành phố nào?", a: "tp ho chi minh" },
            { q: "Thác Bản Giốc thuộc tỉnh nào?", a: "cao bang" },
            { q: "Chùa Thiên Mụ nổi tiếng ở tỉnh nào?", a: "hue" },
            { q: "Hang Sơn Đoòng thuộc tỉnh nào?", a: "quang binh" },
            { q: "Núi Bà Đen nằm ở tỉnh nào?", a: "tay ninh" },
            { q: "Cổng Trời Sa Pa thuộc tỉnh nào?", a: "lao cai" },
            { q: "Thành cổ Quảng Trị gắn liền với sự kiện gì?", a: "chien dich 81 ngay dem" }
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
