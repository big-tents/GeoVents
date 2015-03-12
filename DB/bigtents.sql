-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jan 19, 2015 at 03:37 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bigtents`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`id` int(10) unsigned NOT NULL,
  `e_organizer_id` int(11) NOT NULL,
  `e_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `e_location` text COLLATE utf8_unicode_ci NOT NULL,
  `total_attendees` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `e_organizer_id`, `e_type`, `e_name`, `e_date`, `e_location`, `total_attendees`, `status`, `created_at`, `updated_at`) VALUES
(2, 0, 'Sports', 'Cartmel Vs. Pendle', '2015-01-21 12:35:00', 'Sport Centre', 18, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48'),
(3, 0, 'dinner', 'Pendle big night out!', '2015-01-30 00:00:00', 'Pendle bar avenue', 50, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48'),
(4, 0, 'lunch', 'vegetarain lunch', '2015-01-19 01:15:25', 'cafe21', 8, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48'),
(5, 0, '20mins', '20mins game', '2015-01-22 12:00:00', 'anywhere on campus', 100, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48'),
(6, 0, 'drink', 'drinking game flat 11', '2015-02-01 22:30:00', 'flat 11 d floor', 12, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48'),
(7, 0, 'predrink', 'predrink at ann''s place', '2015-01-24 20:00:00', 'flat 32', 30, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48'),
(8, 0, 'outdoor', 'Just Chill...', '2015-01-19 17:00:00', 'sport centre', 4, 1, '2015-01-18 03:50:48', '2015-01-18 03:50:48'),
(9, 0, 'indoor', 'whatever', '2015-01-23 14:00:00', 'Furness bar', 8, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48'),
(10, 0, 'ict', 'study time', '2015-01-21 09:00:00', 'infolab', 15, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_01_17_005731_create_users_table', 1),
('2015_01_17_035819_add_code_to_users', 2),
('2015_01_17_170618_add_rememberToken_to_users', 3),
('2015_01_17_181905_drop_profileName_from_users', 4),
('2015_01_17_182143_create_profile_table', 5),
('2015_01_18_025733_create_events_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `profile_name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'AnsonXY', '	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum minima enim suscipit eligendi quas reprehenderit at dicta doloremque amet tempora velit, sunt perferendis nostrum quibusdam libero delectus labore ut, autem nulla hic. Unde exercitationem ipsam doloremque aperiam, numquam quo, perferendis sed, et hic ratione quae perspiciatis, maiores quos inventore ipsa! Officia placeat doloribus deleniti beatae illo nobis nostrum, voluptatem, sit deserunt similique, necessitatibus in. Obcaecati, dolorum error eaque amet quibusdam? Natus quam numquam quae officiis, architecto veniam corporis unde ducimus odit quibusdam provident expedita maxime ipsum consequatur quasi accusantium! Expedita corrupti atque facilis quo. Saepe quibusdam labore molestiae, deleniti illo!', 'https://dl.dropboxusercontent.com/u/19418366/lobbyboy.png', '2015-01-17 22:30:21', '2015-01-19 01:29:11'),
(2, 21, 'Hakuna Matata', '"Hakuna matata" is a Swahili phrase; literally translated, it roughly means "there isn''t a problem/trouble". Its meaning is similar to the English phrase "no problem" and is akin to "don''t worry, be happy". The phrase is uncommon among native speakers of Swahili in Tanzania, who prefer the phrase "hamna shida" in the north and "hamna tabu" in the south. The phrase has been popularized by its use in The Lion King (in which it is translated as "no worries" in a song named after the phrase), so that it is heard often at resorts, hotels and other places appealing to the tourist trade. Furthermore the phrase is in more common use in Zanzibar and Kenya.', 'http://fc01.deviantart.net/fs71/i/2013/198/1/8/hakuna_matata_by_themightyhylian-d6dvjrd.jpg', '2015-01-18 01:16:44', '2015-01-18 04:41:43'),
(3, 7, 'Hannibal', 'Hannibal is an American psychological thriller–horror television series developed by Bryan Fuller for NBC. The series is based on characters and elements appearing in the novel Red Dragon by Thomas Harris and focuses on the budding relationship between FBI special investigator Will Graham and Dr. Hannibal Lecter, a forensic psychiatrist destined to become Graham''s most cunning enemy.\r\n\r\nThe series received a 13-episode order for its first season and, unlike most U.S. network shows, all future seasons will feature 13 episodes.[1] David Slade executive produced and directed the first episode. The series premiered on NBC on April 4, 2013.[2] On May 9, 2014, NBC renewed Hannibal for a third season,[3] to premiere in summer 2015.[4]\r\n\r\nThe series has received critical acclaim, with the performances of the lead actors and the visual style of the show being singled out by critics.', 'http://www.thetimes.co.uk/tto/multimedia/archive/00434/TMM27HANNIBAL1_a_434295c.jpg', '2015-01-18 01:24:13', '2015-01-18 01:24:13'),
(4, 22, 'eighteenthuser', 'eighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthuser', 'http://pediatricdentistryofglensfalls.com/wp-content/uploads/2013/04/Tooth-fairy-2.jpg', '2015-01-18 04:08:31', '2015-01-18 04:09:30'),
(5, 1, 'firstuser', 'firstuserfirstuserfirstuser', '', '2015-01-18 14:47:53', '2015-01-18 14:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `acc_type` tinyint(4) NOT NULL,
  `private_settings` tinyint(4) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `verified`, `acc_type`, `private_settings`, `email`, `created_at`, `updated_at`, `code`, `remember_token`) VALUES
(1, 'anson', '$2y$10$HQXqKnmlHemUrxDyYWIqquExVtpwVxympGCNfH/YR351DruVwgdsu', 1, 0, 0, 'ansonox@gmail.com', '2015-01-17 01:07:52', '2015-01-18 23:54:19', '', 'YuDVOlHwy8M4VQceiJL3euCN63z5oqqjMzsa9NMTCTXeApVbrkTQq1H1AlGB'),
(2, 'ash', '$2y$10$YV/pR2osfRXV8MdX.FJ9J.aYP5z1lbA/JakEpHLVeoJp4kZOHoBgq', 0, 0, 0, '', '2015-01-17 01:07:53', '2015-01-17 01:07:53', '', ''),
(3, 'josh', '$2y$10$wMXNzVZMS4cLM71UO96npOqOb1nQ/ITfTHQ7UNT8Iw/KoFzHT3G.e', 0, 0, 0, '', '2015-01-17 01:07:53', '2015-01-17 01:07:53', '', ''),
(4, 'liam', '$2y$10$g50wjheH9xk9R6lG.SsJ4OHXBbxRvmzgMyKWdopnc/MAgEIpA2H3G', 0, 0, 0, '', '2015-01-17 01:07:53', '2015-01-17 01:07:53', '', ''),
(5, 'andrew', '$2y$10$AK95BrA7swx2q1EOiEh8k.iHh6hXpJj08aS9zRw9lmNKSb/xBUurK', 0, 0, 0, '', '2015-01-17 01:07:53', '2015-01-17 01:07:53', '', ''),
(6, 'firstuser', '32323232', 0, 0, 0, 'firstuser@gmail.com', '2015-01-17 03:41:34', '2015-01-17 03:41:34', '', ''),
(7, 'seconduser', '$2y$10$u5xQ/4GV3mptnFOAPZwHgOLox/FO/ULzRscQubgeHcOgRyHD6DRkS', 1, 0, 0, 'seconduser@gmail.com', '2015-01-17 03:43:15', '2015-01-18 01:24:25', '', 'VbMa3jSd3TbJe20JS2eg6xpfrkCruTI8YHBlCQF4oK7os960e1g0v1vFDN36'),
(8, 'thirduser', '$2y$10$7dcgIxSRr2hmuOt3gli8weUzyoUZ1bLlLk9tlZ2qrue7bh6r1do5S', 0, 0, 0, 'thirduser@gmail.com', '2015-01-17 04:03:25', '2015-01-17 04:03:25', '', ''),
(9, 'forthuser', '$2y$10$YRKZ9x5FTYc6CXEt.rqQd.7JrbUKNOcPNifG06YLpApIzk9V.nNOi', 0, 0, 0, 'forthuser@gmail.com', '2015-01-17 04:06:05', '2015-01-17 04:06:05', '', ''),
(10, 'fifthuser', '$2y$10$YgQPnQb/WZbfa69e3/ZWSec9sxA3az/xoVNpYdNtbm66z76LeCERu', 0, 0, 0, 'fifthuser@gmail.com', '2015-01-17 04:07:34', '2015-01-17 04:07:34', '', ''),
(11, 'sixthuser', '$2y$10$4Fp3F9O61BDSKF5Wl8lYReoSKDWVuanrAtWmfoO3j9TmVAmA3Ftle', 0, 0, 0, 'sixthuser@gmail.com', '2015-01-17 04:10:44', '2015-01-17 04:10:44', 'zZRcQyrpAlXqXEEvIffLFdVJTTP3UaKRTqqcmuOJB4nR97HQX8BRIm3ylP0y', ''),
(12, 'seventhuser', '$2y$10$CE9mXKCkla0kJ.0TErlGS.flCkmDCo3A8A2iN3CY7HOX976PJEgH.', 0, 0, 0, 'seventhuser@gmail.com', '2015-01-17 04:11:01', '2015-01-17 04:11:01', '7mZmkj6sS8hOkUVnj7FhfSGGGU3dTlZRIJcZ4E5iBaNYqXjIZJrNf36CaYCe', ''),
(13, 'eigthuser', '$2y$10$7Xw41jZO2XaPeL3AN/liiOF9.2uqaGnFWHrnpnjaYIFOaCZOqA0Za', 0, 1, 0, 'eigthuser@gmail.com', '2015-01-17 04:11:51', '2015-01-17 04:11:51', 'xmpJ83THuYxk5IRp8UF0FRuIKmDulmgFPlkSgjybyFKmQrQT2dX9B31Q9sHa', ''),
(14, 'ninthuser', '$2y$10$BRfhbxPpflSM2KO6fVvBNuzAABgomEQ26/giIuLEJMl/lCKWJG486', 0, 0, 0, 'ninthuser@gmail.com', '2015-01-17 04:12:30', '2015-01-17 04:12:30', 'Ns8s9zZoPX4VoxnrI4zNzevc9dE52XHnWWoecCMCJEbd2TRfMRgT8yHu9uZr', ''),
(15, 'tenthuser', '$2y$10$zL6FpkkMrt6qWLE4w8arSOyx6rFGxLDNOiXQ9I4DQG.oUOnyfPeB.', 0, 1, 0, 'tenthuser@gmail.com', '2015-01-17 04:32:41', '2015-01-17 04:32:41', 'xwQcisdnduEZFIaoLstsGHQlIXkad9DdGjax3kNSp9SfkGJL7tYXtsTSO3dW', ''),
(16, 'eleventhuser', '$2y$10$fiyLcDxhYdKIEDyzu5deD.ZNAdimxl5GZDoAgENXg69nLcivUeu32', 1, 1, 0, 'a.nsonox@gmail.com', '2015-01-17 04:34:23', '2015-01-17 05:03:46', '', ''),
(17, 'twelfthuser', '$2y$10$AdiCMBC3xhaoPaQDB1MOJu3BEFmS22GaFw4KYSXvivPhCsuNg9Q8e', 1, 0, 0, 'bigtents2015@gmail.com', '2015-01-17 04:35:21', '2015-01-17 17:11:56', '', '1nKetOjs3XKfKS9YWNZEoEKbJ1QbsJE75p7YI8eWkzfo3XyXClYHrEL16OMU'),
(18, 'thirteenthuser', '$2y$10$YJIWBSFaozIS4O9zC2wNduiC.j2xJU5dUrz.PiaXJokv1oGwfFPg6', 0, 0, 0, 'thirteenthuser@gmail.com', '2015-01-17 05:08:07', '2015-01-17 05:08:07', '8vYKEd6FtfVsezkqcgTf9J9cpzDIRDswneNB8yi9AJPGTS3o2oV5jzpY9ZiO', ''),
(19, 'forthteenth', '$2y$10$KBFPK4SykZa/g.B8aB/E2efCW.WpWNZU8Frq5ARzYpyQ6Rj26.utK', 1, 0, 0, 'bigtents.2015@gmail.com', '2015-01-17 05:08:44', '2015-01-17 05:08:59', '', ''),
(20, 'fifthteenth', '$2y$10$LVVC2Ij.9X7btQTFY1bdEuyD7s0rJLJ3zEQKuS86FIAD4fTy0Z0ou', 1, 0, 0, 'an.sonox@gmail.com', '2015-01-17 20:33:04', '2015-01-17 20:33:52', '', ''),
(21, 'sixteenuser', '$2y$10$kAyAAssaqWJGuMrtwYj0COxBVmd5PkHnZHKGT2hNyEgTaNz4uJc6C', 1, 1, 0, 'sixteenuser@gmail.com', '2015-01-17 23:48:47', '2015-01-18 23:29:48', '0BfN3ZEOSZwLlIKUKxnE5hdRWrmuKZNEGsQndMgm7j90RonFFmZjgauSWO7I', 'YYO3Txvtvzi4A3zaQ5dfqtJfI72Qmj6Po8LYjeOkJNgQdYTjOquVZX7LTeQU'),
(22, 'eighteenthuser', '$2y$10$3o9JirTgi2XUhRNNZ2SNVerT1dkEbAFG20Paio3hOLMpQC0tV2Pje', 1, 0, 0, 'eighteenthuser@gmail.com', '2015-01-18 04:07:55', '2015-01-18 04:10:41', '1ZrpVLIGMbQed2nqQ2mZfMIxeow8lM5N8KTMW1ujxh1x4DhFT58w9txGoi6o', '1AvciACoF8v3TkezODTKE3XahewCrkMuFyeys6ibTrRo7pneccwWGzSEqDBQ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
