<?php
//POST 後端 用來修改密碼
$conn=require_once "../config.php";
     echo"成功";
   
    if(isset($_POST["token"])){
        $sql="UPDATE  users SET password='".$password."'where forgettoken='".$token."'";
        mysqli_query($conn,$sql);
        $sql="UPDATE users SET forgettoken=NULL WHERE forgettoken='".$token."'";
        mysqli_query($conn,$sql);
        echo"結束";
    }else if(isset($_POST["userID"])){
        $sql="UPDATE  users SET password='".$password."'where userID='".$_POST["userID"]."'";
        mysqli_query($conn,$sql);
        echo"結束";
    } 
?>