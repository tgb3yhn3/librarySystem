<?php
	session_start();
	$_SESSION['unsave_id'] = '0';
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
	echo '<form action="index.php" method="POST" onsubmit="return validateForm()">';
    for($i = 0;$i<count($datas);$i++){
        echo '
            <h1>'.$datas[$i]["userID"].'</h1>
            <a>學號</a>
            <a>數量</a>
            <a>時長</a>
            <a>信用</a><br>
            <input type="hidden" name="userID'.$i.'" value='.$datas[$i]["userID"].'>
            <input type="text" name="book_num'.$i.'" id="book_num'.$i.'" value='.$datas[$i]["book_num"].' size = "5" onchange="change_color(this.id)">
            <input type="text" name="book_time'.$i.'" id="book_time'.$i.'" value='.$datas[$i]["book_time"].' size = "5" onchange="change_color(this.id)">
            <input type="text" name="book_fine'.$i.'" id="book_fine'.$i.'" value='.$datas[$i]["book_fine"].' size = "5" onchange="change_color(this.id)">
            <a>'.$datas[$i]["credit"].'</a>
        <br>';
    }
	echo '<input type="hidden" name="unsave_ornot" id="unsave_ornot" value = 0><input type="submit" id="submit'.$i.'" value="設定" onclick = "unsave_ornot_to_0()"></form>';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
		for($i = 0;$i<count($datas);$i++){
			$book_num = $_POST["book_num$i"];
        	$book_time = $_POST["book_time$i"];
        	$book_fine = $_POST["book_fine$i"];
			$userID = $_POST["userID$i"];
			$change = "UPDATE user_condition SET book_num = $book_num, book_time = $book_time, book_fine = $book_fine WHERE userID = $userID";
        	mysqli_query($conn, $change);
		}
        //檢查帳號是否重複
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
				document.getElementById(unsave_ornot).value = 1;
			}
			function unsave_ornot_to_0(){
				document.getElementById(unsave_ornot).value = 0;
			}
			
        </script>
    </head>
    <body>
		
    </body>
</html>