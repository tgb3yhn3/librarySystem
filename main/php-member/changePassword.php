<?php
//POST 後端 用來修改密碼
$conn=require_once "../config.php";
     echo"成功";
   
    if(isset($_POST["token"])){
        $sql="UPDATE  users SET password='".$_POST["password"]."'where forgettoken='".$_POST["token"]."'";
        mysqli_query($conn,$sql);
        $sql="UPDATE users SET forgettoken=NULL WHERE forgettoken='".$_POST["token"]."'";
        mysqli_query($conn,$sql);
        echo"結束";
        session_start(); 
        $_SESSION = array(); 
        session_destroy(); 
        function_alert("密碼修改成功，請重新登入");
        header("refresh:0;url=../index.php",false);
    }else if(isset($_POST["userID"])){
        $sql="UPDATE  users SET password='".$_POST["password"]."'where userID='".$_POST["userID"]."'";
        mysqli_query($conn,$sql);
        echo"結束";
        session_start(); 
        $_SESSION = array(); 
        session_destroy(); 
        function_alert("密碼修改成功，請重新登入");
        header("refresh:0;url=../index.php",false);
    } 
    function function_alert($message) { 
        // window.location.href='index.php';
        // Display the alert box  
        echo "<script>alert('$message')</script>"; 
        return false;
    } 
?>