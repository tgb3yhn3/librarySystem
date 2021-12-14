<?php  
//POST 後端 用來新建書籍
$host = 'localhost';
$dbuser ='root';
$dbpassword = '123456';
$dbname = 'test';
$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
$bookName=$_POST["bookName"];
$author=$_POST["author"];
$ISBN=$_POST["ISBN"];
$describeBook=$_POST["describeBook"];

$filename=$_FILES['image']['name'];
$filetype=$_FILES['image']['type'];
$filesize=$_FILES['image']['size']; 
$tmpname=$_FILES['image']['tmp_name'];
if ($_FILES["image"]["error"] != 0){//檔案上傳發生錯誤
    echo "<script>alert('上傳發生錯誤');history.back();</script>";
}
$imageBlob = mysqli_real_escape_string($link,file_get_contents($tmpname)); //獲取圖片    

echo "bookName是 $bookName<br>";
echo "author是 $author<br>";
echo "ISBN是 $ISBN<br>";
echo "describeBook是 $describeBook<br>";
// echo $file;

if($link){
    mysqli_query($link,'SET NAMES uff8');
    echo "正確連接資料庫";
}
else {
    echo "不正確連接資料庫</br>" . mysqli_connect_error();
}
$sql="insert into `book` (`bookName`,`author`,`ISBN`,`describeBook`,`bookImage`,`imageType`)VALUE('$bookName','$author','$ISBN','$describeBook','$imageBlob','$filetype')";
$result = mysqli_query($link,$sql);
if (mysqli_affected_rows($link)>0) {
    // 如果有一筆以上代表有更新
    // mysqli_insert_id可以抓到第一筆的id
    $new_id= mysqli_insert_id ($link);
    echo "書籍已經上傳成功";
    echo "<script>window.alert('書籍已經上傳成功')</script>";
    }
    elseif(mysqli_affected_rows($link)==0) {
        echo "無資料新增";
    }
    else {
        echo "<script>window.alert('新增失敗，可能已存在此書或圖片檔案大小超過10Mb 若有其他問題請聯繫管理員')</script>";
        echo "語法執行失敗，錯誤訊息: " . mysqli_error($link);
    }
        mysqli_close($link); 
        
     
        // header('refresh:0;url=select.php',false);
?>
