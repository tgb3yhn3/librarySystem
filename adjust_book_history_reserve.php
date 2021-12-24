<?php
    function adjust_book_history_reserve($userID,$bookuniqueID,$ISBN,$conn){
        date_default_timezone_set('Asia/Taipei');
        $start_rent_date = date("Y").'-'.date("m").'-'.date("d");
        $get_user_book_time =  "SELECT book_time FROM user_condition WHERE userID = $userID";
        $result = mysqli_query($conn,$get_user_book_time);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        $day = $datas[0]['book_time'];
        $lasting_return_date = date("Y-m-d",strtotime($start_rent_date."+$day day"));
        $sql = "UPDATE user_book_history SET start_rent_date = '".$start_rent_date."',book_unique_ID = '".$bookuniqueID."',lasting_return_date = '".$lasting_return_date."'
                ,book_status = '出借中',comment_status = '-' WHERE userID = '".$userID."'AND book_unique_ID = '".$ISBN."'";
        mysqli_query($conn,$sql);
    }
?>