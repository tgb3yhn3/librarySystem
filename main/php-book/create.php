<?php  
//POST 後端 用來新建書籍
$bookName=$_POST["bookName"];
$author=$_POST["author"];
$ISBN=$_POST["ISBN"];
$describeBook=$_POST["describeBook"];
echo "bookName是 $bookName<br>";
echo "author是 $author<br>";
echo "ISBN是 $ISBN<br>";
echo "describeBook是 $describeBook<br>";
$host = 'localhost';
$dbuser ='root';
$dbpassword = '123456';
$dbname = 'test';
$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
if($link){
    mysqli_query($link,'SET NAMES uff8');
    echo "正確連接資料庫";
}
else {
    echo "不正確連接資料庫</br>" . mysqli_connect_error();
}
$sql="insert into `book` (`bookName`,`author`,`ISBN`,`describeBook`)VALUE('$bookName','$author','$ISBN','$describeBook')";
$result = mysqli_query($link,$sql);
if (mysqli_affected_rows($link)>0) {
    // 如果有一筆以上代表有更新
    // mysqli_insert_id可以抓到第一筆的id
    $new_id= mysqli_insert_id ($link);
    echo "資料已更新";
    }
    elseif(mysqli_affected_rows($link)==0) {
        echo "無資料新增";
    }
    else {
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
    }
        mysqli_close($link); 
        
        header('Location: select.php');
?>
