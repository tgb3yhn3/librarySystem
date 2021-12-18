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
        echo '<form action="index.php" method="POST" id="user'.$i.'">
            <h1>'.$datas[$i]["userID"].'</h1>
            <a>學號</a>
            <a>數量</a>
            <a>時長</a>
            <a>信用</a><br>
            <input type="hidden" name="userID" value='.$datas[$i]["userID"].'>
            <input type="text" name="book_num" id="book_num'.$i.'" value='.$datas[$i]["book_num"].' size = "5" onchange="change_color(this.id)">
            <input type="text" name="book_time" id="book_time'.$i.'" value='.$datas[$i]["book_time"].' size = "5" onchange="change_color(this.id)">
            <input type="text" name="book_fine" id="book_fine'.$i.'" value='.$datas[$i]["book_fine"].' size = "5" onchange="change_color(this.id)">
            <a>'.$datas[$i]["credit"].'</a>
            <input type="submit" id="submit'.$i.'" value="設定" onclick = "cancel_color('.$i.')">
        </form><br>';
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $book_num = $_POST["book_num"];
        $book_time = $_POST["book_time"];
        $book_fine = $_POST["book_fine"];
        $userID = $_POST["userID"];
        //檢查帳號是否重複
        $change = "UPDATE user_condition SET book_num = $book_num, book_time = $book_time, book_fine = $book_fine WHERE userID = $userID";
        mysqli_query($conn, $change);
        header("refresh:0.005;url=index.php",true);
    }
    mysqli_close($conn);
?>
<html>
    <head>
        <script>
            function change_color(id){
                console.log(id);
                document.getElementById(id).style = "background-color:#FFCC6E;"
            }
            function cancel_color(id){
                console.log(id);
                document.getElementById("book_num"+id).style = "background-color:#ffffff;"
                document.getElementById("book_time"+id).style = "background-color:#ffffff;"
                document.getElementById("book_fine"+id).style = "background-color:#ffffff;"
            }
        </script>
    </head>
    <body>
    </body>
</html>