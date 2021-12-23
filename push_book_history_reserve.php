<?php
    function push_book_history_reserve($userID,$ISBN,$conn){
        $set_book_history = "INSERT INTO user_book_history (userID,book_unique_ID,start_rent_date,return_date,lasting_return_date,book_status,comment_status) 
            VALUES('".$userID."','".$ISBN."','-','-','-','已預約','-')";
        mysqli_query($conn,$set_book_history);
    }
?>