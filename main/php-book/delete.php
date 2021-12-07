<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $del=$_POST['delete'];
    $host = 'localhost';
    $dbuser ='root';
    $dbpassword = '123456';
    $dbname = 'test';
    $sql="delete  from `book` where bookName='$del '";
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
</body>
</html>