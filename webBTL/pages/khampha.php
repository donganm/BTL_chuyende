<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="https://glitch.com/favicon.ico" />
    <title>KHÁM PHÁ</title>
    
  </head>
  <h1>
  KHÁM PHÁ
  </h1>
  <body>
    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Tìm Kiếm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }
        .search-container {
            position: relative;
            width: 400px;
        }
        #search-input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .suggestions {
            position: absolute;
            width: 100%;
            background: white;
            border: 1px solid #ccc;
            border-top: none;
            display: none;
            max-height: 150px;
            overflow-y: auto;
        }
        .suggestions div {
            padding: 10px;
            cursor: pointer;
        }
        .suggestions div:hover {
            background: #f0f0f0;
        }
        #history-btn {
            margin-top: 10px;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #history-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="search-container">
        <input type="text" id="search-input" placeholder="Tìm kiếm...">
        <div class="suggestions" id="suggestions-box"></div>
    </div>
    <button id="history-btn">Xem lịch sử tìm kiếm</button>

    <script>
        const searchInput = document.getElementById("search-input");
        const suggestionsBox = document.getElementById("suggestions-box");
        const historyBtn = document.getElementById("history-btn");

        // Danh sách gợi ý
        const suggestions = ["Vịnh Hạ Long", "Chùa Thiên Mụ", "Tháp Rùa", "Đền Hùng", "Hoàng Thành Thăng Long", "Phố Cổ Hội An"];

        // Lưu lịch sử tìm kiếm
        let searchHistory = JSON.parse(localStorage.getItem("searchHistory")) || [];

        searchInput.addEventListener("input", function () {
            const value = this.value.toLowerCase();
            suggestionsBox.innerHTML = "";
            if (value) {
                const filteredSuggestions = suggestions.filter(item => item.toLowerCase().includes(value));
                if (filteredSuggestions.length) {
                    suggestionsBox.style.display = "block";
                    filteredSuggestions.forEach(item => {
                        const div = document.createElement("div");
                        div.textContent = item;
                        div.addEventListener("click", function () {
                            searchInput.value = item;
                            saveSearchHistory(item);
                            suggestionsBox.style.display = "none";
                        });
                        suggestionsBox.appendChild(div);
                    });
                } else {
                    suggestionsBox.style.display = "none";
                }
            } else {
                suggestionsBox.style.display = "none";
            }
        });

        // Lưu tìm kiếm vào lịch sử
        function saveSearchHistory(query) {
            if (!searchHistory.includes(query)) {
                searchHistory.push(query);
                localStorage.setItem("searchHistory", JSON.stringify(searchHistory));
            }
        }

        // Xem lịch sử tìm kiếm
        historyBtn.addEventListener("click", function () {
            alert("Lịch sử tìm kiếm:\n" + (searchHistory.length ? searchHistory.join("\n") : "Không có lịch sử"));
        });

        // Ẩn gợi ý khi click ra ngoài
        document.addEventListener("click", function (event) {
            if (!searchInput.contains(event.target) && !suggestionsBox.contains(event.target)) {
                suggestionsBox.style.display = "none";
            }
        });
    </script>

</body>
</html>
    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Game Lịch Sử</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 20px; }
        #quiz-container { max-width: 500px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        .answer-btn { display: block; width: 100%; padding: 10px; margin: 5px 0; cursor: pointer; }
        .correct { background-color: lightgreen; }
        .wrong { background-color: lightcoral; }
    </style>
</head>
<body>
    <h2>Mini Game: Đoán Di Tích Lịch Sử</h2>
    <div id="quiz-container">
        <p id="question">Câu hỏi sẽ hiển thị ở đây</p>
        <div id="answers"></div>
        <p id="feedback" style="display:none;"></p>
        <button id="next-btn" style="display:none;">Câu tiếp theo</button>
    </div>
    
    <script>
        const places = [
            {"name": "Hoa Lư", "location": "Ninh Bình", "description": "Kinh đô đầu tiên của Việt Nam thời Đinh - Tiền Lê."},
            {"name": "Chùa Một Cột", "location": "Hà Nội", "description": "Ngôi chùa có kiến trúc độc đáo, biểu tượng của thủ đô Hà Nội."},
            {"name": "Lăng Chủ tịch Hồ Chí Minh", "location": "Hà Nội", "description": "Nơi an nghỉ của Chủ tịch Hồ Chí Minh."},
            {"name": "Hoàng Thành Thăng Long", "location": "Hà Nội", "description": "Di sản thế giới, trung tâm chính trị của nhiều triều đại."},
            {"name": "Vịnh Hạ Long", "location": "Quảng Ninh", "description": "Kỳ quan thiên nhiên thế giới với hàng nghìn đảo đá vôi."}
        ];
        
        let questions = [];
        let currentIndex = 0;

        function startGame() {
            questions = [...places].sort(() => 0.5 - Math.random()).slice(0, 5);
            currentIndex = 0;
            showQuestion();
        }

        function showQuestion() {
            if (currentIndex >= questions.length) {
                document.getElementById("quiz-container").innerHTML = "<h3>Chúc mừng! Bạn đã hoàn thành game!</h3>";
                return;
            }
            
            const question = questions[currentIndex];
            document.getElementById("question").textContent = `Di tích nào nằm ở ${question.location}?`;
            const answersContainer = document.getElementById("answers");
            answersContainer.innerHTML = "";
            
            let options = [...places].sort(() => 0.5 - Math.random()).slice(0, 3);
            if (!options.includes(question)) options[Math.floor(Math.random() * 3)] = question;
            
            options.forEach(place => {
                const btn = document.createElement("button");
                btn.textContent = place.name;
                btn.classList.add("answer-btn");
                btn.onclick = () => checkAnswer(place, question);
                answersContainer.appendChild(btn);
            });
            
            document.getElementById("feedback").style.display = "none";
            document.getElementById("next-btn").style.display = "none";
        }

        function checkAnswer(selected, correct) {
            const feedback = document.getElementById("feedback");
            if (selected.name === correct.name) {
                feedback.textContent = "Đúng!";
                feedback.style.color = "green";
                document.querySelectorAll(".answer-btn").forEach(btn => btn.classList.add("correct"));
            } else {
                feedback.textContent = `Sai! Đáp án đúng là: ${correct.name}. \nMô tả: ${correct.description}`;
                feedback.style.color = "red";
                document.querySelectorAll(".answer-btn").forEach(btn => {
                    if (btn.textContent === correct.name) btn.classList.add("correct");
                    else btn.classList.add("wrong");
                });
            }
            feedback.style.display = "block";
            document.getElementById("next-btn").style.display = "block";
        }
        
        document.getElementById("next-btn").addEventListener("click", function() {
            currentIndex++;
            showQuestion();
        });
        
        startGame();
    </script>
</body>
</html>

    <h2>
    I.KỲ QUAN THIÊN NHIÊN
    </h2>
    <h3>
      1.Vịnh Hạ Long
    </h3>
    <img src="https://media.istockphoto.com/id/119379231/vi/anh/b%C3%A3i-bi%E1%BB%83n-v%E1%BB%8Bnh-h%E1%BA%A1-long-vi%E1%BB%87t-nam.jpg?s=2048x2048&w=is&k=20&c=cQYj3G1ynbbuHmDESzQcBfYKzSBc9nTJzLdsVhamVKI="
         width="600" 
     height="400"
         alt="">
    <p>
      Vịnh Hạ Long là một vịnh nhỏ thuộc phần bờ tây vịnh Bắc Bộ tại khu vực biển Đông Bắc Việt Nam, bao gồm vùng biển đảo của thành phố Hạ Long thuộc tỉnh Quảng Ninh.

Là trung tâm của một khu vực rộng lớn có những yếu tố ít nhiều tương đồng về địa chất, địa mạo, cảnh quan, khí hậu và văn hóa, với vịnh Bái Tử Long phía Đông Bắc và quần đảo Cát Bà phía Tây Nam, vịnh Hạ Long giới hạn trong diện tích khoảng 1.553 km² bao gồm 1.969 hòn đảo lớn nhỏ, phần lớn là đảo đá vôi, trong đó vùng lõi của vịnh có diện tích 335 km² quần tụ dày đặc 775 hòn đảo. Lịch sử kiến tạo địa chất đá vôi của vịnh đã trải qua khoảng 500 triệu năm với những hoàn cảnh cổ địa lý rất khác nhau; và quá trình tiến hóa karst đầy đủ trải qua trên 20 triệu năm với sự kết hợp các yếu tố như tầng đá vôi dày, khí hậu nóng ẩm và tiến trình nâng kiến tạo chậm chạp trên tổng thể.[1] Sự kết hợp của môi trường, khí hậu, địa chất, địa mạo, đã khiến vịnh Hạ Long trở thành quần tụ của đa dạng sinh học bao gồm hệ sinh thái rừng kín thường xanh mưa ẩm nhiệt đới và hệ sinh thái biển và ven bờ với nhiều tiểu hệ sinh thái.[2] 17 loài thực vật đặc hữu[3] và khoảng 60 loài động vật đặc hữu[4] đã được phát hiện trong số hàng ngàn động, thực vật quần cư tại vịnh.
    </p>
    <h3>
      2.Mù Căng chải
    </h3>
    <img src="https://yenbai.gov.vn/noidung/tintuc/PublishingImages/Thong-Tin-Tinh/Thang-Canh-Du-Lich/mu-cang-chi.jpg" alt="">
    <p>
      Mù Cang Chải là huyện vùng cao phía Tây của tỉnh Yên Bái, cách trung tâm thành phố Yên Bái 180km, cách thủ đô Hà Nội hơn 300km về phía Tây Bắc. Vùng đất này nằm dưới chân của dãy núi Hoàng Liên Sơn, ở độ cao trên 2.000m so với mặt biển. Đến Mù Cang Chải, du khách có thể đi đường Quốc lộ 32 bằng hai hướng. Nếu từ Hà Nội, sẽ lên Yên Bái, từ Yên Bái đến Mường Lò 70km, ngủ tại đây để sáng sớm mai đi xe từ Mường Lò, xế trưa sẽ đến Mù Cang Chải. Đoạn này dài gần 100km, nhưng hơn 80km là đường đèo dốc tiến lên liên tục, chừng nào leo đến độ cao 1.750m, sương mây mù mịt là sắp đến thị trấn Mù Cang Chải. Chặng giữa đèo có một miền đất phẳng, hãy nghỉ chân ở đây để thưởng thức thứ cơm lam nếp Tú Lệ dẻo thơm nức tiếng khắp vùng. Hướng thứ hai, du khách đi hết đường cao tốc Nội Bài - Lào Cai, lên Sa Pa và qua đèo Ô Quy Hồ, sau đó qua Tân Uyên và Than Uyên của Lai Châu để tới Mù Cang Chải.
    </p>
     <h3>
      3.Thác Bản Giốc
    </h3>
    <img src="https://images.vietnamtourism.gov.vn/vn//images/2019/CNMN/16.10._Thac_Ban_gioc_ve_dep_ky_vi_giua_non_nuoc_cao_bang_1.jpg" alt="">
    <p>
      Nằm ở vùng Đông Bắc Việt Nam với địa hình 90% là đồi núi hiểm trở, Cao Bằng trong thời kì trước là vùng đất được lực lượng cách mạng Việt Nam chọn làm căn cứ để làm việc và huấn luyện. Khi kháng chiến kết thúc, Cao Bằng trở thành một điểm du lịch lịch sử lẫn du lịch khám phá. Nơi đây nổi tiếng với cả khách du lịch trong nước lẫn nước ngoài với núi non trùng điệp, các thắng cảnh tự nhiên khá hoang sơ cùng vô số các di tích lịch sử, căn cứ địa còn sót lại sau chiến tranh. Một trong những điểm du lịch nổi tiếng và thu hút du khách nhất chính là thác Bản Giốc. Đây là một nhóm các thác nước nằm bên dòng sông Quây của Cao Bằng, được bao phủ với nhiều thắng cảnh văn hóa lẫn thắng cảnh tự nhiên. Nổi tiếng là vậy nhưng không phải ai cũng biết rõ thác Bản Giốc ở đâu, cách di chuyển hay các thông tin khi đi du lịch thác Bản Giốc. Nhưng đừng quá lo lắng vì chúng tôi sẽ cung cấp cho bạn tất tần tật các thông tin cần thiết về Thác Bản Giốc ngay dưới đây.


    </p>
    <h3>
      4.Hang Sơn Đòng
    </h3>
    <img src="https://oxalisadventure.com/uploads/2019/12/banner_sondoong1920x540__637110437124471008.jpg" alt="">
    <p>
      Sơn Đoòng là hang động lớn nhất hành tinh và cũng là hang động hùng vĩ nhất tại Việt Nam. Hang Sơn Đoòng được Hồ Khanh - một thợ rừng người Phong Nha, Quảng Bình phát hiện ra cửa hang vào năm 1990 và đến năm 2009 thì được nhóm thám hiểm hang động Anh-Việt (The British Vietnam Caving Expedition Team) do ông Howard Limbert dẫn đầu vào thám hiểm, khảo sát và đo vẽ. Hang Sơn Đoòng được nhóm thám hiểm cùng với tạp chí National Geographic công bố là hang động đá vôi tự nhiên lớn nhất thế giới năm 2009. Năm 2013, Hang Sơn Đoòng được tổ chức kỷ lục thế giới Guinness ghi nhận là hang động tự nhiên lớn nhất thế giới.
    </p>
    <h3>
      4.Núi Bà Đen
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Dau_Tieng_Lake_-_50766650163.png/420px-Dau_Tieng_Lake_-_50766650163.png" alt="">
    <p>
      Núi Bà Đen là ngọn núi lửa đã tắt nằm ở trung tâm tỉnh Tây Ninh, Việt Nam. Với độ cao 986 m, đây là ngọn núi cao nhất miền Nam Việt Nam hiện nay, được mệnh danh "Đệ nhất thiên sơn".[2][3]

Theo Gia Định thành thông chí, tên gốc của núi Bà Đen là Bà Dinh. Những bậc kỳ lão địa phương thì cho rằng tên gốc là núi Một. Đến khoảng nửa thế kỷ XVIII mới xuất hiện tên gọi núi Bà Đênh, sau gọi trại dần thành núi Bà Đen. Cũng có người gọi là núi Điện Bà.[4] Trong Chiến tranh Việt Nam, khu vực xung quanh núi là một điểm nóng khi là nơi đường mòn Hồ Chí Minh kết thúc và cách biên giới Campuchia vài km về phía Tây.[5]

Khu vực này thực chất là một cụm gồm ba núi nằm liền kề nhau là Núi Bà Đen (còn được gọi tắt là Núi Bà), Núi Heo và Núi Phụng trên tổng diện tích 24 km².[6] Quần thể Núi Bà Đen được Bộ Văn hóa (nay là Bộ Văn hóa, Thể thao và Du lịch) công nhận là di tích lịch sử và danh thắng cấp quốc gia vào ngày 21 tháng 1 năm 1989
    </p>
    <h2>
      II.Di tích lịch sử
    </h2>
    <h3>
    1.Chùa Một Cột
    </h3>
    <img src="https://statics.vinpearl.com/chua-mot-cot-0_1685367087.jpg" alt="">
    <p>
      Chùa Một Cột có tên ban đầu là Liên Hoa Đài (蓮花臺)[1][2][3] tức là Đài Hoa Sen với lối kiến trúc độc đáo: một điện thờ đặt trên một cột trụ duy nhất. Liên Hoa Đài là công trình nổi tiếng nhất nằm trong quần thể kiến trúc Chùa Diên Hựu (延祐寺)[1][4], có nghĩa là ngôi chùa "Phúc lành dài lâu". Công trình Chùa Diên Hựu nguyên bản được xây vào thời vua Lý Thái Tông mùa đông năm 1049[5] và hoàn thiện vào năm 1105 thời vua Lý Nhân Tông[6] nay đã không còn. Công trình Liên Hoa Đài hiện tại nằm ở Hà Nội là một phiên bản được chỉnh sửa nhiều lần qua các thời kỳ, bị Pháp phá huỷ khi rút khỏi Hà Nội ngày 11/9/1954[7][8][9][10] và được dựng lại năm 1955 bởi kiến trúc sư Nguyễn Bá Lăng theo kiến trúc để lại từ thời Nguyễn. Đây là ngôi chùa có kiến trúc độc đáo ở Việt Nam.
    </p>
    <h3>
      2.Hoàng Thành Thăng Long
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Main_Gate_-_Citadel_of_Hanoi.jpg/390px-Main_Gate_-_Citadel_of_Hanoi.jpg" alt="">
    <p>
       theo giờ địa phương tại Brasil, tức 6 giờ 30 ngày 1/8/2010 theo giờ Việt Nam, Ủy ban di sản thế giới (WHC) thuộc Tổ chức Giáo dục, Khoa học và Văn hóa Liên Hợp Quốc (UNESCO) đã thông qua nghị quyết công nhận khu Trung tâm Hoàng thành Thăng Long - Hà Nội là di sản Văn hóa thế giới.[1] Những giá trị nổi bật toàn cầu của khu di sản này được ghi nhận bởi 3 đặc điểm nổi bật: chiều dài lịch sử văn hóa suốt 13 thế kỷ; tính liên tục của di sản với tư cách là một trung tâm quyền lực, và các tầng di tích di vật đa dạng, phong phú, sinh động.[
    </p>
    <h3>
      3.Kinh đô Hoa Lư
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Co_do_Hoa_Lu_113.JPG/420px-Co_do_Hoa_Lu_113.JPG" alt="">
    <p>
      Cố đô Hoa Lư (chữ Hán: 華閭) là kinh đô của Việt Nam trong giai đoạn 968-1010. Đây là kinh đô đầu tiên của nhà nước phong kiến Trung ương tập quyền ở Việt Nam và là quê hương của vị Anh hùng dân tộc Đinh Bộ Lĩnh.[1] Kinh đô Hoa Lư tồn tại 42 năm, gắn với sự nghiệp của ba triều đại liên tiếp là nhà Đinh, nhà Tiền Lê và nhà Lý với các dấu ấn lịch sử: thống nhất đất nước, đánh Tống - dẹp Chiêm và phát tích quá trình định đô Hà Nội. Năm 1010 vua Lý Thái Tổ dời kinh đô từ Hoa Lư (Ninh Bình) về Thăng Long (Hà Nội), Hoa Lư trở thành Cố đô. Các triều vua Lý, Trần, Lê, Nguyễn sau đó dù không đóng đô ở Hoa Lư nữa nhưng vẫn cho tu bổ và xây dựng thêm ở đây nhiều công trình kiến trúc như đền, lăng, đình, chùa, phủ,...[2] Hiện nay, Cố đô Hoa Lư vẫn còn nhiều di tích nằm trong Quần thể di sản thế giới Tràng An thuộc địa bàn tỉnh Ninh Bình.
    </p>
    <h3>
      4.Quốc Tử Giám
    </h3>
    <img src="https://statics.vinpearl.com/van-mieu-quoc-tu-giam-01_1682005307.jpg" alt="">
    <p>
      Văn Miếu – Quốc Tử Giám là quần thể di tích đa dạng, phong phú hàng đầu của thành phố Hà Nội, nằm ở phía Nam kinh thành Thăng Long. Quần thể kiến trúc Văn Miếu – Quốc Tử Giám bao gồm: hồ Văn, khu Văn Miếu – Quốc Tử Giám và vườn Giám, mà kiến trúc chủ thể là Văn miếu (chữ Hán: 文廟) - nơi thờ Khổng Tử, và Quốc tử giám (chữ Hán: 國子監) - trường đại học đầu tiên của Việt Nam. Khu Văn Miếu – Quốc Tử Giám có tường gạch vồ bao quanh, phía trong chia thành 5 lớp không gian với các kiến trúc khác nhau. Mỗi lớp không gian đó được giới hạn bởi các tường gạch có 3 cửa để thông với nhau (gồm cửa chính giữa và hai cửa phụ hai bên). Từ ngoài vào trong có các cổng lần lượt là: cổng Văn Miếu, Đại Trung, Khuê Văn các, Đại Thành và cổng Thái Học.[1] Với hơn 700 năm hoạt động đã đào tạo hàng nghìn nhân tài cho đất nước. Ngày nay, Văn Miếu – Quốc Tử Giám là nơi tham quan của du khách trong và ngoài nước đồng thời cũng là nơi khen tặng cho học sinh xuất sắc và còn là nơi tổ chức hội thơ hàng năm vào ngày rằm tháng giêng. Đặc biệt, đây còn là nơi các sĩ tử ngày nay đến "cầu may" trước mỗi kỳ thi quan trọng.
    </p>
    <h3>
      5.Thành nhà Hồ
    </h3>
    <img src="https://statics.vinpearl.com/thanh-nha-ho--2_1629195660.jpg" alt="">
    <p>
      Thành nhà Hồ (hay còn gọi là thành Tây Đô, thành An Tôn, thành Tây Kinh hay thành Tây Giai) là kinh đô nước Đại Ngu (quốc hiệu của Việt Nam dưới thời nhà Hồ), nằm trên địa phận tỉnh Thanh Hóa. Đây là tòa thành kiên cố với kiến trúc độc đáo bằng đá có quy mô lớn hiếm hoi ở Việt Nam, có giá trị và độc đáo nhất, duy nhất còn lại ở tại Đông Nam Á và là một trong rất ít những thành lũy bằng đá còn lại trên thế giới[1]. Thành được xây dựng trong thời gian ngắn, chỉ khoảng 3 tháng (từ tháng Giêng đến tháng 3 năm 1397) và cho đến nay, dù đã tồn tại hơn 6 thế kỷ nhưng một số đoạn của tòa thành này còn lại tương đối nguyên vẹn.

Ngày 27 tháng 6 năm 2011, sau 6 năm đệ trình hồ sơ, Thành nhà Hồ đã được UNESCO công nhận là di sản văn hóa thế giới, thành cũng được CNN đánh giá là một trong 21 di sản nổi bật và vĩ đại nhất thế giới[2]. Hiện nay, nơi đây đã được thủ tướng chính phủ Việt Nam đưa vào danh sách xếp hạng 62 di tích quốc gia đặc biệt. Từ tháng 12 năm 2018 đến tháng 6 năm 2020, Quỹ Bảo tồn Văn hóa của Đại sứ Hoa Kỳ (AFCP) đã tài trợ 92,500 USD vào dự án bảo tồn Cổng Nam, Thành nhà Hồ.[3]
    </p>
    <h3>
      6.Cố đô Huế
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cc/Ngomon2.jpg/405px-Ngomon2.jpg" alt="">
    <p>
      Cố đô Huế, còn gọi là Phú Xuân, là thủ phủ Đàng Trong dưới thời các chúa Nguyễn từ năm 1687 đến 1774, sau đó là thủ đô của triều đại Tây Sơn từ năm 1788 khi Hoàng đế Quang Trung tức Nguyễn Huệ lên ngôi. Khi Nguyễn Ánh lên ngôi vào năm 1802 lấy niên hiệu là Gia Long, ông cũng chọn thành Phú Xuân làm kinh đô cho nhà Nguyễn – triều đại phong kiến cuối cùng trong lịch sử Việt Nam. Huế kết thúc sứ mệnh là thủ đô Việt Nam vào năm 1945 khi vị hoàng đế cuối cùng của nhà Nguyễn là Bảo Đại thoái vị
    </p>
    <h3>
      7.Đền Hùng
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Mausoleum_of_Hung_King.JPG/375px-Mausoleum_of_Hung_King.JPG" alt="">
    <p>
      Đền Hùng (Tên chữ: Hùng Vương miếu) là tên gọi khái quát của Khu di tích lịch sử Đền Hùng - quần thể đền chùa thờ phụng các Vua Hùng và tôn thất của nhà vua trên núi Nghĩa Lĩnh (Việt Trì, Phú Thọ), xưa thuộc xã Hy Cương, huyện Sơn Vi, gắn với Giỗ Tổ Hùng Vương - Lễ hội Đền Hùng được tổ chức tại địa điểm đó hàng năm vào ngày 10 tháng 3 âm lịch. Hiện nay, theo các tài liệu khoa học đã công bố đa số đều thống nhất nền móng kiến trúc đền Hùng bắt đầu được xây dựng từ thời vua Đinh Tiên Hoàng trị vì. Đến thời Hậu Lê (thế kỷ 15) được xây dựng hoàn chỉnh theo quy mô như hiện tại.

Từ chân núi đi lên, qua cổng đền, điểm dừng chân của du khách là đền Hạ, tương truyền là nơi nàng Âu Cơ đẻ ra bọc trăm trứng. Trăm trứng ấy đẻ ra trăm người con, năm mươi người theo cha xuống biển, bốn chín người theo mẹ lên núi. Người con ở lại làm vua, lấy tên là Hùng Vương (thứ nhất).

Qua đền Hạ là đền Trung, nơi các vua Hùng dùng làm nơi họp bàn với các Lạc hầu, Lạc tướng. Trên đỉnh núi là đền Thượng là lăng Hùng Vương thứ sáu (trong dân gian gọi là mộ tổ) từ đền Thượng đi xuống phía Tây nam là đền Giếng, nơi có cái giếng đá quanh năm nước trong vắt. Tương truyền ngày xưa các công chúa Tiên Dung và Ngọc Hoa, con vua Hùng Vương thứ mười tám, thường tới gội đầu tại đó.

Lễ hội đền Hùng bao gồm những hoạt động văn hóa, văn nghệ mang tính chất nghi thức truyền thống và những hoạt động văn hóa dân gian khác… Các hoạt động văn hóa mang tính chất nghi thức còn lại đến ngày nay là lễ rước kiệu vua và lễ dâng hương. Đó là hai nghi lễ được cử hành đồng thời trong ngày chính hội. Đám rước kiệu xuất phát từ dưới chân núi rồi lần lượt qua các đền để tới đền Thượng, nơi làm lễ dâng hương. Đó là một đám rước tưng bừng những âm thanh của các nhạc cụ cổ truyền và màu sắc sặc sỡ của bạt ngàn cờ, hoa, lọng, kiệu, trang phục truyền thống… Dưới tán lá mát rượi của những cây trò, cây mỡ cổ thụ và âm vang trầm bổng của trống đồng, đám rước như một con rồng uốn lượn trên những bậc đá huyền thoại để tới đỉnh núi Thiêng.[3][4][5][6]
    </p>
    <h3>
      8.Cột cờ hà Nội
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/Flag_tower%2C_Hanoi.jpg/360px-Flag_tower%2C_Hanoi.jpg" alt="">
    <p>
     Cột cờ Hà Nội hay còn gọi Kỳ đài Hà Nội là một kết cấu dạng tháp được xây dựng cùng thời với thành Hà Nội dưới triều nhà Nguyễn (bắt đầu năm 1805, hoàn thành năm 1812). Kiến trúc cột cờ bao gồm ba tầng đế và một thân cột, được coi là một trong những biểu tượng của thành phố. 
    </p>
    <h3>
      9.Nhà tù côn Đảo
    </h3>
    <img src="https://ik.imagekit.io/tvlk/blog/2023/09/nha-tu-con-dao-6.jpeg?tr=q-70,c-at_max,w-500,h-300,dpr-2" alt="">
    <p>
      Nhà tù Côn Đảo là một khu nhà tù tại Côn Đảo. Hệ thống nhà tù này được người Pháp xây dựng để giam giữ những tù phạm đặc biệt nguy hiểm cho chế độ thực dân Pháp như: tù phạm chính trị, tử tù... Nơi đây thời Pháp thuộc đã giam giữ những nhân vật tham gia các phong trào cách mạng và những người ái quốc chống lại chính phủ thuộc địa, và sau đó lại được Mỹ sử dụng để giam cầm tù binh trong cuộc chiến chống Mỹ. Hiện nay, nơi đây đã được thủ tướng chính phủ Việt Nam đưa vào danh sách xếp hạng 23 di tích quốc gia đặc biệt. Địa điểm nổi tiếng nhất trong khu nhà tù này là "chuồng cọp". Đây là nơi ghi lại những hành động ngược đãi tù nhân nghiêm trọng của thực dân Pháp, quân đội Mỹ và chế độ Quốc gia Việt Nam/Việt Nam Cộng hòa.[1]
    </p>
    <h3>
      10.thành cổ Quảng Trị
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/34._Quang_Tri_Citadel_and_City_looking_South_Fall_1967.jpg/330px-34._Quang_Tri_Citadel_and_City_looking_South_Fall_1967.jpg" alt="">
    <p>
      Theo tài liệu thì vào đầu thời Gia Long, thành Quảng Trị được xây dựng tại phường Tiền Kiên (Triệu Thành - Triệu Phong), đến năm 1809, vua Gia Long cho dời đến xã Thạch Hãn (tức vị trí ngày nay, thuộc phường 2, thị xã Quảng Trị).[1] Ban đầu thành được đắp bằng đất, tới năm 1837 vua Minh Mạng cho xây lại bằng gạch. Thành có dạng hình vuông, chu vi tường thành là hơn 2.000 m, cao hơn 4 m, dưới chân dày hơn 12 m, bao quanh có hệ thống hào, bốn góc thành là 4 pháo đài nhô hẳn ra ngoài. Thành được xây theo lối kiến trúc thành trì Việt Nam với tường thành bao quanh hình vuông được làm từ gạch nung cỡ lớn; kết dính bằng vôi, mật mía và một số phụ gia khác trong dân gian. Thành trổ bốn cửa chính ở các phía Đông, Tây, Nam, Bắc.
    </p>
    <h3>
      11.Lăng Chủ Tịch
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fd/L%C4%83ng_B%C3%A1c_-_NKS.jpg/450px-L%C4%83ng_B%C3%A1c_-_NKS.jpg" alt="">
    <p>
     Lăng Chủ tịch Hồ Chí Minh, còn gọi là Lăng Hồ Chủ tịch, Lăng Bác, là nơi gìn giữ thi hài Chủ tịch Hồ Chí Minh. Lăng được chính thức khởi công ngày 2 tháng 9 năm 1973, tại vị trí lễ đài cũ giữa Quảng trường Ba Đình, nơi Chủ tịch Hồ Chí Minh từng chủ trì các cuộc gặp mặt quan trọng.

Lăng được khánh thành vào ngày 29 tháng 8 năm 1975, gồm 3 lớp với chiều cao 21,6 m, chiều rộng 41,2 m; lớp dưới tạo dáng bậc thềm tam cấp, lớp giữa là kết cấu trung tâm của lăng gồm phòng thi hài và những hành lang, những cầu thang. Bên ngoài lăng được ốp bằng đá granite xám, bên trong làm bằng đá xám và đỏ được đánh bóng. Quanh 4 mặt là những hàng cột vuông bằng đá hoa cương, lớp trên cùng là mái lăng hình tam cấp. Ở mặt chính có dòng chữ: "CHỦ TỊCH HỒ-CHÍ-MINH" bằng đá hồng màu mận chín. Xung quanh lăng là các khu vườn nơi hơn 250 loài thực vật được trồng từ khắp mọi miền của Việt Nam.

Trong di chúc, Chủ tịch Hồ Chí Minh muốn được hỏa táng và đặt tro tại 3 miền đất nước.[1] Tuy nhiên với lý do tuân theo nguyện vọng và tình cảm của người dân, Bộ Chính trị Ban Chấp hành Trung ương Đảng khóa III quyết định giữ gìn lâu dài thi hài chủ tịch Hồ Chí Minh để sau này người dân cả nước, nhất là người dân miền Nam, du khách quốc tế có thể tới viếng.[2][3] 
    </p>
    <h2>
      III.Du lịch
    </h2>
    <h3>
      1.Chùa Hương
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/Ch%C3%B9a_H%C6%B0%C6%A1ng.jpg/375px-Ch%C3%B9a_H%C6%B0%C6%A1ng.jpg" alt="">
    <p>
      Chùa Hương (cách gọi dân gian) hay Hương Sơn là một quần thể văn hóa - tôn giáo của Việt Nam, gồm hàng chục ngôi chùa thờ Phật, các ngôi đền thờ Thần và các ngôi đình thờ tín ngưỡng nông nghiệp. Trung tâm của cụm đình đền chùa này là chùa Hương (tức chùa Trong) nằm trong động Hương Tích ở hữu ngạn sông Đáy, thuộc xã Hương Sơn, huyện Mỹ Đức, Hà Nội. Quần thể Hương Sơn là một trong 21 Khu du lịch Quốc gia của Việt Nam và là Di tích Quốc gia Đặc biệt theo quyết định 2082/QĐ-TTg năm 2017.[1]
    </p>
    <h3>
      2. Chợ Bến Thành
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Ben_Thanh_market_2.jpg/420px-Ben_Thanh_market_2.jpg" alt="">
    <p>
      Chợ Bến Thành là một ngôi chợ nằm tại Quận 1, Thành phố Hồ Chí Minh. Chợ được khởi công xây dựng từ năm 1912, hình ảnh đồng hồ ở cửa nam của ngôi chợ này được xem là biểu tượng không chính thức của Thành phố Hồ Chí Minh.

Chợ nằm giữa các đường Phan Bội Châu - Phan Chu Trinh - Lê Thánh Tôn - Công trường Quách Thị Trang tại phường Bến Thành với diện tích 13.056 m². Các ngành hàng kinh doanh chủ yếu ở đây bao gồm: quần áo, vải sợi, giày dép, thời trang, hàng thủ công mỹ nghệ, thực phẩm tươi sống, trái cây, hoa tươi,...

Thời kì đầu của những năm thành lập, chợ Bến Thành đã có từ trước cả khi người Pháp xâm chiếm Gia Định. Ban đầu, vị trí của chợ nằm bên bờ sông Bến Nghé, cạnh một bến sông gần thành Gia Định (bấy giờ là thành Quy, còn gọi là thành Bát Quái). Bến này dùng để cho hành khách vãng lai và quân nhân vào thành, vì vậy mới có tên gọi là Bến Thành, và khu chợ cũng có tên gọi là chợ Bến Thành - tên gọi chính thức vẫn được sử dụng cho đến ngày nay.
    </p>
    <h3>
      3.Thánh Địa Mỹ Sơn
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/2024_-_M%E1%BB%B9_S%C6%A1n_Group_B%2C_C_and_D_-_img_23.jpg/432px-2024_-_M%E1%BB%B9_S%C6%A1n_Group_B%2C_C_and_D_-_img_23.jpg" alt="">
    <p>
      Thánh địa Mỹ Sơn thuộc xã Duy Phú, huyện Duy Xuyên, tỉnh Quảng Nam, cách thành phố Đà Nẵng khoảng 69 km và gần thành cổ Trà Kiệu, bao gồm nhiều đền đài Chăm Pa, trong một thung lũng đường kính khoảng 2 km, bao quanh bởi đồi núi. Đây từng là nơi tổ chức cúng tế của vương triều Chăm Pa. Thánh địa Mỹ Sơn được coi là một trong những trung tâm đền đài chính của Ấn Độ giáo ở khu vực Đông Nam Á và là di sản duy nhất của thể loại này tại Việt Nam.

Thông thường người ta hay so sánh Thánh địa này với các tổ hợp đền đài chính khác ở Đông Nam Á như Borobudur (Java, Indonesia), Pagan (Myanmar), Wat Phou (Lào), Angkor Wat (Campuchia) và Prasat Hin Phimai (Thái Lan). Từ năm 1999, Thánh địa Mỹ Sơn đã được UNESCO chọn là một trong các di sản thế giới tân thời và hiện đại tại phiên họp thứ 23 của Ủy ban di sản thế giới theo tiêu chuẩn C (III) như là một ví dụ điển hình về trao đổi văn hoá và theo tiêu chuẩn C (III) như là bằng chứng duy nhất của nền văn minh châu Á đã biến mất. Hiện nay, nơi đây đã được thủ tướng chính phủ Việt Nam đưa vào danh sách xếp hạng 23 di tích quốc gia đặc biệt quan trọng.
    </p>
    <h3>
      4.Cầu Rồng
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/19/Dragon_bridge_from_above.png/420px-Dragon_bridge_from_above.png" alt="">
    <p>
      Cầu Rồng là cây cầu thứ 6 và là cây cầu mới nhất bắc qua sông Hàn.[1] Vì cây cầu có hình dáng giống một con rồng nên được gọi là Cầu Rồng

Cầu Rồng dài 666 m và rộng 37,5 m với 6 làn xe chạy. Cầu được khởi công xây dựng vào ngày 19/7/2009 và chính thức thông xe ngày 29 tháng 3 năm 2013, kinh phí xây cầu gần 1,5 nghìn tỷ đồng (US$88m).[2] Cầu được thiết kế bởi Ammann & Whitney Consulting Engineers với tập đoàn Louis Berger. Việc xây dựng được thực hiện bởi Tổng công ty xây dựng công trình giao thông 1.

Cây cầu hiện đại này bắc qua sông Hàn tại bùng binh (cũ) Lê Đình Dương/Bạch Đằng, tạo con đường ngắn nhất từ sân bay quốc tế Đà Nẵng tới các đường chính trong thành phố Đà Nẵng, và một tuyến đường trực tiếp đến bãi biển Mỹ Khê và bãi biển Non Nước ở rìa phía đông của thành phố. Cầu được thiết kế và xây dựng với hình dạng của một con rồng có khả năng phun lửa và phun nước.[3] Hiện tại, thời gian phun lửa và phun nước bắt đầu vào lúc 21 giờ các ngày thứ sáu, thứ bảy, Chủ nhật hàng tuần và các ngày lễ lớn.[4]
    </p>
    <h3>
      5.Lễ hội Gióng
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/54/Cong_chinh_den_Phu_Dong_%282%29.JPG/401px-Cong_chinh_den_Phu_Dong_%282%29.JPG" alt="">
    <p>
      Lễ Hội Gióng là một lễ hội truyền thống hàng năm ở nhiều nơi thuộc vùng Hà Nội để tưởng niệm và ca ngợi chiến công của người anh hùng truyền thuyết Thánh Gióng, một trong tứ bất tử của tín ngưỡng dân gian Việt Nam.

Có 2 hội Gióng[1] tiêu biểu ở Hà Nội là hội Gióng Sóc Sơn ở đền Sóc xã Phù Linh, huyện Sóc Sơn và hội Gióng Phù Đổng ở đền Phù Đổng, xã Phù Đổng, huyện Gia Lâm đã được UNESCO ghi danh là di sản văn hóa phi vật thể của nhân loại.[2][3] Ngoài ra còn hơn 10 hội Gióng cũng thuộc địa bàn Hà Nội (gọi là vùng lan tỏa vì chưa được UNESCO ghi danh) như: hội Gióng Bộ Đầu xã Thống Nhất, huyện Thường Tín; lễ hội thờ Thánh Gióng ở các làng Đổng Xuyên, Chi Nam (huyện Gia Lâm); các làng Phù Lỗ Đoài, Thanh Nhàn, Xuân Lai (huyện Sóc Sơn); Sơn Du, Cán Khê, Đống Đồ (huyện Đông Anh); Xuân Tảo (Phường Xuân Đỉnh, Quận Bắc Từ Liêm); làng Hội Xá (Quận Long Biên).

Giá trị nổi bật toàn cầu ở hội Gióng chính là một hiện tượng văn hóa được bảo lưu, trao truyền khá liên tục và toàn vẹn qua nhiều thế hệ. Mặc dù ở gần trung tâm thủ đô và đời sống cộng đồng trải qua nhiều biến động do chiến tranh, do sự xâm nhập và tiếp biến văn hóa, hội Gióng vẫn tồn tại một cách độc lập và bền vững, không bị nhà nước hóa, thương mại hóa.[4]
    </p>
    <h3>
      6.Bảo tàng chứng tích chiến tranh
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Vietnam-_War_Remnants_Museum.jpg/330px-Vietnam-_War_Remnants_Museum.jpg" alt="">
    <p>
      Bảo tàng Chứng tích Chiến tranh (War Remnants Museum) là một bảo tàng vì hòa bình ở số 28 đường Võ Văn Tần, Phường Võ Thị Sáu, Quận 3, Thành phố Hồ Chí Minh. Bảo tàng Chứng tích Chiến tranh trực thuộc Sở Văn hóa và Thể thao Thành phố Hồ Chí Minh, là thành viên của hệ thống Bảo tàng vì hòa bình thế giới và Hội đồng các bảo tàng thế giới (ICOM). Bảo tàng Chứng tích Chiến tranh là Bảo tàng chuyên đề nghiên cứu, sưu tầm, lưu trữ, bảo quản và trưng bày những tư liệu, hình ảnh, hiện vật về những chứng tích tội ác và hậu quả của các cuộc chiến tranh mà các thế lực xâm lược đã gây ra đối với Việt Nam. Qua đó, Bảo tàng tuyên truyền về tinh thần đấu tranh bảo vệ độc lập tự do của Tổ quốc, về ý thức chống chiến tranh xâm lược, bảo vệ hòa bình và tinh thần đoàn kết hữu nghị giữa các dân tộc trên thế giới. Bảo tàng lưu giữ hơn 20.000 tài liệu, hiện vật và phim ảnh, trong đó hơn 1.500 tài liệu, hiện vật, phim ảnh đã được đưa vào giới thiệu ở 8 chuyên đề trưng bày thường xuyên.


Bảo tàng Chứng tích Chiến tranh và Cơ quan Phát triển Quốc tế Hoa Kỳ (USAID) đã ký kết Bản ghi nhớ hợp tác thực hiện phòng trưng bày tại Bảo tàng Chứng tích Chiến tranh về những nỗ lực chung của hai nước Việt Nam và Hoa Kỳ khắc phục hậu quả chiến tranh, chiều 10/4/2023.
Từ nhiều năm qua, Bảo tàng Chứng tích Chiến tranh là một trong những điểm tham quan thu hút lượng khách đông nhất ở TPHCM và cả nước.[1] Qua 48 năm hình thành và phát triển (1975 - 2023), Bảo tàng đã đón tiếp hơn 23 triệu lượt khách tham quan, trong đó có hơn 11 triệu lượt khách quốc tế và hơn 2 triệu lượt khách tham quan triển lãm lưu động. Hiện nay Bảo tàng Chứng tích Chiến tranh thu hút trên 1 triệu lượt khách tham quan mỗi năm.[2]
    </p>
    <h3>
      7.Cầu hiền Lương
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/3/31/Benhairiver1.jpg" alt="">
    <p>
      Cầu Hiền Lương bắc qua sông Bến Hải, tại thôn Hiền Lương, xã Hiền Thành, huyện Vĩnh Linh, tỉnh Quảng Trị, Việt Nam. Cũng tại nơi đây, đã từng diễn ra những cuộc "chọi loa", "chọi cờ" quyết liệt trong Chiến tranh Việt Nam[1][2]. Thời kỳ đó, cầu Hiền Lương là cây cầu bắc qua sông Bến Hải nơi mà chính là vùng biên giới chia cắt Việt Nam thành hai miền dọc theo vĩ tuyến 17: Miền Bắc do nước Việt Nam Dân chủ Cộng hòa quản lý, miền Nam do phía Quốc gia Việt Nam và sau đó là nước Việt Nam Cộng hoà rồi nước Cộng hòa Miền Nam Việt Nam quản lý, trong suốt gần 22 năm, từ năm 1954 đến năm 1976.
    </p>
    <h3>
      8.Phố cổ Hội An
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/HoiAnOldQuarter.jpg/390px-HoiAnOldQuarter.jpg" alt="">
    <p>
      Phố cổ Hội An là một đô thị cổ nằm ở hạ lưu sông Thu Bồn, thuộc vùng đồng bằng ven biển tỉnh Quảng Nam, Việt Nam, cách thành phố Đà Nẵng khoảng 30 km về phía Nam. Nhờ những yếu tố địa lý và khí hậu thuận lợi, Hội An từng là một thương cảng quốc tế sầm uất, nơi gặp gỡ của những thuyền buôn Nhật Bản, Trung Quốc và phương Tây trong suốt thế kỷ XVII và XVIII. Trước thời kỳ này, nơi đây cũng từng có những dấu tích của thương cảng Chăm Pa hay được nhắc đến cùng con đường tơ lụa trên biển. Thế kỷ XIX, do giao thông đường thủy ở đây không còn thuận tiện, cảng thị Hội An dần suy thoái, nhường chỗ cho Đà Nẵng khi đó đang được người Pháp xây dựng. Hội An may mắn không bị tàn phá trong hai cuộc chiến tranh và tránh được quá trình đô thị hóa ồ ạt cuối thế kỷ 20. Bắt đầu từ thập niên 1980, những giá trị kiến trúc và văn hóa của phố cổ Hội An dần được giới học giả và cả du khách chú ý, khiến nơi đây trở thành một trong những điểm du lịch hấp dẫn của Việt Nam.

Đô thị cổ Hội An ngày nay là một điển hình đặc biệt về cảng thị truyền thống ở Đông Nam Á được bảo tồn nguyên vẹn và chu đáo. Phần lớn những ngôi nhà ở đây là những kiến trúc truyền thống có niên đại từ thế kỷ 17 đến thế kỷ 19, phân bố dọc theo những trục phố nhỏ hẹp. Nằm xen kẽ giữa các ngôi nhà phố, những công trình kiến trúc tôn giáo, tín ngưỡng minh chứng cho quá trình hình thành, phát triển và cả suy tàn của đô thị. Hội An cũng là vùng đất ghi nhiều dấu ấn của sự pha trộn, giao thoa văn hóa. Các hội quán, đền miếu mang dấu tích của người Hoa nằm bên những ngôi nhà phố truyền thống của người Việt và những ngôi nhà mang phong cách kiến trúc Pháp. Bên cạnh những giá trị văn hóa qua các công trình kiến trúc, Hội An còn lưu giữ một nền văn hóa phi vật thể đa dạng và phong phú. Cuộc sống thường nhật của cư dân phố cổ với những phong tục tập quán, sinh hoạt tín ngưỡng, nghệ thuật dân gian, lễ hội văn hóa vẫn đang được bảo tồn và phát triển. Hội An được xem như một bảo tàng sống về kiến trúc và lối sống đô thị.
    </p>
    <h3>
      9.Nhà thờ Đức Bà
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/Inside_Notre_Dame_Cathedral%2C_Ho_Chi_Minh_City%2C_Vietnam_%283371553898%29.jpg/330px-Inside_Notre_Dame_Cathedral%2C_Ho_Chi_Minh_City%2C_Vietnam_%283371553898%29.jpg" alt="">
    <p>
      Nhà thờ chính tòa Đức Bà Sài Gòn (hay Vương cung thánh đường chính tòa Đức Mẹ Vô nhiễm Nguyên tội, tiếng Anh: Immaculate Conception Cathedral Basilica, tiếng Pháp: Cathédrale Notre-Dame de Saïgon), thường được gọi tắt là Nhà thờ Đức Bà, là nhà thờ chính tòa của Tổng giáo phận Sài Gòn.[2]

Nhà thờ không chỉ là biểu tượng của Công giáo ở Việt Nam, mà còn là một trong những công trình kiến trúc độc đáo của Thành phố Hồ Chí Minh và điểm đến nổi tiếng với du khách.[3] Tên gọi ban đầu của nhà thờ là Nhà thờ Sài Gòn (tiếng Pháp: l'eglise de Saïgon), tên gọi Nhà thờ Đức Bà bắt đầu được sử dụng từ năm 1959 bằng việc đặt Tượng Đức Bà Hòa Bình trước khuôn viên.

Nhà thờ là nơi tấn phong nhiều giám mục, đón tiếp các đại diện Tòa thánh Rôma, nhậm chức của các Tổng giám mục và cũng là nơi thụ phong của hàng ngàn linh mục.
    </p>
    <h3>
      10.Cổng trời SAPA
    </h3>
    <img src="https://ik.imagekit.io/tvlk/blog/2023/08/cong-troi-sapa-6.jpg?tr=q-70,c-at_max,w-500,h-300,dpr-2" alt="">
    <p>
      Cổng trời Sapa nằm trên đỉnh đèo Ô Quy Hồ, nếu từ trung tâm Sapa du khách sẽ đi qua lần lượt các địa điểm Thác Bạc, Trạm Tôn, Thác Tình Yêu theo lối quốc lộ 4D đi Lai Châu và sẽ đến với Cổng trời Sapa. Nằm ở đỉnh đèo Ô Quy Hồ - một trong tứ đại đỉnh đèo của Việt Nam nên trong quá trình đi đến Cổng trời Sapa, mọi người sẽ cảm nhận được vẻ đẹp hùng vĩ của đỉnh Fansipan, bên dưới là những rặng nguyên sinh bao phủ đất đá chứa đựng vẻ huyền bí. Ngoài ra, từ đoạn Thác Bạc hướng lên Cổng trời du khách cũng sẽ được chiêm ngưỡng những thửa ruộng bậc thang vùng rẻo cao Tây Bắc.
    </p>
    <h3>
      11.Chùa Thiên Mụ
    </h3>
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/26/Thi%C3%AAn_M%E1%BB%A5_Pagoda.jpg/1280px-Thi%C3%AAn_M%E1%BB%A5_Pagoda.jpg" alt="">
    <p>Chùa Thiên Mụ hay còn gọi là chùa Linh Mụ là một ngôi chùa cổ nằm trên đồi Hà Khê, tả ngạn sông Hương, cách trung tâm thành phố Huế (Việt Nam) khoảng 5 km về phía tây. Chùa Thiên Mụ chính thức khởi lập năm Tân Sửu (1601), đời chúa Tiên Nguyễn Hoàng - vị chúa Nguyễn đầu tiên ở Đàng Trong.

Lịch sử

Bốn trụ biểu và các bậc thang dẫn lên chùa Thiên Mụ

Ảnh chụp tháp Phước Duyên, chùa Thiên Mụ vào năm 1930

Cổng tam quan của chùa Thiên Mụ đầu thế kỷ 20
Trước thời điểm khởi lập chùa, trên đồi Hà Khê có ngôi chùa cũng mang tên Thiên Mỗ hoặc Thiên Mẫu, là một ngôi chùa của người Chăm1.

Truyền thuyết kể rằng, khi chúa Nguyễn Hoàng vào làm Trấn thủ xứ Thuận Hóa kiêm trấn thủ Quảng Nam, ông đã đích thân đi xem xét địa thế ở đây nhằm chuẩn bị cho mưu đồ mở mang cơ nghiệp, xây dựng giang sơn cho dòng họ Nguyễn sau này. Trong một lần rong ruổi vó ngựa dọc bờ sông Hương ngược lên đầu nguồn, ông bắt gặp một ngọn đồi nhỏ nhô lên bên dòng nước trong xanh uốn khúc, thế đất như hình một con rồng đang quay đầu nhìn lại, ngọn đồi này có tên là đồi Hà Khê.

Người dân địa phương cho biết, nơi đây ban đêm thường có một bà lão mặc áo đỏ quần lục xuất hiện trên đồi, nói với mọi người: "Rồi đây sẽ có một vị chân chúa đến lập chùa để tụ linh khí, làm bền long mạch, cho nước Nam hùng mạnh". Vì thế, nơi đây còn được gọi là Thiên Mụ Sơn 2.

Tư tưởng lớn của chúa Nguyễn Hoàng dường như cùng bắt nhịp được với ý nguyện của dân chúng. Nguyễn Hoàng cả mừng, vào năm 1601 đã cho dựng một ngôi chùa trên đồi, ngoảnh mặt ra sông Hương, đặt tên là "Thiên Mụ".
      
    </p>
  </body>
</html>