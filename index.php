<?php
    $conn=require_once("config.php");
    $get_userID =  "SELECT * FROM user_condition";
    $result = mysqli_query($conn,$get_userID);
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
    for($i = 0;$i<count($datas);$i++){
        echo '<form action="set_condition.php" method="POST" id="user'.$i.'"><h1>
            '.$datas[$i]["userID"].'</h1>
            <input type="text" name="book_num" id="book_num'.$i.'" value='.$datas[$i]["book_num"].' size = "5">
            <input type="text" name="book_time" id="book_time'.$i.'" value='.$datas[$i]["book_time"].' size = "5">
            <input type="text" name="book_fine" id="book_fine'.$i.'" value='.$datas[$i]["book_fine"].' size = "5">
            <input type="text" name="credit" id="credit'.$i.'" value='.$datas[$i]["credit"].' size = "5">
            <input type="submit" id="submit'.$i.'" value="設定" >
        </form><br>';
    }
?>
<html>
    <head>
        <script>

        </script>
    </head>
    <body>
    </body>
</html>