<?php
function isLike($username,$ISBN,$context,$userID,$conn){

    if($userID !=""){//若當前有登入且身分是一般使用者
        $sql="select *  from `good` where ISBN='".$ISBN."'and context='".$context."' and userID='".$userID."' and username='".$username."';";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)>0) {
            return true;
        }else{
            return false;
        }
    }
    return false;
}
?>