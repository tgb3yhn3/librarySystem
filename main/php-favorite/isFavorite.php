<?php
function isFavorite($conn,$ISBN){
    $sql="select *  from `user_favorite_book_data` where ISBN='$ISBN '";
    
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result)>0) {
        return true;
    }else{
        return false;
    }
    return true;
}