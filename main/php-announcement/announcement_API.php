<?php
    //announcement_API.php
    $action = $_POST["action"];//前端必須用表單傳action到此php,此php才能知道接下來是要新增、刪除還是修改公告
    if($action =="add"){//新增公告
        announcement_add();
    }
    else if($action =="delete"){//移除公告
        announcement_delete();
    }
    else if($action =="edit"){//修改公告
        announcement_edit();
    }
    
    //新增公告
    function announcement_add(){
        $title = $_POST["title"];
        $message = $_POST["message"];
        $sent_to = $_POST["sent_to"];
        
        $conn = require_once("../config.php");//連線至資料庫
        if(!$conn){
            die("Fatal Error");//若未成功連線，終止程式並回報錯誤
        }   

        //新增至資料庫
        if($sent_to==""){//若管理員沒輸入傳送對象，則傳送對象為全體使用者
            $sent_to = "all";
        }
        $sql="insert INTO announcement (title,message,sent_to) VALUES('$title','$message','$sent_to')";
        mysqli_query($conn,$sql);

        //若輸入的公告內容有空格，則在資料庫中將空格存成html的「&ensp;」(半形空格)
        $sql=  "update announcement
                set message = replace(message,' ','&ensp;')
                where ID = (SELECT MAX(ID) from announcement)";
        mysqli_query($conn,$sql);

        //若輸入的公告內容有換行符號，則在資料庫中將空格存成html的「<br>」
        $sql=  "update announcement
                set message = replace(message,'\n','<br>')
                where ID = (SELECT MAX(ID) from announcement)";
        mysqli_query($conn,$sql);

        echo "<script>alert('加入成功!');window.location.replace('announcement_admin.html');</script>";
    
        $conn->close();//關閉與資料庫的連線 
    }

    //移除公告
    function announcement_delete(){
        $ID = $_POST["ID"];   
        if(!$ID){
            die("Fatal Error");//若ID不存在，終止程式並回報錯誤
        }
        $conn = require_once("config.php");//連線至資料庫
        if(!$conn){
            die("Fatal Error");//若未成功連線，終止程式並回報錯誤
        }   
        $sql="delete from announcement where ID = '$ID'";
        mysqli_query($conn,$sql);
        echo "<script>alert('刪除成功!');window.location.replace('announcement_admin.html');</script>";

        $conn->close();//關閉與資料庫的連線 
    }

    //修改公告
    function announcement_edit(){

        $ID = $_POST["ID"]; 
        $title = $_POST["title"];
        $message = $_POST["message"];
        $sent_to = $_POST["sent_to"];

        if(!$ID){
            die("Fatal Error");//若ID不存在，終止程式並回報錯誤
        }
        $conn = require_once("config.php");//連線至資料庫
        if(!$conn){
            die("Fatal Error");//若未成功連線，終止程式並回報錯誤
        }   

        //修改資料庫中的內容
        if($sent_to==""){//若管理員沒輸入傳送對象，則傳送對象為全體使用者
            $sent_to ="all";
        }
        $sql=  "update announcement
                set title = '$title',  
	                message = '$message',
                    sent_to = '$sent_to'
                where ID = '$ID'";
        mysqli_query($conn,$sql);

        //若輸入的公告內容有空格，則在資料庫中將空格存成html的「&ensp;」(半形空格)
        $sql=  "update announcement
                set message = replace(message,' ','&ensp;')
                where ID = '$ID'";
        mysqli_query($conn,$sql);

        //若輸入的公告內容有換行符號，則在資料庫中將空格存成html的「<br>」
        $sql=  "update announcement
                set message = replace(message,'\n','<br>')
                where ID = '$ID'";
        mysqli_query($conn,$sql);

        echo "<script>alert('修改成功!');window.location.replace('announcement_admin.html');</script>";

        $conn->close();//關閉與資料庫的連線 
    }

?>