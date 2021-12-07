
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        img{
            float:left;
            width:50px;
            length:50px;
        }
        </style>
</head>
<body>
    
    <form action="book.php" method="post">
        搜尋書名<input type="text" name='search'><input type="submit" >
    </form>
    <?php
  
    $host = 'localhost';
    $dbuser ='root';
    $dbpassword = '123456';
    $dbname = 'test';
    $sql="select * from `book`";
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
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
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
    <?php 
    if(!empty($datas)){
    for($i=0;$i<count($datas);$i++){
        
        $bookName=$datas[$i]["bookName"];
        $author=$datas[$i]["author"];
        $ISBN=$datas[$i]["ISBN"];
        $describeBook=$datas[$i]["describeBook"];
        echo "<br>第$i 本書<br> ";
        echo "<a href='book.php?search=".$ISBN."'><h3>$bookName<br></h3></a>";
        echo "author:$author<br>";
        echo "ISBN:$ISBN<br>";
        echo "describeBook:$describeBook<br>";
        
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        
    
        echo "<form action='delete.php'method='post'>
                <input type='hidden'name='delete' value='$bookName'>
                <input type='submit' value='刪除這本書 'onclick='msg()'>        
        </form> ";
    }
        echo "<hr>";
    }}else{
        echo"沒有書籍";
    }

?>
<?php mysqli_close($link); ?>
    <script>
        function msg(){
            alert("已刪除");
        }
        </script>
</body>
</html>