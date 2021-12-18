<?php
    //view_blackList_API.php
    $conn = require_once("config.php");//連線至資料庫
    if(!$conn){
        die("Fatal Error");//若未成功連線，終止程式並回報錯誤
    }
    /*從資料庫抓取資料*/
    $sql=  "select userID,username,reason 
            FROM blacklist";
    mysqli_query($conn,$sql);
    $result = mysqli_query($conn,$sql);//抓取的結果
    if (!$result) die("Fatal Error");//若抓取的結果不存在，終止程式並回報錯誤

    /*將抓取的資料轉成JSON並輸出給前端*/
    $rows = $result->num_rows;//抓取的結果中共有幾列資料
    $arr = array();//將所有資料存成陣列形式
    for ($i = 0 ; $i < $rows ; ++$i){
        $result->data_seek($i);//查找第i列資料
        $row = $result->fetch_assoc();//讀取第i列資料
        array_push($arr,$row);//將第i列資料存到陣列
    }
    header("content-Type: application/json; charset=utf-8");//設定資料編碼
    echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);//將陣列中的每一筆資料轉成JSON

    $result->close();// 釋放抓取結果的記憶體
    $conn->close();//關閉與資料庫的連線 
?>