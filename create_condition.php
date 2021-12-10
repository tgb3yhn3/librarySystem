<?php
    function create_condition($userID){
        $conn=require_once("config.php");
        $sql="INSERT INTO user_condition (userID,book_num, book_time, book_fine) VALUES($userID,,)";
    }
?>