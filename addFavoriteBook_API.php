<?php
//addFavoriteBooK.php

/*要新增到最愛的書籍之資料*/
$userID   = $_POST["userID"];
$bookName = $_POST["bookName"];
$author   = $_POST["author"];
$ISBN     = $_POST["ISBN"];

/*與資料庫連線*/
$conn=require_once "config.php";
          

/*使用者將書籍加入最愛的紀錄存進資料庫中*/
$sql="insert into user_favorite_book_data(userID,bookName,author,ISBN) values('$userID','$bookName','$author','$ISBN')";
mysqli_query($link,$sql);
mysqli_close($link);//關閉資料庫連線
echo "<script>alert('加入最愛成功!');window.location.replace('addFavoriteBook.html');;</script>";

    /*資料庫table

    CREATE TABLE `user_favorite_book_data` (
    `userID` varchar(10) COLLATE utf8_croatian_ci NOT NULL,
    `ISBN` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
    `author` varchar(20) COLLATE utf8_croatian_ci DEFAULT NULL,
    `bookName` varchar(100) COLLATE utf8mb4_croatian_ci DEFAULT NULL,
    
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;
    
    */
?>