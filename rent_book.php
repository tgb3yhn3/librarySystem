<?php
    require_once('check_condition.php');
    require_once('adjust_book_status.php');
    require_once('adjust_user_condition.php');
    require_once('push_book_history.php');
    require_once('check_book_status.php');
    $conn=require_once("config.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $userID=$_POST["userID"];
        $bookuniqueID=$_POST["bookuniqueID"];
        if(check_condition($userID,$conn)){
            if(check_book_status($bookuniqueID,$conn)){
                adjust_book_status($bookuniqueID,1,$conn);
                adjust_user_condition($userID,1,$conn);
                push_book_history($userID,$bookuniqueID,$conn);
            }
            else{
                echo "此書已被借走";
            }
        }
        else{
            echo "已達借書上限,不得借書";
        }
    }
?>