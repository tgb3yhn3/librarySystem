<?php

/*上傳圖片 */
$filename=$_FILES['image']['name'];
$filetype=$_FILES['image']['type'];
$filesize=$_FILES['image']['size']; 
$tmpname=$_FILES['image']['tmp_name'];
if ($_FILES["image"]["error"] != 0){//檔案上傳發生錯誤
    echo "<script>alert('上傳發生錯誤');history.back();</script>";
}
else if($filetype == "image/jpeg" || $filetype == "image/png"){//檔案上傳成功

    /*與資料庫連線*/
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'wys899195');
    define('DB_PASSWORD', '00857039');
    define('DB_NAME', 'test1');
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);      
    mysqli_query($link, 'SET NAMES utf8'); 

    /*將上傳的圖片轉成longblob*/
    $imageBlob = mysqli_real_escape_string($link,file_get_contents($tmpname)); //獲取圖片           

    /*圖片存進資料庫中的imageDB table*/
    $idNum = random_int(0,99);//圖片在資料庫中的id是隨機的，因為我不會檢查id是否已經存在資料庫
    $sql="insert into imagedb(id,image) values('$idNum','$imageBlob')";
    mysqli_query($link,$sql);
    mysqli_close($link);//關閉資料庫連線
    echo "圖片已經存入資料庫";
}
else{//上傳的檔案不是圖檔
    echo "<script>alert('請上傳圖檔，附檔名須為jpg.jpge.png');history.back();</script>";
}

    /*資料庫table

    CREATE TABLE `imageDB` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `image` LONGBLOB 
    ) 
    
    */
?>