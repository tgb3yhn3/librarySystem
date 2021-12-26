<?php
//addFavoriteBooK.php

/*要新增到最愛的書籍之資料*/
session_start();
$userID= $_SESSION["userID"];
$bookName = $_POST["bookName"];

$ISBN     = $_POST["ISBN"];

/*與資料庫連線*/
$conn=require_once "../config.php";
require_once "isFavorite.php";    

/*使用者將書籍加入最愛的紀錄存進資料庫中*/
if(!isFavorite($conn,$ISBN)){
$sql="insert into user_favorite_book_data(userID,bookName,ISBN) values('$userID','$bookName','$ISBN')";
mysqli_query($conn,$sql);
mysqli_close($conn);//關閉資料庫連線
echo "<script>alert('加入最愛成功!');history.go(-1);</script>";

}else{
    $sql="delete from  user_favorite_book_data where userID='".$userID."' and ISBN='".$ISBN."'";
    mysqli_query($conn,$sql);
    mysqli_close($conn);//關閉資料庫連線
    echo "<script>alert('刪除最愛成功!');history.go(-1);</script>";
}


// header("refresh:0;url=../index.php",false);
    /*資料庫table
    CREATE TABLE `user_favorite_book_data` (
    `userID` varchar(10) COLLATE utf8_croatian_ci NOT NULL,
    `ISBN` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
    `author` varchar(20) COLLATE utf8_croatian_ci DEFAULT NULL,
    `bookName` varchar(100) COLLATE utf8mb4_croatian_ci DEFAULT NULL,
    
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;
    
    */
?>