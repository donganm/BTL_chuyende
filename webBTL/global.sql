-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 07:24 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Role` enum('User','Seller','Admin') DEFAULT 'User',
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
(1, 'dta', '123', 'dta@gmail.com', 'User', NULL, 'Hà Nội', 'Đồng Thị Anh', '0000-00-00', 'Nữ'),
(0, 'Nguyen Van A', '123', 'nguyenvana@gmail.com', 'User', NULL, 'Thái Bình', 'Nguyễn Văn A', '0000-00-00', 'Nam'),
(0, 'Nguyen Thi B', '123', 'nguyenvanb@gmail.com', 'User', NULL, 'Thái Nguyên', 'Nguyễn Văn B', '0000-00-00', 'Nữ');

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `blog_articles`
--

CREATE TABLE IF NOT EXISTS `blog_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `hue_heritage`
--

CREATE TABLE IF NOT EXISTS `hue_heritage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `tintuc`
--

CREATE TABLE IF NOT EXISTS `tintuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieude` varchar(255) NOT NULL,
  `noidung` text NOT NULL,
  `hinhanh` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    username VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES blog_articles(id) ON DELETE CASCADE
);

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


--
-- Dumping data for tables
--

INSERT INTO `articles` (`id`, `title`, `description`, `link`, `image`) VALUES;

INSERT INTO `blog_articles` (`id`, `title`, `description`, `link`) VALUES;

INSERT INTO `hue_heritage` (`id`, `title`, `description`, `image`, `link`) VALUES;

INSERT INTO `tintuc` (`id`, `tieude`, `noidung`, `hinhanh`) VALUES;

INSERT INTO blog_articles (id, title, description, link) VALUES
(13, 'Văn Miếu - Quốc Tử Giám', 
 'Văn Miếu - Quốc Tử Giám là một trong những di tích lịch sử quan trọng nhất của Hà Nội. Được xây dựng từ thời nhà Lý, nơi đây từng là trường đại học đầu tiên của Việt Nam, đào tạo nhiều nhân tài cho đất nước.', 
 'view-blog.php?id=1'),

(14, 'Vịnh Hạ Long - Kỳ quan thiên nhiên thế giới', 
 'Vịnh Hạ Long là một di sản thiên nhiên thế giới được UNESCO công nhận, nổi tiếng với hàng nghìn hòn đảo đá vôi hùng vĩ. Cảnh quan kỳ thú, hệ sinh thái đa dạng cùng các truyền thuyết ly kỳ đã biến nơi đây thành một điểm du lịch hấp dẫn.', 
 'view-blog.php?id=2'),

(15, 'Hoàng thành Thăng Long', 
 'Hoàng thành Thăng Long là quần thể di tích gắn liền với lịch sử nghìn năm văn hiến của thủ đô Hà Nội. Đây là trung tâm chính trị của các triều đại phong kiến Việt Nam, được UNESCO công nhận là di sản thế giới.', 
 'view-blog.php?id=3');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
