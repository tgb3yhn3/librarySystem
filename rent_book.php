<?php
    require_once('check_condition.php');
    require_once('adjust_book_num.php');
    require_once('adjust_user_condition.php');
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $userID=$_POST["userID"];
        $bookID=$_POST["bookID"];
        if(check_condition($userID)){
            adjust_book_num($bookID,1);
            adjust_user_condition($userID,1);
        }
        else{
            echo "已達借書上限,不得借書";
        }
    }
?>