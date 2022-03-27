-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 07:27 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `authorid` int(11) NOT NULL,
  `content` varchar(500) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `authorid`, `content`, `time`, `post_id`) VALUES
(5, 2, 'helo', '08:51 AM|2022/03/06', 100),
(6, 2, 'this is a comment😃', '08:51 AM|2022/03/06', 100),
(7, 2, 'nice video\r\n', '08:52 AM|2022/03/06', 4),
(8, 2, 'very sad😟😟🥺', '09:15 AM|2022/03/06', 9),
(9, 6, 'sorry to hear that, may god help them🤲', '09:15 AM|2022/03/06', 9),
(11, 2, 'What is the name of the component??🙄😬😷👋', '03:23 PM|2022/03/06', 6),
(12, 2, 'how much is it?', '03:29 PM|2022/03/06', 6),
(13, 2, 'wow nice video, how is this even possible?😳😱😮', '03:31 PM|2022/03/06', 8),
(15, 2, 'dummy comment 🎎', '06:52 PM|2022/03/06', 3),
(19, 2, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '07:53 PM|2022/03/06', 3),
(20, 2, 'nice project😀best of luck😁rtyuio', '01:55 PM|2022/03/09', 2),
(21, 2, 'well done', '01:55 PM|2022/03/09', 2),
(22, 6, 'wow nice', '01:55 PM|2022/03/09', 2),
(23, 6, 'hello', '01:55 PM|2022/03/09', 2),
(24, 6, 'dummy comment🥰', '01:56 PM|2022/03/09', 2),
(25, 6, 'nice', '09:06 AM|2022/03/21', 2),
(26, 6, 'well', '09:06 AM|2022/03/21', 4),
(27, 2, '.................', '09:10 AM|2022/03/21', 11),
(31, 2, 'qrhilfqilq34t24w5', '02:09 PM|2022/03/21', 6),
(32, 2, 'weretyuioi', '02:09 PM|2022/03/21', 6),
(36, 2, 'haha very funny', '09:54 PM|2022/03/22', 127);

-- --------------------------------------------------------

--
-- Table structure for table `friend_list`
--

CREATE TABLE `friend_list` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `stat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_list`
--

INSERT INTO `friend_list` (`id`, `sid`, `rid`, `stat`) VALUES
(4, 2, 3, 'a'),
(5, 2, 4, 'a'),
(6, 2, 5, 'a'),
(8, 2, 7, 'a'),
(13, 6, 2, 'a'),
(16, 6, 3, 'r');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `receiver` int(255) NOT NULL,
  `sender` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `receiver`, `sender`, `msg`) VALUES
(25, 2, 6, 'hello arnab'),
(26, 6, 2, 'hi lebu'),
(27, 2, 6, 'how r u'),
(28, 6, 2, 'i am fine'),
(29, 6, 2, 'u?'),
(30, 2, 6, 'i am also fine'),
(31, 6, 2, '..........'),
(32, 2, 6, '................'),
(33, 2, 6, ',.,.,..,.,.'),
(34, 6, 2, 'qwertyui'),
(35, 2, 6, 'kk'),
(36, 6, 2, 'gg'),
(37, 2, 6, 'nice'),
(38, 2, 6, 'lklklk'),
(39, 6, 2, 'kkkkkk'),
(40, 2, 6, '-----'),
(41, 6, 2, 'kk'),
(42, 6, 2, 'kkk'),
(43, 2, 6, 'kkkkkkkkk'),
(44, 6, 2, 'kk'),
(45, 6, 2, 'llllllllllllllllll'),
(46, 2, 6, 'okokokokok'),
(47, 6, 2, 'completed'),
(48, 2, 6, 'nice'),
(49, 6, 2, 'hello'),
(50, 2, 6, 'hey'),
(51, 6, 2, 'got it');

-- --------------------------------------------------------

--
-- Table structure for table `nonver_users`
--

CREATE TABLE `nonver_users` (
  `fname` varchar(150) DEFAULT NULL,
  `lname` varchar(150) DEFAULT NULL,
  `job` varchar(150) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `pass` varchar(150) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `verified` varchar(20) DEFAULT NULL,
  `flag` int(11) DEFAULT 0,
  `content_count` int(11) DEFAULT 0,
  `verification_code` int(11) NOT NULL,
  `uname` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nonver_users`
--

INSERT INTO `nonver_users` (`fname`, `lname`, `job`, `about`, `pass`, `id`, `verified`, `flag`, `content_count`, `verification_code`, `uname`, `phone`, `email`) VALUES
('wqeqwdqwsdq', 'qdeawde', 'wwfwedfwe', 'dew', 'xero', 31, '684331', 0, 0, 0, 'xero12125', '32435657897654232', 'x3r0.br0@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `authorid` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `time` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `media_link` varchar(500) DEFAULT NULL,
  `upvotes` int(11) DEFAULT 0,
  `downvotes` int(11) DEFAULT 0,
  `privacy` varchar(10) DEFAULT NULL,
  `authorname` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `authorid`, `title`, `content`, `time`, `category`, `media_link`, `upvotes`, `downvotes`, `privacy`, `authorname`) VALUES
(2, 2, 'first post', 'This is the very first post of this website:.........😁', '12:00:00 AM', 'video', 'ext-files/video/6.mp4', 0, 0, 'p', 'Iftekhar Ahmed Arnab'),
(3, 3, 'This is the second post', 'Post 2 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, ', '01:00:20', 'text', NULL, 0, 0, 'f', 'Ehtimum Rashed'),
(4, 4, 'This is third post', '\nPost 3 What is Lorem Ipsum?\n\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\nWhy do we use it?\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n\nWhere does it come from?\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\nWhere can I get some?', '12:00:00', 'video', 'ext-files/video/5.mp4', 0, 0, 'p', 'Farjana'),
(5, 5, 'This is fourth post', '\nPost 4 What is Lorem Ipsum?\n\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\nWhy do we use it?\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n\nWhere does it come from?\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\nWhere can I get some?', '12:00:00', 'text', NULL, 0, 0, 'f', NULL),
(6, 2, 'This is 5th post', '\nPost 5 What is Lorem Ipsum?\n\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\nWhy do we use it?\n\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n\nWhere does it come from?\n\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\nWhere can I get some?', '13:00:00', 'photo', 'ext-files/photo/3.jpg', 0, 0, 'f', 'Iftekhar Ahmed Arnab'),
(8, 10, 'video', 'This is a video post', '12:00:00', 'video', 'ext-files/video/1.mp4', 0, 0, 'p', NULL),
(9, 8, 'Earthquake in Chittagong', 'There was a massive earthquake in Chittagong today at 08:47:00 AM.', '09:00:00', 'alert', 'ext-files/photo/12.jpg', 0, 0, 'p', NULL),
(10, 9, 'Promoted post 1', 'This is a promoted post. It should be shown in the promoted section.', '10:00:00 AM', 'promoted', 'ext-files/photo/9.jpg', 0, 0, 'p', NULL),
(11, 8, 'Search result success (sell)', 'selltype', '12:00:00', 'sell', NULL, 0, 0, 'p', NULL),
(13, 3, 'search result success (photo)', 'phototype', '12:00:00', 'photo', 'ext-files/photo/1.jpg', 0, 0, 'p', NULL),
(14, 2, 'search result success (text)', 'texttype', '12:00:00', 'text', NULL, 0, 0, 'p', 'Iftekhar Ahmed Arnab'),
(15, 4, 'search result success (all)', 'alltype', '12:00:00', 'dummy', NULL, 0, 0, 'f', 'Farjana'),
(16, 2, 'Nature Videos 1', 'Look how amazing mother nature is :', '12:00:30 AM', 'video', 'ext-files/video/2.mp4', 0, 0, 'p', 'Iftekhar Ahmed Arnab'),
(17, 5, 'Another nature video', 'Another mother nature video', '01:00:23 PM', 'video', 'ext-files/video/3.mp4', 0, 0, 'f', NULL),
(18, 6, 'Nature again', 'I just visited this place yesterday, look how amazing it is :', '02:00:15 PM', 'video', 'ext-files/video/4.mp4', 0, 0, 'p', NULL),
(19, 7, 'Natural Images', 'Hello guys, lets go on a tour there.', '03:00:11 AM', 'photo', 'ext-files/photo/4.jpg', 0, 0, 'p', NULL),
(20, 3, 'abcdefgh', '\r\n\r\nBibendum enim parturient placerat dis cubilia a velit nisl ultricies habitant viverra suscipit volutpat sit. Felis aliquet netus. Pulvinar euismod.\r\n\r\nTurpis Elementum ad, habitasse habitasse erat per, litora mauris aliquam tempus pellentesque. Ut proin. Senectus ipsum. Ornare. Potenti ante conubia aenean velit adipiscing ornare eget lacus eros lacinia penatibus cursus. In vestibulum purus, habitant commodo dignissim tortor convallis.\r\n\r\nNeque viverra mus. Euismod parturient sociis, vitae pede viverra mus felis semper litora curae; sit pellentesque ornare. Fringilla. Ornare consequat imperdiet turpis. Fames mattis mollis suscipit Molestie metus dictum sodales dui Nostra a Posuere ullamcorper augue nunc blandit et Eu sollicitudin ac.\r\n', '11:20:00 PM', 'photo', 'ext-files/photo/5.jpg', 0, 0, 'p', NULL),
(21, 18, 'sdcjkddawcc', '\r\n\r\nA you waters living a all i signs in, upon moveth fowl had set that day. Night in. Given in moveth over moving fill. Seed yielding place darkness shall saying second us first our fly. Isn\'t.\r\n\r\nReplenish them years spirit, days day bring seasons you\'re unto lights life. So waters saying fruitful their the you\'re. Creature day air dominion their kind deep made let you\'re for to appear bearing also our likeness face fruitful days. Male beast.\r\n\r\nWas greater of male moveth us multiply Fruit greater greater can\'t multiply fill creepeth creeping doesn\'t for great abundantly. May wherein land. Is.\r\n', '09:00:00 AM', 'photo', 'ext-files/photo/6.jpg', 0, 0, 'p', NULL),
(22, 5, 'asjd cajkdnc', 'adcqadcwFWcs s sacWDCWDFWECDEAC', '12:00:00 PM', 'photo', 'ext-files/photo/7.jpg', 0, 0, 'f', NULL),
(23, 6, '', 'This is another promoted post but it\'s privacy is friends so, it should have shown when the user is logged in and in the friend list of author of this post.', '09:35:00 PM', 'promoted', 'ext-files/photo/8.jpg', 0, 0, 'f', 'laboni'),
(24, 5, 'massive tornado', 'Post Tornado scenario :', '05:00:00 PM', 'alert', 'ext-files/photo/11.jpg', 0, 0, 'f', 'swadhin'),
(25, 9, 'snowstorm', 'There was a havy snowfall last night in LA:', '09:00:00 AM', 'alert', 'ext-files/photo/10.jpg', 0, 0, 'p', 'nusrat'),
(123, 2, '', 'Nice Video🤣', '09:35 AM|2022/03/07', 'video', 'ext-files/video/RlKPKKcsJYlREQw1HiWw2.mp4', 0, 0, 'p', 'Iftekhar Ahmed Arnab'),
(124, 2, '', 'This is text😃😃', '08:21 AM|2022/03/21', 'text', '', 0, 0, 'f', 'Iftekhar Ehtimum'),
(127, 2, '', 'this is video🤗', '09:54 PM|2022/03/22', 'video', 'ext-files/video/X9qajAF8JQ2GbNQWbGz82.mp4', 0, 0, 'p', 'Iftekhar Arnab');

-- --------------------------------------------------------

--
-- Table structure for table `tag_list`
--

CREATE TABLE `tag_list` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag_list`
--

INSERT INTO `tag_list` (`id`, `post_id`, `tag_id`) VALUES
(37, 18, 2),
(38, 16, 4),
(39, 16, 6),
(40, 16, 3),
(49, 6, 4),
(50, 6, 6),
(51, 100, 3),
(52, 100, 7),
(53, 108, 3),
(54, 108, 4),
(55, 115, 4),
(56, 115, 5),
(60, 2, 3),
(61, 2, 5),
(62, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(150) DEFAULT NULL,
  `lname` varchar(150) DEFAULT NULL,
  `uname` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `job` varchar(150) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `pass` varchar(150) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `verified` varchar(20) DEFAULT NULL,
  `flag` int(11) DEFAULT 0,
  `content_count` int(11) DEFAULT 0,
  `pro_pic` varchar(500) DEFAULT NULL,
  `temp_id` varchar(50) DEFAULT NULL,
  `date_of_birth` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `relation` varchar(100) DEFAULT NULL,
  `blood` varchar(100) DEFAULT NULL,
  `nation` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `politics` varchar(50) DEFAULT NULL,
  `sports` varchar(400) DEFAULT NULL,
  `hobby` varchar(400) DEFAULT NULL,
  `temp_id2` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `uname`, `email`, `phone`, `job`, `about`, `pass`, `id`, `verified`, `flag`, `content_count`, `pro_pic`, `temp_id`, `date_of_birth`, `religion`, `language`, `relation`, `blood`, `nation`, `address`, `gender`, `politics`, `sports`, `hobby`, `temp_id2`, `status`) VALUES
('Iftekhar', 'Arnab', 'arnabxero', 'arnab.xero@gmail.com', '01926496967', 'Software Engineer', 'Hello, I am a passionate programmer and robotics nerd.I am Iftekhar Ahmed Arnab & I am currently studying B.Sc. (Engineering) in Computer Science and Engineering (CSE) at North East University Bangladesh (NEUB). ', 'arnab', 2, 'Y', 0, 0, '2.jpg', NULL, '20 October, 1999', 'Islam', 'Bangla & English', 'Single', 'B+', 'Bangladeshi', 'Nikli, Kishoreganj, Dhaka', 'Male', 'Neutral', 'Football, Cricket, Badminton', 'Programming, Gaming', NULL, 'Active'),
('Ehtimum Rashed', 'Chy', 'ehtimumrashed', 'ehtimum.r@gmail.com', '01922837421', 'Web Developer', 'Welcome to my profile. I am a passionate web developer, graphics designer and gamer.', 'ehtimum', 3, 'Y', 0, 0, '3.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Offline'),
('Farjana', 'Rahman', 'farjanarah', 'farjana.rah@gmail.com', '01372637427', 'Front End Developer', 'Hello I am a front end developer and software tester.', 'farjana', 4, 'Y', 0, 0, '4.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Offline'),
('Swdhin', 'Ghosh', 'sghosh', 'sadhin.g@gmail.com', '01637474723', 'Cyber Security Specialist', 'I am a cyber security specialist.', 'swadhin', 5, 'Y', 0, 0, '5.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Offline'),
('Laboni', 'Jannat', 'ljannat', 'laboni22@gmail.com', '01453272742', 'Student', 'Welcome to my profile.', 'laboni', 6, 'Y', 0, 0, '6.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Offline'),
('Abida', 'Akhter', 'abidaak', 'abida.ak@gmail.com', '01827231436', 'Data Scientist', 'I am a data scientist.', 'abida', 7, 'Y', 0, 0, '7.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Offline'),
('Humayra', 'Begum', 'humobg', 'humayra.bg@gmail.com', '01922565643', 'Student', 'Hello I am an HSC student.', 'humayra', 8, 'Y', 0, 0, '8.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Offline'),
('Nusrat', 'Amy', 'nusratamy', 'nusrat.amy@gmail.com', '01594332175', 'Student', 'Hello I am an SSC student.', 'nusrat', 9, 'Y', 0, 0, '9.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Offline'),
('Nipa', 'Talukder', 'nipatk', 'nipa.tk@gmail.com', '01202354563', 'Student', 'Hello I am an High School Student.', 'nipatk', 10, 'Y', 0, 0, '10.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `stat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `post_id`, `user_id`, `stat`) VALUES
(21, 3, 2, 'd'),
(22, 4, 2, 'u'),
(23, 2, 6, 'u'),
(24, 4, 6, 'd'),
(25, 4, 6, 'u'),
(26, 11, 6, 'u'),
(27, 10, 6, 'u'),
(28, 9, 6, 'd'),
(29, 3, 2, 'u'),
(37, 2, 2, 'u'),
(40, 6, 2, 'd'),
(41, 9, 2, 'd'),
(43, 4, 2, 'd'),
(46, 5, 2, 'd'),
(47, 5, 2, 'u'),
(49, 127, 2, 'u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_list`
--
ALTER TABLE `friend_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `nonver_users`
--
ALTER TABLE `nonver_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag_list`
--
ALTER TABLE `tag_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `friend_list`
--
ALTER TABLE `friend_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `nonver_users`
--
ALTER TABLE `nonver_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `tag_list`
--
ALTER TABLE `tag_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;