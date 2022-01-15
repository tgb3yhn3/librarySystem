<?php
//current_state.php
    $conn = require_once("config.php");//連線至資料庫
    if(!$conn){
        die("Fatal Error");//若未成功連線，終止程式並回報錯誤
    }   
    //圖書館已出借書籍總數
    $sql="  select COUNT(DISTINCT bookUniqueID) as borrowedNum
            from book
            where status = 1";
    $result = mysqli_query($conn,$sql);//抓取的結果
    if (!$result) die("Fatal Error");//若抓取的結果不存在，終止程式並回報錯誤
    $row = $result->fetch_assoc();
    $borrowedNum = $row['borrowedNum'];

    //圖書館逾期未還書籍總數
    $today = date('Y-m-d');
    $sql="  select  COUNT(DISTINCT numbering) as overdueNum
            from 	user_book_history
            WHERE 	book_status='出借中' and
                    user_book_history.return_date = '-' and 
                    user_book_history.lasting_return_date < '$today'";
    $result = mysqli_query($conn,$sql);//抓取的結果
    if (!$result) die("Fatal Error");//若抓取的結果不存在，終止程式並回報錯誤
    $row = $result->fetch_assoc();
    $overdueNum = $row['overdueNum'];

    //圖書館館藏書籍總數
    $today = date('Y-m-d');
    $sql="  select sum(num) as holdingsNum
            from book";
    $result = mysqli_query($conn,$sql);//抓取的結果
    if (!$result) die("Fatal Error");//若抓取的結果不存在，終止程式並回報錯誤
    $row = $result->fetch_assoc();
    $holdingsNum = $row['holdingsNum'];

    //圖書館剩餘館藏書籍總數
    $remainingHoldingsNum = $holdingsNum-$borrowedNum;

    //將所有要輸出到管理員頁面的變數存到陣列
    $arr = array(
        "borrowedNum" => $borrowedNum,
        "overdueNum"  => $overdueNum,
        "holdingsNum" => $holdingsNum,
        "remainingHoldingsNum" => (string)$remainingHoldingsNum
    );

    //設定資料編碼，並將陣列中的每一筆資料轉成JSON
    header("content-Type: application/json; charset=utf-8");
    echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);

    $result->close();// 釋放抓取結果的記憶體
    $conn->close();//關閉與資料庫的連線 

?>