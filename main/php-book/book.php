<?php 
//POST 前端 用來檢視所選(詳細顯示所選書籍的資訊)
session_start();
$conn=require_once("../config.php");
require_once("search.php");//包含config.php了
require_once("../php-comment/comment.php");
require_once("../php-favorite/isFavorite.php");
$search=$_GET["search"];
$book=get_search_book($search,2,1,$conn);
$comment=get_comment($search,$conn);
$isFavorite=isFavorite($conn,$search);
// echo $book;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>書籍資訊</title>
    <style>
    h1 {
        text-align: center;
        color: #000000;  
    }
    h2 {
        text-align: center;
        line-height: 6px;
     
        color: #000000;  
    }
    .bt_sure {
        background-image:url(sure.png);
        background-repeat: no-repeat;
        /* background-position: left; */
        background-size: 30px;
        background-position:10px 5px;
        border: none;
        background-color: #a5a5a5;
        color: white;
        font-size: 15px;
        padding: 10px;/*按鈕內邊距離*/
        width: 180px;/*按鈕寬*/
        border-radius: 5px;/*圓角*/
    }
    .bt_love {
        
        

        background-repeat: no-repeat;
        /* background-position: left; */
        background-size: 30px;
        background-position:10px 5px;
        border: none;
        background-color: #a5a5a5;
        color: white;
        font-size: 15px;
        padding: 10px;/*按鈕內邊距離*/
        width: 180px;/*按鈕寬*/
        border-radius: 5px;/*圓角*/
        <?php 
    if($isFavorite){
         echo 'background-image:url(loveed.png);' ;
    }else{
        echo 'background-image:url(love.png);' ;
    }?>
    }
    .bt_sure:hover{
        background-color: #000;
        color: #fff;
    }
    .bt_love:hover{
        background-color: #000;
        color: #fff;
    }table{
       
    }
    .comment{
        /* border:2px solid rgb(189, 234, 252); */
        border-bottom: solid rgb(189, 234, 252);
        
    }
    #context{
        word-break: break-all;
        width:100%;
    }
    #sent{
        width:auto;
    }
    
    </style>
    <script>
            function reserve_post(){
                book.action = "reserve_book.php";
                book.submit();
            }
    </script>
</head>
<body>
    <div style="text-align:center">
        <table style = "margin:auto">
            <tr>
                <td>
                    <img width="100px" height="100px"src="ntou_logo.png">
                </td>
                <td>
                    <h1>海大資工系圖書館系統</h1>
                    <h2>書籍資訊</h2> 
                </td>
            </tr>
        </table>
    </div>
    <div style="position:absolute;left:32%;">
        <table>
            <tr>
                <td>
                    <div style="border:2px rgb(0, 0, 0) solid;">
                     <img id="img"width="180px" height="180px" src="<?php echo $book[0]->img ?>">;
                    </div><br>
                    <div style="border:2px rgb(0, 0, 0) solid;">
                        <img  width="25px" height="25px" src="star.png">
                        <img width="25px" height="25px" src="star.png">
                        <img width="25px" height="25px" src="star.png">
                        <img width="25px" height="25px" src="star.png">
                        <img width="25px" height="25px" src="star.png">
                        <a>5.0</a>
                    </div><br>
                    <div style="text-align: center;">
                    <form name="book" method="POST" >
                        <input type = "hidden" id = "userID" name="userID" value = "<?php echo $_SESSION['userID'] ?>"><br>
                        <input type = "hidden" id = "ISBN" name="ISBN" value = "<?php echo $book[0]->ISBN ?>"><br>
                        <input type="button"  class ="bt_sure" value="預約租書" onClick="reserve_post()">
                    </form>
                    </div><br>
                    <div style="text-align: center;">
                    <form action="../php-favorite/addFavoriteBook_API.php" method="POST">
                        <input type="hidden" name="ISBN"value="<?php echo $search;  ?>"/>
                        <input type="hidden" name="bookName"value="<?php echo $book[0]->bookName;  ?>"/>
                        <input  type ="submit" class="bt_love" value="<?php echo($isFavorite?'移除':'加入') ?>最愛"></input>
                    </form>
                    </div>
                </td>
                <td>
                    <div style="border:2px rgb(0, 0, 0) solid;height:50px;width:50%;overflow:auto;">
                        <h3><?php echo $book[0]->bookName ?></h3>
                    </div><br>
                    <div style="border:2px rgb(0, 0, 0) solid;height:200px;overflow:auto;width:50%;">
                        <p>作者： <?php echo $book[0]->author ?>
                            <br> 
                           出版社：<?php echo $book[0]->publisher ?>
                            <br>  
                           出版日期：<?php echo $book[0]->publish_year ?>
                            <br> 
                           ISBN:<?php echo $book[0]->ISBN ?>
                            <br>
                           內容:
                            <br>
                            <?php echo $book[0]->describeBook ?>     
                        </p>
                    </div><br>
                    <div style="text-align: center;width:50%;">
                        <p style="border:2px rgb(0, 0, 0) solid;">剩餘: <?php echo $book[0]->num ?></p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    
    <div style="position:absolute;left:32%;border:2px rgb(0, 0, 0) solid;height:200px;width:40%;overflow-x:hidden;top:70%">
    <?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    //     echo '<form action="../php-comment/sentComment.php" method="POST">
        
    //     <input id="context"type="text" width=80% name="context">
    //     <input type="hidden" name="username" value='.$_SESSION['username'].'>
    //     <input type="hidden" name="ISBN" value='.$search.'>
    //     <input id="sent"type="submit" value="送出評論">
        
    // </form>';
    }
    ?>    
    <table >
            <?php
            for($i=0;$i<count($comment);$i++){
                echo '<tr >
                <td class="comment">
                    '.$comment[$i]->username.':
                </td>
                <td  id="context" class="comment">
                    '.$comment[$i]->context.'
                </td>
               
            </tr>';
             
            }
            ?>
        </table>
    </div>
    
</body>
     
</html>;
