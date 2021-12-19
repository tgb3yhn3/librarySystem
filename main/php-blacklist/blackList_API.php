<?php
    //blackList_API.php
    $action = $_POST["action"];//前端必須用表單傳action到此php,此php才能知道接下來是要新增、刪除還是修改黑名單
    if($action =="add"){//將使用者加入黑名單
        blackList_add();
    }
    else if($action =="delete"){//將使用者從黑名單移除
        blackList_delete();
    }
    else if($action =="edit"){//編輯加入黑名單原因
        blackList_editReason();
    }

    //將使用者加入黑名單
    function blackList_add(){
        
        $userID = $_POST["userID"];
        $reason = $_POST["reason"];

        //檢查userID是否為空
        if(empty($userID)){
            echo "<script>alert('使用者學號不得為空!');history.back();</script>";
        }
        else{
            $conn = require_once("../config.php");//連線至資料庫
            if(!$conn){
                die("Fatal Error");//若未成功連線，終止程式並回報錯誤
            }   
            //檢查使用者是否已經在黑名單內
            $sql = "select userID FROM blacklist where userID ='$userID' LIMIT 1";//"LIMIT 1"代表只要找到一筆資料即可
            mysqli_query($conn,$sql);
            $result = mysqli_query($conn,$sql);//抓取的結果
            if (!$result) die("Fatal Error");//若抓取的結果發生錯誤，終止程式並回報錯誤
            if($result->num_rows == 1){//使用者已經在黑名單內了
                echo "<script>alert('使用者已存在黑名單內!');history.back();</script>";
            }
            else{//使用者尚未在黑名單，執行新增
    
                //檢查此使用者是否存在
                $sql="select username FROM users where userID ='$userID' LIMIT 1";//"LIMIT 1"代表只要找到一筆資料即可
                mysqli_query($conn,$sql);//從資料庫抓取資料
                $result = mysqli_query($conn,$sql);//抓取的結果
                if (!$result) die("Fatal Error");//若抓取的結果發生錯誤，終止程式並回報錯誤
                if($result->num_rows == 1){//使用者存在
                    
                    //讀取使用者姓名
                    $row = $result->fetch_assoc();
                    $username = $row['username'];
    
                    //將使用者加入黑名單資料庫並返回黑名單頁面
                    if($reason == ""){
                        $sql = "  insert into blacklist VALUES('$userID','$username','無')";
                    }
                    else{
                        $sql = "  insert into blacklist VALUES('$userID','$username','$reason')";
                    }
                    mysqli_query($conn,$sql);
                    echo "<script>alert('加入成功!');window.location.replace('blackList.html');</script>";
    
                }
                else{//使用者不存在，返回輸入頁面
    
                    echo "<script>alert('找不到該使用者!');history.back();</script>";
    
                }
            }
            $result->close();// 釋放抓取結果的記憶體
            $conn->close();//關閉與資料庫的連線 
        }

        
    }

    //將使用者從黑名單移除
    function blackList_delete(){
        $userID  = $_POST["userID"];
        /*與資料庫連線*/
        $conn=require_once "../config.php";
        if(!$conn){
            die("Fatal Error");//若未成功連線，終止程式並回報錯誤
        } 
        $sql=  "delete from blacklist
                where userID = '$userID'";
        mysqli_query($link,$sql);
        mysqli_close($link);//關閉資料庫連線
        echo "<script>alert('刪除成功!');window.location.replace('blackList.html');</script>";
    }
    
    //編輯加入黑名單原因
    function blackList_editReason(){
        $userID = $_POST["userID"];
        $reason = $_POST["reason"];
        $conn = require_once("../config.php");//連線至資料庫
        if(!$conn){
            die("Fatal Error");//若未成功連線，終止程式並回報錯誤
        } 
        $sql=  "update blacklist
                set reason = '$reason'
                where userID = '$userID'";
        mysqli_query($link,$sql);
        mysqli_close($link);//關閉資料庫連線
        echo "<script>alert('編輯成功!');window.location.replace('blackList.html');</script>";
    }
    
?>