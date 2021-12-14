<!DOCTYPE html>
<!-- GET 前端 用來搜尋書籍 -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        img{
            float:left;
            width:50px;
            length:50px;
        }
        </style>
</head>
<body>
    <form action="select.php" method="post">
        搜尋書名<input type="text" name='search'><input type="submit" >
    </form>
    <?php
require("search.php");
  if(array_key_exists(("search"),$_POST)){
    
    echo get_search_book($_POST['search'],1);
  }else{
    echo get_search_book("");
  }
?>

 
</body>
</html>