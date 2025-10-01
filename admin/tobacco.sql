-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 01, 2024 at 08:18 AM
-- Server version: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tobacco`
--

-- --------------------------------------------------------

--
-- Table structure for table `tob_album_title`
--

CREATE TABLE `tob_album_title` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `htitle` text NOT NULL,
  `position` int(11) NOT NULL,
  `updated_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tob_album_title`
--

INSERT INTO `tob_album_title` (`id`, `title`, `htitle`, `position`, `updated_on`) VALUES
(11, '160th Board meeting ', '<p>160th Board meeting</p>', 13, '2014-01-21'),
(12, '161st Board meeting held on 18.07.2023', '<p>161st Board meeting held on 18.07.2023</p>', 14, '2014-01-21'),
(10, '158th Board meeting held on 8.06.2022', '<p>158th Board meeting held on 8.06.2022</p>', 12, '2014-01-21'),
(9, '157th Board meeting held on 18.02.2022', '<p>157th Board meeting held on 18.02.2022</p>', 11, '2014-01-21'),
(5, '153 Board Meeting held on 19.04.2021 at Guntur on Virtual Mode', '153 Board Meeting held on 19.04.2021 at Guntur on Virtual Mode', 7, '2014-01-21'),
(6, '154th Board meeting held on 23.06.2021 at Guntur through Video Conference', '<p>154th Board meeting held on 23.06.2021 at Guntur through Video Conference</p>', 8, '2014-01-21'),
(7, '155th Board meeting held on 16.08.2021 at Guntur through Video Conference', '<p>155th Board meeting held on 16.08.2021 at Guntur through Video Conference</p>', 9, '2014-01-21'),
(8, '156th Board meeting held on 03.12.2021 at Guntur through Video Conference', '<p>156th Board meeting held on 03.12.2021 at Guntur through Video Conference</p>', 10, '2022-02-10'),
(13, 'Tobacco Board India participated in International tobacco exclusive Exhibition at Dortmund, Germany - 14th to 16th Sept, 2023', '<p>Tobacco Board India participated in International tobacco exclusive Exhibition at Dortmund, Germany - 14th to 16th Sept, 2023</p>', 15, '2023-09-15'),
(14, 'Tobacco Board participation in International Tobacco exclusive Exhibition - World Tobacco Middle East, Dubai from 27th to 28th November,2023 - Dr A. Sridhar Babu, IAS, Executive Director and Sri A. Jeevan Kumar Field Officer participated.', '<p>Tobacco Board participation in International Tobacco exclusive Exhibition - World Tobacco Middle East, Dubai from 27th to 28th November,2023 - Dr A. Sridhar Babu, IAS, Executive Director and Sri A. Jeevan Kumar Field Officer participated.</p>', 16, '2014-01-21'),
(15, '162nd Board meeting held on 16-02-2024 at Guntur.', '<p>162nd Board meeting held on 16-02-2024 at Guntur.</p>', 17, '2014-01-21'),
(16, 'Honourable Executive Director Dr. A. Sridhar Babu, IAS and M.Sankara Rap AS/SGO/of Tobaccoboard participated in Intertabac/Inntersupply-2024 at Dortmund, Germany', '<p>Honourable Executive Director Dr. A. Sridhar Babu, IAS and M.Sankara Rap AS/SGO/of Tobaccoboard participated in Intertabac/Inntersupply-2024 at Dortmund, Germany</p>', 18, '2014-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `tob_images`
--

CREATE TABLE `tob_images` (
  `id` int(11) NOT NULL,
  `titleid` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `cover` tinyint(4) NOT NULL,
  `position` int(11) NOT NULL,
  `position1` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tob_images`
--

INSERT INTO `tob_images` (`id`, `titleid`, `image`, `cover`, `position`, `position1`, `status`) VALUES
(29, '13', '29.jpg', 0, 4, 0, 0),
(30, '14', '30.jpg', 1, 3, 0, 0),
(25, '12', '25.jpg', 1, 1, 0, 0),
(26, '13', '26.jpg', 1, 1, 0, 0),
(27, '13', '27.jpg', 0, 2, 0, 0),
(1, '5', '1.jpg', 0, 1, 0, 0),
(2, '5', '2.jpg', 0, 2, 0, 0),
(3, '6', '3.jpg', 1, 1, 0, 0),
(4, '6', '4.jpg', 0, 2, 0, 0),
(28, '13', '28.jpg', 0, 3, 0, 0),
(19, '5', '19.jpg', 1, 4, 0, 0),
(10, '7', '10.jpg', 1, 3, 0, 0),
(8, '8', '8.jpg', 0, 0, 0, 0),
(9, '8', '9.jpg', 0, 2, 0, 0),
(11, '7', '11.jpg', 0, 4, 0, 0),
(21, '9', '21.jpg', 0, 2, 0, 0),
(20, '9', '20.jpg', 1, 1, 0, 0),
(18, '5', '18.php', 0, 3, 0, 0),
(22, '9', '22.jpg', 0, 3, 0, 0),
(23, '10', '23.jpg', 1, 1, 0, 0),
(24, '11', '24.jpg', 1, 1, 0, 0),
(31, '14', '31.jpeg', 1, 2, 0, 0),
(32, '14', '32.jpeg', 1, 1, 0, 0),
(33, '14', '33.jpeg', 0, 4, 0, 0),
(34, '14', '34.jpeg', 0, 5, 0, 0),
(39, '16', '39.jpg', 1, 5, 0, 0),
(38, '16', '38.jpg', 1, 4, 0, 0),
(37, '16', '37.jpg', 0, 3, 0, 0),
(36, '16', '36.jpg', 0, 2, 0, 0),
(35, '16', '35.jpg', 1, 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tob_album_title`
--
ALTER TABLE `tob_album_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tob_images`
--
ALTER TABLE `tob_images`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
