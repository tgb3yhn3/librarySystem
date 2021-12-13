<?php 
//GET 前端 用來創建書籍

require_once("islog.php");
 function function_alert($message) { 
    // window.location.href='index.php';
    // Display the alert box  
    echo "<script>alert('$message');
     
    </script>"; 
    return false;
} 
//TODO 權限功能尚未製作
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){//如果沒有登入就不允許新增書籍
   
    function_alert("尚未登入或權限不足");
    
    header("refresh:0;url=../index.php",true);
    exit;  //記得要跳出來，不然會重複轉址過多次
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            text-align:center;
        }
        img{
            float:left;
            width:50px;
            length:50px;
            box-sizing:border-box;
        }
        table{
            margin-left: auto;
  margin-right: auto;
        }
        </style>
</head>
<body>
    <a href="index.php"><img src="home.png" alt="home"></a>
    <form action="create.php" method="post">
        <table>
            
        <tr>
            <th>書籍名稱</th>   <td><input type="text"name="bookName" ></td>
        </tr>
        <tr>
            <th>書籍作者</th>   <td><input type="text"name="author" ></td>
        </tr>
        <tr> 
            <th>ISBN</th>   <td><input type="text"name="ISBN"></td>
        </tr>
        <tr> 
            <th>書籍描述</th>   <td><input type="text"name="describeBook"></td>
        </tr>
        <tr>
            <th colspan="2"><input type="submit"></th>
        </tr>   
    </table>
</form>
</form>
    <?php
    
    
    ?>
</body>
</html>