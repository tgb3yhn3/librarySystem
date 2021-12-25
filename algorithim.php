<?php
    function algorithim($datas,$number,$conn){
        $userID = $datas[0]["userID"];
        $book_num = $datas[0]["book_num"];
        $book_time = $datas[0]["book_time"];
        $book_fine = $datas[0]["book_fine"];
        $credit = $datas[0]["credit"];
        if($credit==4&&$number==1){//4->5
            $book_num = $book_num + 1;
            echo "<script>alert('可借書本數增加至 : $book_num')</script>";
        }
        else if($credit==5&&$number==-1){//5->4
            $book_num = $book_num - 1;
            echo "<script>alert('可借書本數減少至 : $book_num')</script>";
        }
        //--------------------------------------
        else if($credit==9&&$number==1){//9->10
            $book_time = $book_time + 5;
            echo "<script>alert('可借書本時間增加至 : $book_time 天')</script>";
        }
        else if($credit==10&&$number==-1){//10->9
            $book_time = $book_time - 5;
            echo "<script>alert('可借書本時間減少至 : $book_time 天')</script>";
        }
        //--------------------------------------
        else if($credit==19&&$number==1){//19->20
            $book_num = $book_num + 1;
            $book_time = $book_time + 5;
            echo "<script>alert('可借書本數增加至 : $book_num 且可借書本時間增加至 : $book_time 天')</script>";
        }
        else if($credit==20&&$number==-1){//20->19
            $book_num = $book_num - 1;
            $book_time = $book_time - 5;
            echo "<script>alert('可借書本數減少至 : $book_num 且可借書本時間減少至 : $book_time 天')</script>";
        }
        //--------------------------------------
        else if($credit==-4&&$number==-1){//-4->-5
            $book_num = $book_num - 1;
            echo "<script>alert('可借書本數減少至 : $book_num')</script>";
        }
        else if($credit==-5&&$number==1){//-5->-4
            $book_num = $book_num + 1;
            echo "<script>alert('可借書本數增加至 : $book_num')</script>";
        }
        //--------------------------------------
        else if($credit==-9&&$number==-1){//-9->-10
            $book_time = $book_time - 5;
            $book_fine = $book_fine + 0.5;
            echo "<script>alert('可借書時間減少至 : $book_num 且逾期罰金倍率增加至 : $book_fine ')</script>";
        }
        else if($credit==-10&&$number==1){//-10->-9
            $book_time = $book_time + 5;
            $book_fine = $book_fine - 0.5;
            echo "<script>alert('可借書時間增加至 : $book_num 且逾期罰金倍率減少至 : $book_fine ')</script>";
        }
        //--------------------------------------
        else if($credit==-19&&$number==-1){//-19->-20
            $book_fine = $book_fine + 0.5;
            echo "<script>alert('逾期罰金倍率增加至 : $book_fine ')</script>";
        }
        else if($credit==-20&&$number==1){//-20->-19
            $book_fine = $book_fine - 0.5;
            echo "<script>alert('逾期罰金倍率減少至 : $book_fine ')</script>";
        }
        //--------------------------------------超過處理
        else if($credit==20&&$number==1){//20->21
            $credit = 20;
        }
        else if($credit==-20&&$number==-1){//-20->-21
            $credit = -20;
        }
        $credit = $credit+$number;
        echo $book_num."<br>";
        echo $book_time."<br>";
        echo $book_fine."<br>";
        echo $credit."<br>";
        echo $userID."<br>";
        $adjust = "UPDATE user_condition SET book_num = '".$book_num."',book_time = '".$book_time."',book_fine = '".$book_fine."',credit = '".$credit."' WHERE userID = '".$userID."'";
        mysqli_query($conn,$adjust);
    }
?>