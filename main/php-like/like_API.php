<?php
//favoriteBook_API.php
session_start();
require_once("like_query.php");
if(!isset($_SESSION["userID"])){//訪客
    echo"<script>alert('請先登入!');history.go(-1);</script>";
}
else if($_SESSION["admin"]==true){//管理員
    echo"<script>alert('管理員不可按讚評論!');history.go(-1);</script>";
}
else{//使用者
    $userID   = $_SESSION["userID"];
    $ISBN     = $_POST["ISBN"];
    $commentUsername = $_POST["commentUsername"];
    $context = $_POST['context'];
    /*與資料庫連線*/
    $conn=require_once "../config.php";
    require_once "isLike.php";    
    if(!isLike($commentUsername,$ISBN,$context,$userID,$conn)){//使用者將評論加入喜歡的紀錄存進資料庫中
        $sql="insert good(username, ISBN, context, userID) values('".$commentUsername."','".$ISBN."','".$context."','".$userID."')";
        mysqli_query($conn,$sql);
        mysqli_close($conn);//關閉資料庫連線
        echo "<script>alert('加入喜歡成功!');history.go(-1);</script>";
        
    }
    else{//使用者將書籍從最愛移除
        $sql="delete from good where context='".$context."'and userID='".$userID."' and username='".$commentUsername."' and ISBN='".$ISBN."'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);//關閉資料庫連線
        echo "<script>alert('刪除喜歡成功!');history.go(-1);</script>";
    }
}


?>