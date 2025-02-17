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
