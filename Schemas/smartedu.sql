-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2025 at 07:55 PM
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
-- Database: `smartedu`
--

-- --------------------------------------------------------

--
-- Table structure for table `module_english`
--

CREATE TABLE `module_english` (
  `id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `chapter` varchar(1000) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_english`
--

INSERT INTO `module_english` (`id`, `subject`, `chapter`, `title`, `description`) VALUES
(1, 'english', '1', 'The Power of Language – Understanding How Words Shape Our World', 'Introduction\nLanguage is more than just a means of communication—it\'s the foundation of how we think, express ourselves, connect with others, and shape the world around us. In this chapter, we will explore how language functions not only as a tool for daily communication but also as a powerful instrument for storytelling, persuasion, emotion, and identity. Understanding the power of language will help you become a more effective speaker, a critical reader, and a confident writer.\n\nWhat Is Language?\nLanguage is a structured system of symbols—words, sounds, gestures, and rules—that allows humans to convey thoughts, feelings, and information. It includes both spoken and written forms and varies widely across cultures and communities.\n\nLanguage is made up of key components:\n\nVocabulary: the collection of words known and used\n\nGrammar: the rules that govern how words are structured into sentences\n\nSyntax: how words are arranged in a sentence\n\nTone: the emotional quality or mood of the message\n\nContext: the situation in which language is used (who, when, where, why)\n\nThe Role of Language in Communication\nLanguage allows us to:\n\nExpress thoughts and emotions: We use language to say how we feel or what we think.\n\nShare knowledge: Through books, conversation, and media, we communicate what we know.\n\nBuild relationships: Language connects people. We use it to relate, empathize, and understand others.\n\nInfluence and persuade: Advertisements, speeches, and debates show how language can influence opinions and actions.');

-- --------------------------------------------------------

--
-- Table structure for table `module_history`
--

CREATE TABLE `module_history` (
  `id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `chapter` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module_history`
--

INSERT INTO `module_history` (`id`, `subject`, `chapter`, `title`, `description`) VALUES
(1, 'history', '1', 'The History of Asia', 'Asia, the largest and most diverse continent on Earth, has been home to some of the world\'s earliest civilizations. From the fertile valleys of Mesopotamia and the Indus River to the ancient dynasties of China, Asia\'s history spans thousands of years and has shaped the world in profound ways. This lesson explores the early civilizations of Asia, their cultures, and their lasting contributions to human history.\nAncient Civilizations of Asia\nThe earliest civilizations in Asia emerged in river valleys, where fertile land allowed agriculture to flourish. One of the first great civilizations was Mesopotamia, located between the Tigris and Euphrates rivers (present-day Iraq). The Sumerians, Akkadians, Babylonians, and Assyrians ruled this region, developing the earliest known writing system, cuneiform, and the first set of laws, Hammurabi’s Code.\nIn South Asia, the Indus Valley Civilization (c. 3300–1300 BCE) developed in present-day Pakistan and northwest India. This highly organized society built well-planned cities such as Mohenjo-Daro and Harappa, with advanced drainage systems and trade networks. The people of this civilization had a writing system that remains undeciphered today.\nFurther east, in China, the Shang Dynasty (c. 1600–1046 BCE) was the first recorded dynasty, known for its bronze casting, oracle bones (used for divination), and early forms of Chinese writing. This was followed by the Zhou Dynasty (1046–256 BCE), which introduced the concept of the Mandate of Heaven, the belief that rulers were given the right to rule by the gods.\nReligions and Philosophies\nAsia is the birthplace of many major religions and philosophies. Hinduism and Buddhism originated in India, shaping the spiritual and cultural traditions of the region. Hinduism, one of the world\'s oldest religions, is based on sacred texts like the Vedas and Upanishads. Buddhism, founded by Siddhartha Gautama (the Buddha) in the 5th-4th century BCE, spread from India to China, Japan, and Southeast Asia, influencing millions.\nIn China, Confucianism and Daoism emerged as dominant philosophical traditions. Confucius (551–479 BCE) taught about social harmony, respect for elders, and moral leadership. Meanwhile, Laozi, the founder of Daoism, emphasized living in harmony with nature.\nThe Silk Road and Cultural Exchange\nTrade routes, such as the Silk Road, connected Asia with Europe and Africa, allowing for the exchange of goods, ideas, and cultures. The Silk Road facilitated the spread of Buddhism from India to China, Persia, and beyond. It also introduced silk, spices, and paper-making techniques to the West.\nConclusion\nAsia’s ancient civilizations laid the foundations for modern societies. Their innovations in writing, law, religion, and trade influenced cultures across the world. Understanding this early history helps us appreciate Asia’s role in shaping global civilization.\n\n');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_history`
--

CREATE TABLE `quiz_history` (
  `id` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `quiz_title` varchar(500) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `choice_a` varchar(200) NOT NULL,
  `choice_b` varchar(200) NOT NULL,
  `choice_c` varchar(200) NOT NULL,
  `choice_d` varchar(200) NOT NULL,
  `correct_choice` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_history`
--

INSERT INTO `quiz_history` (`id`, `subject`, `quiz_title`, `question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `correct_choice`) VALUES
(1, 'history', 'The History of Asia', 'Where did the earliest Asian civilizations typically emerge?', 'Mountain ranges', 'Deserts', 'River valleys', 'Coastal regions', 'C'),
(2, 'history', 'The History of Asia', 'Which writing system was developed by the Sumerians?', 'Hieroglyphics', 'Sanskrit', 'Oracle Bones', 'Cuneiform', 'D'),
(3, 'history', 'The History of Asia', 'What is Hammurabi best known for?', 'Inventing the wheel', 'Building the pyramids', 'Creating the first set of written laws', 'Founding Buddhism', 'C'),
(4, 'history', 'The History of Asia', 'The cities of Mohenjo-Daro and Harappa were part of which ancient civilization?', 'Mesopotamian', 'Indus Valley', 'Chinese', 'Persian', 'B'),
(5, 'history', 'The History of Asia', 'Which Chinese dynasty is known for bronze casting and using oracle bones?', 'Han Dynasty', 'Zhou Dynasty', 'Shang Dynasty', 'Qin Dynasty', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `total_score` varchar(200) NOT NULL,
  `total_item` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `name`, `total_score`, `total_item`) VALUES
(1, 'PogiKo talaga eh', '4', '5'),
(2, 'PogiKo talaga eh', '4', '5'),
(3, 'PogiKo talaga eh', '4', '5'),
(4, 'PogiKo talaga eh', '4', '5'),
(5, 'PogiKo talaga eh', '1', '5'),
(6, 'PogiKo talaga eh', '1', '5'),
(7, 'PogiKo talaga eh', '4', '5'),
(8, 'PogiKo talaga eh', '4', '5'),
(9, 'PogiKo talaga eh', '4', '5'),
(10, 'PogiKo talaga eh', '2', '5');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `profile_pic` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `age`, `profile_pic`, `created_at`) VALUES
(1, 'renz', 'matthew', 'matthewybamit@ymail.com', 'matthewibamit', '$2y$10$PhgpPvPEXTqayIEiIQx/eu4qjaj3npbVXLo76nyKUdgo1VoUlClCu', 21, 'photos/default-avatar-icon.jpg', '2025-03-23 19:10:29'),
(4, 'dwa', 'awfa', 'matthewybamit@gmail.com', 'matthewibamit', '$2y$10$jyeFF22l6aQATQAYQ/n28uQ2bjso4m8rWBfRzZtW5PCMQsnA9DGqu', 21, 'photos/default-avatar-icon.jpg', '2025-03-23 19:35:31'),
(5, 'Renz Matthew waf', 'Ybamitfa', 'renzmatthew.ybamit@gmail.com', 'nfafnionf', '$2y$10$DqZj9U.ApBRw8ohtFncQvuGMfZhfgxlg5s190K/A62pCBpbnvSWWG', 21, 'photos/default-avatar-icon.jpg', '2025-03-23 19:46:41'),
(6, 'Pogi', 'Talaga', 'pogikotalaga@gmail.com', 'Pogi', '$2y$10$ngW4ACX1j0tAL.oEVmAVK.eVwzYnfiW7Tb9OjG6Q6hGXYZJiU5xri', 20, 'photos/default-avatar-icon.jpg', '2025-04-07 19:18:50'),
(7, 'PogiKo', 'Yon', 'pogikotalaga1@gmail.com', 'PogiKo', '$2y$10$J6018UvuddavsBacJkqnSO0biH/gMosjjqq46GdvKg/lvdSumqMcC', 20, 'photos/default-avatar-icon.jpg', '2025-04-07 19:26:58'),
(8, 'PogiKo', 'talaga eh', 'pogikotalaga2@gmail.com', 'PogiKo2', '$2y$10$kGFNDxqB2CprZweEA68JeeVs7LDuQZvfjfIdFAETfGCQ4VIIfIccu', 18, 'photos/67fba851abc62_lets-go 1.png', '2025-04-13 08:57:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `module_english`
--
ALTER TABLE `module_english`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_history`
--
ALTER TABLE `module_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_history`
--
ALTER TABLE `quiz_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
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
-- AUTO_INCREMENT for table `module_english`
--
ALTER TABLE `module_english`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `module_history`
--
ALTER TABLE `module_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quiz_history`
--
ALTER TABLE `quiz_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
