<?php
    function adjust_user_condition($userID,$number){
        $conn=require_once("config.php");
        $get_user_renting_book_num =  "SELECT renting_book_num FROM user_condition WHERE userID = $userID";
        $result = mysqli_query($conn,$get_user_renting_book_num);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        $adjust = "UPDATE user_condition SET renting_book_num = $datas[0]['renting_book_num']+$number WHERE userID = $userID";
        mysqli_query($conn,$adjust);
    }
?>
