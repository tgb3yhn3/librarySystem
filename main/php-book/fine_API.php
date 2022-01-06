<?php
    function late_total_day($data){
        $lasting_date = explode("-",$data[0]["lasting_return_date"]);
        $return_date = explode("-",$data[0]["return_date"]);
        $lasting = mktime(0,0,0,$lasting_date[1],$lasting_date[2],$lasting_date[0]);
        $return = mktime(0,0,0,$return_date[1],$return_date[2],$return_date[0]);
        $days = round(($return-$lasting)/3600/24);
        return $days;
    }
    function start_rent_date($data){
        return $data[0]["start_rent_date"];
    }
    function return_date($data){
        return $data[0]["return_date"];
    }
    function book_name($data){
        return $data[0]["book_name"];
    }
    function lasting_return_date($data){
        return $data[0]["lasting_return_date"];
    }
    function get_book_fine($userID,$conn){//dont care
        $get_data =  "SELECT * FROM user_condition WHERE userID = '".$userID."'" ;
        $result = mysqli_query($conn,$get_data);
        if ($result) {
            // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
            if (mysqli_num_rows($result)>0) {
                // 取得大於0代表有資料
                // while迴圈會根據資料數量，決定跑的次數
                // mysqli_fetch_assoc方法可取得一筆值
                while ($row = mysqli_fetch_assoc($result)) {
                    // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                    $datas[] = $row;
                }
            }
            // 釋放資料庫查到的記憶體
            mysqli_free_result($result);
        }
        return $datas[0]['book_fine'];
    }
    function total_fine($late_total_date,$book_fine){
        $total_fine = $late_total_date*$book_fine*10;
        if($total_fine>1000){
            $total_fine = 1000;
        }
        return $total_fine;
    }
?>