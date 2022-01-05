<?php
if(isset($_GET["ISBN"])){
    $ISBN=$_GET["ISBN"];
    $conn=require_once("../config.php");
    echo check_still_have_borrow($ISBN,$conn);
}

function check_still_have_borrow($ISBN,$conn){
    $sql="select * from user_book_history where ISBN='$ISBN' and book_status <> '已歸還'";
    // $stmt->bind_param("s",$ISBN);
    $result=mysqli_query($conn,$sql);
    if($result){
        if(mysqli_num_rows($result)>0) {
            echo"true";
            return true;
        }else{
            echo"false";
            return false;
        }
    }else{
        echo "ERROR";
    }
   
}
function alertMsg($msg){
    echo "<script>
    window.alert('$msg');
    </script>";
}
?>