<?php
//精準搜尋才需要印出評論區
function get_star($ISBN,$link){
    // $link=require("../config.php");
    $comment=array();
    $times = 0;
    $starnum = 0;
    $sql="select * from `comment` where ISBN=".$ISBN;
    $datas=array();
    $result=mysqli_query($link,$sql);
    if($result){
        if (mysqli_num_rows($result)>0) {
            // 取得大於0代表有資料
            // while迴圈會根據資料數量，決定跑的次數
            // mysqli_fetch_assoc方法可取得一筆值
            while ($row = mysqli_fetch_assoc($result)) {
                // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                $datas[] = $row;
                $times = $times + 1;
            }
        }
        // 釋放資料庫查到的記憶體
        mysqli_free_result($result);
    }
    for($i=0; $i<$times; $i++){
        $starnum += $datas[$i]['good']; 
    }
    if($times==0)
    return 0;
    return $starnum/$times;
    // if(!empty($datas)){
    //     for($i=0;$i<count($datas);$i++){
    //         $commentdata=new stdClass;
    //         $commentdata->username=$datas[$i]['username'];
    //         $commentdata->context=$datas[$i]['context'];
    //         // $return_value=$return_value."<br>".$username."說<br>";
    //         // $return_value=$return_value.$context."<hr>";
    //         array_push($comment,$commentdata);
    //     }
    // } 
    // return $comment;

}
   
 
?>