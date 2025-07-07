-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 01:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brac_verse`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow_list`
--

CREATE TABLE `follow_list` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow_list`
--

INSERT INTO `follow_list` (`id`, `follower_id`, `user_id`) VALUES
(10, 4, 3),
(19, 5, 3),
(23, 3, 4),
(25, 3, 5),
(26, 4, 5),
(27, 5, 4),
(28, 6, 3),
(29, 7, 3),
(30, 9, 8),
(31, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(12, 3, 5),
(15, 4, 5),
(16, 4, 3),
(17, 6, 3),
(18, 9, 7),
(19, 8, 7),
(20, 4, 7),
(21, 6, 7),
(22, 10, 8);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_img` text NOT NULL,
  `post_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_img`, `post_text`, `created_at`) VALUES
(1, 4, '1735746018up12.jpg', 'Love Birds\r\n', '2025-01-01 15:40:18'),
(2, 4, '1735749953uj23.jpg', 'Nice weather. ', '2025-01-01 16:45:53'),
(3, 4, '1735750262doogs.jpg', '', '2025-01-01 16:51:02'),
(4, 3, '1735750522tree.jpg', 'Big Tree', '2025-01-01 16:55:22'),
(5, 4, '1735800430cristal ball.jpg', '', '2025-01-02 06:47:10'),
(6, 3, '1735822292large_Animals_cb1.jpg', 'Bear\r\n', '2025-01-02 12:51:32'),
(7, 5, '17359017399tailterror.jpg', 'Destroyer', '2025-01-03 10:55:39'),
(8, 7, '1735903964fire_iron.jpg', 'Wanna Try me!!!', '2025-01-03 11:32:44'),
(9, 7, '1735904005iron game.jpg', 'Introducing Iron man game!!!1', '2025-01-03 11:33:25'),
(10, 8, '1735906500thorwith friends.jpg', 'Meet my friends\r\n', '2025-01-03 12:15:00'),
(11, 8, '1735906517thorcpuples.jpg', 'Couples\r\n\r\n', '2025-01-03 12:15:17'),
(12, 9, '1735906852inaction.jpg', 'Wanna mess with me???\r\n', '2025-01-03 12:20:52'),
(13, 9, '1735906862wwcutew.jpg', 'Happy', '2025-01-03 12:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `profile_pic` text NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `ac_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `username`, `password`, `profile_pic`, `created_at`, `updated_at`, `ac_status`) VALUES
(3, 'Mahir', 'labib', 1, 'test@gmail.com', 'ml_labib', 'e10adc3949ba59abbe56e057f20f883e', '1735901448ml.jpg', '2024-12-31 09:30:56', '2025-01-03 10:50:48', 1),
(4, 'Jaky', 'Adib', 1, 'test2@gmail.com', 'jacky', 'e10adc3949ba59abbe56e057f20f883e', '1735739862download12.jpg', '2025-01-01 07:35:42', '2025-01-01 16:53:50', 1),
(5, 'Nine', 'Tails', 2, 'test3@gmail.com', 'beast', 'e10adc3949ba59abbe56e057f20f883e', '17359016489tails 2.jpg', '2025-01-02 06:52:10', '2025-01-03 10:54:08', 1),
(6, 'Pasific', 'Rim 2', 0, 'test4@gmail.com', 'robot', 'e10adc3949ba59abbe56e057f20f883e', '1735902336pasific2.jpg', '2025-01-02 06:54:02', '2025-01-03 11:05:36', 1),
(7, 'Iron', 'Man', 1, 'test5@gamil.com', 'ironman', 'e10adc3949ba59abbe56e057f20f883e', '1735903932iron.jpg', '2025-01-03 11:30:15', '2025-01-03 11:32:12', 1),
(8, 'Thor', 'Thunder', 1, 'test6@gamil.com', 'thor', 'e10adc3949ba59abbe56e057f20f883e', '1735906281Thor.jpg', '2025-01-03 11:52:04', '2025-01-03 12:11:21', 1),
(9, 'Wonder', 'Women', 2, 'test7@gmail.com', 'wonderwomen', 'e10adc3949ba59abbe56e057f20f883e', '1735906794WWomen.jpg', '2025-01-03 12:19:07', '2025-01-03 12:19:54', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
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
-- AUTO_INCREMENT for table `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
