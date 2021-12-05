<?php
    //設定要從資料庫尋找的預覽圖的id
    $id = 81 ;
    //從資料庫取得圖片
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'wys899195');
    define('DB_PASSWORD', '00857039');
    define('DB_NAME', 'test1');
    
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);      
    mysqli_query($link, 'SET NAMES utf8');           
    $sql="select * from imageDB where id=$id";
    $result = mysqli_query($link,$sql);
                   
    //顯示圖片
    if ($result) {
        echo "以下呈現圖片<br>";
        // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
        if (mysqli_num_rows($result)>0) {
            // 取得大於0代表有資料
            // while迴圈會根據資料數量，決定跑的次數
            // mysqli_fetch_assoc方法可取得一筆值
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
            }
        }
        // 釋放資料庫查到的記憶體
        mysqli_free_result($result);
    }
    mysqli_close($link);

    /*資料庫table

    CREATE TABLE `imageDB` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `image` LONGBLOB 
    ) 
    
    */

?>