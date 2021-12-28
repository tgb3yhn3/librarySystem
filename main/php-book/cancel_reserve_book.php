<?php
    if(isset($_GET['num'])){
        require_once('adjust_user_condition.php');
        require_once('adjust_line_up.php');
        require_once('check_adjust_balance.php');
        require_once('set_book_status_to_0.php');
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
        if($datas[0]["lasting_time"]!='-'){//如果他是那個ISBN裡有收到簡訊的話
            echo "有收到簡訊<br>";
            if(check_adjust_balance($_GET['book'],$link)){//如果滿了
                echo "滿了<br>";
                set_book_status_to_0($_GET['book'],$link);//表使此書不用保留給預約的,直接放上架,要把book的status設為0
            }
            else{//表示還有人預約還沒收到簡訊
                adjust_line_up($_GET['book'],$link);//把借書權推給下一個排隊的
            }
        }
        $delete_reserve_history = "DELETE FROM user_book_history WHERE numbering = '".$_GET['num']."'" ;//在user_book_history透過numbering刪掉
        mysqli_query($link,$delete_reserve_history);
        $delete_reserve_line_up = "DELETE FROM line_up WHERE userID = '".$_GET['userID']."' AND ISBN = '".$_GET['book']."' ORDER BY numbering DESC LIMIT 1";//如果同一個人預約同一本書,刪掉後面那一本,else 普通刪除
        mysqli_query($link,$delete_reserve_line_up);
        adjust_user_condition($_GET['userID'],-1,$link);
        echo "取消預約成功";
    }
    else{
        echo "失敗";
    }
?>
