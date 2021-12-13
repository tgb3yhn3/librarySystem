<?php 
//GET 後端 登出
// $from=$_GET['from'];
session_start(); 
$_SESSION = array(); 
session_destroy(); 

function_alert("成功登出");
header("refresh:0;url=../index.php",false);

function function_alert($message) { 
    // window.location.href='index.php';
    // Display the alert box  
    echo "<script>alert('$message');
     
    </script>"; 
    
    return false;
} 
?>