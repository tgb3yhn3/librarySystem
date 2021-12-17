<?php
    function adjust_user_condition($userID,$number,$conn){
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
        $result = $datas[0]["renting_book_num"]+$number;
        // echo '<a>'.$result.'</a>';
        $adjust = "UPDATE user_condition SET renting_book_num = '".$result."' WHERE userID = $userID";
        mysqli_query($conn,$adjust);
    }
?>
