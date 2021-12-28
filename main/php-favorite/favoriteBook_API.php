<?php
//favoriteBook_API.php
session_start();
if(!isset($_SESSION["userID"])){//訪客
    echo"<script>alert('請先登入!');history.go(-1);</script>";
}
else if($_SESSION["admin"]==true){//管理員
    echo"<script>alert('管理員不可加入最愛!');history.go(-1);</script>";
}
else{//使用者
    $userID   = $_SESSION["userID"];
    $ISBN     = $_POST["ISBN"];
    
    /*與資料庫連線*/
    $conn=require_once "../config.php";
    require_once "isFavorite.php";    
    
    if(!isFavorite($conn,$ISBN,$userID)){//使用者將書籍加入最愛的紀錄存進資料庫中
        $bookName = $_POST["bookName"];
        $sql="insert into user_favorite_book_data(userID,bookName,ISBN) values('$userID','$bookName','$ISBN')";
        mysqli_query($conn,$sql);
        mysqli_close($conn);//關閉資料庫連線
        echo "<script>alert('加入最愛成功!');history.go(-1);</script>";
        
    }
    else{//使用者將書籍從最愛移除
        $sql="delete from  user_favorite_book_data where userID='".$userID."' and ISBN='".$ISBN."'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);//關閉資料庫連線
        echo "<script>alert('刪除最愛成功!');history.go(-1);</script>";
    }
}


?>