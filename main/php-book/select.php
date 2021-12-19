<!DOCTYPE html>
<!-- GET 前端 用來搜尋書籍 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
      
        body{
            text-align:center;
            font-family:'微軟正黑體', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            
        }
        img{
            float:left;
            width:50px;
            length:50px;
            box-sizing:border-box;
        }
      
        form{
          letter-spacing: 10px;
            line-height: 40px;
            margin-left: auto;
            margin-right: auto;
            height: auto;
        }
        input{
            /* height: 40px; */
        }
        </style>
</head>
<body>
    <form action="select.php" method="post">
        搜尋書名<input type="text" name='search'><input type="submit" >
    </form>
    <?php
    $conn=require_once("../config.php");
    require("search.php");
    if(array_key_exists(("search"),$_POST)){
      
      echo get_search_book($_POST['search'],1,0,$conn);
    }else{
      echo get_search_book("",0,0,$conn);
    }
    mysqli_close($conn);
?>

 
</body>
</html>