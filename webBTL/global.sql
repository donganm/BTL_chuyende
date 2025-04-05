-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 12:27 PM
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
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `tac_gia` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ngay_dang` datetime DEFAULT current_timestamp(),
  `hinhanh` varchar(255) DEFAULT 'default.jpg',
  `luot_xem` int(11) DEFAULT 0,
  `luot_thich` int(11) DEFAULT 0,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_articles`
--

INSERT INTO `blog_articles` (`id`, `title`, `tac_gia`, `description`, `ngay_dang`, `hinhanh`, `luot_xem`, `luot_thich`, `link`) VALUES
(25, '“Nghe nhã nhạc, tôi thấy như đang ngồi giữa cung đình xưa”', '', 'Một trong những trải nghiệm tôi nhớ mãi trong chuyến đi là khi tôi nghe Nhã nhạc Cung đình Huế lần đầu tiên. Những âm thanh nhẹ nhàng, trầm bổng của đàn tranh, đàn bầu, cùng với những giọng hát thanh thoát đã làm tôi như lạc vào một thế giới khác, một thế giới của những hoàng đế, của những buổi tiệc cung đình xa xưa.\r\n\r\nNgồi trên bờ sông Hương, tôi cảm nhận được sự tĩnh lặng và thiêng liêng của âm nhạc, như thể từng nốt nhạc là tiếng thì thầm của những vua chúa, những cung phi trong suốt hàng trăm năm qua. Huế không chỉ là một địa danh, mà là một di sản sống, nơi mà âm nhạc vẫn còn vang vọng, như một phần không thể thiếu trong tâm hồn của mỗi người dân Huế. Từng giai điệu của Nhã nhạc như gợi lại những hình ảnh của một thời phong kiến rực rỡ, đồng thời cũng khơi dậy trong tôi một niềm tự hào về di sản văn hóa của dân tộc.\r\n\r\nĐược UNESCO công nhận là di sản văn hóa phi vật thể của nhân loại, Nhã nhạc không chỉ là âm nhạc, mà là một phần linh hồn của Huế, một di sản phải được bảo tồn và phát huy. Và trong khoảnh khắc đó, tôi đã nhận ra một điều rất rõ ràng: Di sản không phải là thứ gì đó xa vời, mà là thứ đang sống ngay trong hiện tại, trong mỗi nốt nhạc, trong từng câu hát.', '2025-04-05 09:30:17', '1743820242_9138-10-3.9.jpg', 0, 0, ''),
(29, 'Làng Chài Cửa Cạn (Phú Quốc)', '', 'Làng Chài Cửa Cạn là một trong những địa điểm hiếm hoi ở Phú Quốc mà bạn có thể trải nghiệm cuộc sống ven biển bình dị và hoang sơ. Khác với các khu du lịch nổi tiếng như Bãi Sao hay Long Beach, Cửa Cạn vẫn giữ được nét đẹp yên bình, không bị ảnh hưởng bởi sự phát triển du lịch. Đây là một làng chài nằm ở phía Tây Bắc của đảo, với những bãi biển cát trắng và làn nước trong vắt, là nơi lý tưởng để bạn tận hưởng sự bình yên của biển cả. Làng Cửa Cạn không chỉ có những cảnh đẹp tự nhiên mà còn là nơi sinh sống của cộng đồng ngư dân với những hoạt động đánh bắt thủy sản truyền thống. Bạn có thể tham gia cùng ngư dân đi thuyền ra biển, hoặc thưởng thức các món hải sản tươi ngon, trong không gian mộc mạc và thân thiện. Những ngôi nhà sàn nhỏ, những chiếc thuyền đánh cá, tất cả tạo nên một bức tranh sống động về cuộc sống ven biển mà bạn khó có thể tìm thấy ở những khu du lịch đông đúc.', '2025-04-05 10:05:37', 'img_67f09e01b759b.jpg', 0, 0, ''),
(30, 'Vườn Quốc Gia Phong Nha – Kẻ Bàng (Quảng Bình)', '', 'Phong Nha – Kẻ Bàng là một trong những khu bảo tồn thiên nhiên tuyệt vời nhất của Việt Nam, không chỉ nổi bật với các hang động kỳ vĩ như động Phong Nha, động Sơn Đoòng mà còn là một khu vực có giá trị sinh học và di sản văn hóa cực kỳ phong phú. Vườn quốc gia này có những con suối trong vắt, những hang động chưa được khai thác hết, và một hệ sinh thái động thực vật phong phú, tạo ra một không gian hoàn hảo cho những ai yêu thích khám phá thiên nhiên hoang dã.\r\n\r\nPhong Nha không chỉ nổi bật với những hang động, mà còn là nơi chứa đựng những giá trị văn hóa dân gian. Các bản làng của người dân tộc Vân Kiều và Rục quanh vườn quốc gia vẫn giữ được nhiều nét văn hóa truyền thống. Tôi vẫn nhớ những lần trò chuyện với người dân bản địa về những câu chuyện xưa, về các vị thần bảo vệ các hang động, hay những truyền thuyết kỳ bí về các con quái vật trong rừng sâu.', '2025-04-05 10:08:06', 'img_67f09e96ad538.jpg', 0, 0, ''),
(31, 'Khu du lịch sinh thái Bà Nà Hills (Đà Nẵng)', '', 'Khu du lịch Bà Nà Hills không chỉ nổi tiếng với hệ thống cáp treo dài nhất thế giới, mà còn là một trong những địa điểm có vẻ đẹp hoang sơ và không khí trong lành, cách xa sự ồn ào của thành phố. Điều đặc biệt ở đây là bạn sẽ được trải nghiệm không gian núi rừng nguyên sinh, kết hợp với các công trình kiến trúc độc đáo như ngôi chùa Linh Ứng, cầu Vàng nổi tiếng – cây cầu được nâng đỡ bởi đôi bàn tay khổng lồ.\r\n\r\nMặc dù khu du lịch này đã được phát triển mạnh mẽ trong những năm gần đây, nhưng vẫn còn những góc khuất của Bà Nà Hills chưa bị du lịch hóa. Bạn có thể khám phá những làng quê cổ xưa quanh khu vực này, dạo bước trên những con đường mòn dẫn qua các khu rừng, cảm nhận sự bình yên giữa thiên nhiên hoang sơ.\r\n\r\nNgoài ra, Bà Nà cũng là nơi chứa đựng nhiều di sản văn hóa của các cộng đồng người Kinh, người Cơ Tu và các nhóm dân tộc khác, tạo ra một bức tranh đa dạng về văn hóa và lịch sử. Những con đường nhỏ trong khu du lịch, những ngôi nhà sàn của người Cơ Tu, những bức tượng Phật cổ, tất cả đều tạo nên một không gian yên bình, gần gũi với thiên nhiên.', '2025-04-05 10:09:05', 'img_67f09ed1b23de.jpg', 0, 0, '');

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
(15, NULL, 'Ẩn danh', 'xin chao', '2025-03-25 14:42:25', NULL, 5, 'post'),
(16, NULL, 'Ẩn danh', 'heloo', '2025-03-26 03:09:25', NULL, 5, 'post'),
(18, NULL, 'admin', 'aa', '2025-04-05 02:16:11', 4, 32, 'post'),
(21, NULL, 'dta', '123', '2025-04-05 03:02:11', 1, 28, 'post');

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
(2, 'Dong Anh', 'dta@gmail.com', 'Good', '2025-03-05 16:39:36'),
(3, 'Dong Anh', 'dta@gmail.com', 'aaa', '2025-03-29 05:29:45'),
(4, 'anm', 'anm@gmail.com', 'không tải được ảnh xuống', '2025-04-02 19:29:53'),
(5, 'ẩn danh', 'andanh@gmail.com', 'ảnh dính bản quyền :((', '2025-04-02 19:31:01'),
(6, 'Dong Anh', 'dta@gmail.com', '1234567890', '2025-04-05 02:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_path`, `description`) VALUES
(1, '../assets/img/trangimage/1.jpg', 'ảnh'),
(2, '../assets/img/trangimage/2.jpg', 'Hình ảnh mới'),
(3, '../assets/img/trangimage/3.jpg', 'Hình ảnh mới'),
(4, '../assets/img/trangimage/5.jpg', 'Hình ảnh mới'),
(5, '../assets/img/trangimage/6.jpg', 'Hình ảnh mới'),
(6, '../assets/img/trangimage/7.jpg', 'Hình ảnh mới'),
(7, '../assets/img/trangimage/8.jpg', 'Hình ảnh mới'),
(8, '../assets/img/trangimage/11.jpg', 'Hình ảnh mới'),
(9, '../assets/img/trangimage/12.jpg', 'Hình ảnh mới'),
(10, '../assets/img/trangimage/13.jpg', 'Hình ảnh mới'),
(11, '../assets/img/trangimage/14.jpg', 'Hình ảnh mới'),
(12, '../assets/img/trangimage/1718331318364.png', 'Hình ảnh mới'),
(13, '../assets/img/trangimage/bd.jpg', 'Hình ảnh mới');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `title`, `content`, `image`, `created_at`) VALUES
(25, 0, 'Vì sao ẩm thực Huế có nhiều món ăn cung đình?', 'Ảnh hưởng từ văn hóa cung đình\r\nCác vua triều Nguyễn rất quan tâm đến ăn uống, yêu cầu các món ăn phải không chỉ ngon mà còn đẹp mắt, tinh tế và cầu kỳ trong cách chế biến.\r\nNhiều món ăn được chế biến theo công thức đặc biệt chỉ dành riêng cho hoàng gia.', 'image_post/67f00cad81aa1_hue.jpg', '2025-03-09 22:39:14'),
(26, 0, 'Thời điểm nào là đẹp nhất để du lịch Hội An?', 'Vào ngày 14 âm lịch mỗi tháng, Hội An tổ chức Đêm phố cổ, nơi toàn bộ khu phố sẽ lung linh với hàng ngàn chiếc đèn lồng, không có ánh đèn điện.\r\nĐây là thời điểm tuyệt vời để tham gia lễ hội thả đèn hoa đăng trên sông Hoài và tận hưởng không gian truyền thống.', 'image_post/67f00c881778f_hoi-an.jpg', '2025-03-09 22:47:03'),
(28, 0, 'Di sản văn hóa phi vật thể là gì?', 'Đó là những giá trị phi hữu hình như truyền thống, phong tục, lễ hội, nghệ thuật biểu diễn… được UNESCO công nhận và bảo tồn như một phần không thể tách rời của di sản văn hóa.\r\n- Di sản văn hoá vật thể là sản phẩm vật chất có giá trị lịch sử, văn hoá, khoa học, bao gồm di tích lịch sử - văn hoá, danh lam thắng cảnh, di vật, cổ vật, bảo vật quốc gia.', 'image_post/67f00d0b3003c_di-san-van-hoa.jpg', '2025-03-15 08:46:54'),
(32, 3, 'Chùa Một Cột - Biểu tượng văn hóa, kiến trúc độc đáo của Hà Nội', 'Khi nhắc đến những công trình kiến trúc ấn tượng, không thể bỏ qua chùa Một Cột. Năm 2012, tổ chức Kỷ lục Châu Á đã chính thức công nhận chùa Một Cột là \"Ngôi chùa có kiến trúc độc đáo nhất Châu Á\". Nó được xây dựng theo hình tượng của một đóa hoa sen nở trên mặt nước, tượng trưng cho sự tinh khiết và cao quý của Phật pháp.', 'image_post/67f00d724c3f9_chua-mot-cot.jpg', '2025-04-04 16:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `created_at`, `image`) VALUES
(25, 0, 'Vì sao ẩm thực Huế có nhiều món ăn cung đình?', 'Ảnh hưởng từ văn hóa cung đình\r\nCác vua triều Nguyễn rất quan tâm đến ăn uống, yêu cầu các món ăn phải không chỉ ngon mà còn đẹp mắt, tinh tế và cầu kỳ trong cách chế biến.\r\nNhiều món ăn được chế biến theo công thức đặc biệt chỉ dành riêng cho hoàng gia.', '2025-03-10 05:39:14', 'uploads/67ce7b024304a_am_thuc_hue_1.jpg'),
(26, 0, 'Thời điểm nào là đẹp nhất để du lịch Hội An?', 'Vào ngày 14 âm lịch mỗi tháng, Hội An tổ chức Đêm phố cổ, nơi toàn bộ khu phố sẽ lung linh với hàng ngàn chiếc đèn lồng, không có ánh đèn điện.\r\nĐây là thời điểm tuyệt vời để tham gia lễ hội thả đèn hoa đăng trên sông Hoài và tận hưởng không gian truyền thống.', '2025-03-10 05:47:03', 'uploads/67ce7cd7a7e19_le-hoi-den-hoa-dang.jpg'),
(28, 0, 'Di sản văn hóa phi vật thể là gì?', 'Đó là những giá trị phi hữu hình như truyền thống, phong tục, lễ hội, nghệ thuật biểu diễn… được UNESCO công nhận và bảo tồn như một phần không thể tách rời của di sản văn hóa.', '2025-03-15 15:46:54', 'uploads/67d5a0eed2b28_disanvanhoa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `postss`
--

CREATE TABLE `postss` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postss`
--

INSERT INTO `postss` (`id`, `title`, `content`, `created_at`) VALUES
(1, 'Tại sao Quần thể di tích Cố đô Huế lại được UNESCO công nhận là Di sản Thế giới?', 'Quần thể Di tích Cố đô Huế được UNESCO công nhận là Di sản Thế giới vào năm 1993 nhờ vào những giá trị nổi bật về lịch sử, văn hóa, kiến trúc và cảnh quan.Nơi đây từng là kinh đô của triều đại Nguyễn với các công trình như kinh thành, lăng tẩm, đền đài và chùa chiền độc đáo. Di tích không chỉ phản ánh sự phát triển của nền văn hóa Việt Nam mà còn là nơi giao thoa của các giá trị nghệ thuật, truyền thống và phong tục tập quán, góp phần làm giàu thêm di sản nhân loại.\r\n\r\n', '2025-03-18 17:43:00');

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
(1, 'Tạo sự hòa giải: Cầu Mostar', 'Trong cuộc xung đột ở Nam Tư cũ, cầu Mostar đã bị phá hủy hoàn toàn. Việc tái sinh cây cầu là một bước tiến quan trọng.', 'mosta.jpg', 'https://example.com/mostar'),
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
  `hinhanh` varchar(255) NOT NULL,
  `ngay_dang` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tintuc`
--

INSERT INTO `tintuc` (`id`, `tieude`, `noidung`, `hinhanh`, `ngay_dang`) VALUES
(11, 'Quần thể Tràng An – Kỳ quan non nước Ninh Bình', 'Tràng An – nơi hội tụ của thiên nhiên kỳ thú và lịch sử oai hùng – được UNESCO công nhận là Di sản Thế giới hỗn hợp đầu tiên của Việt Nam. Hệ sinh thái rừng núi đá vôi, sông ngòi, hang động tạo nên một bức tranh thủy mặc sống động.\r\n\r\nĐây cũng là nơi ghi dấu của Cố đô Hoa Lư – kinh đô đầu tiên của nước Đại Cồ Việt dưới thời Đinh – Tiền Lê. Bạn có thể tham quan các di tích như đền vua Đinh, đền vua Lê, chùa Bái Đính – một trong những quần thể chùa lớn nhất Đông Nam Á.\r\n\r\nTràng An nổi tiếng với hệ thống hang động dài và đẹp như hang Sáng, hang Tối, hang Nấu Rượu. Khi ngồi thuyền xuôi dòng, du khách như lạc vào chốn tiên cảnh với dòng nước trong xanh, rừng cây tĩnh lặng và các vách núi dựng đứng, tráng lệ.', 'trang_an.jpg', '2025-04-05 09:27:40'),
(14, 'Phố cổ Hội An – Di sản văn hóa sống giữa lòng Quảng Nam', 'Phố cổ Hội An từng là thương cảng sầm uất vào thế kỷ 16–18, nơi giao thương giữa các thương nhân Việt, Trung, Nhật, Bồ Đào Nha… Những ngôi nhà cổ với kiến trúc pha trộn Á – Âu, các hội quán, chùa cầu Nhật Bản, những mái ngói phủ rêu là minh chứng cho một thời kỳ vàng son. Dù thời gian trôi qua, Hội An vẫn giữ được nhịp sống chậm rãi, thanh bình. Vào buổi tối, khi hàng ngàn chiếc đèn lồng thắp sáng khắp các con phố, không gian trở nên huyền ảo, lôi cuốn du khách trong không khí cổ tích hiếm nơi nào có được. Ngoài kiến trúc, Hội An còn nổi tiếng với các nghề thủ công truyền thống như may đo áo dài, làm đèn lồng, nghề mộc Kim Bồng, làng gốm Thanh Hà… Lễ hội \"Đêm phố cổ\", lễ Vu Lan, lễ hội đèn hoa đăng mang lại trải nghiệm đặc sắc cho khách du lịch.', 'unnamed.jpg', '2025-04-05 10:10:44'),
(15, 'Cố đô Huế – Viên ngọc di sản miền Trung.', 'Cố đô Huế, tọa lạc bên dòng sông Hương thơ mộng, từng là thủ đô của Việt Nam dưới triều đại nhà Nguyễn trong suốt gần 150 năm. Với hệ thống kiến trúc đồ sộ gồm Kinh thành, Hoàng thành, Tử Cấm Thành, 7 lăng tẩm của các vị vua Nguyễn, và hơn 100 di tích lớn nhỏ, Huế là bảo tàng sống của văn hóa cung đình Việt Nam.\r\n\r\nKhông chỉ là di sản vật thể, Huế còn nổi bật với di sản phi vật thể như Nhã nhạc cung đình – loại hình âm nhạc bác học, được UNESCO công nhận là Di sản Văn hóa Phi vật thể Đại diện của Nhân loại. Các lễ hội truyền thống như Festival Huế, lễ hội áo dài, lễ tế Nam Giao… mang đến không gian sống động, đưa du khách trở về thời phong kiến xa xưa.\r\n\r\nẨm thực Huế cũng là một phần di sản tinh tế, với các món ăn cung đình như bánh bèo, bún bò, nem công chả phượng, thể hiện sự khéo léo và thẩm mỹ trong văn hóa ẩm thực miền Trung.', 'co-do-hue-9.jpg', '2025-04-05 10:11:47');

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
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

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
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postss`
--
ALTER TABLE `postss`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_articles`
--
ALTER TABLE `blog_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `postss`
--
ALTER TABLE `postss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `postss` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `blog_articles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
