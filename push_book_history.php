<?php
    function push_book_history($userID,$book_unique_ID){
        $conn=require_once("config.php");
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
        $lasting_return_date = date("Y-m-d",strtotime($start_rent_date."+$datas[0]['book_time'] day"));
        $set_book_history = "INSERT INTO user_book_history (userID,book_unique_ID,start_rent_date,return_date,lasting_return_date,book_status,comment_status) 
            VALUES($userID,$book_unique_ID,$start_rent_date,'-',$lasting_return_date,'出借中','-')";
        mysqli_query($conn,$set_book_history);
    }
?>