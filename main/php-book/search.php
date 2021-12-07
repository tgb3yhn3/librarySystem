<?php
    require_once("cav.php");
     $search=$_POST['search'];
     $host = 'localhost';
     $dbuser ='root';
     $dbpassword = '123456';
     $dbname = 'test';
     $sql="select * from `book` where bookName like '%$search%'";
     $link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
     $result = mysqli_query($link,$sql);
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
     // 處理完後印出資料
     if(!empty($result)){
         // 如果結果不為空，就利用print_r方法印出資料
         //print_r($datas);
         //print_r("\n");
     }
     else {
         // 為空表示沒資料
         echo "查無資料";
     }?>
     <h3>所有書籍查詢結果</h3>
     <?php foreach($datas as $i){
         //print_r($i) ;
     }
     for($i=0;$i<count($datas);$i++){
         $bookName=$datas[$i]["bookName"];
         $author=$datas[$i]["author"];
         $ISBN=$datas[$i]["ISBN"];
         $describeBook=$datas[$i]["describeBook"];
         echo "<br>第$i 筆<br> ";
         echo "<h3><a href='book.php?search=".$ISBN."'>$bookName</a><br></h3>";
         echo "author:$author<br>";
         echo "ISBN:$ISBN<br>";
         echo "describeBook:$describeBook<br>";
        
         echo "<hr>";
     }
 ?>
