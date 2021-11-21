<?php
require_once("config.php");
$ISBN=$_GET["ISBN"];
echo("You're  look for ".$ISBN);
     $host = 'localhost';
     $dbuser ='root';
     $dbpassword = '123456';
     $dbname = 'test';
     $sql="select * from `book` where ISBN = '$ISBN'";
     $link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
     $result = mysqli_query($link,$sql);
     $data=array();
     
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
         echo "找不到書籍" ;
     }
     if(!empty($datas)){
        
            
            $bookName=$datas[0]["bookName"];
            $author=$datas[0]["author"];
            $ISBN=$datas[0]["ISBN"];
            $describeBook=$datas[0]["describeBook"];
            
            echo "<h3>bookName:$bookName<br></h3>";
            echo "author:$author<br>";
            echo "ISBN:$ISBN<br>";
            echo "describeBook:$describeBook<br>";
        
    }
     ?>