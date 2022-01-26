
<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
/*define() 函數定義一個常量。
在設定以後，常量的值無法更改
常量名不需要開頭的美元符號 ($)
作用域不影響對常量的訪問
常量值只能是字符串或數字

此文件用來定義資料庫相關資訊
*/
define('DB_SERVER', 'us-cdbr-east-05.cleardb.net');
define('DB_USERNAME', 'b173ff6c6fd8c1');
define('DB_PASSWORD', '6e46f35e');
define('DB_NAME', 'heroku_5199541154d8577');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// 輸入中文也OK的編碼
mysqli_query($link, 'SET NAMES utf8');
//TODO

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else{
    return $link;
}
?>