<?php
    require_once('check_user_renting_book.php');
    require_once('adjust_book_status.php');
    require_once('adjust_user_condition.php');
    require_once('adjust_book_history.php');
    $conn=require_once("config.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $userID=$_POST["userID"];
        $bookuniqueID=$_POST["bookuniqueID"];
        if(check_user_renting_book($userID,$bookuniqueID,$conn)){
            adjust_book_status($bookuniqueID,0,$conn);
            adjust_user_condition($userID,-1,$conn);
            adjust_book_history($userID,$bookuniqueID,$conn);
        }
        else{
            echo "此使用者無借閱此書";
        }
    }
?>
<html>
    <body>
        <?php
        // $userID=$_POST["userID"];
            echo $userID;
        ?>
    </body>
</html>