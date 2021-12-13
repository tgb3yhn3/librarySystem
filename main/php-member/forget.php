<?php
//POST 後端 用來寄出驗證信
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
    }else{
        header("location:forget.html");
    }
        ?>
