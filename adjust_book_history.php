<?php
    function adjust_book_history($userID,$book_unique_ID,$conn){
        require_once('adjust_credit.php');
        $get_user_credit =  "SELECT * FROM user_book_history WHERE userID = $userID  AND book_status = '出借中'";
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
?>