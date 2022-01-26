<?php
    function auto_cancel_reserve_book(){
        require_once('adjust_line_up.php');
        define('DB_SERVER', 'us-cdbr-east-05.cleardb.net');
define('DB_USERNAME', 'b173ff6c6fd8c1');
define('DB_PASSWORD', '6e46f35e');
define('DB_NAME', 'heroku_5199541154d8577');
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        mysqli_query($link, 'SET NAMES utf8');
        $get_all_line_up =  "SELECT * FROM line_up WHERE lasting_time <> '-'" ;
        $result = mysqli_query($link,$get_all_line_up);
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
        date_default_timezone_set('Asia/Taipei');
        $d1 = date("Y").'-'.date("m").'-'.date("d");//現在日期->即歸還日期
        $return_date = explode("-",$d1);
        $today = mktime(0,0,0,$return_date[1],$return_date[2],$return_date[0]);
        for($i = 0;$i<$count;$i++){
            $lasting_date = explode("-",$datas[$i]["lasting_time"]);
            $lasting = mktime(0,0,0,$lasting_date[1],$lasting_date[2],$lasting_date[0]);
            $days = round(($lasting-$today)/3600/24);
            if($days<0){
                $delete_line_up = "DELETE FROM line_up WHERE numbering = '".$datas[$i]["numbering"]."'";
                mysqli_query($link,$delete_line_up);
                echo "刪掉number:".$datas[$i]["numbering"]."<br>";
                adjust_line_up($datas[$i]["ISBN"],$link);
            }
        }
    }
?>