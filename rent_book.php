<?php
    require_once('check_condition.php');
    require_once('adjust_book_status.php');
    require_once('adjust_user_condition.php');
    require_once('push_book_history.php');
    require_once('check_book_status.php');
    require_once('adjust_book_history_reserve.php');
    require_once('check_reserve.php');
    $conn=require_once("config.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $userID=$_POST["userID"];
        $bookuniqueID=$_POST["bookuniqueID"];
        $array = str_split($bookuniqueID);
        $ISBN = '';
        for($i=0;$i<13;$i++){
            $ISBN = $ISBN.$array[$i];
        }
        if(check_reserve($userID,$ISBN,$conn)){//看是不是已被預約的書
            echo "有預約<br>";
            adjust_book_status($bookuniqueID,1,$conn);//把此書登記為借出
            adjust_book_history_reserve($userID,$bookuniqueID,$ISBN,$conn);//把history已預約的狀態改成出借中
        }
        else{
            if(check_condition($userID,$conn)){//查user還有沒有扣打
                if(check_late_return($userID,$conn)){//查user有沒有逾期還書
                    if(check_book_status($bookuniqueID,$conn)){//查此書有沒有被借走(理論上用不到)
                        echo "正常借書<br>";
                        adjust_book_status($bookuniqueID,1,$conn);//把此書登記為借出
                        adjust_user_condition($userID,1,$conn);//user的renting_book_num+1
                        push_book_history($userID,$bookuniqueID,$conn);//將借書資訊放到history
                    }
                    else{
                        echo "此書已被借走";
                    }
                }
                else{
                    echo "有逾期書籍未歸還";
                }
            }
            else{
                echo "已達借書上限,不得借書";
            }
        }
        echo "借書成功";
    }
?>