<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
        </style>
        <script>
            // const browser = await puppeteer.launch({ headless: true });
            // //如果為false則會開啟瀏覽器，適合用作於debug時。
            // const page = await browser.newPage();
            // await page.goto(url);
        </script>
    </head>
    <body>
        <form name="search" method="post" action="index.php" >
            請輸入ISBN：<input type="text" name="isbn"><br><br>
            <input type="submit" value="搜尋" name="submit">
        </form>
    </body>
</html>
<?php
    header("Content-type: text/html; charset=utf-8");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $isbn=$_POST["isbn"];
        $path="python search.py "; //需要注意的是：末尾要加一個空格
        $command = escapeshellcmd($path.$isbn);
        $output = exec($command.' 2>error.txt"',$isbn);
        $after_decode =  iconv(mb_detect_encoding($output), "cp950", $output);
        // echo $after_decode;
        $obj = json_decode($after_decode);
        $book_name = $obj -> {'book_name'};
        echo $book_name.'<br>';
        $author = $obj -> {'author'};
        echo $author.'<br>';
        $company = $obj -> {'company'};
        echo $company.'<br>';
        $date = $obj -> {'date'};
        echo $date.'<br>';
        $img_url = $obj -> {'img_url'};
        echo $img_url.'<br>';
        $text = $obj -> {'text'};
        echo $text.'<br>';
    }
?>