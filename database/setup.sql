-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2016 at 10:11 AM
-- Server version: 5.5.49-0+deb8u1
-- PHP Version: 5.6.23-0+deb8u1

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
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `password_hash`, `role`, `hint`, `salt`) VALUES
(1, 'admin', 'mobydick', '', 'staff', 'my favourite book', 'This is the salt for exercise 2'),
(2, 'matt', 'ilikecats', '', 'user', 'what i love most', 'This is the salt for exercise 2'),
(3, 'john', 'password', '', 'user', 'ditto', 'This is the salt for exercise 2'),
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
(100, 'b001', NULL, '7f5214fe89bfb7626bdafad41eeed501d58f7eb25338b22b24a7aca5f3bbaa79', 'staff', '', 'bc95aba9fbb626e2e2edd18f5b07444ea4ee96ee1a1f78e0ab1800bc6ff97eaa'),
(101, 'b002', NULL, 'ad524378892eec75e96f4813148cf58a6922a485af8b28797613cea01248f489', 'user', '', 'e926b29e73099c9345692b71cba70b9120afe7ba2900ff119fc03f5b3efc29d3'),
(102, 'b003', NULL, '49029a52333fddd6d7410eb34d90e3f0bcc8c57e71ee61eccdb9149438f3eeeb', 'user', '', '951b45c744166533222f9354393397fa32cba848c5cbcd38b7be78910a14c230'),
(103, 'b004', NULL, 'f4743ef86bc50216852edc447c7186f425db0d83f301d8ff25ae89b3f4e7e642', 'user', '', '71dfed2e0ae0409f5c4cefc2a231b2a21b44b57a544863e58ad1cda6e6017d32'),
(104, 'b005', NULL, '0cd026f659531e3dc573cb6fed017781f54c3e0942b9870945911fe611040d9f', 'user', '', 'b316757141b275c3f9312e7d74ce66a41400b010537f3558d7beec5b5322a0a2'),
(105, 'b006', NULL, '1fc6e1b06e97f3f566a6ef1bc8032e2abc473b8aff04b63418fc0f9b87aebe87', 'user', '', 'f679e513ef3f979446cd7cbebff846c8dfa4a685459889f913915ef40dd8e926'),
(106, 'b007', NULL, '5be2e27c0095b488a64df993bab69929a1a7cff262c76fc58b878fe5a6413c76', 'user', '', '4fff251de28027843919b10944b1129289e951462f9dc0b8d267a18bb29a8fb1'),
(107, 'b008', NULL, 'c512172bbd4c2d16cbcdde6f923cc8317ff7dd50359c0cae863346f584578e2d', 'user', '', '9ddd450b1e85983ac70e40a35056a129423fa0d96d77fc915de55d34d928b34a'),
(108, 'b009', NULL, 'e812ce69ea07900a7ec1dd1d9cc1c0d69f609340bd0481d1cf81a301866ea89f', 'user', '', '34f17c194bca94472ffd3933d80d300b7602965de1fb90788b8cb0dd30ed7ec3'),
(109, 'b010', NULL, '4fc63e4a0b4286ee6ef6f87e0919c921516348dbc96e5cd0995fa02f2e2518aa', 'user', '', '40e7fcebd8f328241e1d45d72884d709e3496bdc50d50f2130491b311a3a0679'),
(110, 'b011', NULL, '6b788cbf82b79f9e3cbf92ce99ce21a5f07921705b9b041542bb300d9ef13e2b', 'user', '', '7d787f88c24b070e25760caf654afcc991095501edacab65a873cf175206bc45'),
(111, 'b012', NULL, '775776031e160e402924a4973a8eb1c66124c758f60b089e797a2feda834ad41', 'user', '', 'a83c3e6dee5f21dffe7530b7ee63201ca67a0466f1f5a15729d30527a9eb06c6'),
(112, 'b013', NULL, '1712ee91936b9e46ae8e13ba84220bf207db6bb250822b1b047392cbadbc50d2', 'user', '', 'b4e9eead7aa1caea3c9b46c5ff34f063b73b44e2e5c3370748d179cc594a9dd8'),
(113, 'b014', NULL, '8c57522f9c48be4f0d8ee5e37be9e3b7ac43a0c57e357de24c9d6222e81ecf98', 'user', '', '31407f5e0de6fee957b33e254b5d6c317d4bf3e2de2ef301f1210210c2c52e83'),
(114, 'b015', NULL, '446473cce1c6698e3618dd8f945057d0f8155c7060b685da5c5d722e814fe933', 'user', '', 'f9230b12a6d9e5c1bee695cfb2336f624ef2809e58c9342e1262c2ffcc2db40a'),
(115, 'b016', NULL, '4980e16e49692e8bd30b4068514da69e425fb233d4f565bd42bf8b021e896aba', 'user', '', '0f399071ba74ddb0e3d4a312801339896032762b3dccacb026c5a1f92852e639'),
(116, 'b017', NULL, '2093f51839004e6e4225dfaf446fc05593dd234e30ca2a5369e9d7843a81d2cc', 'user', '', '2c7bd3f31dc6e861cf11d2f282f5dc962c964b704241215826798f6a8abbe68f'),
(117, 'b018', NULL, '7fd4c53efdb50f7add0cd6cfc7e4e52c1b0b92b8ef8f4d5dcc106414220e8ddb', 'user', '', '7493180e1d29353f5fe2c0a6af5481986fd7341efdd58db37c35cf7b812ab85a'),
(118, 'b019', NULL, 'f33a2af31b03835a2bc5a0affa2d05a9567b284bed7f748a47fc46f62be1686a', 'user', '', '02e0bd919da4513a740fe45a56585fd0f05886c3e6c93ce111be2d34109f22ae'),
(119, 'b020', NULL, 'a79618cca95fac35b431291f1c1714fd515347c35998ebded42feefd48266cc5', 'user', '', '5081e26fe85b2d637e524c37cc67ebadeb6a013fc718b479b41dbaa38547f9d8');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=128;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
