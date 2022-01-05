<?php
function isFavorite($conn,$ISBN,$userID){

    if($userID !=""){//若當前有登入且身分是一般使用者
        $sql="select *  from `user_favorite_book_data` where userID='$userID' and ISBN='$ISBN'";
    
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)>0) {
            return true;
        }else{
            return false;
        }
    }
    return false;
}