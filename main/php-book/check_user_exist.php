<?php
    function check_user_exist($userID,$conn){
        $get_data =  "SELECT * FROM users WHERE userID = '".$userID."' " ;
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
            return true;
        }
        return false;
    }
?>