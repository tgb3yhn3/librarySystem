<?php
    function check_line_up($ISBN,$conn){
        $get_user_book_time =  "SELECT * FROM line_up WHERE ISBN = $ISBN";
        $result = mysqli_query($conn,$get_user_book_time);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        if($datas){
            return true;
        }
        else{
            return false;
        }
    }
?>