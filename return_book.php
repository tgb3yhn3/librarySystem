<?php
    require_once('check_user_renting_book.php');
    require_once('adjust_book_status.php');
    require_once('adjust_user_condition.php');
    require_once('adjust_book_history.php');
    require_once('check_line_up.php');
    require_once('adjust_line_up.php');
    $conn=require_once("config.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $userID=$_POST["userID"];
        $bookuniqueID=$_POST["bookuniqueID"];
        $array = str_split($bookuniqueID);
        $ISBN = '';
        for($i=0;$i<13;$i++){
            $ISBN = $ISBN.$array[$i];
        }
        if(check_user_renting_book($userID,$bookuniqueID,$conn)){//查使用者有沒有借這本書
            adjust_book_status($bookuniqueID,0,$conn);//表使此書尚有庫存
            adjust_user_condition($userID,-1,$conn);//user還書 可借數量++
            adjust_book_history($userID,$bookuniqueID,$conn);//調整歷史借書紀錄為已還書
            if(check_line_up($ISBN,$conn)){//查有沒有人在預約這本書
                adjust_line_up($ISBN,$conn);
                echo "管理員~有人預約此書";
            }
        }
        else{
            echo "此使用者無借閱此書";
        }
    }
?>