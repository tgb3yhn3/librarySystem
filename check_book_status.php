<?php
    function check_book_status($bookuniqueID,$conn){
        $check_status = "SELECT * FROM book WHERE bookUniqueID = '$bookuniqueID'";
        $result = mysqli_query($conn,$check_status);
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
        if($datas[0]["status"]==0){
            return true;
        }
        else{
            return false;
        }
    }
?>