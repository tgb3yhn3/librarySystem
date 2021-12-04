<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="forget.php" method="POST">
        請輸入學號<input type=text name="userID"><br>
        <input type="submit">
        <input type="reset">
       
</body>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
        $conn=require_once "config.php";
        require_once "sentForgetEmail.php";
        $userID=$_POST["userID"];
        $sql="SELECT * FROM users WHERE userID='".$userID."'";
        if(mysqli_num_rows(mysqli_query($conn,$sql))==1){
            $forgetToken=md5($userID.time());
            $sql="UPDATE users SET forgettoken='".$forgetToken."' WHERE userID=".$userID;
            if(mysqli_query($conn,$sql)){
                try{
                    sentForgetMail($userID."@mail.ntou.edu.tw",$forgetToken);
                    echo"修改密碼驗證信已寄出";
                }catch(Error $e){
                    echo"寄信異常";
                }
            }else{
                echo "系統錯誤 請聯繫管理員";
            }
        }else{
            echo"此使用者不存在 請重新輸入";
        }
    }
        ?>
</html>