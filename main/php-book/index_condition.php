<?php
	session_start();
	$_SESSION['unsave_id'] = '0';
    $conn=require_once("config.php");
    $get_userID =  "SELECT userID, book_num, book_time, book_fine, credit FROM user_condition";
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
            <input type="hidden" name="userID'.$i.'" value='.$datas[$i]["userID"].'>
            <table>
            <tr>
                <th colspan="4"><h1>'.$datas[$i]["userID"].'</h1></th>
                
            </tr>
            <tr>
                <td>數量</td>
                <td>時長</td>
                <td>倍率</td>
                <td>信用</td>
            </tr>
            <tr>
                <td><input type="text" name="book_num'.$i.'" id="book_num'.$i.'" value='.$datas[$i]["book_num"].' size = "5" onchange="change_color(this.id)"></td>
                <td><input type="text" name="book_time'.$i.'" id="book_time'.$i.'" value='.$datas[$i]["book_time"].' size = "5" onchange="change_color(this.id)"></td>
                <td><input type="text" name="book_fine'.$i.'" id="book_fine'.$i.'" value='.$datas[$i]["book_fine"].' size = "5" onchange="change_color(this.id)"></td>
                <td><a>'.$datas[$i]["credit"].'</a></td>
            </tr>
            </table>
        <br>';
    }
	echo '<input type="hidden" name="unsave_ornot" id="unsave_ornot" value = 0><input type="submit" id="submit'.$i.'" value="設定" onclick = "ChangeState();"></form>';
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
			var hasSaved = false;//是否有輸入的內容未儲存標誌，初始值為false
            function CheckUnsave(){
                if(hasSaved==false){
                    alert("您上傳的東西尚未儲存，請儲存後再離開頁面");
                return false;}
            }
            //儲存了則改變狀態
            function ChangeState()
            {
                hasSaved = true;
            }
        </script>
    </head>
    <body onbeforeunload="return CheckUnsave();">
		
    </body>
</html>