<?php
//POST 後端 用來修改密碼
$conn=require_once "config.php";
     echo"成功";
    $password=$_POST["password"];
    $token=$_POST["token"];
    if($token!='null'){
        $sql="UPDATE  users SET password='".$password."'where forgettoken='".$token."'";
        mysqli_query($conn,$sql);
        $sql="UPDATE users SET forgettoken='null' WHERE forgettoken='".$token."'";
        mysqli_query($conn,$sql);
        echo"結束";
    }  
?>