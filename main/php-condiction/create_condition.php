<?php
    function create_condition($conn,$userID){
        // $conn=require_once("config.php");
        $book_num = 3;
        $book_time = 15;
        $book_fine = 1;
        $credit = 0;
        $sql="INSERT INTO user_condition (userID,book_num, book_time, book_fine, credit) VALUES('"."$userID"."',$book_num,$book_time,$book_fine,$credit)";
        mysqli_query($conn, $sql);
    }
?>