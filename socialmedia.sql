-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 02:35 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` int(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, 'hey', 'sadab_mostafa', 0, '2020-12-26 02:25:23', 'no', 28),
(4, 'tai naki!', 'sadab_mostafa', 0, '2020-12-26 02:55:17', 'no', 29),
(5, 'nijerei nije reply dw', 'tasnim_hoque', 0, '2020-12-26 03:00:33', 'no', 28),
(6, '', 'sadab_mostafa', 0, '2020-12-26 03:08:13', 'no', 29),
(7, '', 'sadab_mostafa', 0, '2020-12-29 13:53:39', 'no', 30),
(8, 'hello world 2', 'sadab_mostafa', 0, '2020-12-29 19:24:12', 'no', 36),
(9, 'ki re madari', 'wasy_tabassum', 0, '2020-12-29 19:25:26', 'no', 36),
(10, 'hello', 'sadab_mostafa', 0, '2021-01-02 20:57:41', 'no', 38),
(11, 'sadab', 'sadab_mostafa', 0, '2021-01-02 23:23:28', 'no', 62),
(12, 'hello\r\n', 'sadab_mostafa', 0, '2021-01-05 00:08:34', 'no', 96),
(13, 'ki re\r\n', 'faria_mitu', 0, '2021-01-05 00:09:27', 'no', 96),
(14, 'oma!\r\n', 'tasnim_hoque', 0, '2021-01-05 00:09:46', 'no', 96),
(15, 'sa', 'sadab_mostafa', 0, '2021-01-05 02:31:51', 'no', 97),
(16, 'hey', 'sadab_mostafa', 0, '2021-01-05 13:05:19', 'no', 120),
(17, 'ki', 'sadab_mostafa', 0, '2021-01-05 13:05:45', 'no', 120),
(18, 'hello', 'tasnim_hoque', 0, '2021-01-05 13:49:02', 'no', 121),
(19, 'hey', 'tasnim_hoque', 0, '2021-01-05 13:49:30', 'no', 116),
(20, 'hi!\r\n', 'sadab_mostafa', 0, '2021-04-11 18:55:49', 'no', 116),
(21, 'hey', 'tasnim_hoque', 0, '2021-04-11 20:56:05', 'no', 137);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user_from`) VALUES
(26, 'wasy_tabassum', 'sadab_mostafa'),
(35, 'faria_mitu', 'sadab_mostafa');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(156, 'sadab_mostafa', 21),
(158, 'sadab_mostafa', 31),
(159, 'tasnim_hoque', 33),
(160, 'tasnim_hoque', 32),
(173, 'tasnim_hoque', 29),
(174, 'sadab_mostafa', 28),
(177, 'wasy_tabassum', 36),
(182, 'sadab_mostafa', 36),
(183, 'tasnim_hoque', 36),
(185, 'tasnim_hoque', 39),
(186, 'tasnim_hoque', 38),
(240, 'tasnim_hoque', 47),
(244, 'sadab_mostafa', 64),
(264, 'faria_mitu', 96),
(265, 'tasnim_hoque', 96),
(299, 'sadab_mostafa', 95),
(306, 'sadab_mostafa', 97),
(307, 'sadab_mostafa', 96),
(308, 'sadab_mostafa', 112),
(309, 'tasnim_hoque', 113),
(328, 'tasnim_hoque', 115),
(331, 'tasnim_hoque', 120),
(332, 'tasnim_hoque', 114),
(333, 'sadab_mostafa', 115),
(338, 'sadab_mostafa', 120),
(343, 'tasnim_hoque', 123),
(344, 'sadab_mostafa', 121),
(347, 'sadab_mostafa', 123),
(350, 'sadab_mostafa', 116),
(352, 'tasnim_hoque', 137);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(40, 'wasy_tabassum', 'sadab_mostafa', 'hello!', '2020-12-29 19:26:54', 'yes', 'no', 'no'),
(41, 'sadab_mostafa', 'wasy_tabassum', 'ki chas!', '2020-12-29 19:27:07', 'yes', 'no', 'no'),
(42, 'wasy_tabassum', 'sadab_mostafa', 'tor bal', '2020-12-29 19:27:18', 'yes', 'no', 'no'),
(43, 'faria_mitu', 'sadab_mostafa', 'assignmmet de\r\n', '2020-12-29 19:27:41', 'no', 'no', 'no'),
(44, 'sadab_mostafa', 'sadab_mostafa', 'hello', '2021-01-05 17:03:21', 'yes', 'no', 'no'),
(45, 'sadab_mostafa', 'sadab_mostafa', 'hi\r\n', '2021-03-03 14:36:02', 'yes', 'no', 'no'),
(46, 'sadab_mostafa', 'sadab_mostafa', 'sas', '2021-03-03 14:46:48', 'yes', 'no', 'no'),
(47, 'tasnim_hoque', 'sadab_mostafa', 'hey!', '2021-04-12 17:24:34', 'no', 'no', 'no'),
(48, 'tasnim_hoque', 'sadab_mostafa', 'ki hal\r\n', '2021-04-12 17:24:42', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_to`, `user_from`, `message`, `datetime`) VALUES
(95, '', 'sadab_mostafa', 'Shared your post', '2021-04-11 18:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` int(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `original_user` varchar(60) NOT NULL,
  `original_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`, `original_user`, `original_post_id`) VALUES
(115, 'hello,world!', 'tasnim_hoque', 0, '2021-01-05 03:11:51', 'no', 'no', 2, '', 'none', -1),
(116, 'hello,world!', 'sadab_mostafa', 0, '2021-01-05 03:12:08', 'no', 'no', 1, '', 'tasnim_hoque', 115),
(121, '1', 'tasnim_hoque', 0, '2021-01-05 13:17:55', 'no', 'no', 1, '', 'none', -1),
(134, 'hey', 'sadab_mostafa', 0, '2021-04-11 18:59:42', 'no', 'no', 0, '', 'none', -1),
(140, 'hey', 'sadab_mostafa', 0, '2021-04-12 18:33:57', 'no', 'no', 0, '../view/images/posts/60743e3512cc0a.jpg', 'none', -1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(15, 'Sadab', 'Mostafa', 'sadab_mostafa', 'sadabmostafa@gmail.com', '41dc32b6d6d8c3fb6b56e949d36909a7', '2020-12-26', '../view/images/profile_pics/defaults/three.jpg', 40, 83, 'no', ',tasnim_hoque,'),
(16, 'Tasnim', 'Hoque', 'tasnim_hoque', 'Tasnim33@gmail.com', '41dc32b6d6d8c3fb6b56e949d36909a7', '2020-12-26', '../view/images/profile_pics/defaults/two.jpg', 5, 27, 'no', ',faria_mitu,sadab_mostafa,'),
(17, 'Faria', 'Mitu', 'faria_mitu', 'Fariamitu@gmail.com', '41dc32b6d6d8c3fb6b56e949d36909a7', '2020-12-26', '../view/images/profile_pics/defaults/one.jpg', 3, 1, 'no', ',tasnim_hoque,'),
(18, 'Wasy', 'Tabassum', 'wasy_tabassum', 'Wasy@gmail.com', '41dc32b6d6d8c3fb6b56e949d36909a7', '2020-12-29', '../view/images/profile_pics/defaults/two.jpg', 0, 0, 'no', ','),
(23, 'Noshu', 'Pro', 'noshu_pro', 'Noshupro69@gmail.com', '41dc32b6d6d8c3fb6b56e949d36909a7', '2021-04-12', '../view/images/profile_pics/defaults/two.jpg', 0, 0, 'no', ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=353;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
