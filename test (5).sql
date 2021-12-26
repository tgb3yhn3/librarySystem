-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-12-21 18:31:12
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
-- 資料表結構 `blacklist`
--

CREATE TABLE `blacklist` (
  `userID` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `reason` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `blacklist`
--

INSERT INTO `blacklist` (`userID`, `username`, `reason`) VALUES
('00857020', 'warren', 'sdasd');

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
  `img_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `book`
--

INSERT INTO `book` (`bookName`, `author`, `ISBN`, `describeBook`, `bookImage`, `imageType`, `bookUniqueID`, `class`, `publish_year`, `num`, `status`, `publisher`, `img_url`) VALUES
('用大腦喜歡的方式「1人學習」：運用腦科學原理x掌握五大原則，制霸考場、錄取公職、順利考取證照的速效讀書法', '韓在佑', '9786269521159', '<div style=\"text-align: center;\"><div><div style=\"text-align: left;\"><div style=\"text-align: center;\"><div style=\"text-align: left;\"><div style=\"text-align: center;\"><strong>沒有更強的武術，只有更強的人。</strong></div><div style=\"text-align: center;\"><strong>讀書更是如此，不是尋找更好的方法把書讀好，</strong></div><div style=\"text-align: center;\"><strong>而是依循大腦的運作模式「重複」越多次，就越能有好表現。</strong></div><div style=\"text-align: center;\"><strong>而這個運作模式就是「1人學習」！</strong></div><div>       </div><div>      　　★ 來自讀者的真實回饋，他們「1人學習」之後，都：</div><div>      　　‧我開始思考必須學習的理由，也領悟到自己過去的學習方法是錯的。（高三考生）　　</div><div>      　　‧開始刻意獨學之後，我的成績真的好到令人驚訝，尤其背科變得特別好。（公職考生）</div><div>      　　‧不光是學習法，我甚至覺得自己找到人生的目標。（國三考生）</div><div>      　　‧很謝謝這本書，我達成目標了。（成功轉學進入藥學院的學生）</div><div>      　　‧我這輩子第一次考了全校第一名！這是我以前從不敢想像的！（外語高中一年級生）</div><div>      　　‧除了學習之外，也對人生有很多幫助。因為這本書，即便我一邊上班、一邊帶小孩，也能考到技師證照！（上班族）</div><div>      　　‧我看了很多跟學習有關的書，但沒有一本能超越這本書。（在家自學者）</div><div>      　　‧每位考生與家長，都應該讀一讀這本書！（學生家長）</div><div>      　　‧本來是為了好好教孩子而開始讀這本書，反而對我自己帶來很大的幫助。（教師）</div><div>       </div><div>      　　● 打破資質神話，用對方法鍛鍊「思考肌肉」就會變聰明。</div><div>      　　● 覺得讀書無聊，在於不夠專注；一旦深度專注，大腦就會分泌多巴胺產生快樂和成就感。</div><div>      　　● 不花錢、縮短時間、做好學習的唯一速效讀書法，就是自己一個人不斷地獨自學習！</div><div>       </div><div>      　　所謂的學習，就是將外部刺激轉換成長期記憶，置放於大腦中，以便於日後需要隨時拿提取運用。為此，唯有遵照大腦將某些東西放入腦中的「運作模式」，才是有效的學習方法；而這個運作模式，就是「1人學習」！</div><div>       </div><div>      　　<strong>■ 從腦科學原理，理解「1人學習」有助長期記憶儲存的原因</strong></div><div>      　　人腦中有許多神經元，這些神經元受到刺激後會變形，產生突觸；而突觸之外有一層髓磷脂；越厚的髓磷脂，其神經元傳導訊號的速度就會越快，進而更容易儲存為長期記憶。</div><div>       </div><div>      　　那麼，該如何增加髓磷脂的厚度呢？答案就是：讓「一模一樣」的訊號「重複」流過神經元。這也是為什麼需要一人學習的原因：唯有專注的重複學習，這些知識才會化成長期記憶，而這件事情，只有自己「一個人」的時候，才做得到。因為每個人大腦內的運作，只有自身有辦法掌握。這是上再多補習班、參加再多讀書會，甚至請再多位家教，都無法達成的事。</div><div>       </div><div>      　　<strong>■ 貫徹「1人學習」的五大原則 </strong></div><div><strong>　　【1】一定要運動</strong></div><div>      　　‧根據美國調查加州上百萬名學生的資料後發現，運動能力出色的學生，成績比運動學生不出色的學生高上兩倍。</div><div>      　　‧運動時大腦的神經傳導物質濃度會提高，增加長期記憶的儲存空間。</div><div>      　　‧覺得書念不下去時，就去運動；據研究，每日5分鐘短時間的運動能有效維持專注力。</div><div>       </div><div>      　　<strong>【2】學習目標要非常明確</strong></div><div>      　　‧1953年耶魯大學畢業生中，只有3％的人擁有具體目標，並把目標用文字寫下來。過了22年之後，那3％畢業生所擁有的財富，比剩餘97％的人加總起來還多。</div><div>      　　‧重點是擁有「清晰的」目標，而不是「像樣的」目標。這個目標必須清晰到，當流星劃過許願時，就能立刻說出來。</div><div>      　　‧設定目標的方法，有：SMART目標設定法、BHAG設定法、超額達成策略、改善策略等。</div><div>       </div><div>      　　<strong>【3】重複是讀好書的唯一解答</strong></div><div>      　　‧有效的重複，是放下已知、挑選不知道的部分重複學習，直到完全了解為止。</div><div>      　　‧重複閱讀是最基本的方法；其次，重複抄寫雖然要花很多時間，效果卻是最好的。</div><div>      　　‧重複學習完後馬上闔上書本，立刻檢視是否能在腦說出剛剛的內容，最有效。</div><div>       </div><div>      　　<strong>【4】專注程度，必須達到忘我境界的心流狀態</strong></div><div>      　　‧學習量 = 學習時間 x 專注度；因此，越能進入深度專注，讀書的時間就可以越少。</div><div>      　　‧據研究，當專注度提升到一定程度以上，大腦就會分泌多巴胺使人感到快樂，使得我們維持在深度專注中。這也說明越是深度專注的學習，成就感會越高。</div><div>      　　‧學習內容的難易度必須與自身能力相當，否則很快就會失去興趣，進而使專注度下降。</div><div>       </div><div><strong>　　【5】積極善用零碎時間</strong></div><div>      　　‧每個人都只有24小時，所以唯有懂得化零為整、隨時隨地處在學習狀態，才能和其他人做出差異。</div><div>      　　‧無法坐在書桌前時，可利用回想或在腦中解題、創意發想等方式學習。</div><div>      　　‧把握通勤、移動時間，利用智慧型手機當作零碎時間的學習工具。</div><div>       </div><div>      　　<strong>〔特別加映〕如何克服「不想讀書」的瓶頸？</strong></div><div>      　　學習，一定會有很累、想放棄、充滿挫折與絕望的時候；當面對到這種情形時，要如何做好心理建設，突破難關呢？</div><div>       </div><div>      　　►人之所以會感到挫折，是因為貪欲，是因為想要成就什麼的野心。如果想克服挫折，必須意識到這樣的想法是源自於野心；放下野心，就能放下挫折。</div><div>       </div><div>      　　►難以提升專注度時，「放輕鬆」就是最好的解答。但所謂的「放輕鬆」不是停止學習，而是修正學習內容，例如原本要解數學題目20題，改完成5題就好。</div><div>      　</div><div>      　　►要做的事太多，力有未逮時，便容易陷入絕望之中。不過大多數的人所承受的痛苦，都超出實際存在的痛苦總量，那是因為人都會在內心編故事，為此要隨時提醒自己專注「此時此刻」就好。</div><div>       </div><div><strong>本書特色</strong></div><div>       </div><div>      　　（1）以腦科學原理的角度出發，提供真實的研究數據，說明「一人學習」是最佳學習法。</div><div>      　　（2）從學習原理、生活管理到心理素質強化等，提供考生全方位的完整學習和備考指南。</div><div>      　　（3）每章結尾皆有重點整理摘要，提供讀者快速掌握重點，依照自身所需快速查照翻閱。<br>       <div><div><strong>好評推薦</strong></div><div><strong>　　</strong></div><div>        　　<strong>【獨學推薦】</strong>（依姓氏筆劃排序）</div><div>         </div><div>        　　水丰刀｜閱部客創辦人／知名YouTuber</div><div>        　　宋怡慧｜作家／新北市丹鳳高中圖書館主任</div><div>        　　沈雅琪｜神老師</div><div>        　　鄭俊德｜閱讀人社群主編　</div><div>        　　歐陽立中｜暢銷作家／爆文學院創辦人</div></div></div></div><div>      </div></div></div><div style=\"text-align: left;\">    </div></div><div style=\"text-align: left;\">   </div></div><br>', '', '', '9786269521159_0', '', '2021/12/16', 1, 0, '境好出版', 'https://im2.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/091/02/0010910241.jpg&v=61a5fd62&w=348&h=348'),
('我們，MZ新世代：準時下班？不婚不生？奉行極簡？帶你秒懂八年級生都在想什麼', '高光烈', '9789573293163', '        　　MZ世代，即橫跨「千禧世代」及「Z世代」，<br>　　本書聚焦討論出生於一九九〇年代的這群人，相當於我國的八年級生。<br><br>　　★ 第一本由MZ世代所撰寫，傳達該世代的真實想法，揭示他人未見之處！<br>　　★ 著重組織管理與市場行銷，從工作哲學到購物趨勢，洞悉市場新消費主力！<br> <br>　　作者企圖帶領外界了解MZ世代的文化、趨勢、思想、價值觀以及消費習慣，<br>　　內容提及與他們打交道的方法，以及向擁有經濟實力的他們行銷的方法。<br>　　他們可能是大學剛畢業的職場新鮮人、小資男女，<br>　　也可能是考慮成家、擔任公司幹部的而立青年，<br>　　重點是他們就在你我身邊，已是生活與消費的文化引領者，<br>　　不了解他們就沒有未來！<br><strong> <br>　　【試舉 MZ世代的特質】</strong><br>　　〔關於工作〕<br>　　準時下班｜如果提前30分鐘上班，就必須提前30分鐘下班，工作只是獲得穩定薪水的地方。<br>　　拒絕無償加班｜八年級生不是拒絕加班，而是拒絕提供免費服務。<br>　　避開應酬｜下班後藉由安靜地離開公司，以婉拒不必要的應酬。<br>　　機會短缺｜找不到好的工作，薪資收入普遍少於父母。<br><br>　　〔關於社群〕<br>　　獨來獨往｜喜歡獨飯、獨影、獨旅，且基於互相尊重的前提下奉行個人主義。<br>　　興趣至上｜學緣、地緣已非人脈組成核心，習慣跟志趣相投的人組成社群。<br>　　瞬變的流行｜習慣使用 Instagram，習慣創造新造語或縮略語。<br><br>　　〔關於消費〕<br>　　重視體驗｜花一樣的錢，與其擁有一樣東西，不如選擇十種不同的體驗。<br>　　習慣訂閱｜樂於付費購買好的內容，以非法軟體為榮的時代早已是過去式。<br>　　追隨網紅｜相較於品牌，更愛網紅推薦，經常購買自己喜歡的網紅推薦的衣服和用品。<br>　　日常極簡主義與一次性 Flex｜消費趨勢是「選擇和集中」，買一個奢侈品，其他用便宜貨。<br>　　便利付費｜即食調理包和外賣市場的成長，只要方便，再貴都買單。<br><br>　　〔關於人生〕<br>　　七拋世代｜戀愛、結婚、生子、買房、人際關係、夢想、希望皆已拋，決定不努力了。<br>　　專注當下｜否定未來，絕望於看不見階級流動的可能，好像什麼事都不可能成功<br>　　重視公平｜沉迷於比特幣的理由是，在新類型的資產上獲得公平競爭的機會。<br>　　不婚不生｜不完全是因為沒錢所以不結婚，而是不想踏入婚姻。<br>　　注重過程｜擺脫結果主義，重視努力的過程，把意義聚焦在挑戰本身。<br><strong> <br>　　【MZ世代的十誡】</strong><br>　　01. 上班打卡09:01很可以，但無法接受08:59<br>　　02. 雖然不能成為有錢人，但一定要體驗有錢人生活<br>　　03. 用辭職對付頻繁的公司聚餐<br>　　04. 電子郵件是老頑固做的事，手寫信是感性<br>　　05. 網路上的朋友也是朋友<br>　　06. 用惡搞對抗大叔笑話<br>　　07. 疼痛不是青春，是生病<br>　　08. 364天超商便當，1天名牌族<br>　　09. 雖然接受貧窮，但拒絕免費<br>　　10. 在公司進行無言修行才是正解（在朋友面前則是多話人）<br>　　儘管摸不著頭緒，但一定得知道的MZ世代的真正想法！<br> <br><strong>各界好評推薦</strong><br><br>　　末羊子｜台灣知名極簡主義 YouTuber<br>　　李明璁｜社會學家、作家<br>　　胃酸人｜資深韓文老師／YouTuber<br>　　姚詩豪｜大人學共同創辦人<br>　　黃銘彰｜《VERSE》執行主編', '', '', '9789573293163_0', '', '2021/11/26', 1, 0, '遠流', ''),
('公司的品格：22個案例，了解公司治理和上市櫃公司的財務陷阱', '李華驎,鄭佳綾', '9789861341613', '<p style=\"text-align: center;\"><span style=\"color:#ff0000;\"><strong>為什麼好企業一夕之間淪為全民公敵？<br /> 你用血汗錢傾力託付的對象，是值得信賴的公司嗎？</strong></span></p><p> 　　財經版「看見台灣」，揭露台灣上市櫃公司治理盲點及怪現狀，<br /> 　　讓你知道怎樣選擇好公司，投資不吃虧、消費不憂心！<br /><br /> 　　誰是接班人？台積電 的交棒難題<br /> 　　高階主管獎酬計畫是激勵還是誘惑？宏碁 與蘭奇條款<br /><br /> 　　績優生也犯錯？從 中華電信 避險案看內部控制<br /> 　　什麼是合理的董監酬勞？以 力晶科技 為例<br /><br /> 　　餐桌上的董事會－－莊頭北工業 啟示錄<br /> 　　一場荒謬的股東會－－中石化 經營權之爭<br /><br /> 　　禿鷹與狼的鬧劇－－亞洲化學<br /> 　　高獲利低配股的迷思－－從 TPK宸鴻 談起<br /><br /> 　　帝國夢碎，股東買單－－明基 併購啟示錄<br /> 　　從 國巨 案談台灣的管理層收購<br /><br /><strong>　　★胖達人炒股事件、黑心油風波、日月光廢水汙染案．．．標竿企業內部藏了哪些股東不知的隱憂？</strong><br /> 　　食安問題、內線交易、掏空公司、金融危機．．．公司治理不彰，結果竟是你我必須付出代價！<br /> 　　22個案例，讓你看懂企業體質、守住自己的基本權益！<br /><br /> 　　良好的公司治理是企業永續發展及健全資本市場的重要基礎，但變相的公司治理、法律規範與金融機構，已形成共犯結構，嚴重影響台灣人民財富自由及資訊透明的權益！<br /><br /> 　　專業財經部落格「RusRule」格主 Rus 針對五年來台灣上市櫃公司重要議題，以公司治理角度切入，透過不同面向的分析，引領讀者深入淺出了解公司治理對投資人和經營者的重要性。<br /><br /><strong>　　★台灣人應該關心的代表性案例！投資人最想問的關鍵問題！深入淺出精采解說！</strong><br /> 　　為什麼上市櫃公司喜歡把旗下金雞母分割上市？<br /> 　　企業分割，小股東任人宰割？<br /> 　　為什麼台灣內線交易很少被定罪？<br /> 　　上市櫃公司董事長會因為經營績效不佳下台嗎？<br /> 　　是慈善公益還是在慷股東之慨？<br /> 　　如何掏空一家公司？<br /> 　　政治利益與股東利益，孰者為重？<br /> 　　如何強化企業誠信經營，減少可能的違規或不法？<br /><br /> 　　〈Rus的真心告白．台灣人應該看見的真相〉<br /><br /> 　　在本書寫作將近完成時，台灣正被食品安全問題弄得人心惶惶。<br /><br /> 　　整件事最早始於一個香港觀光客無心揭露了知名麵包店胖達人使用人工香料問題，而後另一家食用米大廠山水米，被抓到混用進口米，欺騙消費者為本地米。<br /><br /> 　　最後胖達人被「重罰」18萬元，而山水米則是被「怒罰」了20萬元。而且見鬼的是，這時大家才知道，原來同樣的事山水米在過去兩年被抓了18次，更見鬼的是，原來台灣最大的包裝米公司中興米過去兩年被抓了19次。</p><p> 　　這代表著什麼？我們的稽查人員非常認真？還是我們的罰則太輕？<br /><br /><strong>　　讓我推敲一下，如果胖達人這件事發生在美國，會有什麼結果？</strong><br /> 　　首先，在衛生部門介入調查後如果確定屬實，會開出一張具有懲罰性金額的罰單，接下來大家會在電視上看到一堆律師告訴你：只要你曾經買過這家公司產品而有身體不適現象，請與他們連絡，他們會免費幫你打官司。再接下來的結果不意外，這家公司會有打不完的官司，公司就算沒倒閉也會因而要付出驚人的代價，這就是美國著名的消費者集體訴訟！<br /><br /> 　　很多人說美國人的亂訟造成了社會無謂的成本，可是我反問你，如果一家公司造假被抓包的結果是公司重傷或是倒閉，連帶老闆身敗名裂，台灣還有幾家公司膽敢欺騙消費者？更不要講兩年被抓20次還是18次這種笑話！<br /><br /> 　　這件事告訴大家的不只是公司治理問題，而是今天台灣所有的問題都在此。<br /><br /><strong>各界推薦</strong><br /><br /> 　　輔仁大學管理學院院長 李天行<br /><br /> 　　深入探討台灣上市櫃公司財務陷阱，幫助投資人趨吉避凶的最佳專業著作。<br /> ──總幹事黃國華（作家）<br /><br /> 　　自然人有人格，法人也有人格；自然人有品格，法人也有品格。自然人的品格不消說，法人的品格也不難懂。<br /> 　　公司法以董事長為公司代表人，因此法人的品格看董事長／會的管（治）理風格也就不言而喻了。<br /> 　　本書篇篇精采的案例與問題解答，在在說明真相只有一個：<br /> 　　有好品格的公司雖未必能讓你投資增值開心，但絕對能讓你的投資保值安心。<br /> 　　俏皮的說，詳讀本書內容，雖未必能讓您迎向大富大貴，但絕對能讓您避開大災大難！<br /> ──唐樹萬（中華策略管理會計學會理事長）</p>', '', '', '9789861341613_0', '', '2014/02/25', 1, 0, '先覺', 'https://im2.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/062/66/0010626613.jpg&v=52fb4d73&w=348&h=348'),
('華人室內設計經營智庫100', '張麗寶,漂亮家居編輯部', '9789864087532', '<p style=\"margin-left:0cm; margin-right:0cm\"><strong>全亞洲第一本室內設計公司經營調查報告</strong></p><p style=\"margin-left:0cm; margin-right:0cm\"><strong>透過全面性的調查，從個人工作室到小型、中型、大型百人設計公司之中，歸納出經營指引</strong></p><p style=\"margin-left:0cm; margin-right:0cm\"><strong>找出設計師創業的制勝法則：</strong></p><p style=\"margin-left:0cm; margin-right:0cm\"><strong>0</strong><strong>～5年拼生存</strong></p><p style=\"margin-left:0cm; margin-right:0cm\"><strong>5</strong><strong>～10年求成名</strong></p><p style=\"margin-left:0cm; margin-right:0cm\"><strong>10</strong><strong>～20年找定位</strong></p><p style=\"margin-left:0cm; margin-right:0cm\"><strong>20</strong><strong>年過後定傳承</strong></p><p style=\"margin-left:0cm; margin-right:0cm\"><strong> </strong></p><p style=\"margin-left:0cm; margin-right:0cm\"><strong>後疫情・</strong><strong>新常態，面對變動與挑戰，決戰設計管理力</strong></p><p style=\"margin-left:0cm; margin-right:0cm\">以創意為價值核心的室內設計師，成為設計公司的經營者後，會是不及格的老闆嗎？右腦驅動的設計魂能和左腦掌管的商業運作、經營數字和諧對話嗎？</p><p style=\"margin-left:0cm; margin-right:0cm\">如何有效設計管理，永遠是空間設計人不斷追求答案的大哉問。本書特別尋找華人室內設計產業中，值得參考的百家設計公司，從不同角度分析其營運成果，為在經營日常中的室內設計公司管理者提供有價值的經驗參考。</p><p style=\"margin-left:0cm; margin-right:0cm\"> </p><p style=\"margin-left:0cm; margin-right:0cm\">漂亮家居編採團隊首度以個案分析法，針對兩岸三地華人室內設計公司，進行深度訪談調查，參照室內設計公司經營成長擴張軌跡，對象依室內設計公司成立時間從5 年以下、6~10年、11~20年以及21年以上區別，規模遍及五人以下的個人工作室到近百人的大型組織，共100家華人知名室內設計公司。內容包括室內設計公司的創立經營歷程，以八大角度：行銷業務力、工程管控力、設計創新力、財務管理力、人才培育力、獎項策略力、危機應變力、國際拓展力進行深入分析。以商管角度解構與歸納各設計公司的營運軌跡，系統性建立室內設計公司的經營智庫，作為未來室內設計師提升商業管理能力的有效知識奠基。</p><p style=\"margin-left:0cm; margin-right:0cm\">    </p><p style=\"margin-left:0cm; margin-right:0cm\">・<strong>設計經營八力，直指經營關鍵</strong></p><p style=\"margin-left:0cm; margin-right:0cm\">1.行銷業務力</p><p style=\"margin-left:0cm; margin-right:0cm\">2.工程管理力</p><p style=\"margin-left:0cm; margin-right:0cm\">3.設計創新力</p><p style=\"margin-left:0cm; margin-right:0cm\">4.財務管理力</p><p style=\"margin-left:0cm; margin-right:0cm\">5.人才培育力</p><p style=\"margin-left:0cm; margin-right:0cm\">6.獎項策略力</p><p style=\"margin-left:0cm; margin-right:0cm\">7.危機管理力</p><p style=\"margin-left:0cm; margin-right:0cm\">8.海外拓展力<br /><br /> </p><p style=\"margin-left:0cm; margin-right:0cm\">・<strong>1</strong><strong>00</strong><strong>家設計公司，助你參透經營奧義</strong></p><p style=\"margin-left:0cm; margin-right:0cm\">住家、商空、地產，工作室、中小型、大型設計公司，5年、10年、20年以上，泛設計服務、跨足國際市場，全面呈現華人設計產業經營的類型與樣貌。</p>', '', '', '9789864087532_0', '', '2021/12/16', 1, 0, '麥浩斯', 'https://im1.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/091/03/0010910334.jpg&v=61b2d87c&w=348&h=348'),
('蘇黎士投機定律', 'Max Gunther', '9789866320040', '<P>　　◆假使你反對賭，那麼這本書將不會帶給你太多好處。除非你改變自己的看法。假如你不在乎承擔合理風險，甚至你有興趣冒險，那麼這本書正為你而作。本書討論風險以及風險的管理，會幫助你在賭中獲勝，而且勝算遠超過你所能想像，值得用心學習。本書將對賭作廣義的詮釋。作者除了談論股票，也將定律應用於商品期貨、貴重金屬、藝術品及古玩上；以及應用於不動產投機、日常的生意及應賭場和牌桌上。總之，蘇黎士投機定律指引你如何在金錢遊戲中獲得更豐厚的報酬。</P><P>　　◆「蘇黎士定律」一詞是瑞士證券和期貨投機俱樂部所創，是在第二次世界大戰後從華爾街收集來的。最初是由一夥志同道合、希望發財的男女所組成。他們認為沒有人能靠薪水而致富。瑞士人總結出一項有意義的結論，即人的一生，不能逃避風險，而應該謹慎的投入風險，必須謹慎而用思考去賭。在這種情況下收穫總是大於損失。成功的瑞士投機者幾乎不太注意那些一般性的投資建議，他們有自己更好的方法。</P><P>　　◆《蘇黎士投機定律》是投資經典著作，專門討論如何打賭賺錢。本書談論的十二項主要定律和十六項次要定律，歷久不衰，近年來守則內容並未改變，但卻深值投資人心，是投資人奉行不悖的真理。它的價值是數不清的，它不僅是一種投機哲理，實質上也是一條成功之路。畢竟已經使許多人致富。<BR></P>', '', '', '9789866320040_0', '', '2010/01/19', 1, 0, '寰宇', 'https://im1.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/045/90/0010459040.jpg&v=4b4f1392&w=348&h=348'),
('智慧型股票投資人（全新增訂版）', '班傑明．葛拉漢,傑森．茲威格', '9789866320972', '<div style=\"text-align: center;\"><strong>◆價值投資的原點由此開始。本書是根據當今的市況，對葛拉漢永恆智慧的最新詮釋</strong></div><div style=\"text-align: center;\"><strong>◆最具權威的價值型投資書籍，價值投資之父葛拉漢經典著作</strong></div><div style=\"text-align: center;\"><strong>◆原著全球至今銷售超過100萬冊，長據亞馬遜投資書籍榜首位</strong></div><div style=\"text-align: center;\"><strong>◆他將投資人分為「防禦型」和「積極型」，就是為了幫助這兩種不同的投資人，達到應有的投資成效</strong></div><div style=\"text-align: center;\">  </div><div style=\"text-align: center;\"> 股神巴菲特：1950年代初，我閱讀了本書的第一版， 那年我19歲。</div><div style=\"text-align: center;\"> 當時，我認為它是有史以來投資論述中最傑出的一本書籍。</div><div style=\"text-align: center;\"> 至今，我仍然如此認為。</div><div>  </div><div> 　　做為20世紀最偉大的投資顧問，班傑明．葛拉漢成功激勵了全球的投資界。他的「價值投資」哲學，讓投資人避免犯下巨大錯誤，並建立一套具有安全邊際的長期投資策略，也使得《智慧型股票投資人》從1949年首次出版以來，在市場上一直被奉為股票投資的聖經。</div><div>  </div><div> 　　多年以來，市場的進展已證明葛拉漢的策略是可行的。在完整保留原著的同時，本修訂版還提供了著名財經記者傑森．茲威格所做的最新評釋。茲威格指出當今的市場情況，與葛拉漢書中的案例有許多相似之處，讓讀者能更透徹理解，進而成功運用葛拉漢所提出的原則於現今市場。</div><div>  </div><div> 　　這本最新版的《智慧型股票投資人》，在如何實現理財目標的議題上，將是你至今閱讀過最好的一本著作。</div><div>  </div><div><strong>【來自華倫．巴菲特的告白】</strong></div><div> 　　1950年代初，我閱讀了本書的第一版，那年我19歲。當時，我認為它是有史以來投資論述中最傑出的一本書籍。至今，我仍然如此認為。</div><div>  </div><div> 　　想在投資生涯獲得成功，並不需要絕頂的智商、超凡的商業頭腦或內線消息，而是需要一個完整的知識架構以作為決策的基礎，並且有能力控制自己的情緒以避免該架構遭受破壞。本書明確而清晰地描述該架構，但對情緒的控制則是你自己必須做的。</div><div>  </div><div> 　　如果你遵循葛拉漢所倡導的行為和操作原則，尤其是第8章與第20章所提供的極為寶貴的建議——那麼，你將會獲得不錯的投資結果。（這是一種遠超出你所能想像到的成就。）你是否能獲得優異的投資成果，這要取決於你在投資方面的努力和擁有的知識，或取決於你的投資生涯中所展現的愚蠢程度。股市的行為越愚蠢，明智的投資者機會就越多。遵循葛拉漢的教誨，你就能從股市的愚蠢行為中受益，而不會成為其中的受害者。</div><div>  </div><div> 　　對我來說，班傑明．葛拉漢不僅是一位作者或老師，他對我一生的影響僅次於我的父親。葛拉漢於1976年去世後不久，我寫下了下面這篇紀念短文，發表在《金融分析師雜誌》上。當你閱讀本書時，我相信你一定能感受到這篇文章中所提及關於葛拉漢的一些特質。</div><div>  </div><div><strong>《金融分析師雜誌》，1976年11/12月刊</strong></div><div> 　　幾年前，就在班傑明．葛拉漢即將80歲之際，他向一位朋友表達了他的想法，希望每天都做一些｢傻事、有創造性的事和慷慨的事｣。</div><div>  </div><div> 　　他的第一個奇怪目標給人的印象是，他對自己想法的表達方式不會帶有任何說教或傲慢的成分。儘管他的想法是強有力的，但他的表達方式無疑是溫和的。</div><div>  </div><div> 　　對於葛拉漢創造性的成就，本雜誌的讀者無需我們詳細的介紹。在絕大多數情況下，任何原則的創始者都會發現，自己的研究成果很快就會被後繼者所超越。然而，本書對混亂和令人困惑的投資領域進行了系統化和邏輯化的分析；與此同時，在本書出版後的40年時間裡，人們很難想出有誰能夠在證券分析領域曾經達到過葛拉漢的水平。在這一領域，許多研究成果發表之後的幾個星期或幾個月，就會看起來非常可笑，但葛拉漢所提出的原則卻依然是屹立不搖——在金融風暴襲摧毀不可靠的知識架構之後，更加凸顯其價值，而且為人們所認同。他的穩健原則始終為其追隨者帶來可觀的報酬，甚至那些資質遠不及聰慧投資者的人，也獲得了可觀的報酬，而那些聰慧的投資者卻因為追求卓越或趕時髦而摔了個大跟斗。</div><div>  </div><div> 　　班傑明在其專業領域的傑出成就，在於他對事情的看法沒有偏見，而是廣泛的思維讓他成就這樣的地位。毫無疑問地，我從未遇到過思維如此廣泛的人，他對任何新知識都充滿著無限的好奇心，並且能夠把這些知識應用在看似毫無關連的問題，所有這一切使得他的思維方式受到各領域人們的喜愛。</div><div>  </div><div> 　　然而，他的第三個目標——「慷慨」，正是他比所有其他人做得更成功的地方。我把班傑明視為我的導師、我的雇主和我的朋友。無論是哪一種關係，作為他的學生、雇員或朋友，他都會毫無保留地提供他自己的想法、時間和精力。如果想尋求清晰的思維，那麼沒有比班傑明更好的人選了。而且，如果需要獲得鼓勵和忠告，可以隨時去找班傑明。</div><div>  </div><div> 　　華特．李普曼(Walter Lippmann)曾經說：「前人種樹，後人乘涼」。而班傑明．葛拉漢就是這樣的一個人。</div><div>  </div><div>  </div><div><strong>各界推薦</strong><br />  </div><div><strong>雷浩斯推薦：智慧型股票投資人（全新增訂版）今年必讀的一本好書！</strong></div><div><strong>(本文摘錄自雷浩斯價值投資網，筆者為知名財經作者與價值投資人)</strong></div><div>  </div><div> 　　經典中的經典，價值投資必讀的好書。《智慧型股票投資人》這次推出全新增訂版本，我非常高興的入手此書。葛拉漢這本《智慧型股票投資人》的初版寫於1948年，現在這個版本是葛拉漢的修訂版，寫於1971-1972年，這是一本非常優越的投資教學書，推薦每個人都應該閱讀。</div><div>  </div><div> 　　如果你是價值投資者，並且看過舊版，你心裡的問題應該是：「這本和舊版哪裡不同？」</div><div> 　　如果你不是價值投資者，你的問題應該是：《智慧型股票投資人》這本書談的內容是什麼？</div><div>  </div><div><strong>問題一：這版和舊版那裡不同？</strong></div><div> 　　1.翻譯品質提高，閱讀起來很輕鬆</div><div> 　　2.每篇章節後，增加傑森．茲威格的獨立評釋</div><div> 　　3.開本變大，並且增加註解，提高閱讀性</div><div>  </div><div> 　　首先，翻譯品質真的非常的重要，我要特別感謝本次譯者齊克用先生，讓這本書的閱讀流暢度大為提高，透過這個翻譯能再度展現葛拉漢的精彩智慧。</div><div>  </div><div> 　　再來，每篇的後面增加了傑森．茲威格的評釋，撰寫評釋的時間約在2003年左右，所以你看到的舉例時間點都在這段時間。</div><div>  </div><div> 　　另外，文章下方有「原註」和「註解」讓一些原本葛拉漢用隱晦表達的語意變得更清楚。例如在後記、葛拉漢提了「某間公司」的例子，註解則指出這間公司是蓋可。</div><div>  </div><div><strong>問題二：智慧型股票投資人談的內容是什麼？</strong></div><div> 　　1.他不是教你致富的書，而是要你避開可能的錯誤，建立一套放心的投資策略。</div><div> 　　2.他將投資人分為「防禦型」和「積極型」，這兩者的差異點在於「對投資願意付出的時間和精力」。葛拉漢認為散戶只要少許努力和能力，就能獲得一筆可靠但不可觀的報酬，如果像要更多的報酬，就必需要更多的投資知識和智慧。</div><div> 　　3.不管是哪種類型，都要分清楚股價和內在價值之間的區別，並且培養出凡事衡量的習慣。</div><div>  </div><div> 　　這本智慧型股票投資人，雖然可以說是《證券分析》的簡單版本，但是實際閱讀之後，卻充滿了「不簡單」的感覺，本書第一版寫至1948年，至今已經70多年，但葛拉漢的智慧不但毫無過時，書中更清楚地展現出他對投資教學無私的付出。</div><div>  </div><div> 　　也許葛拉漢不是「最有錢的投資人」，但那是因為他志不在此，葛拉漢非常的大方慷慨，總是匿名幫助他生活艱苦的同事，對他而言，幫助本身就是目的。更甚至他完全不在乎別人學走他的投資技術，就算因此會增加他在投資上的競爭對手，他依然毫不保留。</div><div>  </div><div> 　　他將投資人分為「防禦型」和「積極型」，就是為了幫助這兩種不同的投資人，達到應有的投資成效。所謂的「防禦型」，在現在看來就是繁忙、沒有時間分析股票的上班族，葛拉漢為他們設計了一套投資法則來幫助他們。「積極型」則是為了「專業投資人」而設計的投資技術。</div><div>  </div><div> 　　只有一個真正的好老師，才會這樣用心的幫助不同類型的投資人。</div><div>  </div>', '', '', '9789866320972_0', '', '2018/01/04', 1, 0, '寰宇', 'https://im1.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/071/64/0010716458.jpg&v=5a53563e&w=348&h=348');

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
('aaa', '9786269521159', '作者： 韓在佑 出版社：境好出版 出版日期：2021/12/16 ISBN:9786269521159 內容: 沒有更強的武術，只有更強的人。 讀書更是如此，不是尋找更好的方法把書讀好， 而是依循大腦');

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
('00857029', '2021-12-21 13:41:43', ' ::1 ');

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
('00857029', '00857000', '00857000@mail.ntou.edu.tw', '111111', 'e412bdfb939ecf9e48e45482d3a02bfc', '0', '2021-12-13 13:50:13', NULL),
('以', '00857006', '00857006@mail.ntou.edu.tw', '1234567890', 'fa9b4b332f4d4c102b1fb8deed4ea040', '1', '2021-12-14 15:06:31', NULL),
('warren', '00857020', '00857020@mail.ntou.edu.tw', '00857020', '02a16ab82e3fe1096e94b345572ef8db', '2', '2021-12-03 16:37:05', 'ca2113c687a2395a97abc6ed545524b7'),
('aaa', '00857029', '00857029@mail.ntou.edu.tw', '111111', 'b28cbc7f13f2283e88cdda5d86f61a1c', '2', '2021-12-12 14:43:11', NULL);

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
('00857020', 3, 15, 1, 0, 1),
('00857029', 3, 15, 1, 0, 0);

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
-- 已傾印資料表的索引
--

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
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
