<?php
    function adjust_line_up($ISBN,$conn){
        $get_user_book_time =  "SELECT * FROM line_up WHERE ISBN = $ISBN AND lasting_time = '-' LIMIT 1";
        $result = mysqli_query($conn,$get_user_book_time);
        $count = 0;
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                    $count++;
                }
            }
            mysqli_free_result($result);
        }
        if($count){
            date_default_timezone_set('Asia/Taipei');
            $now_time = date("Y").'-'.date("m").'-'.date("d");
            $lasting_time = date("Y-m-d",strtotime($now_time."+5 day"));//5天不取的話就取消資格
            $unique = $datas[0]['numbering'];
            $sql = "UPDATE line_up SET lasting_time = '".$lasting_time."' WHERE numbering = '".$unique."'";
            echo "向".$datas[0]['userID']."寄簡訊<br>";
            mysqli_query($conn,$sql);
        }
        
    }
?>