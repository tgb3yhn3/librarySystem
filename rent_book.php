<?php
    require_once('check_condition.php');
    require_once('adjust_book_num.php');
    require_once('adjust_user_condition.php');
    require_once('push_book_history.php');
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $userID=$_POST["userID"];
        $bookuniqueID=$_POST["bookuniqueID"];
        if(check_condition($userID)){
            adjust_book_status($bookuniqueID,1);
            adjust_user_condition($userID,1);
            push_book_history($userID,$bookuniqueID);
        }
        else{
            echo "已達借書上限,不得借書";
        }
    }
?>