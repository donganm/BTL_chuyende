<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khám Phá Di Tích Lịch Sử</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .search-container {
            margin-top: 20px;
            position: relative;
            width: 400px;
            margin: auto;
        }

        #search-input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #quiz-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .answer-btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .answer-btn:hover {
            background-color: #dcdcdc;
        }
    </style>
</head>
<body>
    <h1>KHÁM PHÁ DI TÍCH LỊCH SỬ</h1>

    <div id="quiz-container">
        <p id="question">Đang tải câu hỏi...</p>
        <div id="answers"></div>
        <p id="feedback" style="display:none;"></p>
        <button id="next-btn" style="display:none;">Câu tiếp theo</button>
    </div>

    <script>
        let places = [];
        let currentIndex = 0;
        let questions = [];

        // Lấy dữ liệu từ PHP
        fetch('./pages/get_data.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không thể lấy dữ liệu từ máy chủ.');
                }
                return response.json();
            })
            .then(data => {
                places = data;
                startGame();
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra khi tải dữ liệu. Vui lòng kiểm tra lại kết nối.');
            });

        function startGame() {
            questions = [...places].sort(() => 0.5 - Math.random()).slice(0, 5);
            currentIndex = 0;
            showQuestion();
        }

        function showQuestion() {
            if (currentIndex >= questions.length) {
                document.getElementById('quiz-container').innerHTML = '<h3>Chúc mừng! Bạn đã hoàn thành game!</h3>';
                return;
            }

            const question = questions[currentIndex];
            document.getElementById('question').textContent = `Di tích nào nằm ở ${question.location}?`;

            const answersContainer = document.getElementById('answers');
            answersContainer.innerHTML = '';

            let options = [...places].sort(() => 0.5 - Math.random()).slice(0, 3);
            if (!options.includes(question)) options[Math.floor(Math.random() * 3)] = question;

            options.forEach(place => {
                const btn = document.createElement('button');
                btn.textContent = place.name;
                btn.classList.add('answer-btn');
                btn.onclick = () => checkAnswer(place, question);
                answersContainer.appendChild(btn);
            });

            document.getElementById('feedback').style.display = 'none';
            document.getElementById('next-btn').style.display = 'none';
        }

        function checkAnswer(selected, correct) {
            const feedback = document.getElementById('feedback');
            if (selected.name === correct.name) {
                feedback.textContent = 'Đúng!';
                feedback.style.color = 'green';
            } else {
                feedback.textContent = `Sai! Đáp án đúng là: ${correct.name}. Mô tả: ${correct.description}`;
                feedback.style.color = 'red';
            }
            feedback.style.display = 'block';
            document.getElementById('next-btn').style.display = 'block';
        }

        document.getElementById('next-btn').onclick = () => {
            currentIndex++;
            showQuestion();
        };
    </script>
</body>
</html>