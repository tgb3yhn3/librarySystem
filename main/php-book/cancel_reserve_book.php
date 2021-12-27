<?php
    if(isset($_GET['num'])){
        require_once('adjust_user_condition.php');
        require_once('adjust_line_up.php');
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '123456');
        define('DB_NAME', 'test');
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        mysqli_query($link, 'SET NAMES utf8');
        $get_this_line_up =  "SELECT * FROM line_up WHERE userID = '".$_GET['userID']."' AND ISBN = '".$_GET['book']."'" ;
        $result = mysqli_query($link,$get_this_line_up);
        $count=0;
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                    $count++;
                }
            }
            mysqli_free_result($result);
        }
        if($datas[0]["lasting_time"]!='-'){
            adjust_line_up($_GET['book'],$link);
        }
        $delete_reserve_history = "DELETE FROM user_book_history WHERE numbering = '".$_GET['num']."'" ;
        mysqli_query($link,$delete_reserve_history);
        $delete_reserve_line_up = "DELETE FROM line_up WHERE userID = '".$_GET['userID']."' AND ISBN = '".$_GET['book']."' ORDER BY numbering DESC LIMIT 1";
        mysqli_query($link,$delete_reserve_line_up);
        adjust_user_condition($_GET['userID'],-1,$link);
        if($count==1){
            
        }
        echo "取消預約成功";
    }
    else{
        echo "失敗";
    }
?>
