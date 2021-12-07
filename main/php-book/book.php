<?php

require_once("../config.php");

$ISBN=$_POST["search"];
if($ISBN){
    $ISBN=$_GET["search"];
}
     $sql="select * from `book` where ISBN = '$ISBN'";
     $sql2="select * from `book` where bookName = '$ISBN'";
     $result = mysqli_query($link,$sql);
     $result2= mysqli_query($link,$sql2);
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
     }if(empty($datas)){
         
        if (mysqli_num_rows($result2)>0) {
            // 取得大於0代表有資料
            // while迴圈會根據資料數量，決定跑的次數
            // mysqli_fetch_assoc方法可取得一筆值
            while ($row = mysqli_fetch_assoc($result2)) {
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                $datas[] = $row;
            }
        }
        // 釋放資料庫查到的記憶體
        mysqli_free_result($result2);
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
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            echo '<form action="sentComment.php" method="POST">
            <input type="text" name="context">
            <input type="hidden" name="username" value='.$username.'>
            <input type="hidden" name="ISBN" value='.$ISBN.'>
            <input type="submit" value="送出評論">
        </form>';
        }
        $sql="select * from `comment` where ISBN=".$ISBN;
        $datas=array();
        $result=mysqli_query($link,$sql);
        if($result){
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
        if(!empty($datas)){
            for($i=0;$i<count($datas);$i++){
                $username=$datas[$i]['username'];
                $context=$datas[$i]['context'];
                echo "<br>".$username."說<br>";
                echo $context."<hr>";
            }
        }            
}else{
    echo "找不到書籍" ;
}
?>
     