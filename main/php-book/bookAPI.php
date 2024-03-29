<?php
    function adjust_book_history_reserve($userID,$bookuniqueID,$ISBN,$conn){//將預約中的書轉為借書中
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
    function adjust_book_history($userID,$book_unique_ID,$conn){//將借書中的狀態改為還書或是遲還
        $get_user_credit =  "SELECT * FROM user_book_history WHERE userID = $userID  AND book_status = '出借中'";
        $result = mysqli_query($conn,$get_user_credit);
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
        date_default_timezone_set('Asia/Taipei');
        $lasting_date = explode("-",$datas[0]["lasting_return_date"]);
        $d1 = date("Y").'-'.date("m").'-'.date("d");//現在日期->即歸還日期
        $return_date = explode("-",$d1);
        $lasting = mktime(0,0,0,$lasting_date[1],$lasting_date[2],$lasting_date[0]);
        $return = mktime(0,0,0,$return_date[1],$return_date[2],$return_date[0]);
        $days = round(($lasting-$return)/3600/24);
        if($days>=0){
            $book_status = "已歸還";
            adjust_credit($userID,1,$conn);
        }
        else{
            $book_status = "遲還";
            adjust_credit($userID,-1,$conn);
        }
        $sql = "UPDATE user_book_history SET return_date = '".$d1."',book_status = '".$book_status."',comment_status = '未評論' WHERE userID = '".$userID."'AND book_unique_ID = '".$book_unique_ID."'";
        mysqli_query($conn,$sql);
    }
    function adjust_book_status($bookuniqueID,$number,$conn){//調整書籍狀態
        $adjust_status = "UPDATE book SET status = '".$number."' WHERE bookUniqueID = '".$bookuniqueID."'";
        mysqli_query($conn,$adjust_status);
    }
    function adjust_book_num($ISBN,$number,$conn){//調整書籍數量
        $get_book_data =  "SELECT * FROM book WHERE ISBN = '".$ISBN."'";
        $result = mysqli_query($conn,$get_book_data);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        $after_adjust = $datas[0]['num']+$number;
        $adjust_status = "UPDATE book SET num = '".$after_adjust."' WHERE ISBN = '".$ISBN."'";
        mysqli_query($conn,$adjust_status);
    }
    function adjust_credit($userID,$number,$conn){//調整使用者的信用點數
        $get_user_credit =  "SELECT * FROM user_condition WHERE userID = $userID";
        $result = mysqli_query($conn,$get_user_credit);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        algorithim($datas,$number,$conn);
    }
    function adjust_line_up($ISBN,$conn){//通知下一個預約的拿書
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
            require_once '../php-announcement/sentCanBorrowMail.php';
            sentCanBorrowMail($datas[0]['userID'],$datas[0]['ISBN'],$lasting_time,$conn);
            // echo "向".$datas[0]['userID']."寄簡訊<br>";
            mysqli_query($conn,$sql);
        }
        
    }
    function adjust_special_user_book_history($bookuniqueID,$conn){//特殊情況發生時，調整user_book_history
        $sql =  "SELECT * FROM user_book_history WHERE book_unique_ID = '".$bookuniqueID."' AND book_status = '出借中'" ;
        $result = mysqli_query($conn,$sql);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        date_default_timezone_set('Asia/Taipei');
        $d1 = date("Y").'-'.date("m").'-'.date("d");//現在日期->即歸還日期
        $reset = "UPDATE user_book_history SET return_date = '".$d1."',book_status = '特殊狀況',comment_status = '未評論' WHERE numbering = '".$datas[0]['numbering']."'";
        mysqli_query($conn,$reset);
        return $datas[0]['userID'];
    }
    function adjust_user_condition($userID,$number,$conn){//調整使用者正在借閱的數量
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
    function algorithim($datas,$number,$conn){//用credit算使用者的condition
        $userID = $datas[0]["userID"];
        $book_num = $datas[0]["book_num"];
        $book_time = $datas[0]["book_time"];
        $book_fine = $datas[0]["book_fine"];
        $credit = $datas[0]["credit"];
        if($credit==4&&$number==1){//4->5
            $book_num = $book_num + 1;
            echo "<script>alert('可借書本數增加至 : $book_num')</script>";
        }
        else if($credit==5&&$number==-1){//5->4
            $book_num = $book_num - 1;
            echo "<script>alert('可借書本數減少至 : $book_num')</script>";
        }
        //--------------------------------------
        else if($credit==9&&$number==1){//9->10
            $book_time = $book_time + 5;
            echo "<script>alert('可借書本時間增加至 : $book_time 天')</script>";
        }
        else if($credit==10&&$number==-1){//10->9
            $book_time = $book_time - 5;
            echo "<script>alert('可借書本時間減少至 : $book_time 天')</script>";
        }
        //--------------------------------------
        else if($credit==19&&$number==1){//19->20
            $book_num = $book_num + 1;
            $book_time = $book_time + 5;
            echo "<script>alert('可借書本數增加至 : $book_num 且可借書本時間增加至 : $book_time 天')</script>";
        }
        else if($credit==20&&$number==-1){//20->19
            $book_num = $book_num - 1;
            $book_time = $book_time - 5;
            echo "<script>alert('可借書本數減少至 : $book_num 且可借書本時間減少至 : $book_time 天')</script>";
        }
        //--------------------------------------
        else if($credit==-4&&$number==-1){//-4->-5
            $book_num = $book_num - 1;
            echo "<script>alert('可借書本數減少至 : $book_num')</script>";
        }
        else if($credit==-5&&$number==1){//-5->-4
            $book_num = $book_num + 1;
            echo "<script>alert('可借書本數增加至 : $book_num')</script>";
        }
        //--------------------------------------
        else if($credit==-9&&$number==-1){//-9->-10
            $book_time = $book_time - 5;
            $book_fine = $book_fine + 0.5;
            echo "<script>alert('可借書時間減少至 : $book_num 且逾期罰金倍率增加至 : $book_fine ')</script>";
        }
        else if($credit==-10&&$number==1){//-10->-9
            $book_time = $book_time + 5;
            $book_fine = $book_fine - 0.5;
            echo "<script>alert('可借書時間增加至 : $book_num 且逾期罰金倍率減少至 : $book_fine ')</script>";
        }
        //--------------------------------------
        else if($credit==-19&&$number==-1){//-19->-20
            $book_fine = $book_fine + 0.5;
            echo "<script>alert('逾期罰金倍率增加至 : $book_fine ')</script>";
        }
        else if($credit==-20&&$number==1){//-20->-19
            $book_fine = $book_fine - 0.5;
            echo "<script>alert('逾期罰金倍率減少至 : $book_fine ')</script>";
        }
        //--------------------------------------超過處理
        else if($credit==20&&$number==1){//20->21
            $credit = 19;
        }
        else if($credit==-20&&$number==-1){//-20->-21
            $credit = -19;
        }
        $credit = $credit+$number;
        // echo $book_num."<br>";
        // echo $book_time."<br>";
        // echo $book_fine."<br>";
        // echo $credit."<br>";
        // echo $userID."<br>";
        $adjust = "UPDATE user_condition SET book_num = '".$book_num."',book_time = '".$book_time."',book_fine = '".$book_fine."',credit = '".$credit."' WHERE userID = '".$userID."'";
        mysqli_query($conn,$adjust);
    }
    function check_adjust_balance($ISBN,$conn){//看status2的書籍數量和預約的數量是否一致
        $get_book_status2_num =  "SELECT * FROM book WHERE bookUniqueID like '".$ISBN."%' AND status = '2'";
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
        // echo "book_status2_num = ".$book_status2_num."<br>";
        $get_reserve_num =  "SELECT * FROM line_up WHERE ISBN = '".$ISBN."'";
        $res = mysqli_query($conn,$get_reserve_num);
        $reserve_num = 0;
        if ($res) {
            if (mysqli_num_rows($res)>0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $datas[] = $row;
                    $reserve_num++;
                }
            }
            mysqli_free_result($res);
        }
        // echo "reserve_num = ".$reserve_num."<br>";
        if($book_status2_num==$reserve_num){
            return true;
        }
        else{
            return false;
        }
    }
    function check_book_exist($bookuniqueID,$conn){//看這個書存不存在
        $get_data =  "SELECT * FROM book WHERE bookUniqueID = '".$bookuniqueID."' " ;
        $result = mysqli_query($conn,$get_data);
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
            return true;
        }
        return false;
    }
    function check_book_status($bookuniqueID,$conn){//查看此書是否在圖書館內
        $check_status = "SELECT * FROM book WHERE bookUniqueID = '$bookuniqueID'";
        $result = mysqli_query($conn,$check_status);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        if($datas[0]["status"]==0){
            return true;
        }
        else{
            return false;
        }
    }
    function check_condition($userID,$conn){//查看此使用者有沒有資格藉此書
        $get_user_credit =  "SELECT * FROM user_condition WHERE userID = $userID";
        $result = mysqli_query($conn,$get_user_credit);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        if($datas[0]["book_num"]>$datas[0]["renting_book_num"]){
            return true;
        }
        else{
            return false;
        }
    }
    function check_late ($data){
        date_default_timezone_set('Asia/Taipei');
        $d1 = date("Y").'-'.date("m").'-'.date("d");//現在日期->即歸還日期
        $today = explode("-",$d1);
        $return = mktime(0,0,0,$today[1],$today[2],$today[0]);
        $lasting_date = explode("-",$data[0]["lasting_return_date"]);
        $lasting = mktime(0,0,0,$lasting_date[1],$lasting_date[2],$lasting_date[0]);
        $days = round(($lasting-$return)/3600/24);
        if($days>0){
            return true;
        }
        else{
            return false;
        }
    }
    function check_late_return ($userID,$conn){//查看此使用者有沒有
        $get_user_credit =  "SELECT * FROM user_book_history WHERE userID = $userID AND book_status = '出借中'" ;
        $result = mysqli_query($conn,$get_user_credit);
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
            $d1 = date("Y").'-'.date("m").'-'.date("d");//現在日期->即歸還日期
            $today = explode("-",$d1);
            $return = mktime(0,0,0,$today[1],$today[2],$today[0]);
            for($i=0;$i<count($datas);$i++){   
                $lasting_date = explode("-",$datas[$i]["lasting_return_date"]);
                $lasting = mktime(0,0,0,$lasting_date[1],$lasting_date[2],$lasting_date[0]);
                $days = round(($lasting-$return)/3600/24);
                if($days<0){
                    return false;
                }
            }
        }
        return true;
    }
    function check_line_up($ISBN,$conn){//查看此書是否還有未收到簡訊的
        $get_user_book_time =  "SELECT * FROM line_up WHERE ISBN = $ISBN AND lasting_time = '-'";
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
            return true;
        }
        else{
            return false;
        }
    }
    function check_reserve($userID,$ISBN,$conn){//看是不是已被預約的書
        $get_user_credit =  "SELECT * FROM line_up WHERE userID = $userID AND ISBN = $ISBN";
        $result = mysqli_query($conn,$get_user_credit);
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
            $sql = "DELETE FROM line_up WHERE userID = $userID AND ISBN = $ISBN";
            mysqli_query($conn,$sql);
            return true;
        }
        else{
            return false;
        }
    }
    function check_this_book_late_return($bookuniqueID,$conn){//如果這本書有遲還，回傳此書資料
        $get_data =  "SELECT * FROM user_book_history WHERE book_unique_ID = '".$bookuniqueID."' ORDER BY numbering DESC" ;
        $result = mysqli_query($conn,$get_data);
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

        return $datas;
    }
    function check_user_exist($userID,$conn){//查看此學號是否存在
        $get_data =  "SELECT * FROM users WHERE userID = '".$userID."' " ;
        $result = mysqli_query($conn,$get_data);
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
            return true;
        }
        return false;
    }
    function check_user_renting_book($userID,$bookuniqueID,$conn){//查看此使用者是否有借用此書
        $get_user_credit =  "SELECT * FROM user_book_history WHERE userID = $userID AND book_status = '出借中'";
        $result = mysqli_query($conn,$get_user_credit);
        $count=0;
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                    $count++;
                }
            }
            mysqli_free_result($result);
        }
        for($i = 0;$i<$count;$i++){
            if($datas[$i]["book_unique_ID"] == $bookuniqueID){
                return true;
            }
        }
        return false;
    }
    function delete_the_book($bookuniqueID,$conn){
        $delete = "DELETE FROM book WHERE bookUniqueID = '".$bookuniqueID."'";
        mysqli_query($conn,$delete);
    }
    function get_book_name($ISBN,$conn){//get book name
        $sql = "SELECT bookName FROM book WHERE ISBN = '".$ISBN."'";
        $result = mysqli_query($conn,$sql);
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
        if($count==0){
            return 0;
        }
        return $datas[0]['bookName'];
    }
    function push_book_history_reserve($userID,$ISBN,$conn){//幫此使用者預約此書
        require_once('bookAPI.php');
        $book_name = get_book_name($ISBN,$conn);
        $set_book_history = "INSERT INTO user_book_history (userID,book_unique_ID,start_rent_date,return_date,lasting_return_date,book_status,comment_status,ISBN,book_name) 
            VALUES('".$userID."','".$ISBN."','-','-','-','已預約','-','".$ISBN."','".$book_name."')";
        mysqli_query($conn,$set_book_history);
    }
    function push_book_history($userID,$book_unique_ID,$conn,$ISBN){//把借書資訊push到user_book_history
        require_once('bookAPI.php');
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
        // echo $lasting_return_date;
        $book_name = get_book_name($ISBN,$conn);
        $set_book_history = "INSERT INTO user_book_history (userID,book_unique_ID,start_rent_date,return_date,lasting_return_date,book_status,comment_status,ISBN,book_name) 
            VALUES('".$userID."','".$book_unique_ID."','".$start_rent_date."','-','".$lasting_return_date."','出借中','-','".$ISBN."','".$book_name."')";
        mysqli_query($conn,$set_book_history);
    }
    function push_line_up($userID,$ISBN,$conn){//新增預約(排隊)
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
    function set_book_status_to_0($ISBN,$conn){//把book_status從2->0
        $sql =  "SELECT * FROM book WHERE bookUniqueID like '".$ISBN."%' AND status = '2'" ;
        $result = mysqli_query($conn,$sql);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        $adjust_status = "UPDATE book SET status = '0' WHERE bookUniqueID = '".$datas[0]["bookUniqueID"]."'";
        //echo "把".$datas[0]["bookUniqueID"]."的status設為0<br>";
        mysqli_query($conn,$adjust_status);
    }
    
?>