-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 05:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jokiannovi`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(25) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `category`, `content`, `image_path`, `created_at`, `updated_at`) VALUES
(74, 'Lorem ipsum dolor sit amet', 'Gangguan Kecemasan', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum, libero in lobortis volutpat, est erat lacinia nibh, quis imperdiet nisi massa non purus. Pellentesque at enim a ligula sollicitudin porta. Ut lacus diam, auctor non nisl a, tincidunt volutpat nulla. Sed tristique mauris sed pulvinar vulputate. Aenean justo turpis, malesuada sed odio ac, dapibus iaculis mauris. Phasellus hendrerit vel elit vitae gravida. Quisque nibh metus, scelerisque quis ex nec, pharetra fringilla metus. Ut pulvinar lacinia blandit. Proin quis vulputate libero. Quisque nunc augue, pellentesque in tempus ac, ultrices at arcu.</p>\r\n\r\n<p>Sed diam purus, consectetur vitae nulla non, ultricies vehicula velit. Pellentesque ac turpis congue, volutpat enim sit amet, pulvinar sem. Curabitur molestie facilisis augue, at euismod leo iaculis in. Sed ullamcorper lacinia turpis in fringilla. Donec quis mauris vitae ante efficitur imperdiet. Aenean sit amet sagittis orci. Sed maximus ac massa eu placerat. Cras id convallis nisi. Nam id vulputate dolor.</p>\r\n\r\n<p>Morbi volutpat, ligula sit amet interdum pharetra, arcu ipsum eleifend est, at sagittis sapien arcu id enim. Maecenas rutrum consequat est, non pretium est laoreet sit amet. Vivamus ac massa eget massa suscipit condimentum eu rhoncus ante. Maecenas dapibus magna non massa consectetur rutrum. Maecenas quis tristique arcu, at sodales massa. Vestibulum nulla quam, laoreet at tincidunt quis, dictum non justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam nulla ligula, malesuada in magna eu, ornare tincidunt tellus. Praesent pellentesque leo neque, ut aliquet sapien ultrices et. Pellentesque pharetra turpis id ipsum accumsan, ut malesuada justo pretium. Vestibulum a leo elementum, vestibulum turpis et, consequat massa. Aliquam erat volutpat. Suspendisse laoreet dignissim porta. Donec ullamcorper elementum sem, ut cursus turpis lacinia in.</p>\r\n\r\n<p>Vivamus eleifend mauris nulla, nec consequat ante varius eget. Proin id tortor at sapien aliquam sollicitudin. Donec efficitur mauris neque, pellentesque porttitor velit tincidunt eu. Maecenas faucibus arcu lectus, id accumsan nibh sagittis at. Donec vitae quam a mi posuere congue. Donec non erat quam. Morbi massa tortor, tincidunt nec est nec, tincidunt congue mi. Ut et turpis congue, faucibus sem ut, volutpat turpis.</p>\r\n\r\n<p>Nulla vehicula turpis a nulla tempor, nec consectetur ipsum molestie. Aliquam et tempus mi, eget luctus augue. Vivamus justo orci, lobortis quis faucibus sed, dictum mollis purus. In in nisl non dolor aliquam laoreet varius vel leo. Cras diam quam, malesuada accumsan est nec, rutrum fermentum enim. Praesent mollis scelerisque libero quis venenatis. Ut egestas quam vel imperdiet tincidunt. Curabitur ultricies purus sem, vel euismod felis tincidunt sed. Cras vitae lectus pharetra, hendrerit nunc id, interdum enim. Proin pellentesque vestibulum turpis posuere tristique.</p>\r\n', '../uploads/Mengatasi-Tantangan-Kesehatan-Mental-Mahasiswa-Universitas-Prasetiya-Mulya (1).jpg', '2024-06-30 12:09:51', '2024-07-01 15:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `consultation_results`
--

CREATE TABLE `consultation_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_score` int(11) NOT NULL,
  `result_category` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions_a`
--

CREATE TABLE `questions_a` (
  `id_soal` int(11) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `nilai_a` int(11) NOT NULL,
  `nilai_b` int(11) NOT NULL,
  `nilai_c` int(11) NOT NULL,
  `nilai_d` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `questions_a`
--

INSERT INTO `questions_a` (`id_soal`, `kode`, `nilai_a`, `nilai_b`, `nilai_c`, `nilai_d`, `question_text`, `created_at`, `updated_at`) VALUES
(109, 'A1', 0, 1, 2, 3, 'Mulut kering', '2024-07-02 06:05:34', '2024-07-02 06:05:34'),
(110, 'A2', 0, 1, 2, 3, 'Sulit bernafas', '2024-07-02 06:05:51', '2024-07-02 06:05:51'),
(111, 'A3', 0, 1, 2, 3, 'Gemetar', '2024-07-02 06:06:05', '2024-07-02 06:06:05'),
(112, 'A4', 0, 1, 2, 3, 'Khawatir saat panik', '2024-07-02 06:06:20', '2024-07-02 06:06:20'),
(113, 'A5', 0, 1, 2, 3, 'Hampir panik', '2024-07-02 06:06:34', '2024-07-02 06:06:34'),
(114, 'A6', 0, 1, 2, 3, 'Perubahan detak jantung', '2024-07-02 06:06:47', '2024-07-02 06:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `questions_d`
--

CREATE TABLE `questions_d` (
  `id_soal` int(11) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `nilai_a` int(11) NOT NULL,
  `nilai_b` int(11) NOT NULL,
  `nilai_c` int(11) NOT NULL,
  `nilai_d` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `questions_d`
--

INSERT INTO `questions_d` (`id_soal`, `kode`, `nilai_a`, `nilai_b`, `nilai_c`, `nilai_d`, `question_text`, `created_at`, `updated_at`) VALUES
(92, 'D1', 0, 1, 2, 3, 'Tidak ada perasaan positif', '2024-07-02 06:07:06', '2024-07-02 06:07:06'),
(93, 'D2', 0, 1, 2, 3, 'Tidak ada inisiatif dalam melakukan sesuatu', '2024-07-02 06:07:17', '2024-07-02 06:07:17'),
(94, 'D3', 0, 1, 2, 3, 'Kehilangan minat', '2024-07-02 06:07:32', '2024-07-02 06:07:32'),
(95, 'D4', 0, 1, 2, 3, 'Sedih dan putus asa', '2024-07-02 06:07:44', '2024-07-02 06:07:44'),
(96, 'D5', 0, 1, 2, 3, 'Pesimis', '2024-07-02 06:07:55', '2024-07-02 06:07:55'),
(97, 'D6', 0, 1, 2, 3, 'Hidup tidak berharga dan berarti', '2024-07-02 06:08:07', '2024-07-02 06:08:07'),
(98, 'D7', 0, 1, 2, 3, 'Hidup tidak ada artinya (merasa tidak layak)', '2024-07-02 06:08:20', '2024-07-02 06:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `questions_s`
--

CREATE TABLE `questions_s` (
  `id_soal` int(11) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `nilai_a` int(11) NOT NULL,
  `nilai_b` int(11) NOT NULL,
  `nilai_c` int(11) NOT NULL,
  `nilai_d` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `questions_s`
--

INSERT INTO `questions_s` (`id_soal`, `kode`, `nilai_a`, `nilai_b`, `nilai_c`, `nilai_d`, `question_text`, `created_at`, `updated_at`) VALUES
(92, 'S1', 0, 1, 2, 3, 'Sulit untuk menenangkan diri', '2024-07-02 06:08:32', '2024-07-03 14:19:20'),
(93, 'S2', 0, 1, 2, 3, 'Reaksi berlebihan terhadap situasi', '2024-07-02 06:08:45', '2024-07-02 06:08:45'),
(94, 'S3', 0, 1, 2, 3, 'Menghabiskan banyak energi saat cemas (gugup)', '2024-07-02 06:08:57', '2024-07-02 06:08:57'),
(95, 'S4', 0, 1, 2, 3, 'Gelisah', '2024-07-02 06:09:08', '2024-07-02 06:09:08'),
(96, 'S5', 0, 1, 2, 3, 'Sulit untuk rileks', '2024-07-02 06:09:19', '2024-07-02 06:09:19'),
(97, 'S6', 0, 1, 2, 3, 'Tidak toleran terhadap gangguan atau hambatan', '2024-07-02 06:09:30', '2024-07-02 06:09:30'),
(98, 'S7', 0, 1, 2, 3, 'Mudah tersinggung', '2024-07-02 06:09:42', '2024-07-02 06:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Namalengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `profile_image` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Namalengkap`, `email`, `password`, `phoneNumber`, `prodi`, `gender`, `role`, `created_at`, `updated_at`, `profile_image`, `reset_token`) VALUES
(48, 'Admin Serenity', 'admin@gmail.com', '$2y$10$q0LC8jO4Mo7wBjmZcqsJCOzVG1.vVo.Zw9wxKnE5/ts7X84W52kAK', '0859671428701', 'MI', 'Laki-Laki', 'admin', '2024-01-05 11:09:18', '2024-07-03 14:57:14', '../uploads/profile/Logo Serenity.ico', 'e8ede0fb892ed9239c96b100d2d374c0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `consultation_results`
--
ALTER TABLE `consultation_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `questions_a`
--
ALTER TABLE `questions_a`
  ADD PRIMARY KEY (`id_soal`) USING BTREE;

--
-- Indexes for table `questions_d`
--
ALTER TABLE `questions_d`
  ADD PRIMARY KEY (`id_soal`) USING BTREE;

--
-- Indexes for table `questions_s`
--
ALTER TABLE `questions_s`
  ADD PRIMARY KEY (`id_soal`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `consultation_results`
--
ALTER TABLE `consultation_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `questions_a`
--
ALTER TABLE `questions_a`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `questions_d`
--
ALTER TABLE `questions_d`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `questions_s`
--
ALTER TABLE `questions_s`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultation_results`
--
ALTER TABLE `consultation_results`
  ADD CONSTRAINT `consultation_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
