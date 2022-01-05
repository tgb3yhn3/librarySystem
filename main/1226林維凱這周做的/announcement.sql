-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-12-26 11:52:45
-- 伺服器版本： 10.4.19-MariaDB
-- PHP 版本： 8.0.7

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
-- 資料表結構 `announcement`
--

CREATE TABLE `announcement` (
  `ID` int(11) NOT NULL COMMENT '公告id',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '公告標題',
  `message` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '公告詳細訊息',
  `annouceTime` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '公告時間',
  `sent_to` varchar(10) DEFAULT NULL COMMENT '傳送對象'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `announcement`
--

INSERT INTO `announcement` (`ID`, `title`, `message`, `annouceTime`, `sent_to`) VALUES
(3, '(重要通知)00857039 林維凱同學', '00857039&ensp;林維凱同學，您還有3本書未歸還，請盡速歸還!', '2021-12-22 01:01:26', '00857039'),
(4, '(重要通知)00857039 林維凱同學', '恭喜同學在圖書館2樓聖誕活動抽到&ensp;&ensp;3獎&ensp;無印良品自動筆!\r<br>\r<br>請盡速在3日內到圖書館領取獎勵', '2021-12-22 01:01:33', '00857039'),
(46, '國立臺灣圖書館舉辦「身心障礙研究優良論文獎助要點」 活動，最高獎金五萬元，歡迎申請。', '一、為鼓勵各界人士從事身心障礙者應用圖書資訊之相關研究，臺灣圖書館於110年6月1日起至8月31日止，開放博、碩士學位論文及期刊論文研究主題屬相關領域者提出獎助申請。\r<br>二、獎助名額與獎金：&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;\r<br>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;(1)博士論文每年以獎助優良及佳作各1至3名為原則，獲評為優良者每名獎助新臺幣（以下同）5萬元，佳作者每名1萬元；&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;\r<br>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;(2)碩士論文每年以獎助優良及佳作各1至5名為原則，獲評為優良者每名獎助3萬元，佳作者每名8千元。&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;\r<br>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;(3)期刊論文每年以獎助優良及佳作各1至5名為原則，獲評為優良者每名獎助1萬元，佳作者每名3千元。&ensp;&ensp;\r<br>詳請參閱附件或活動網頁。', '2021-12-24 10:41:13', 'all');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '公告id', AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
