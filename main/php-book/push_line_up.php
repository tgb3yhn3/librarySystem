<?php
    function push_line_up($userID,$ISBN,$conn){
        date_default_timezone_set('Asia/Taipei');
        $start_time = date("Y").'-'.date("m").'-'.date("d");
        // $get_user_book_time =  "SELECT book_time FROM user_condition WHERE userID = $userID";
        // $result = mysqli_query($conn,$get_user_book_time);
        // if ($result) {
        //     if (mysqli_num_rows($result)>0) {
        //         while ($row = mysqli_fetch_assoc($result)) {
        //             $datas[] = $row;
        //         }
        //     }
        //     mysqli_free_result($result);
        // }
        // $day = $datas[0]['book_time'];
        // $lasting_time = date("Y-m-d",strtotime($start_time."+$day day"));
        $set_line_up = "INSERT INTO line_up (userID,ISBN,start_time,lasting_time) 
            VALUES('".$userID."','".$ISBN."','".$start_time."','-')";
        mysqli_query($conn,$set_line_up);
    }
?>