<?php
//deleteFavoriteBook_API.php
session_start();
/*要從最愛移除的書籍之資料*/
$userID   = $_SESSION["userID"];
$ISBN     = $_POST["ISBN"];

/*與資料庫連線*/
$conn=require_once "../config.php";
          

/*使用者將書籍加入最愛的紀錄存進資料庫中*/
$sql="delete from user_favorite_book_data
      where userID = '$userID' and ISBN = '$ISBN'";
mysqli_query($link,$sql);
mysqli_close($link);//關閉資料庫連線
echo "<script>alert('刪除成功!');window.location.replace('viewFavoriteBooK.html');</script>";

    /*資料庫table
    CREATE TABLE `user_favorite_book_data` (
    `userID` varchar(10) COLLATE utf8_croatian_ci NOT NULL,
    `ISBN` varchar(20) COLLATE utf8_croatian_ci NOT NULL,
    `author` varchar(20) COLLATE utf8_croatian_ci DEFAULT NULL,
    `bookName` varchar(100) COLLATE utf8mb4_croatian_ci DEFAULT NULL,
    
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;
    
    */
?>