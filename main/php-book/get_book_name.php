<?php
    function get_book_name($ISBN,$conn){
        $sql = "SELECT bookName FROM book WHERE ISBN = '".$ISBN."'";
        $result = mysqli_query($conn,$sql);
        if ($result) {
            if (mysqli_num_rows($result)>0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        return $datas[0]['bookName'];
    }
?>