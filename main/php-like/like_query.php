<?php
    function getLike($username,$ISBN,$context,$link){
        $sql="select * from good where context='".$context."' and ISBN='".$ISBN."' and username='".$username."';";
        $datas=array();
        $like=0;
        $result=mysqli_query($link,$sql);
        if($result){
            if (mysqli_num_rows($result)>0) {
                // 取得大於0代表有資料
                // while迴圈會根據資料數量，決定跑的次數
                // mysqli_fetch_assoc方法可取得一筆值
                while ($row = mysqli_fetch_assoc($result)) {
                    // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                    $datas[] = $row;
                    $like += 1;
                }
            }
            // 釋放資料庫查到的記憶體
            mysqli_free_result($result);
        }
        return $like;
    }
?>
