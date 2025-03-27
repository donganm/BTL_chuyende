-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 05:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `global`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `title`, `description`, `image`, `created_at`) VALUES
(1, 'World Heritage and Biodiversity', 'Biological diversity underpins ecosystem functioning and the provision of ecosystem services essential for human well-being. World Heritage properties are the most outstanding places on the planet and constitute a ...', '1.jpg', '2025-03-20 10:58:00'),
(2, 'UNESCO Urban Heritage Atlas: Cultural mapping for historic cities and settlements', 'The Urban Heritage Atlas is an atlas and an archive that documents and explains, visually, narratively and with analytical maps, the diversity and uniqueness of the world’s historic cities and settlements. As such, ...', '2.jpg', '2025-03-20 11:08:32'),
(3, 'World Heritage Cities Programme', 'The World Heritage Cities Programme is one of six thematic programmes formally approved and monitored by the World Heritage Committee. The programme concerns the development of a theoretical framework for urban ...', '3.jpg', '2025-03-20 11:08:32'),
(4, 'Capacity Building', 'Understanding, managing and conserving World Heritage properties requires up-to-date knowledge and well-honed skills. To help build the capacity of all stakeholders in World Heritage – whether they are ...', '4.jpg', '2025-03-20 11:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `link`, `image`) VALUES
(4, 'Chùa Một Cột', 'Ngôi chùa linh thiêng với kiến trúc độc đáo giữa lòng Hà Nội. và nhiều cái nữa', 'tintuc/chua-mot-cot.php', 'chua-mot-cot.jpg'),
(5, 'Phố cổ Hội An', 'Di sản thế giới với những ngôi nhà cổ kính và đèn lồng rực rỡ.', 'tintuc/hoi-an.php', 'hoi-an.jpg'),
(6, 'Huế', 'Cố đô nổi tiếng với những công trình lịch sử và nét đẹp văn hóa cung đình.', 'tintuc/hue.php', 'hue.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blog_articles`
--

CREATE TABLE `blog_articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_articles`
--

INSERT INTO `blog_articles` (`id`, `title`, `description`, `link`) VALUES
(23, 'Văn Miếu - Quốc Tử Giám', 'Văn Miếu - Quốc Tử Giám là biểu tượng của nền giáo dục Việt Nam, nơi tôn vinh các bậc hiền tài và lưu giữ những giá trị lịch sử quý báu.', 'view-blog.php?id=1740649717'),
(24, 'Vịnh Hạ Long', 'Vịnh Hạ Long là một di sản thiên nhiên thế giới được UNESCO công nhận, nổi tiếng với hàng nghìn hòn đảo đá vôi hùng vĩ. Cảnh quan kỳ thú, hệ sinh thái đa dạng cùng các truyền thuyết ly kỳ đã biến nơi đây thành một điểm du lịch hấp dẫn', 'view-blog.php?id=1740658880');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `article_type` enum('blog_article','post') NOT NULL DEFAULT 'post'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `username`, `content`, `created_at`, `user_id`, `post_id`, `article_type`) VALUES
(3, 23, 'Ẩn danh', 'ok', '2025-02-27 12:17:11', NULL, NULL, 'post'),
(4, 23, 'Ẩn danh', 'nice', '2025-02-27 12:17:18', NULL, NULL, 'post'),
(5, 23, 'Ẩn danh', 'ok nhé', '2025-02-27 12:28:47', NULL, NULL, 'post'),
(6, 24, 'Ẩn danh', '10đ', '2025-02-27 12:29:00', NULL, NULL, 'post'),
(14, NULL, '', 'heloo', '2025-03-25 09:10:07', NULL, 5, 'post'),
(15, NULL, 'Ẩn danh', 'xin chao', '2025-03-25 14:42:25', NULL, 5, 'post'),
(16, NULL, 'Ẩn danh', 'heloo', '2025-03-26 03:09:25', NULL, 5, 'post');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `date`, `description`, `image`) VALUES
(1, 'African Heritage Sites Facing Climate Change: Workshop 1', '2025-03-13', 'African Heritage Sites Facing Climate Change is a series of workshops and capacity-building sessions launched in partnership with the Foundation for the Safeguarding of Cultural Heritage in Rabat. This initiative is aimed at site managers, mentees, experts, representatives of civil society, institutional stakeholders, cultural heritage professionals, and young Africans. It seeks to address ...', '1.jpg'),
(2, 'International Conference on Heritage Authenticity in Africa', '2025-03-14', 'The International Conference on Heritage Authenticity in Africa will take place in Nairobi, Kenya, from 5 to 9 May 2025, with the aim of fostering an exchange of research, experience, knowledge, and observations. Event International Scientific Conference on Heritage Authenticity and Integrity in Africa 5 May 2025 - 8:00 am - 9 May 2025 - 6:00 pm Location:  Nairobi, Kenya Rooms: ...', '2.jpg'),
(3, 'Women. Heritage. Digital Technology – Action to Safeguard the World Heritage in Africa', '2025-03-15', 'From 6-8 March 2025, UNESCO is organising an event entitled \"Women. Heritage. Digital Technology\" in Dakar, Senegal. Held in conjunction of the International Women’s Day, this event celebrates the vital role of African women in safeguarding and promoting heritage, particularly through the use of digital technologies. Despite systemic barriers, including limited access to education, ...', '3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'ptvh', 't@t.com', 'Nice', '2025-02-27 12:02:30'),
(2, 'Dong Anh', 'dta@gmail.com', 'Good', '2025-03-05 16:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `UserId`, `title`, `content`, `image`, `created_at`) VALUES
(1, 1, 'cầu monstar', 'Trong cuộc xung đột ở Nam Tư cũ, cầu Mostar đã bị phá hủy hoàn toàn. Việc tái sinh cây cầu là một bư...', '1.jpg', '2025-03-24 04:02:53'),
(2, 1, 'cầu monstar', 'Trong cuộc xung đột ở Nam Tư cũ, cầu Mostar đã bị phá hủy hoàn toàn. Việc tái sinh cây cầu là một bư...', '1.jpg', '2025-03-24 04:11:19'),
(3, 1, 'cầu monstar', 'Trong cuộc xung đột ở Nam Tư cũ, cầu Mostar đã bị phá hủy hoàn toàn. Việc tái sinh cây cầu là một bư...', '1.jpg', '2025-03-24 04:18:09'),
(4, 1, 'cầu monstar', 'Trong cuộc xung đột ở Nam Tư cũ, cầu Mostar đã bị phá hủy hoàn toàn. Việc tái sinh cây cầu là một bư...', '1.jpg', '2025-03-24 07:12:16'),
(5, 1, 'cầu monstar', 'Trong cuộc xung đột ở Nam Tư cũ, cầu Mostar đã bị phá hủy hoàn toàn. Việc tái sinh cây cầu là một bư...', '1.jpg', '2025-03-24 07:13:30');

-- --------------------------------------------------------

--
-- Table structure for table `restoration_projects`
--

CREATE TABLE `restoration_projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restoration_projects`
--

INSERT INTO `restoration_projects` (`id`, `project_name`, `details`, `image_path`) VALUES
(1, 'Khôi phục Lăng mộ Timbuktu', 'Tính đến tháng 5 năm 2012, Chính phủ Mali đã tìm kiếm sự giúp đỡ từ cộng đồng quốc tế thông qua UNESCO. Timbuktu và Lăng mộ Askia đã được đưa vào Danh sách Di sản Thế giới đang bị đe dọa và UNESCO đã khởi xướng một loạt các hành động lớn để hỗ trợ Mali. UNESCO đã bắt đầu một chiến dịch nâng cao nhận thức về ý nghĩa văn hóa của các lăng mộ và vai trò của chúng trong việc định hình cuộc sống của cư dân Timbuktu. Một \'Hộ chiếu Di sản\' của Mali đã được phân phối cho quân nhân, với các bản đồ hiển thị các địa điểm văn hóa quan trọng nhất.', 'timbuktu.jpg'),
(2, 'Angkor,Campuchia', 'Một trong những địa điểm khảo cổ quan trọng nhất ở Đông Nam Á, Công viên Khảo cổ Angkor chứa đựng những di tích tráng lệ của nhiều thủ đô khác nhau của Đế chế Khmer, từ thế kỷ thứ 9 đến thế kỷ thứ 15. Năm 1993, UNESCO đã bắt tay vào một kế hoạch đầy tham vọng nhằm bảo vệ và phát triển địa điểm lịch sử này do Ban Di sản Văn hóa thực hiện với sự hợp tác chặt chẽ với Trung tâm Di sản Thế giới. Khai quật trái phép, cướp bóc các địa điểm khảo cổ và mìn là những vấn đề chính. Ủy ban Di sản Thế giới, sau khi lưu ý rằng những mối đe dọa này đối với địa điểm này không còn tồn tại nữa và nhiều hoạt động bảo tồn và phục hồi do UNESCO phối hợp đã thành công, đã đưa địa điểm này ra khỏi Danh sách Di sản Thế giới đang bị đe dọa vào năm 2004.', 'angkor.jpg'),
(3, 'Thành phố cổ ở Dubrovnik ở Crotia', 'Viên ngọc của biển Adriatic, rải rác những tòa nhà Gothic, Phục hưng và Baroque tuyệt đẹp đã chống chọi qua nhiều thế kỷ và sống sót sau nhiều trận động đất. Vào tháng 11 và tháng 12 năm 1991, khi bị hư hại nghiêm trọng do hỏa lực pháo binh, thành phố đã ngay lập tức được đưa vào Danh sách Di sản Thế giới đang bị đe dọa. Với sự tư vấn kỹ thuật và hỗ trợ tài chính của UNESCO, Chính phủ Croatia đã khôi phục lại mặt tiền của các tu viện dòng Phanxicô và dòng Đaminh, sửa chữa mái nhà và xây dựng lại các cung điện. Kết quả là, vào tháng 12 năm 1998, thành phố đã có thể được đưa khỏi Danh sách Di sản Thế giới đang bị đe dọa.', 'crotia.jpg'),
(4, 'Mỏ muối Wieliczka, gần Cracow ở Ba Lan', 'Tài sản này được ghi vào năm 1978 là một trong mười hai di sản thế giới đầu tiên. Mỏ lớn này đã được khai thác tích cực từ thế kỷ 13. 300 km phòng trưng bày của nó chứa các tác phẩm nghệ thuật nổi tiếng với các bàn thờ và tượng được điêu khắc bằng muối, tất cả đều bị đe dọa nghiêm trọng bởi độ ẩm do sự ra đời của hệ thống thông gió nhân tạo vào cuối thế kỷ 19. Địa điểm này đã được đưa vào Danh sách Di sản thế giới đang bị đe dọa vào năm 1989. Trong chín năm nỗ lực chung của cả Ba Lan và cộng đồng quốc tế, một hệ thống hút ẩm hiệu quả đã được lắp đặt và Ủy ban, tại phiên họp vào tháng 12 năm 1998, đã có sự hài lòng khi đưa địa điểm này ra khỏi Danh sách Di sản thế giới đang bị đe dọa.', 'momuoi.jpg'),
(5, 'Khu bảo tồn Ngorongoro ở Cộng hòa Thống nhất Tanzania', 'Hố khổng lồ này có mật độ động vật hoang dã lớn nhất thế giới đã được liệt kê là một địa điểm có nguy cơ tuyệt chủng vào năm 1984 do tình trạng xuống cấp chung của địa điểm do thiếu sự quản lý. Đến năm 1989, nhờ các dự án hợp tác kỹ thuật và giám sát liên tục, tình hình đã được cải thiện và địa điểm này đã được đưa ra khỏi Danh sách Di sản Thế giới đang bị đe dọa.', 'tanzania.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `title`, `description`, `image_url`, `link`) VALUES
(1, 'Tạo sự hòa giải: Cầu Mostar', 'Trong cuộc xung đột ở Nam Tư cũ, cầu Mostar đã bị phá hủy hoàn toàn. Việc tái sinh cây cầu là một bước tiến quan trọng.', 'caumosta.jpg', 'https://example.com/mostar'),
(2, 'Cùng nhau phát triển: Tongariro', 'Công viên quốc gia Tongariro ở New Zealand đã đạt được đến cân bằng giữa bảo tồn thiên nhiên và văn hóa.', 'tonggariro.jpg', 'https://example.com/tongariro'),
(3, 'Bảo tồn Machu Picchu', 'Các nhà nghiên cứu và cộng đồng địa phương đã nỗ lực bảo tồn Machu Picchu trước nguy cơ xuống cấp.', 'machupichu.jpg', 'https://example.com/machu-picchu'),
(4, 'Bảo vệ Vạn Lý Trường Thành', 'Các sáng kiến bảo vệ và tái tạo Vạn Lý Trường Thành nhằm bảo tồn lịch sử và văn hóa Trung Hoa.', 'vltt.jpg', 'https://example.com/great-wall'),
(5, 'Trùng tu Đấu trường La Mã', 'Các chuyên gia đang làm việc để bảo tồn di tích lịch sử quan trọng này tại Ý.', 'colosseo.jpg', 'https://example.com/colosseum');

-- --------------------------------------------------------

--
-- Table structure for table `success_stories`
--

CREATE TABLE `success_stories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_success` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `success_stories`
--

INSERT INTO `success_stories` (`id`, `title`, `description`, `image_success`) VALUES
(1, 'Làm việc cùng nhau:\r\n     Abu Simbel', 'Năm 1959, Ai Cập đã xây dựng Đập cao Aswan, cần thiết để thúc đẩy nông nghiệp và cung cấp điện. Hồ chứa nước được tạo ra sẽ nhấn chìm các di tích trong khu vực. Đảo Philae đã bị ngập nước theo định kỳ do mực nước dâng cao của sông Nile. Ai Cập và nước láng giềng Sudan đã yêu cầu UNESCO giúp bảo vệ di sản Nubia quý giá của họ. UNESCO đã chấp nhận thách thức và kích hoạt một hoạt động cứu hộ ngoạn mục. Tổ chức này sẽ cho thế giới thấy cách bảo tồn kho báu của quá khứ cho các thế hệ tương lai, chứ không phải hy sinh vì sự tiến bộ. Chìa khóa là sự đoàn kết quốc tế. UNESCO đã triệu tập các chuyên gia hàng đầu - các nhà thủy văn, kỹ sư, nhà khảo cổ học, kiến ​​trúc sư - những người đã đưa ra một kế hoạch cấp tiến: các ngôi đền sẽ bị tháo dỡ, di chuyển đến vùng đất cao hơn và lắp ráp lại.', 'abu.jpg'),
(2, 'Venice, Ý', 'Chiến dịch bảo vệ quốc tế kéo dài nhất đã diễn ra kể từ năm 1966 khi UNESCO quyết định phát động chiến dịch cứu thành phố sau trận lũ lụt thảm khốc năm 1965, một nhiệm vụ đòi hỏi thời gian, trình độ kỹ thuật cao và trên hết là tiền bạc. Sự hợp tác quốc tế nảy sinh từ dự án này là nguồn cảm hứng quan trọng cho những nỗ lực sáng lập Công ước.', 'y.jpg'),
(3, 'Đền Borobudur, Indonesia', 'Một chiến dịch bảo vệ quốc tế đã được UNESCO phát động vào năm 1972 để khôi phục ngôi chùa Phật giáo nổi tiếng này, có niên đại từ thế kỷ thứ 8 và thế kỷ thứ 9. Bị bỏ hoang vào năm 1000, ngôi chùa dần bị cây cối che phủ và không được phát hiện lại cho đến thế kỷ 19. Với sự tham gia tích cực của Quỹ Ủy thác Nhật Bản bảo tồn Di sản Văn hóa Thế giới và các đối tác khác, việc khôi phục Borobudur đã hoàn thành vào năm 1983.', 'indo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tintuc`
--

CREATE TABLE `tintuc` (
  `id` int(11) NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `noidung` text NOT NULL,
  `hinhanh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tintuc`
--

INSERT INTO `tintuc` (`id`, `tieude`, `noidung`, `hinhanh`) VALUES
(1, 'Chùa Một Cột - Biểu tượng ngàn năm', '### Giới thiệu về Chùa Một Cột\n\nChùa Một Cột là một trong những biểu tượng văn hóa lâu đời và độc đáo nhất của Việt Nam. Được xây dựng từ thời vua Lý Thái Tông vào năm 1049, chùa mang đậm giá trị lịch sử, kiến trúc và tâm linh. \n\nTên gọi \"Chùa Một Cột\" xuất phát từ hình dáng đặc biệt của ngôi chùa: một gian nhỏ đặt trên một trụ đá duy nhất, tựa như một đóa sen vươn lên từ mặt nước. Đây là một trong những công trình mang đậm dấu ấn Phật giáo, thể hiện lòng thành kính của vua Lý đối với Đức Phật.\n\n---\n\n### Kiến trúc độc đáo\n\nChùa Một Cột có kiến trúc hoàn toàn khác biệt so với các ngôi chùa truyền thống ở Việt Nam. Chùa có các đặc điểm nổi bật sau:\n\n- **Thiết kế hình vuông**, mỗi cạnh khoảng 3m, đặt trên một trụ đá hình trụ có đường kính 1.25m, cao 4m.  \n- **Mái ngói cong**, uốn lượn theo phong cách kiến trúc cung đình thời Lý.  \n- **Cột đá nguyên khối** được chạm khắc tinh xảo, thể hiện kỹ thuật xây dựng vượt trội của thời kỳ phong kiến.  \n- **Bên trong chùa** đặt tượng Phật Quan Âm ngồi trên tòa sen, tượng trưng cho sự thanh tịnh và lòng từ bi.  \n\n---\n\n### Lịch sử và ý nghĩa\n\nTheo sử sách, vua Lý Thái Tông mơ thấy Phật Quan Âm ngồi trên tòa sen, đưa tay dắt nhà vua lên. Khi tỉnh dậy, nhà vua đã cho xây dựng ngôi chùa với hình dáng giống như trong giấc mơ để thể hiện lòng thành kính với Phật. \n\nChùa Một Cột không chỉ là di sản kiến trúc quan trọng mà còn là nơi linh thiêng, thu hút đông đảo Phật tử và du khách trong và ngoài nước. Chùa cũng là biểu tượng của Hà Nội và từng được in trên tiền kim loại Việt Nam.\n\n---\n\n### Bảo tồn và phục dựng\n\nTrải qua hàng trăm năm, Chùa Một Cột đã nhiều lần được trùng tu và sửa chữa:\n\n- **Năm 1105**, vua Lý Nhân Tông cho mở rộng quy mô chùa.  \n- **Thời nhà Trần**, chùa tiếp tục được bảo tồn và duy trì.  \n- **Năm 1954**, thực dân Pháp đã phá hủy chùa trước khi rút khỏi Hà Nội.  \n- **Năm 1955**, Chính phủ Việt Nam cho xây dựng lại chùa dựa trên kiến trúc cũ.  \n\nNgày nay, Chùa Một Cột vẫn là một địa điểm tham quan nổi tiếng, thu hút hàng triệu lượt khách du lịch mỗi năm.  \n\n---\n\nChùa Một Cột không chỉ là biểu tượng kiến trúc mà còn là một phần của lịch sử, văn hóa và tinh thần của dân tộc Việt Nam.', 'chua-mot-cot.jpg'),
(3, 'Phố cổ Hội An - Di sản văn hóa thế giới', '### Giới thiệu về Hội An\r\n\r\nPhố cổ Hội An là một trong những điểm đến du lịch nổi tiếng nhất của Việt Nam, được UNESCO công nhận là di sản văn hóa thế giới vào năm 1999. Nơi đây từng là một thương cảng sầm uất vào thế kỷ 15-19, với sự giao thoa của nhiều nền văn hóa.\r\n\r\n---\r\n\r\n### Kiến trúc độc đáo\r\n\r\nHội An nổi bật với những ngôi nhà cổ có tuổi đời hàng trăm năm, mái ngói rêu phong, tường vàng đặc trưng và hệ thống đèn lồng lung linh vào ban đêm. Một số địa điểm nổi bật gồm:\r\n\r\n- **Chùa Cầu** - biểu tượng của Hội An, được xây dựng vào cuối thế kỷ 16.\r\n- **Nhà cổ Tấn Ký** - ngôi nhà hơn 200 năm tuổi mang phong cách kiến trúc Trung - Nhật - Việt.\r\n- **Hội quán Quảng Đông** - nơi sinh hoạt tín ngưỡng của người Hoa tại Hội An.\r\n\r\n---\r\n\r\n### Ẩm thực và văn hóa\r\n\r\nHội An còn nổi tiếng với nền ẩm thực phong phú như **cao lầu, mì Quảng, bánh mì Phượng**. Du khách có thể trải nghiệm **thả đèn hoa đăng trên sông Hoài**, thưởng thức nhã nhạc cung đình và khám phá các làng nghề truyền thống.\r\n\r\n---\r\n\r\nHội An không chỉ là một điểm đến du lịch, mà còn là nơi lưu giữ những giá trị văn hóa, lịch sử và tâm hồn của người Việt.', 'hoi-an.jpg'),
(4, 'Cố đô Huế - Di sản văn hóa thế giới', '### Giới thiệu về Cố đô Huế\r\n\r\nHuế là kinh đô của triều đại nhà Nguyễn từ năm 1802 đến 1945. Nơi đây nổi tiếng với hệ thống di tích lịch sử phong phú và là trung tâm văn hóa quan trọng của Việt Nam.\r\n\r\n---\r\n\r\n### Di tích lịch sử quan trọng\r\n\r\n- **Đại Nội Huế**: Quần thể cung điện hoàng gia, nơi sinh sống và làm việc của vua chúa Nguyễn.\r\n- **Lăng tẩm các vua Nguyễn**: Như lăng Minh Mạng, lăng Tự Đức, lăng Khải Định, mang nét kiến trúc độc đáo.\r\n- **Chùa Thiên Mụ**: Ngôi chùa cổ bên dòng sông Hương, biểu tượng tâm linh của xứ Huế.\r\n\r\n---\r\n\r\n### Ẩm thực xứ Huế\r\n\r\nHuế còn được biết đến với nền ẩm thực cung đình tinh tế như **bún bò Huế, bánh bèo, bánh nậm, cơm hến**. Đặc biệt, nơi đây là quê hương của **nhã nhạc cung đình Huế**, một di sản phi vật thể của UNESCO.\r\n\r\n---\r\n\r\nVới vẻ đẹp cổ kính, trầm mặc và mang đậm dấu ấn lịch sử, Huế luôn là điểm đến lý tưởng cho du khách trong và ngoài nước.', 'hue.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Role` enum('User','Admin') DEFAULT 'User',
  `Avatar` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `DateOfBirth` date DEFAULT '2000-01-01',
  `Gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Username`, `Password`, `Email`, `Role`, `Avatar`, `Address`, `FullName`, `DateOfBirth`, `Gender`) VALUES
(1, 'dta', '123', 'dta@gmail.com', 'User', '../uploads/avatar_1743089571_7993.jpg', 'Hà Nội', 'Đồng Thị Anh', '0000-00-00', 'Khác'),
(4, 'admin', '123', 'admin@gmail.com', 'Admin', '../uploads/avatar_1743089546_5937.jpg', 'HN', 'admin', '0000-00-00', 'Nam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_articles`
--
ALTER TABLE `blog_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `fk_post_id` (`post_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `restoration_projects`
--
ALTER TABLE `restoration_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `success_stories`
--
ALTER TABLE `success_stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_articles`
--
ALTER TABLE `blog_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restoration_projects`
--
ALTER TABLE `restoration_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `success_stories`
--
ALTER TABLE `success_stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tintuc`
--
ALTER TABLE `tintuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
