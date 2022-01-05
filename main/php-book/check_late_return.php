<?php
    function check_late_return ($userID,$conn){
        $get_user_credit =  "SELECT * FROM user_book_history WHERE userID = $userID AND book_status = '出借中'" ;
        $result = mysqli_query($conn,$get_user_credit);
        $count = 0;
        if ($result) {
            // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
            if (mysqli_num_rows($result)>0) {
                // 取得大於0代表有資料
                // while迴圈會根據資料數量，決定跑的次數
                // mysqli_fetch_assoc方法可取得一筆值
                while ($row = mysqli_fetch_assoc($result)) {
                    // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                    $datas[] = $row;
                    $count++;
                }
            }
            // 釋放資料庫查到的記憶體
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
?>