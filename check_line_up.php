<?php
    function check_line_up($ISBN,$conn){
        $get_user_book_time =  "SELECT * FROM line_up WHERE ISBN = $ISBN";
        $result = mysqli_query($conn,$get_user_book_time);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
?>