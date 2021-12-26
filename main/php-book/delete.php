<?php
//POST 後端 用來刪除書籍
$del=$_POST['delete'];
$host = 'localhost';
$dbuser ='root';
$dbpassword = '123456';
$dbname = 'test';
$sql="delete  from `book` where bookUniqueID like '$del%'";
$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
$result = mysqli_query($link,$sql);
if (mysqli_affected_rows($link)>0) {
    echo "資料已刪除";
    }
    elseif(mysqli_affected_rows($link)==0) {
        echo "無資料刪除";
    }
    else {
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
    }
        mysqli_close($link); 
        header('Location: select.php');
        exit();
?>
