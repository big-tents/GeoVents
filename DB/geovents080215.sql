-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 08, 2015 at 09:46 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `geovents`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`id` int(10) unsigned NOT NULL,
  `e_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `e_location` text COLLATE utf8_unicode_ci NOT NULL,
  `total_attendees` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `etype_id` int(11) NOT NULL,
  `e_lat` float(8,6) NOT NULL,
  `e_lng` float(8,6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `audience` tinyint(4) NOT NULL,
  `e_date` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `e_name`, `e_location`, `total_attendees`, `status`, `created_at`, `updated_at`, `etype_id`, `e_lat`, `e_lng`, `user_id`, `audience`, `e_date`) VALUES
(2, 'Cartmel Vs. Pendle', 'Sport Centre', 18, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48', 2, 55.944515, -2.785228, 2, 0, 0),
(3, 'Pendle big night out!', 'Pendle bar avenue', 50, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48', 1, 55.944515, -2.785228, 2, 0, 0),
(4, 'vegetarain lunch', 'cafe21', 8, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48', 3, 55.944515, -2.785228, 2, 0, 0),
(5, '20mins game', 'anywhere on campus', 100, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48', 5, 55.944515, -2.785228, 2, 0, 0),
(6, 'drinking game flat 11', 'flat 11 d floor', 12, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48', 2, 55.944515, -2.785228, 2, 0, 0),
(7, 'predrink at ann''s place', 'flat 32', 30, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48', 1, 55.944515, -2.785228, 2, 0, 0),
(8, 'Just Chill...', 'sport centre', 4, 1, '2015-01-18 03:50:48', '2015-01-18 03:50:48', 4, 55.944515, -2.785228, 2, 0, 0),
(9, 'whatever', 'Furness bar', 8, 0, '2015-01-18 03:50:48', '2015-01-18 03:50:48', 6, 55.944515, -2.785228, 2, 0, 0),
(32, 'Reading Fireworks', 'Reading University', 8, 0, '2015-01-26 01:41:43', '2015-01-26 01:41:43', 11, 51.441422, -0.941816, 1, 0, 0),
(33, 'Pendle Big Nightout', 'Pendle College', 8, 0, '2015-01-26 01:42:26', '2015-01-26 01:42:26', 1, 54.006237, -2.785228, 1, 1, 0),
(34, 'Pendle Big Nightout', 'Pendle College', 8, 0, '2015-01-26 01:51:22', '2015-01-26 01:51:22', 1, 54.006237, -2.785228, 1, 2, 0),
(35, 'Time to Study', 'Cartmel College', 10, 0, '2015-01-26 01:55:45', '2015-01-26 01:55:45', 12, 54.003834, -2.789039, 1, 1, 0),
(36, 'Testing', 'Edinburgh University', 8, 0, '2015-01-26 02:07:18', '2015-01-26 02:07:18', 3, 55.944515, -3.189241, 1, 1, 1421028477),
(38, 'Infolab', 'Cartmel College', 8, 0, '2015-01-26 02:35:01', '2015-01-26 02:35:01', 14, 54.003834, -2.789039, 1, 1, 1422498901),
(39, 'Muay Thai Competition', 'George Fox Lancaster', 200, 0, '2015-02-07 17:04:44', '2015-02-07 17:04:44', 5, 54.007759, -2.783390, 21, 0, 1451667884),
(40, '1 person event', 'Great Hall', 1, 0, '2015-02-08 00:26:33', '2015-02-08 00:26:33', 15, 54.012283, -2.785592, 1, 0, 1440721593),
(41, 'mobile', 'furness college', 8, 0, '2015-02-08 17:20:32', '2015-02-08 17:20:32', 16, 54.010395, -2.787729, 1, 0, 1424193632),
(42, 'Testing123', 'Manchester Chinatown', 3, 0, '2015-02-08 20:30:51', '2015-02-08 20:30:51', 11, 53.478336, -2.240129, 3, 0, 1431721851);

-- --------------------------------------------------------

--
-- Table structure for table `event_types`
--

CREATE TABLE IF NOT EXISTS `event_types` (
`id` int(10) unsigned NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `type`) VALUES
(1, 'nightout'),
(2, 'lunch'),
(3, 'dinner'),
(4, 'breakfast'),
(5, 'sport'),
(6, 'predrink'),
(11, 'Testing'),
(12, 'Study'),
(13, 'eat'),
(14, 'NewEventType'),
(15, 'Loner'),
(16, 'mobile');

-- --------------------------------------------------------

--
-- Table structure for table `joined_events`
--

CREATE TABLE IF NOT EXISTS `joined_events` (
`id` int(10) unsigned NOT NULL,
  `attendee_id` int(11) NOT NULL,
  `host_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `joined_events`
--

INSERT INTO `joined_events` (`id`, `attendee_id`, `host_id`, `event_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 21, 1, 32, 0, '2015-02-02 02:01:19', '2015-02-02 02:01:19'),
(6, 21, 1, 40, 0, '2015-02-08 00:27:43', '2015-02-08 00:27:43'),
(7, 1, 0, 8, 0, '2015-02-08 13:17:12', '2015-02-08 13:17:12'),
(11, 2, 21, 39, 0, '2015-02-08 15:52:13', '2015-02-08 15:52:13');

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
('2015_01_18_025733_create_events_table', 6),
('2015_01_20_021959_drop_eType_from_events', 7),
('2015_01_20_022243_create_eventTypes_table', 8),
('2015_01_22_235338_add_eTypeId_to_events', 9),
('2015_01_23_205156_add_passwordTemp_to_users', 10),
('2015_01_25_222218_add_geolocation_to_events', 11),
('2015_01_26_021607_reformat_edate_from_events_to_datetime', 12),
('2015_01_27_021331_drop_e-organizer-id_from_events', 13),
('2015_02_01_212029_create_joinEvents_table', 14);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `profile_name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'AnsonXY', '<script>alert(''Trying to hack this s..t'');</scrpt>', 'https://dl.dropboxusercontent.com/u/19418366/lobbyboy.png', '2015-01-17 22:30:21', '2015-02-07 15:49:14'),
(2, 21, 'Hakuna Matata', '"Hakuna matata" is a Swahili phrase; literally translated, it roughly means "there isn''t a problem/trouble". Its meaning is similar to the English phrase "no problem" and is akin to "don''t worry, be happy". The phrase is uncommon among native speakers of Swahili in Tanzania, who prefer the phrase "hamna shida" in the north and "hamna tabu" in the south. The phrase has been popularized by its use in The Lion King (in which it is translated as "no worries" in a song named after the phrase), so that it is heard often at resorts, hotels and other places appealing to the tourist trade. Furthermore the phrase is in more common use in Zanzibar and Kenya.', 'http://fc01.deviantart.net/fs71/i/2013/198/1/8/hakuna_matata_by_themightyhylian-d6dvjrd.jpg', '2015-01-18 01:16:44', '2015-01-18 04:41:43'),
(3, 7, 'Hannibal', 'Hannibal is an American psychological thriller–horror television series developed by Bryan Fuller for NBC. The series is based on characters and elements appearing in the novel Red Dragon by Thomas Harris and focuses on the budding relationship between FBI special investigator Will Graham and Dr. Hannibal Lecter, a forensic psychiatrist destined to become Graham''s most cunning enemy.\r\n\r\nThe series received a 13-episode order for its first season and, unlike most U.S. network shows, all future seasons will feature 13 episodes.[1] David Slade executive produced and directed the first episode. The series premiered on NBC on April 4, 2013.[2] On May 9, 2014, NBC renewed Hannibal for a third season,[3] to premiere in summer 2015.[4]\r\n\r\nThe series has received critical acclaim, with the performances of the lead actors and the visual style of the show being singled out by critics.', 'http://www.thetimes.co.uk/tto/multimedia/archive/00434/TMM27HANNIBAL1_a_434295c.jpg', '2015-01-18 01:24:13', '2015-01-18 01:24:13'),
(4, 22, 'eighteenthuser', 'eighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthusereighteenthuser', 'http://pediatricdentistryofglensfalls.com/wp-content/uploads/2013/04/Tooth-fairy-2.jpg', '2015-01-18 04:08:31', '2015-01-18 04:09:30'),
(5, 1, 'firstuser', 'firstuserfirstuserfirstuser', '', '2015-01-18 14:47:53', '2015-01-18 14:47:53'),
(9, 6, 'I''m the first user', 'First user<script>alert(''trying to hack this sh11t'').</script>', '', '2015-01-23 04:11:11', '2015-01-23 04:11:11'),
(10, 3, 'Josh', 'Hi, I''m Josh.', '', '2015-02-08 01:03:47', '2015-02-08 01:03:47');

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
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_temp` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `verified`, `acc_type`, `private_settings`, `email`, `created_at`, `updated_at`, `code`, `remember_token`, `password_temp`) VALUES
(1, 'anson', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'ansonox@gmail.com', '2015-01-17 01:07:52', '2015-02-08 20:19:09', '', 'QrR4lwK9yJ0K5OK2AmVjwYCN7sWL9meLbKdCBMZxaxVEmt3LGqa64CRd2UXW', ''),
(2, 'ash', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'ash@bla.com', '2015-01-17 01:07:53', '2015-02-08 16:44:20', '', '6D0C3FvvHjLgVJ6HHXZbI3DSZmMU9GgyLUT4gjaWYT2cwlgTYEZQ75iZrdh4', ''),
(3, 'josh', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'josh@bla.com', '2015-01-17 01:07:53', '2015-02-08 20:42:51', '', 'UPG8QutXknHou0hxw1YTTJ8V7UqB5knA5EQAxRrk76oSBc2BLPHjcHEkqtlZ', ''),
(4, 'liam', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'liam@bla.com', '2015-01-17 01:07:53', '2015-01-17 01:07:53', '', '', ''),
(5, 'andrew', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'andrew@bla.com', '2015-01-17 01:07:53', '2015-02-08 14:44:12', '', 'v9mnBoEBjGbI31bUten9QFz5i09D7HuZsy1lFoYfZ2DorV6tJTB5u9GAPsta', ''),
(6, 'firstuser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'firstuser@gmail.com', '2015-01-17 03:41:34', '2015-02-08 14:44:26', 'TSQZ0MFu7VwmCNNtmysGTssfK3AlvbQbxk4xggJsmTfITeKHAmaHZ8qmpHTr', 'tBYJZZPzLcIKHz0Qj4VX7wDdMeVPDbod7aVzdFo1cz2cCXHehVwHLlI97aPv', '$2y$10$KFgjiWNPTV6Jv9vnnZhC2uJXfy18NLSec/k58HI2e8BUyLLiQ6Z9O'),
(7, 'seconduser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'seconduser@gmail.com', '2015-01-17 03:43:15', '2015-02-08 14:44:37', '', 'dUlOjSYYMVBUlhgVOhd1IBT17ffzU75YpCv3dWQBIndMWCYUHtZEvkewTFqZ', ''),
(8, 'thirduser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'thirduser@gmail.com', '2015-01-17 04:03:25', '2015-01-17 04:03:25', '', '', ''),
(9, 'forthuser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'forthuser@gmail.com', '2015-01-17 04:06:05', '2015-01-17 04:06:05', '', '', ''),
(10, 'fifthuser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'fifthuser@gmail.com', '2015-01-17 04:07:34', '2015-01-17 04:07:34', '', '', ''),
(11, 'sixthuser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'sixthuser@gmail.com', '2015-01-17 04:10:44', '2015-01-17 04:10:44', 'zZRcQyrpAlXqXEEvIffLFdVJTTP3UaKRTqqcmuOJB4nR97HQX8BRIm3ylP0y', '', ''),
(12, 'seventhuser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'seventhuser@gmail.com', '2015-01-17 04:11:01', '2015-01-17 04:11:01', '7mZmkj6sS8hOkUVnj7FhfSGGGU3dTlZRIJcZ4E5iBaNYqXjIZJrNf36CaYCe', '', ''),
(13, 'eigthuser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 1, 0, 'eigthuser@gmail.com', '2015-01-17 04:11:51', '2015-01-17 04:11:51', 'xmpJ83THuYxk5IRp8UF0FRuIKmDulmgFPlkSgjybyFKmQrQT2dX9B31Q9sHa', '', ''),
(14, 'ninthuser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 0, 0, 'ninthuser@gmail.com', '2015-01-17 04:12:30', '2015-01-17 04:12:30', 'Ns8s9zZoPX4VoxnrI4zNzevc9dE52XHnWWoecCMCJEbd2TRfMRgT8yHu9uZr', '', ''),
(15, 'tenthuser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 1, 0, 'tenthuser@gmail.com', '2015-01-17 04:32:41', '2015-01-17 04:32:41', 'xwQcisdnduEZFIaoLstsGHQlIXkad9DdGjax3kNSp9SfkGJL7tYXtsTSO3dW', '', ''),
(16, 'eleventhuser', '$2y$10$fiyLcDxhYdKIEDyzu5deD.ZNAdimxl5GZDoAgENXg69nLcivUeu32', 1, 1, 0, 'a.nsonox@gmail.com', '2015-01-17 04:34:23', '2015-01-17 05:03:46', '', '', ''),
(17, 'twelfthuser', '$2y$10$AdiCMBC3xhaoPaQDB1MOJu3BEFmS22GaFw4KYSXvivPhCsuNg9Q8e', 1, 0, 0, 'bigtents2015@gmail.com', '2015-01-17 04:35:21', '2015-01-17 17:11:56', '', '1nKetOjs3XKfKS9YWNZEoEKbJ1QbsJE75p7YI8eWkzfo3XyXClYHrEL16OMU', ''),
(18, 'thirteenthuser', '$2y$10$YJIWBSFaozIS4O9zC2wNduiC.j2xJU5dUrz.PiaXJokv1oGwfFPg6', 0, 0, 0, 'thirteenthuser@gmail.com', '2015-01-17 05:08:07', '2015-01-17 05:08:07', '8vYKEd6FtfVsezkqcgTf9J9cpzDIRDswneNB8yi9AJPGTS3o2oV5jzpY9ZiO', '', ''),
(19, 'forthteenth', '$2y$10$KBFPK4SykZa/g.B8aB/E2efCW.WpWNZU8Frq5ARzYpyQ6Rj26.utK', 1, 0, 0, 'bigtents.2015@gmail.com', '2015-01-17 05:08:44', '2015-01-17 05:08:59', '', '', ''),
(20, 'fifthteenth', '$2y$10$LVVC2Ij.9X7btQTFY1bdEuyD7s0rJLJ3zEQKuS86FIAD4fTy0Z0ou', 1, 0, 0, 'an.sonox@gmail.com', '2015-01-17 20:33:04', '2015-01-17 20:33:52', '', '', ''),
(21, 'sixteenuser', '$2y$10$KOWWhXRW1CIk2dCBU6Y6r.g5tL28POgx4nzH/8Lbteow/yJCgduvi', 1, 1, 0, 'sixteenuser@gmail.com', '2015-01-17 23:48:47', '2015-02-08 19:44:21', '0BfN3ZEOSZwLlIKUKxnE5hdRWrmuKZNEGsQndMgm7j90RonFFmZjgauSWO7I', '3rKOns6TQRAXi0p7aIfSUkrI5fNvDoKR6zOODJ670pRo3q4gqtTG8kKVWGpk', ''),
(22, 'eighteenthuser', '$2y$10$3o9JirTgi2XUhRNNZ2SNVerT1dkEbAFG20Paio3hOLMpQC0tV2Pje', 1, 0, 0, 'eighteenthuser@gmail.com', '2015-01-18 04:07:55', '2015-01-18 04:10:41', '1ZrpVLIGMbQed2nqQ2mZfMIxeow8lM5N8KTMW1ujxh1x4DhFT58w9txGoi6o', '1AvciACoF8v3TkezODTKE3XahewCrkMuFyeys6ibTrRo7pneccwWGzSEqDBQ', ''),
(23, 'dorisncombs', '$2y$10$olcrDBqETTqdISX6cpWxNOkfu1Ji7VxlownS/f47ED7nDgW1x/U0K', 1, 0, 0, 'dorisncombs@rhyta.com', '2015-02-08 00:32:26', '2015-02-08 01:03:25', '', 'fojTWxQ1chuXMuaSIW055HeREWrwnS5dosAG0CZDUKZBs83156Eu6Y7OWGhr', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`id`), ADD KEY `e_type_id` (`etype_id`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joined_events`
--
ALTER TABLE `joined_events`
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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `joined_events`
--
ALTER TABLE `joined_events`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
