<?php
require_once("checkAPI.php");
//POST 後端 用來刪除書籍
$del=$_POST['ISBN'];
$host = 'us-cdbr-east-05.cleardb.net';
		$dbuser ='b173ff6c6fd8c1';
		$dbpassword = '6e46f35e';
		$dbname = 'heroku_5199541154d8577';
$sql="delete  from `book` where bookUniqueID like '$del%'";
$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
if(check_still_have_borrow($del,$link)){
    alertMsg("還有書籍尚未歸還 所以無法下架");
    echo"<script>history.go(-1)</script>";
}else{
   
    $result = mysqli_query($link,$sql);
if (mysqli_affected_rows($link)>0) {
    alertMsg("刪除");
    echo "資料已刪除";
    }
    elseif(mysqli_affected_rows($link)==0) {
        echo "無資料刪除";
    }
    else {
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
    }
        mysqli_close($link); 
        header('refresh:0;url="bookchange.php"');
        exit();
}

?>
