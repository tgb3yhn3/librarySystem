<?php
    function check_adjust_balance($ISBN,$conn){
        $get_book_status2_num =  "SELECT * FROM book WHERE ISBN = $ISBN AND book_status = '2'";
        $result = mysqli_query($conn,$get_book_status2_num);
        $book_status2_num = 0;
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                    $book_status2_num++;
                }
            }
            mysqli_free_result($result);
        }
        $get_reserve_num =  "SELECT * FROM line_up WHERE ISBN = $ISBN";
        $res = mysqli_query($conn,$get_reserve_num);
        $reserve_num = 0;
        if ($res) {
            if (mysqli_num_rows($res)>0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $datas[] = $row;
                    $reserve_num++;
                }
            }
            mysqli_free_result($result);
        }
        
        if($book_status2_num==$reserve_num){
            return true;
        }
        else{
            return false;
        }
    }
?>