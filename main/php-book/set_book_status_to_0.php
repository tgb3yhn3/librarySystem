<?php
    function set_book_status_to_0($ISBN,$conn){
        $sql =  "SELECT * FROM book WHERE ISBN = '".$ISBN."' AND status = '2'" ;
        $result = mysqli_query($conn,$sql);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        $adjust_status = "UPDATE book SET status = '0' WHERE bookUniqueID = '".$datas[0]["bookUniqueID"]."'";
        echo "把".$datas[0]["bookUniqueID"]."的status設為0<br>";
        mysqli_query($conn,$adjust_status);
    }
?>