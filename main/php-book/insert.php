<?php 
//GET 前端 用來創建書籍


 function function_alert($message) { 
    // window.location.href='index.php';
    // Display the alert box  
    echo "<script>alert('$message');
     
    </script>"; 
    return false;
} 
//TODO 權限功能尚未製作
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){//如果沒有登入就不允許新增書籍
   
    function_alert("尚未登入或權限不足");
    
    header("refresh:0;url=../index.php",true);
    exit;  //記得要跳出來，不然會重複轉址過多次
}
?>
<!DOCTYPE html>
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
            letter-spacing: 10px;
            line-height: 40px;
        }
        img{
            float:left;
            width:50px;
            length:50px;
            box-sizing:border-box;
        }
        table{
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
    <form action="create.php" method="post" enctype="multipart/form-data">
        <table>
        <tr> 
            <th>ISBN</th>   <td><input type="text"name="ISBN" id="ISBN"></td>
        </tr> 
        <tr>
            <th>書籍名稱</th>   <td><input type="text"name="bookName" id="bookName" ></td>
        </tr>
        <tr>
            <th>書籍作者</th>   <td><input type="text"name="author" id="author"></td>
        </tr>
        <tr>
            <th>出版社</th>   <td><input type="text"name="publisher" id="publisher" ></td>
        </tr>
        <tr>
            <th>出版日期</th>   <td><input type="text"name="publish_year" id="publish_year" ></td>
        </tr>
        
        <tr> 
            <th>書籍描述</th>   <td><input type="text"name="describeBook" id="describeBook"></td>
        </tr>
        <tr> 
            <th>書籍數量</th>   <td> <input type="number" min="1" value="1" name="num"  ></td>
        </tr>
        <tr>
            <th>書籍圖片網址</th>   <td><input type="text"name="img_url" id="img_url" ></td>
        </tr>
        <tr> 
            <th>書籍圖片</th>   <td> <input type="file"  name="image"  accept="image/png, image/jpeg,image/gif"></td>
        </tr>
        
       
        <tr>
            <th colspan="2"><input type="submit"></th>
        </tr>   
    </table>
    
</form>
<button id="crawl">自動爬取書籍資料</button>
    <?php
    
    
    ?>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
            $('#crawl').click(function(){
                $.ajax({
                    type: "POST",
                    url: "search_ISBN.php",
                    data : {ISBN : $('#ISBN').val()},
                    success:function(data){
                        var data = JSON.parse(data);
                        document.getElementById("bookName").value = data.book_name;
                        document.getElementById("author").value = data.author;
                        document.getElementById("describeBook").value = data.text;
                        document.getElementById("publisher").value = data.company;
                        document.getElementById("publish_year").value = data.date;
                        document.getElementById("img_url").value = data.img_url;
                    }
                })
            })
        });
</script>
</html>