-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2016 at 10:27 AM
-- Server version: 5.5.50-0+deb8u1
-- PHP Version: 5.6.24-0+deb8u1

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `timestamp`, `author_id`, `title`, `body`) VALUES
(1, 1467812252, 1, 'Alan Turing', 'Alan Mathison Turing OBE FRS (23 June 1912 - 7 June 1954) was a pioneering English computer scientist, mathematician, logician, cryptanalyst and theoretical biologist. He was highly influential in the development of theoretical computer science, providing a formalisation of the concepts of algorithm and computation with the Turing machine, which can be considered a model of a general purpose computer. Turing is widely considered to be the father of theoretical computer science and artificial intelligence.\r\n\r\nDuring the Second World War, Turing worked for the Government Code and Cypher School (GC&CS) at Bletchley Park, Britain''s codebreaking centre. For a time he led Hut 8, the section responsible for German naval cryptanalysis. He devised a number of techniques for breaking German ciphers, including improvements to the pre-war Polish bombe method and an electromechanical machine that could find settings for the Enigma machine. Turing played a pivotal role in cracking intercepted coded messages that enabled the Allies to defeat the Nazis in many crucial engagements, including the Battle of the Atlantic; it has been estimated that this work shortened the war in Europe by as many as four years.\r\n\r\n("Alan Turing", Wikipedia: The Free Encyclopedia)'),
(2, 1467813252, 2, 'Dennis MacAlistair Ritchie', 'Dennis MacAlistair Ritchie (September 9, 1941 - c. October 12, 2011) was an American computer scientist. He created the C programming language and, with long-time colleague Ken Thompson, the Unix operating system. Ritchie and Thompson received the Turing Award from the ACM in 1983, the Hamming Medal from the IEEE in 1990 and the National Medal of Technology from President Clinton in 1999. Ritchie was the head of Lucent Technologies System Software Research Department when he retired in 2007. He was the "R" in K&R C, and commonly known by his username dmr.\r\n\r\n("Dennis MacAlistair Ritchie", Wikipedia: The Free Encyclopedia)'),
(3, 1467814252, 3, 'The PHP Programming Language', 'PHP is a server-side scripting language designed for web development but also used as a general-purpose programming language. Originally created by Rasmus Lerdorf in 1994, the PHP reference implementation is now produced by The PHP Group. PHP originally stood for Personal Home Page, but it now stands for the recursive backronym PHP: Hypertext Preprocessor.\r\n\r\nPHP code may be embedded into HTML code, or it can be used in combination with various web template systems, web content management systems and web frameworks. PHP code is usually processed by a PHP interpreter implemented as a module in the web server or as a Common Gateway Interface (CGI) executable. The web server combines the results of the interpreted and executed PHP code, which may be any type of data, including images, with the generated web page. PHP code may also be executed with a command-line interface (CLI) and can be used to implement standalone graphical applications.\r\n\r\n("PHP", Wikipedia: The Free Encyclopedia)');

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
(8, 1, 2, 1467821812, 'Great article. The most interesting copy-and-pasted article from Wikipedia I''ve read in my entire life.'),
(9, 2, 3, 1467821925, 'This is a great article. This man contributed a lot to Computer Science.'),
(10, 1, 1, 1467821937, 'You''re right, Matt.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `role` varchar(32) NOT NULL DEFAULT 'user',
  `hint` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `password_hash`, `role`, `hint`, `salt`) VALUES
(1, 'admin', 'mobydick', '', 'staff', 'my favourite book', 'This is the salt for exercise 2'),
(2, 'matt', 'ilikecats', '', 'user', 'what i love most', 'This is the salt for exercise 2'),
(3, 'john', 'password', '', 'user', 'ditto', 'This is the salt for exercise 2'),
(4, 'jake', 'pass5', '', 'staff', 'ditto', 'This is the salt for exercise 2'),
(16, 'a001', NULL, 'f0d78f50ccfb95a07c19c44d8cafca4f55f3c379aed16a3cf13fbba4ee994f53', 'staff', '', 'This is the salt for exercise 2'),
(17, 'a002', NULL, 'c1d56af5a8c2651f281fca0c7be811dc99aa38e54daf6e68acba284a691842ee', 'user', 'My usual password', 'This is the salt for exercise 2'),
(18, 'a003', NULL, 'c6a28b5dc80d98b97ffb3a3b9113f6024a0e3b97fcbc3a1117291f1c3bc0f309', 'user', 'He''d never give you up', 'This is the salt for exercise 2'),
(19, 'a004', NULL, '137917844ec56a3aef06c673b14296d3498f09b9334643d1711cf8a3d5ea2ea0', 'user', '', 'This is the salt for exercise 2'),
(20, 'a005', NULL, 'c1d56af5a8c2651f281fca0c7be811dc99aa38e54daf6e68acba284a691842ee', 'user', '', 'This is the salt for exercise 2'),
(21, 'a006', NULL, 'b0fd932b42cb5eaa5df6edc785360b42f81b6995094bbe224a92e967e446dd7a', 'user', 'Best football team', 'This is the salt for exercise 2'),
(22, 'a007', NULL, '0aa5ca601ff4efc9ed402e275a2e967727c228b1465c51282e19936915cb99b1', 'user', 'Favourite biscuit', 'This is the salt for exercise 2'),
(23, 'a008', NULL, 'd4926f3460c6466652b6ad8ef86d01a67d24891dc346d36da8a02c5faf7d0b4a', 'user', '', 'This is the salt for exercise 2'),
(24, 'a009', NULL, 'f0d78f50ccfb95a07c19c44d8cafca4f55f3c379aed16a3cf13fbba4ee994f53', 'user', 'Shake It Off', 'This is the salt for exercise 2'),
(25, 'a010', NULL, '8f7a9a11649a62ec58cca508af6d5d691d916d7b1d2a6112e398505c20c2747f', 'user', '', 'This is the salt for exercise 2'),
(26, 'a011', NULL, 'a96051a7975b9335ac84b63b3b1e505a45714c18668ac4b04e15800ca1fc51b2', 'user', '123', 'This is the salt for exercise 2'),
(27, 'a012', NULL, 'faff3df8bcd19faae22acd433e0636979ec907af6fef30751f1a0612fe5b629b', 'staff', '', 'This is the salt for exercise 2'),
(28, 'a013', NULL, 'f2e39dfdcbd9d1aa38097372642b355eb2330db14415288a98190af2a1c3d50c', 'user', 'Childhood dog', 'This is the salt for exercise 2'),
(29, 'a014', NULL, 'c1d56af5a8c2651f281fca0c7be811dc99aa38e54daf6e68acba284a691842ee', 'user', '', 'This is the salt for exercise 2'),
(30, 'a015', NULL, 'f0d78f50ccfb95a07c19c44d8cafca4f55f3c379aed16a3cf13fbba4ee994f53', 'user', 'Favourite programming language', 'This is the salt for exercise 2'),
(31, 'a016', NULL, '0503119ed41758007418a619a730d1769cf14860e5c2ee7c63fec07408f50e16', 'user', 'Web comic', 'This is the salt for exercise 2'),
(32, 'a017', NULL, '6138713d6348742be9057d72abccf62c0aea85f301bc98e241dbd7d2fb60a084', 'user', 'River', 'This is the salt for exercise 2'),
(33, 'a018', NULL, '8d04afe1e6e71b17defca7ba4932042869cb144a440775aa974c9ac18d90f8f8', 'user', 'Who?', 'This is the salt for exercise 2'),
(34, 'a019', NULL, 'f930987f760bdec540657c43c0205c060b8e1ec5c76dcdc3de30946bcccae99d', 'user', '', 'This is the salt for exercise 2'),
(35, 'a020', NULL, '70e9299e9167af67a01b0e9229b3226b49069a84f3609b966c5b362d8ea2bbfc', 'user', 'Favourite band', 'This is the salt for exercise 2'),
(100, 'b001', NULL, 'e0dc3bebea05b7b869fec88dea588e9c1edf7be95d78730312ed9f025d0ab583', 'staff', '', 'bc95aba9fbb626e2e2edd18f5b07444ea4ee96ee1a1f78e0ab1800bc6ff97eaa'),
(101, 'b002', NULL, 'bc5202c25a712eea61b286745b56c41fc2a5dcc61cf16327c0bd15df24e82638', 'user', '', 'e926b29e73099c9345692b71cba70b9120afe7ba2900ff119fc03f5b3efc29d3'),
(102, 'b003', NULL, 'a1a090827e599c3ec3bd4fa61cb0b43f6ca528f8a65b417c8956ceda7c42e4eb', 'user', '', '951b45c744166533222f9354393397fa32cba848c5cbcd38b7be78910a14c230'),
(103, 'b004', NULL, '710df48a133dfb127c74b85741e57069d3899a7c4febd215abdb4eea08124688', 'user', '', '71dfed2e0ae0409f5c4cefc2a231b2a21b44b57a544863e58ad1cda6e6017d32'),
(104, 'b005', NULL, 'aa0d895b51331cfdba5fedc6371ebb0b9dac8ecb6e9678456919fa3c9dbf7674', 'user', '', 'b316757141b275c3f9312e7d74ce66a41400b010537f3558d7beec5b5322a0a2'),
(105, 'b006', NULL, '54beea3c0d7848f60ca351842773072db8a515bdabe158343ad66f89d18778f7', 'user', '', 'f679e513ef3f979446cd7cbebff846c8dfa4a685459889f913915ef40dd8e926'),
(106, 'b007', NULL, '84eb5ed19d199360affea2b8386c4305af028c000fc893283f922364600eb03f', 'user', '', '4fff251de28027843919b10944b1129289e951462f9dc0b8d267a18bb29a8fb1'),
(107, 'b008', NULL, '1371014a9177aea8713f3242cb9e9d577b0b4b157f1be7ddd0c684ccd355925a', 'user', '', '9ddd450b1e85983ac70e40a35056a129423fa0d96d77fc915de55d34d928b34a'),
(108, 'b009', NULL, 'fba471de11730f5f2e2053044b69930efe897e1427113791c6ecc0bad1be8fc7', 'user', '', '34f17c194bca94472ffd3933d80d300b7602965de1fb90788b8cb0dd30ed7ec3'),
(109, 'b010', NULL, '1cda37c74cde527b56626c170c2e2d88a3ad850fc22124612c6d2d4c69ac515f', 'user', '', '40e7fcebd8f328241e1d45d72884d709e3496bdc50d50f2130491b311a3a0679'),
(110, 'b011', NULL, '4f25f80c09ca9232054f50578d03a7e7b36fb1485417cb6dea731615b655ae9e', 'user', '', '7d787f88c24b070e25760caf654afcc991095501edacab65a873cf175206bc45'),
(111, 'b012', NULL, 'eb2a0a5a17462dae8b15b748c6647d58f8be8f885d6a5bba7b9727dac1740601', 'user', '', 'a83c3e6dee5f21dffe7530b7ee63201ca67a0466f1f5a15729d30527a9eb06c6'),
(112, 'b013', NULL, 'fc5191a4e3584d1f626f39a47e1722c71e8992281a260e82cee6225b80a2c830', 'user', '', 'b4e9eead7aa1caea3c9b46c5ff34f063b73b44e2e5c3370748d179cc594a9dd8'),
(113, 'b014', NULL, 'ce747e51ecfdea77c931c0e840f2363c937a7a300357ef69eaa0e97d635f26aa', 'user', '', '31407f5e0de6fee957b33e254b5d6c317d4bf3e2de2ef301f1210210c2c52e83'),
(114, 'b015', NULL, '1975033991d447e0a7cdbe72e753ea769c4492b331ababcf93e6bd8e93e72336', 'user', '', 'f9230b12a6d9e5c1bee695cfb2336f624ef2809e58c9342e1262c2ffcc2db40a'),
(115, 'b016', NULL, 'fa872aec03a4039baa15194e15fe0696aa477bcba205a534f26071861d0cad7e', 'user', '', '0f399071ba74ddb0e3d4a312801339896032762b3dccacb026c5a1f92852e639'),
(116, 'b017', NULL, 'f02f3d1f0594f0291b06c1fa6c91f73b02c3d0d61559d361f8b4a781c93efa6f', 'user', '', '2c7bd3f31dc6e861cf11d2f282f5dc962c964b704241215826798f6a8abbe68f'),
(117, 'b018', NULL, '53429719fe65870861382e62888c7d43d3862491c75f4c23dd035dd78c1e4cbc', 'user', '', '7493180e1d29353f5fe2c0a6af5481986fd7341efdd58db37c35cf7b812ab85a'),
(118, 'b019', NULL, '6b68ee74bf90e525d5231e66e4c6e8b09c992bb8f554619b37d46f777a82a66e', 'user', '', '02e0bd919da4513a740fe45a56585fd0f05886c3e6c93ce111be2d34109f22ae'),
(119, 'b020', NULL, '0df807ca4e73206a66fceb7ec36c20a4b9526431e9fb6edb1fa1d5fadeb27130', 'user', '', '5081e26fe85b2d637e524c37cc67ebadeb6a013fc718b479b41dbaa38547f9d8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=130;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
