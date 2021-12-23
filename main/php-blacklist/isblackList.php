<?php
    function isblackList($conn,$userID){
        $sql = "SELECT * FROM blacklist WHERE userID ='".$userID."'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $row=$result ->fetch_assoc();
            return $row['reason'];
        }
        return null;
    }
?>