-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-12-06 18:39:13
-- 伺服器版本： 10.4.20-MariaDB
-- PHP 版本： 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `tt`
--

CREATE TABLE `tt` (
  `author` char(125) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `bookName` varchar(125) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ISBN` varchar(125) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `describeBook` varchar(125) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `class` varchar(125) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `publish_year` int(11) NOT NULL,
  `publisher` varchar(125) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `tt`
--

INSERT INTO `tt` (`author`, `bookName`, `ISBN`, `describeBook`, `class`, `publish_year`, `publisher`, `num`) VALUES
('厄尼斯特．海明威', '老人與海', '', '　　本書獲一九五三年普立茲文學獎、一九五四年諾貝爾文學獎，是海洋文學代表作，也是海明威畢生文學成就的總結。　　老人一連八十四天毫無所獲，就在第八十五天早上，他捕到了一條比船還大的馬林魚。經過兩個晝夜的奮戰，老人終於制伏了大魚。可是，鯊魚群立刻過來搶奪', '', 2003, '晨星', 0),
('厄尼斯特．海明威', '老人與海', '', '　　本書獲一九五三年普立茲文學獎、一九五四年諾貝爾文學獎，是海洋文學代表作，也是海明威畢生文學成就的總結。　　老人一連八十四天毫無所獲，就在第八十五天早上，他捕到了一條比船還大的馬林魚。經過兩個晝夜的奮戰，老人終於制伏了大魚。可是，鯊魚群立刻過來搶奪', '', 2003, '晨星', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
