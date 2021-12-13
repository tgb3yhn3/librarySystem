<?php
//後端 function 用來查詢書籍
    function get_search_book($search){
    // require_once("cav.php");
     $conn=require_once("../config.php");
     $sql="select * from `book` where bookName like '%$search%'";
     $result = mysqli_query($conn,$sql);
     $datas=array();
     
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
     $return_value="";
     // 處理完後印出資料
     if(!empty($result)){
         $return_value="<h3>所有書籍查詢結果</h3>";
         for($i=0;$i<count($datas);$i++){
            $bookName=$datas[$i]["bookName"];
            $author=$datas[$i]["author"];
            $ISBN=$datas[$i]["ISBN"];
            $describeBook=$datas[$i]["describeBook"];
            $return_value=$return_value."<br>第$i 筆<br> ";
            $return_value=$return_value."<h3><a href='book.php?search=".$ISBN."'>$bookName</a><br></h3>";
            $return_value=$return_value."author:$author<br>";
            $return_value=$return_value."ISBN:$ISBN<br>";
            $return_value=$return_value."describeBook:$describeBook<br>";
           
            $return_value=$return_value."<hr>";
        }
       }
     else {
         // 為空表示沒資料
         $return_value="查無資料";
     }
     return $return_value;
    }
     ?>
     
     <?php 
    
 ?>
