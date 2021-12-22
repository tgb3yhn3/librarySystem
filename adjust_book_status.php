<?php
    function adjust_book_status($bookuniqueID,$number,$conn){
        $adjust_status = "UPDATE book SET status = '".$number."' WHERE bookUniqueID = '".$bookuniqueID."'";
        mysqli_query($conn,$adjust_status);
    }
?>