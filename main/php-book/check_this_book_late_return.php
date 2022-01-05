<?php
    function check_this_book_late_return($bookuniqueID,$conn){
        date_default_timezone_set('Asia/Taipei');
        $d1 = date("Y").'-'.date("m").'-'.date("d");//現在日期->即歸還日期
        $get_data =  "SELECT * FROM user_book_history WHERE book_unique_ID = '".$bookuniqueID."' AND book_status = '遲還' AND return_date = '".$d1."'" ;
        $result = mysqli_query($conn,$get_data);
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
            
            return $datas;
        }
        return false;
    }
?>