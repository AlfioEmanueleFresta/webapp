-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 06, 2016 at 04:19 PM
-- Server version: 5.5.49-0+deb8u1
-- PHP Version: 5.6.22-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbname`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
`id` int(11) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `timestamp`, `author_id`, `title`, `body`) VALUES
(1, 1467812252, 1, 'My First Article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In egestas nulla eros, eget fringilla mi mollis vitae. Mauris porttitor hendrerit magna, eget viverra purus mattis in. Pellentesque faucibus consequat volutpat. Integer sit amet vulputate sem. Cras id laoreet lectus. Vestibulum convallis, libero ac bibendum aliquam, lacus nunc dapibus ante, ac tincidunt quam libero eget dui. Sed lectus turpis, lacinia et sollicitudin ullamcorper, tincidunt eu tellus. In hac habitasse platea dictumst. Maecenas cursus dolor at ante hendrerit, et molestie metus mollis. Maecenas facilisis egestas libero, in finibus nisl condimentum eget. Nam eu massa turpis. Donec tristique vitae leo sit amet vulputate.\r\n'),
(2, 1467813252, 2, 'My Second Article', 'Nam nec sagittis elit, id dictum eros. Cras pulvinar ex at dictum vehicula. Sed quis est a libero gravida tristique. Pellentesque ligula mauris, efficitur condimentum ipsum sagittis, bibendum placerat nulla. Nulla posuere eleifend metus nec laoreet. Morbi dolor urna, sagittis id ligula at, egestas bibendum neque. Donec vitae magna semper ante ornare feugiat et sed mauris. Cras sagittis turpis ut tristique fermentum. Praesent dignissim tellus nec velit tempus tincidunt.\r\n\r\nCras quis dapibus ipsum, quis rhoncus tellus. Vivamus ac efficitur nisl. Phasellus ultricies purus venenatis leo semper, vitae euismod arcu luctus. Donec malesuada blandit ligula vitae efficitur. Nam dui leo, fringilla quis tellus id, malesuada sagittis lectus. Integer convallis augue vestibulum, aliquet mauris a, ultricies risus. Donec consectetur gravida orci eu porttitor. Donec eget tincidunt lectus. Nunc non ornare lacus.\r\n\r\n'),
(3, 1467814252, 3, 'My Third Article', 'Nam nec sagittis elit, id dictum eros. Cras pulvinar ex at dictum vehicula. Sed quis est a libero gravida tristique. Pellentesque ligula mauris, efficitur condimentum ipsum sagittis, bibendum placerat nulla. Nulla posuere eleifend metus nec laoreet. Morbi dolor urna, sagittis id ligula at, egestas bibendum neque. Donec vitae magna semper ante ornare feugiat et sed mauris. Cras sagittis turpis ut tristique fermentum. Praesent dignissim tellus nec velit tempus tincidunt.\r\n\r\nCras quis dapibus ipsum, quis rhoncus tellus. Vivamus ac efficitur nisl. Phasellus ultricies purus venenatis leo semper, vitae euismod arcu luctus. Donec malesuada blandit ligula vitae efficitur. Nam dui leo, fringilla quis tellus id, malesuada sagittis lectus. Integer convallis augue vestibulum, aliquet mauris a, ultricies risus. Donec consectetur gravida orci eu porttitor. Donec eget tincidunt lectus. Nunc non ornare lacus.\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `author_id`, `timestamp`, `body`) VALUES
(8, 1, 2, 1467821812, 'Great article. The most interesting placeholder text I''ve read in my entire life.'),
(9, 2, 3, 1467821925, 'This is a great first article. The only thing I can think it''s missing is... any meaning at all.'),
(10, 1, 1, 1467821937, 'You''re right, Matt.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(32) NOT NULL DEFAULT 'user',
  `hint` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `hint`) VALUES
(1, 'admin', 'f69f93b059cf27adbc6955fbd566186b26dbe19cacfa0ad1309dfb4eab058085', 'staff', 'my favourite book'),
(2, 'matt', '7e225d0a077d46f59c93ac73bc5aa2d0b495297238c97909a97bed63de3f9e08', 'user', 'what i love most'),
(3, 'john', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'user', 'ditto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`id`), ADD KEY `timestamp` (`timestamp`,`author_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `article_id` (`article_id`,`author_id`,`timestamp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
