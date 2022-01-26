<?php
    //announcement_view_API.php
    define('DB_SERVER', 'us-cdbr-east-05.cleardb.net');
    define('DB_USERNAME', 'b173ff6c6fd8c1');
    define('DB_PASSWORD', '6e46f35e');
    define('DB_NAME', 'heroku_5199541154d8577');
 session_start();
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// 輸入中文也OK的編碼
mysqli_query($conn, 'SET NAMES utf8');

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
    // $conn = require_once("../config.php");//連線至資料庫
    if(!$conn){
        die("Fatal ErrorR");//若未成功連線，終止程式並回報錯誤
    }
    
    
    /*判斷當前登入者*/
    // $_SESSION["admin"] =0;
    if(isset($_SESSION["admin"]) && $_SESSION["admin"]==true){//管理員
        $userID = "admin";
        // echo"ADMIN";
    }
    else if(isset($_SESSION["userID"])){//使用者
        $userID = $_SESSION["userID"];   
        // echo"user";
    }
    else{//訪客
        $userID = "visitor";
        // echo"LOSER";
    }


    $arr = array();//將所有通知存成陣列形式

    /*發布逾期通知給使用者*/
    
    if(isset($_SESSION["admin"]) && $_SESSION["admin"]==false && isset($_SESSION["userID"])){
        $today = date('Y-m-d');
        $username = $_SESSION["username"];
        $sql = "select  user_book_history.book_unique_ID,book.bookName,user_book_history.lasting_return_date 
                from 	user_book_history,book
                WHERE 	SUBSTRING_INDEX(user_book_history.book_unique_ID, '_', 1) = book.ISBN and 
                        user_book_history.userID = '$userID' and 
                        user_book_history.start_rent_date <> '-' and 
                        user_book_history.return_date = '-' and 
                        user_book_history.lasting_return_date < '$today'
                ORDER by user_book_history.lasting_return_date ";
        $result = mysqli_query($conn,$sql);//抓取的結果
        if (!$result) die("Fatal ErrorEE");//若抓取的結果不存在，終止程式並回報錯誤
        if($result->num_rows!=0){//有書逾期未還
            $overdue_notice = array(
                'ID'         => "overdue_notice",
                'title'      => "<span style='color:red;'>【逾期未還通知】</span>".$username."(".$userID.")同學好，您有書籍未歸還且已超過還書期限，請盡速歸還",
                'message'    => "",
                'annouceTime'=> $today,
                'sent_to'    => "",
            );
            array_push($arr,$overdue_notice);//將第i列資料存到陣列
        } 
    }
    
    /*發布一般通知*/
    if(isset($_SESSION["admin"]) && $_SESSION["admin"]==true){//如果是管理員，將顯示所有公告 
        $sql=  "select ID,title,message,annouceTime,sent_to
        FROM announcement";
    }
    else if($userID == "visitor"){//如果是訪客，將只顯示對象為全體的公告
        $sql = "select ID,title,message,annouceTime,sent_to
        FROM announcement 
        where sent_to ='all'";
    }
    else{//如果是使用者，將只顯示對象為全體以及對象為該使用者的公告
        $sql=  "select ID,title,message,annouceTime,sent_to
        FROM announcement 
        where sent_to ='all' or sent_to = $userID";
    }
    $result = mysqli_query($conn,$sql);//抓取的結果
    if (!$result) die("Fatal ErroRrr");//若抓取的結果不存在，終止程式並回報錯誤

    /*將抓取的資料轉成JSON並輸出給前端*/
    $rows = $result->num_rows;//抓取的結果中共有幾列資料
    for ($i = 0 ; $i < $rows ; ++$i){
        $result->data_seek($i);//查找第i列資料
        $row = $result->fetch_assoc();//讀取第i列資料
        $row['annouceTime'] = date("Y-m-d", strtotime($row['annouceTime']));//在前端顯示的公告時間為 西元年-月-日
        $row['message'] = str_replace("<br>","&#10",$row['message']);//修改公告時，不會看到公告內容含有<br> tag
        $row['message'] = preg_replace("/(\s|\&ensp\;|　|\xc2\xa0)/"," ",$row['message']);//修改公告時，不會看到公告內容含有html空格符號(半形空格)
        if($row['sent_to']=="all"){
            $row['sent_to'] = "";//修改公告時，若原本傳送對象為全體，則輸入框會變空
        }
        array_push($arr,$row);//將第i列資料存到陣列
    }
    header("content-Type: application/json; charset=utf-8");//設定資料編碼
    echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);//將陣列中的每一筆資料轉成JSON

    $result->close();// 釋放抓取結果的記憶體
    $conn->close();//關閉與資料庫的連線 
?>