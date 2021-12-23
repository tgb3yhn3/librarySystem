-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-12-13 15:43:31
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
-- 資料表結構 `book`
--

CREATE TABLE `book` (
  `bookName` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `author` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ISBN` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `describeBook` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `book`
--

INSERT INTO `book` (`bookName`, `author`, `ISBN`, `describeBook`) VALUES
('駱駝圖鑑', '陳冠樺', '00857029', '偶然發現的駱駝'),
('善良可愛', '黃禹之', '1121', '無'),
('微積分', '許玉萍', '945', '很難很難'),
('駱駝的一生', '駱駝', '9487', '有高峰也有低峰');

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `username` varchar(20) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `context` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `comment`
--

INSERT INTO `comment` (`username`, `ISBN`, `context`) VALUES
('aaa', '00857029', 'aaa'),
('aaa', '00857029', 'aaa'),
('aaa', '00857029', 'bbb'),
('aaa', '00857029', 'sss'),
('aaa', '00857029', 'dsds'),
('00857022', '00857039', '????'),
('123', '9487', '    '),
('123', '9487', '               '),
('123', '9487', '                   '),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '9487', ''),
('123', '00857029', '???'),
('123', '00857029', '?????'),
('123', '00857029', '???'),
('aaa', '00857029', '?'),
('aaa', '00857029', '幹'),
('123', '00857029', '不能說中文'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡'),
('warren00857020', '9487', '嗡嗡嗡嗡嗡嗡嗡嗡');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userID` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '學號',
  `email` varchar(100) NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `token` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT '0',
  `regTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `forgettoken` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`username`, `userID`, `email`, `password`, `token`, `status`, `regTime`, `forgettoken`) VALUES
('aaa', '', '', 'aaaaaa', '', '0', '2021-12-03 16:05:45', 'ca2113c687a2395a97abc6ed545524b7'),
('aaad', '', '', 'aaaaaa', '', '0', '2021-12-03 16:05:45', 'ca2113c687a2395a97abc6ed545524b7'),
('00857022', '', '', '00857022', '', '0', '2021-12-03 16:05:45', 'ca2113c687a2395a97abc6ed545524b7'),
('aaaaaa', '', '', 'aaaaaa', '', '0', '2021-12-03 16:05:45', 'ca2113c687a2395a97abc6ed545524b7'),
('cj;m5', '', '', 'cj;6m35 ', '', '0', '2021-12-03 16:05:45', 'ca2113c687a2395a97abc6ed545524b7'),
('', '', '', 'aaaaaa', '', '0', '2021-12-03 16:05:45', 'ca2113c687a2395a97abc6ed545524b7'),
('123', '', '', '123 123', '', '0', '2021-12-03 16:05:45', 'ca2113c687a2395a97abc6ed545524b7'),
('warren00857020', '', '', 'warren0702', '', '0', '2021-12-03 16:05:45', 'ca2113c687a2395a97abc6ed545524b7'),
('warren', '00857020', '00857020@mail.ntou.edu.tw', '00857020', '02a16ab82e3fe1096e94b345572ef8db', '1', '2021-12-03 16:37:05', 'ca2113c687a2395a97abc6ed545524b7'),
('aaa', '00857029', '00857029@mail.ntou.edu.tw', '111111', 'b28cbc7f13f2283e88cdda5d86f61a1c', '1', '2021-12-12 14:43:11', NULL),
('00857029', '00857000', '00857000@mail.ntou.edu.tw', '111111', 'e412bdfb939ecf9e48e45482d3a02bfc', '0', '2021-12-13 13:50:13', NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
