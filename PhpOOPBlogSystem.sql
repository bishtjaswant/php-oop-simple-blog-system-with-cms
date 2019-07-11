-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2019 at 02:29 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PhpOOPBlogSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(12) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'jaswant bisht', 'jaswant@admin.com', '$2y$10$Z3boGZ9abvDOeqvFleeqNO.AGLe6WM9H4qmyxbWhWNZMIV8/fivNW'),
(2, 'rajni arya', 'rajni@admin.com', '$2y$10$LBXZ3omnng0o36HNiMDMD.Zxlsdf3tf7LOzoOQjpcNxi00sbYCwiq');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(18, 'angular'),
(19, 'mongo nosql'),
(20, 'web designer'),
(22, 'education NCERT');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(12) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `readby` varchar(120) NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `sentat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `firstname`, `lastname`, `email`, `message`, `readby`, `seen`, `sentat`) VALUES
(7, 'Gitesh', 'Rautela', 'giteshrautela@gmail.in', 'hhello admin', 'rajni arya', 1, '2019-07-10 20:20:32'),
(9, 'Piyush', 'Goyal', 'piyushgoyal785624@outlook.com', 'P\r\nAbout us..Some text will be go here. Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here. Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.\r\n\r\nAbout me..Some text will be go h', 'rajni arya', 0, '2019-07-11 09:34:46'),
(10, 'Kumer', 'Singh', 'kumar@ggmail.in', 'QWERTYUI', 'rajni arya', 1, '2019-07-11 11:19:34'),
(16, 'Kkhem', 'Singh', 'khemsingh@yahoo.im', 'qwerrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', '', 0, '2019-07-11 13:02:23');

-- --------------------------------------------------------

--
-- Table structure for table `copyright`
--

CREATE TABLE `copyright` (
  `id` int(12) NOT NULL,
  `name` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `copyright`
--

INSERT INTO `copyright` (`id`, `name`) VALUES
(1, 'THAKUR WEB TECHNOLOGY');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(12) NOT NULL,
  `title` varchar(100) NOT NULL,
  `cat` int(12) NOT NULL,
  `body` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `author` varchar(25) NOT NULL,
  `postedat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tag` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `cat`, `body`, `images`, `author`, `postedat`, `tag`) VALUES
(52, 'become doctor', 20, 'qwertyun PYARI', '3e5fba1e9c.jpg', 'jaswant bisht', '2019-07-09 11:22:19', 'doctor'),
(53, 'angularr developer', 18, 'About us..Some text will be go here. Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here. Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.\r\n\r\nAbout me..Some text will be go here. Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go he', '0f35ed45a1.jpg', 'jaswant bisht', '2019-07-10 17:32:28', 'angular,deve'),
(54, 'how guys new syllabus released from NCERT', 22, 'About us..Some text will be go here. Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here. Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.Some text will be go here.\r\n\r\nAbout me..Some text will be go h', '0909c60372.jpg', 'rajni arya', '2019-07-11 09:31:40', 'ncert,uk,uni');

-- --------------------------------------------------------

--
-- Table structure for table `slogan`
--

CREATE TABLE `slogan` (
  `id` int(12) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slogan`
--

INSERT INTO `slogan` (`id`, `title`, `slogan`, `logo`) VALUES
(1, 'thakur web technologies', 'php,nodejs,angular,react,sql,mongo and much more', '6d0769f3c7.png');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `gl` varchar(100) NOT NULL,
  `githup` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `fb`, `insta`, `tw`, `gl`, `githup`) VALUES
(1, 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.twitter.com', 'https://www.google.com', 'https://github.com/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `copyright`
--
ALTER TABLE `copyright`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slogan`
--
ALTER TABLE `slogan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `copyright`
--
ALTER TABLE `copyright`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `slogan`
--
ALTER TABLE `slogan`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
