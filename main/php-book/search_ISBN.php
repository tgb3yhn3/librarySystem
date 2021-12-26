<?php
    header("Content-type: text/html; charset=utf-8");
        $ISBN=$_POST["ISBN"];
        // $isbn = '9789865028756';
        // $isbn=$_POST["isbn"];
        $path="python search.py "; //需要注意的是：末尾要加一個空格
        $command = escapeshellcmd($path.$ISBN);
        $output = exec($command.' 2>error.txt"',$ISBN);
        $after_decode =  iconv(mb_detect_encoding($output), "cp950", $output);
        echo $after_decode;
    
    // if($_SERVER["REQUEST_METHOD"]=="POST"){
        // $obj = json_decode($after_decode);
    //     // $book_name = $obj -> {'book_name'};
    //     // echo $book_name.'<br>';
    //     // $author = $obj -> {'author'};
    //     // echo $author.'<br>';
    //     // $company = $obj -> {'company'};
    //     // echo $company.'<br>';
    //     // $date = $obj -> {'date'};
    //     // echo $date.'<br>';
    //     // $img_url = $obj -> {'img_url'};
    //     // echo $img_url.'<br>';
    //     // $text = $obj -> {'text'};
    //     // echo $text.'<br>';
    // }
?>