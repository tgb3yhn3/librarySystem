<?php // query_API.php
    
    function BorrowReturnBook_query_API($uniqueID,$conn){
        $SQL = "SELECT * FROM user_book_history WHERE book_unique_ID = '".$uniqueID."' ORDER BY numbering DESC";
        $result1 = mysqli_query($conn,$SQL);
        $datas=array();
        //  echo "in";
        if ($result1) {
            // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
            if (mysqli_num_rows($result1)>0) {
                // 取得大於0代表有資料
                // while迴圈會根據資料數量，決定跑的次數
                // mysqli_fetch_assoc方法可取得一筆值
                while ($row = mysqli_fetch_assoc($result1)) {
                    // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                    $datas[] = $row;
                }
            }
            // 釋放資料庫查到的記憶體
            mysqli_free_result($result1);
        }
        else {
            //echo "找不到書籍" ;
        }
        return $datas;
    }
    
    function userName_query_API($userID,$conn){
        
        $SQL = "SELECT * FROM users WHERE userID = '".$userID."'";
        $result = mysqli_query($conn,$SQL);
        $datas=array();
        //  echo "in";
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
        else {
            //echo "找不到書籍" ;
        }
        return $datas;
    }
?>
