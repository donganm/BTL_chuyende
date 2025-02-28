<!DOCTYPE html>
<html>
<head>
    <title>Trả lời câu hỏi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
        }
        .sidebar {
            width: 200px;
            background: #f8f9fa;
            padding: 20px;
            position: fixed;
            top: 20px;
            left: 20px;
            overflow-y: auto;
        }
        .sidebar h3 {
            margin: 0 0 10px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li button {
            width: 100%;
            padding: 10px;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .sidebar ul li button:hover {
            background-color: #e9ecef;
        }
        .container {
            max-width: 700px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-grow: 1;
            margin-left: 240px;
        }
        .question {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .actions button {
            margin-right: 10px;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .answer-box {
            display: none;
            margin-top: 10px;
        }
        .answer-box textarea {
            width: 100%;
            height: 50px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Menu</h3>
        <hr>
        <ul>
            <li><button onclick="showQuestions()">Câu hỏi dành cho bạn</button></li>
            <li><button onclick="showDrafts()">Bản nháp</button></li>
        </ul>
    </div>

    <div class="container" id="questions-container">
        <h2>Câu hỏi dành cho bạn</h2>
        <hr>
        <div class="question" id="q1">
            <p><strong>Tại sao Quần thể di tích Cố đô Huế lại được UNESCO công nhận là Di sản Thế giới?</strong></p>
            <div class="actions">
                <button onclick="showAnswerBox('q1')">Trả lời</button>
                <button onclick="followQuestion(this)">Theo dõi</button>
                <button onclick="removeQuestion('q1')">Bỏ qua</button>
            </div>
            <div class="answer-box" id="answer-q1">
                <textarea placeholder="Write your answer..."></textarea>
                <button onclick="submitAnswer('q1')">Gửi</button>
            </div>
        </div>        
        <div class="question" id="q2">
            <p><strong>Vì sao Vạn Lý Trường Thành được UNESCO công nhận là di sản thế giới?</strong></p>
            <div class="actions">
                <button onclick="showAnswerBox('q2')">Trả lời</button>
                <button onclick="followQuestion(this)">Theo dõi</button>
                <button onclick="removeQuestion('q2')">Bỏ qua</button>
            </div>
            <div class="answer-box" id="answer-q2">
                <textarea placeholder="Write your answer..."></textarea>
                <button onclick="submitAnswer('q2')">Gửi</button>
            </div>
        </div>
        <div class="question" id="q3">
            <p><strong>Kim tự tháp Ai Cập có phải là di sản thế giới không?</strong></p>
            <div class="actions">
                <button onclick="showAnswerBox('q3')">Trả lời</button>
                <button onclick="followQuestion(this)">Theo dõi</button>
                <button onclick="removeQuestion('q3')">Bỏ qua</button>
            </div>
            <div class="answer-box" id="answer-q3">
                <textarea placeholder="Write your answer..."></textarea>
                <button onclick="submitAnswer('q3')">Gửi</button>
            </div>
        </div>
    </div>

    <div class="container hidden" id="drafts-container">
        <h2>Bản nháp</h2>
        <hr>
        <p>Chưa có bản nháp nào.</p>
    </div>

    <script>
        function showAnswerBox(questionId) {
            document.getElementById('answer-' + questionId).style.display = 'block';
        }
        function submitAnswer(questionId) {
            alert("Câu trả lời của bạn đã được gửi!");
            document.getElementById('answer-' + questionId).style.display = 'none';
        }
        function followQuestion(button) {
            button.innerText = "Following";
            button.disabled = true;
        }
        function removeQuestion(questionId) {
            document.getElementById(questionId).style.display = 'none';
        }

        function showQuestions() {
            document.getElementById('questions-container').classList.remove('hidden');
            document.getElementById('drafts-container').classList.add('hidden');
        }

        function showDrafts() {
            document.getElementById('questions-container').classList.add('hidden');
            document.getElementById('drafts-container').classList.remove('hidden');
        }
    </script>
</body>
</html> 