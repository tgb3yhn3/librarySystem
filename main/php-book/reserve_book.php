<?php
    require_once('check_condition.php');
    require_once('push_line_up.php');
    require_once('push_book_history_reserve.php');
    require_once('adjust_user_condition.php');
    $conn=require_once("config.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $userID=$_POST["userID"];
        $ISBN=$_POST["ISBN"];
        if(check_condition($userID,$conn)){
            adjust_user_condition($userID,1,$conn);//調整user的renting_book_num
            push_line_up($userID,$ISBN,$conn);//排隊
            push_book_history_reserve($userID,$ISBN,$conn);//借閱歷史顯示已預約
            alertMsg("預約成功");
            echo'<script>history.go(-1)</script>';
        }
        else{
            alertMsg("已達 借書/預約 上限,不得預約") ;
            echo'<script>history.go(-1)</script>';
        }
    }
    function alertMsg($msg){
        echo "<script>
        window.alert('$msg');
        </script>";
    }
   
?>