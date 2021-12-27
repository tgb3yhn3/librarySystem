-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-12-26 16:36:22
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

-- --------------------------------------------------------

--
-- 資料表結構 `blacklist`
--

CREATE TABLE `blacklist` (
  `userID` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `reason` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `book`
--

CREATE TABLE `book` (
  `bookName` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `author` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ISBN` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `describeBook` varchar(10000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `bookImage` longblob DEFAULT NULL,
  `imageType` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `bookUniqueID` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `class` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `publish_year` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `num` int(20) NOT NULL,
  `status` int(15) NOT NULL,
  `publisher` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `img_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `book`
--

INSERT INTO `book` (`bookName`, `author`, `ISBN`, `describeBook`, `bookImage`, `imageType`, `bookUniqueID`, `class`, `publish_year`, `num`, `status`, `publisher`, `img_url`, `create_time`) VALUES
('老人與海', '厄尼斯特．海明威', '9789574554089', '<P>　　本書獲一九五三年普立茲文學獎、一九五四年諾貝爾文學獎，是海洋文學代表作，也是海明威畢生文學成就的總結。</P><P>　　老人一連八十四天毫無所獲，就在第八十五天早上，他捕到了一條比船還大的馬林魚。經過兩個晝夜的奮戰，老人終於制伏了大魚。可是，鯊魚群立刻過來搶奪他的戰利品，老人雖然竭盡全力與鯊魚搏鬥，大魚仍難逃被吃光的命運，老人最後只拖回一副魚骨頭……</P><P>　　海明威以精鍊的文字、細膩的筆觸，生動地刻劃老漁夫和大魚搏鬥、和大自然對決的過程，老漁夫最後雖然毫無所獲，他不被乖舛命運擊敗的毅力卻是值得歌頌的。</P><P>　　《老人與海》出版四十八小時銷售五百三十萬冊，創下出版史上的紀錄，不僅使海明威成了美國最偉大的作家之一，也使他成為了二十世紀世界文壇的傳奇人物。</P><P><STRONG>作者簡介</STRONG></P><P><STRONG>厄尼斯特．海明威(Ernest Hemingway, 1899-1961)</STRONG></P><P>　　美國近代小說家。二十世紀最傑出的作家之一，獲1954年諾貝爾文學獎。 1899年出生於伊利諾州芝加哥的橡樹園鎮，父親是醫生，母親是聲樂家。從小喜歡釣魚、打獵、音樂和繪畫。曾加入紅十字會任救護車司機、戰地記者，過著多采多姿的生活，終生以寫作為職志。晚年患多種疾病，精神抑鬱，1961年在自家住宅用獵槍自殺，結束了一生。主要作品有《老人與海》、《戰地春夢》、《戰地鐘聲》、《雪山盟》、《旭日又東升》、《沒有女人的男人》、《我們的時代》等。</P>', '', '', '9789574554089_0', 'undefined', '2003/06/30', 1, 0, '晨星', 'https://im2.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/022/13/0010221353.jpg&v=4c91ed7c&w=348&h=348', '2021-12-26 08:25:35'),
('信義學 ﹕ESG先行者10個有溫度的創新', '陳建豪', '9789865253431', '<div style=\"text-align: center;\"><strong>揭開第一名房仲信義房屋四十年的經營心法與成功祕訣！<br>信義房屋 ﹕比你還在意你的事，創造無可取代的信任！<br><br>信義深知賣的不只是房子，是家，是信任，<br>是人情，是人與人之間的情感聯繫，<br>因為家健全了，有了溫度，人與人之間有更緊密的關係，<br>社會才能正向發展，這塊土地上的人才會好，企業也才能茁壯。</strong></div><br>　　從創業第一天，信義房屋就堅持走一條不一樣的路，<br>　　不僅以先義後利、以人為本、正向思考做為經營理念，<br>　　更從三十多年前開始就走在眾人之前，一步一腳印的實踐ESG的理念，<br>　　不僅每一個創新都是從誠信出發，每一次交易都是真心對待客戶在意的事，<br>　　更看重腳底下的一草一木，努力為生活其中的人們打造更好的環境，帶來幸福，<br>　　本書揭開信義房屋如何扭轉房仲業樣貌，真誠待客、成就夥伴、打造永續環境，<br>　　成為房仲第一品牌及ESG標竿企業的成功心法！<br><br><strong>信任推薦</strong><br><br>　　政大名譽講座教授　司徒達賢、政大企管系特聘教授　別蓮蒂、逢甲大學人言講座教授　許士軍、台灣地方創生基金會董事長　陳美伶、綠藤生機共同創辦人暨執行長　鄭涵睿、企業講師、作家、主持人　謝文憲、AAMA 台北搖籃計畫共同創辦人 / 校長　顏漏有、鮮乳坊創辦人暨大動物獸醫　龔建嘉<br> ', '', '', '9789865253431_0', 'undefined', '2021/11/10', 3, 0, '天下文化', 'https://im2.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/090/79/0010907927.jpg&v=6181134c&w=348&h=348', '2021-12-26 14:31:58'),
('', '', '', '', '', '', '9789865253431_1', '', '', 0, 0, '', '', '2021-12-26 14:32:53'),
('', '', '', '', '', '', '9789865253431_2', '', '', 0, 0, '', '', '2021-12-26 14:32:53'),
('身而為鳥：從飛翔、築巢、覓食到鳴唱，了解鳥的一舉一動，以及其中的道理', '大衛．希伯利', '9789865562359', '<div style=\"text-align: center;\"><strong>當代觀鳥大師希伯利結合頂尖鳥類繪圖與專業科學研究<br>讓讀者也能「身而為鳥」，體驗種種超乎人類想像的演化適應及生存能力</strong></div><br>　　鳥，在我們日常生活中隨處可見。憑著偶而的驚鴻一瞥，我們就覺得大概知道鳥是怎樣的生物。但是鳥兒看似理所當然的飛翔、覓食和築巢等行為，甚至獨樹一幟的白色排泄物，其實都涉及精密的生理構造或多方權衡的能力！<br><br>　　開始撰寫這本鳥類行為學專書後，即使觀鳥生涯長達五十年，已被譽為鳥界巨擘的作者大衛．希伯利，仍然驚嘆：「原來鳥的生活如此奇妙！」<br><br>　　全書收錄84幅實物尺寸的鳥類繪圖，從水鳥、猛禽到雀鳥，個別鳥種的曼妙姿態躍然紙上。精采、知識量濃密的文字，搭配連續動作分解以及構造解剖等細部繪圖，讓讀者交互參照，一探鳥類日常作息背後隱藏的生物知識：<br><br>　　鳥唱個不停，都不用像人類那樣換氣？原來不論吸氣或吐氣，鳥都能同時發出兩種聲音，大嗚唱家當之無愧。這是怎樣的呼吸系統？<br><br>　　站在樹枝上睡覺的鳥，為何不會掉下來？其實不是爪子抓得緊，而是高超的平衡能力！<br><br>　　鳥蛋的形狀如此多變，原來和母鳥怎麼飛有關！這其中的關聯是什麼？<br><br>　　黑色的鳥在烈日下活動，體溫不會過熱嗎？其實熱的是羽毛，身體反而涼爽！<br><br>　　鳥兒究竟過著怎樣的生活？身而為鳥，是什麼感覺？這種力求突破旁觀視角，從鳥兒的需求出發去認識鳥類生活的渴望，促使希伯利再度完成一本轟動北美鳥界的著作。<br><br>　　不論你是初入門者，或像作者有數十年賞鳥經驗，只要抱著好奇的心盯著鳥兒，總能得到無限驚奇。<br><br>　　本書帶你深入了解驚奇背後，鳥類引人入勝的生理構造及演化適應，突破肉眼觀察局限的圖解，由內部解剖到外觀，讓這生命的奇蹟躍然紙上。<br><br><strong>專業推薦</strong><br><br>　　丁宗蘇／國立臺灣大學森林環境暨資源學系教授<br>　　林大利／特有生物研究保育中心助理研究員<br>　　林思民／國立臺灣師範大學生命科學系教授．台灣猛禽研究會理事長<br>　　張東君／科普作家<br>　　蔡若詩／國立嘉義大學生物資源學系暨研究所助理教授<br>　　顏聖紘／國立中山大學生物科學系副教授<br>　　（按姓氏筆劃排序）<br><br><strong>各界好評</strong><br><br>　　■「【書中】鳥的生理和心智能力將令你驚奇」──Julie Zickefoose，《華爾街日報》書評<br><br>　　■「希伯利的繪圖將讓你對每一頁流連忘返……如果你喜愛鳥，你就會愛上這本書」──Jennifer J. Meyer，「後院賞鳥人」網站<br><br>　　■「希伯利回答人們對於鳥的各種問題……【他】嚴謹的藝術作品和廣博的專業知識讓鳥類的行為躍然紙上。」──賞鳥網<br><br>　　■「本書之美與其中妙筆生花描述的鳥兒交相輝映」──美國全國公共廣播電台<br> ', '', '', '9789865562359_0', '', '2021/12/01', 1, 0, '大家出版', 'https://im1.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/090/94/0010909466.jpg&v=61962b34&w=348&h=348', '2021-12-26 13:20:58');

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
('aaa', '9786269521159', '312321'),
('aaa', '9786269521159', '1231'),
('aaa', '9786269521159', '1231232'),
('aaa', '9786269521159', '3123213123213123213123213123213123213123213123213123213123213123213123213123213123213123213123213123'),
('aaa', '9786269521159', '作者： 韓在佑 出版社：境好出版 出版日期：2021/12/16 ISBN:9786269521159 內容: 沒有更強的武術，只有更強的人。 讀書更是如此，不是尋找更好的方法把書讀好， 而是依循大腦'),
('aaa', '9789574554089', '這是測試評論'),
('aaa', '9789574554089', '測試第二遍'),
('aaa', '9789574554089', '最後測試'),
('aaa', '9789574554089', '有錯啦'),
('aaa', '9786269546305', '耶一');

-- --------------------------------------------------------

--
-- 資料表結構 `line_up`
--

CREATE TABLE `line_up` (
  `numbering` int(100) NOT NULL,
  `userID` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ISBN` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `start_time` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lasting_time` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `line_up`
--

INSERT INTO `line_up` (`numbering`, `userID`, `ISBN`, `start_time`, `lasting_time`) VALUES
(3, '00857029', '9789865253431', '2021-12-26', '-'),
(4, '00857029', '9789574554089', '2021-12-26', '-');

-- --------------------------------------------------------

--
-- 資料表結構 `loginin`
--

CREATE TABLE `loginin` (
  `userID` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `loginin`
--

INSERT INTO `loginin` (`userID`, `time`, `ip`) VALUES
('00857029', '2021-12-19 11:33:15', ' ::1 '),
('00857029', '2021-12-19 11:34:16', ' 36.225.186.10 '),
('00857029', '2021-12-19 13:01:11', ' 36.225.186.10 '),
('00857029', '2021-12-19 13:07:55', ' 49.216.222.38 '),
('00857029', '2021-12-20 11:52:38', ' ::1 '),
('00857029', '2021-12-20 16:43:09', ' ::1 '),
('00857029', '2021-12-20 17:41:23', ' ::1 '),
('00857029', '2021-12-20 17:48:22', ' ::1 '),
('00857029', '2021-12-20 18:20:36', ' ::1 '),
('00857029', '2021-12-21 13:41:43', ' ::1 '),
('00857029', '2021-12-22 09:08:57', ' ::1 '),
('00857029', '2021-12-22 09:17:09', ' ::1 '),
('00857029', '2021-12-23 04:25:09', ' ::1 '),
('00857029', '2021-12-23 05:43:43', ' ::1 '),
('00857029', '2021-12-23 05:44:35', ' ::1 '),
('00857020', '2021-12-23 18:01:12', ' ::1 '),
('00857029', '2021-12-26 07:53:08', ' ::1 '),
('00857029', '2021-12-26 07:58:43', ' 36.225.176.161 '),
('00857029', '2021-12-26 08:22:30', ' ::1 '),
('00857029', '2021-12-26 09:29:37', ' ::1 '),
('00857029', '2021-12-26 13:43:53', ' ::1 '),
('00857029', '2021-12-26 13:44:42', ' ::1 '),
('00857039', '2021-12-26 15:10:02', ' 49.216.184.134 '),
('00857029', '2021-12-26 15:11:44', ' 36.225.176.161 '),
('00857029', '2021-12-26 15:18:25', ' 36.225.176.161 ');

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
('以', '00857006', '00857006@mail.ntou.edu.tw', '1234567890', 'fa9b4b332f4d4c102b1fb8deed4ea040', '1', '2021-12-14 15:06:31', NULL),
('warren', '00857020', '00857020@mail.ntou.edu.tw', '00857020', '02a16ab82e3fe1096e94b345572ef8db', '2', '2021-12-03 16:37:05', 'ca2113c687a2395a97abc6ed545524b7'),
('00857029', '00857029', '00857029@mail.ntou.edu.tw', '111111', 'e87ca334d121da617ad1f4412f2e21d8', '1', '2021-12-26 15:17:34', NULL),
('凱凱', '00857039', '00857039@mail.ntou.edu.tw', '123456', 'f3108c51ef7a2c0c1cca250992eea454', '1', '2021-12-26 15:07:19', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `user_book_history`
--

CREATE TABLE `user_book_history` (
  `userID` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `numbering` int(100) NOT NULL,
  `book_unique_ID` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `start_rent_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `return_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lasting_return_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `book_status` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment_status` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ISBN` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `book_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `user_book_history`
--

INSERT INTO `user_book_history` (`userID`, `numbering`, `book_unique_ID`, `start_rent_date`, `return_date`, `lasting_return_date`, `book_status`, `comment_status`, `ISBN`, `book_name`) VALUES
('00857029', 5, '9789574554089_0', '2021-12-25', '2021-12-26', '2022-01-09', '已歸還', '已評論', '9789574554089', '????'),
('00857029', 6, '9786269546305_0', '2021-12-26', '2021-12-26', '2022-01-10', '已歸還', '已評論', '9786269546305', 'Wrinkles —— BIOS monthly 專訪選集 2021'),
('00857029', 7, '9789865253431', '-', '-', '-', '已預約', '-', '9789865253431', '信義學 ﹕ESG先行者10個有溫度的創新'),
('00857029', 8, '9789574554089', '-', '-', '-', '已預約', '-', '9789574554089', '老人與海');

-- --------------------------------------------------------

--
-- 資料表結構 `user_condition`
--

CREATE TABLE `user_condition` (
  `userID` varchar(15) NOT NULL,
  `book_num` int(15) NOT NULL,
  `book_time` int(15) NOT NULL,
  `book_fine` float NOT NULL,
  `credit` int(15) NOT NULL,
  `renting_book_num` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `user_condition`
--

INSERT INTO `user_condition` (`userID`, `book_num`, `book_time`, `book_fine`, `credit`, `renting_book_num`) VALUES
('00857020', 3, 15, 1, 3, 1),
('00857029', 3, 15, 1, 2, 2),
('857029', 3, 15, 1, 0, 0),
('857039', 3, 15, 1, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `user_favorite_book_data`
--

CREATE TABLE `user_favorite_book_data` (
  `userID` varchar(10) COLLATE utf8_croatian_ci NOT NULL,
  `ISBN` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
  `bookName` varchar(50) COLLATE utf8_croatian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- 傾印資料表的資料 `user_favorite_book_data`
--

INSERT INTO `user_favorite_book_data` (`userID`, `ISBN`, `bookName`) VALUES
('00857029', '9789574554089', '老人與海');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`userID`);

--
-- 資料表索引 `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookUniqueID`);

--
-- 資料表索引 `line_up`
--
ALTER TABLE `line_up`
  ADD PRIMARY KEY (`numbering`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- 資料表索引 `user_book_history`
--
ALTER TABLE `user_book_history`
  ADD PRIMARY KEY (`numbering`);

--
-- 資料表索引 `user_condition`
--
ALTER TABLE `user_condition`
  ADD PRIMARY KEY (`userID`);

--
-- 資料表索引 `user_favorite_book_data`
--
ALTER TABLE `user_favorite_book_data`
  ADD PRIMARY KEY (`userID`,`ISBN`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `announcement`
--
ALTER TABLE `announcement`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '公告id', AUTO_INCREMENT=56;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `line_up`
--
ALTER TABLE `line_up`
  MODIFY `numbering` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_book_history`
--
ALTER TABLE `user_book_history`
  MODIFY `numbering` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
