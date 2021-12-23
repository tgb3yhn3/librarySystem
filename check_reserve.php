<?php
    function check_reserve($userID,$ISBN,$conn){//看是不是已被預約的書
        $get_user_credit =  "SELECT * FROM line_up WHERE userID = $userID AND ISBN = $ISBN";
        $result = mysqli_query($conn,$get_user_credit);
        if($result){
            $sql = "DELETE FROM line_up WHERE userID = $userID AND ISBN = $ISBN";
            mysqli_query($conn,$sql);
            return true;
        }
        else{
            return false;
        }
    }
?>