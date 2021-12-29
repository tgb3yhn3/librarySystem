<?php
//後端 function 用來查詢書籍
    if(isset($_POST['modeNum'])){
        $conn= require_once("../config.php");
        
        get_search_book($_POST['search'],$_POST['modeNum'],0,$conn);
       
    }
    function get_search_book($search="",$modeNum=1,$usejson=0,$conn=null){//混沌搜尋 或者 全部列出
    // require_once("cav.php");
     
     $book=array();
     $sql="";
     if($modeNum==0){
        $sql="select * from `book` where num<>'0'";  
     }else if($modeNum==1){//search by book name (渾沌) 此時search為書名
        $sql="select * from `book` where bookName like '%$search%'";
     }else if($modeNum==2){//search by book ISBN 此時search為ISBN
        $sql="select * from `book` where ISBN='".$search."'";
     }else if($modeNum==3){//search by book author
        $sql="select * from `book` where author='%$search%'";
     }else if($modeNum==4||$modeNum==5){//上下架館藏調整
        $sql="select * from `book` where ISBN='$search'";
     }else if($modeNum==6){
        $sql="SELECT * FROM `user_book_history` group by book_unique_ID order by count(book_unique_ID)'";
     }else if($modeNum==7){//討論度排行(先抓討論度>0)
      $sql="SELECT book.*,count(*) as commentnum 
            FROM   book,comment
            where  book.ISBN = comment.ISBN AND SUBSTRING_INDEX(book.bookUniqueID, '_', -1) ='0'
            group  by comment.ISBN
            order  by commentnum DESC";
     }
     $ISBN="";
     $result = mysqli_query($conn,$sql);
     $datas=array();
    //  echo "in";
     if ($result) {
         // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
         if (mysqli_num_rows($result)>0) {
             // 取得大於0代表有資料
             // while迴圈會根據資料數量，決定跑的次數
             // mysqli_fetch_assoc方法可取得一筆值
             while ($row = mysqli_fetch_assoc($result)) {
                 // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                 $datas[] = $row;
             }
         }
         if($modeNum==7){//討論度排行(再抓討論度=0)
            $sql2="SELECT book.*,0 as commentnum 
                   FROM   book
                   where  book.ISBN not in (SELECT comment.ISBN FROM comment) AND
                         SUBSTRING_INDEX(book.bookUniqueID, '_', -1) ='0'";
            $result2 = mysqli_query($conn,$sql2);
            if($result2){
                if (mysqli_num_rows($result2)>0) {
                    // 取得大於0代表有資料
                    // while迴圈會根據資料數量，決定跑的次數
                    // mysqli_fetch_assoc方法可取得一筆值
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        // 每跑一次迴圈就抓一筆值，最後放進data陣列中
                        $datas[] = $row2;
                    }
                }
            }
         }
         // 釋放資料庫查到的記憶體
         mysqli_free_result($result);
     }
     else {
         //echo "找不到書籍" ;
     }
     $return_value="";
     // 處理完後印出資料
     if(!empty($result)){
         if($modeNum!=2)
         $return_value=$return_value."<h3>所有書籍查詢結果</h3>";
         
         for($i=0;$i<count($datas);$i++){
            
            $bookName=$datas[$i]["bookName"];
            $author=$datas[$i]["author"];
            $ISBN=$datas[$i]["ISBN"];
            $publisher=$datas[$i]['publisher'];
            $publish_year=$datas[$i]['publish_year'];
            $sql="SELECT count(status) as num FROM `book` where bookUniqueID like '$ISBN%' and status=0;";
            $num=mysqli_fetch_assoc(mysqli_query($conn,$sql))['num'];
            if($modeNum==7){
                $commentnum = $datas[$i]['commentnum'];    
            }
            // $num=$datas[$i]['num'];
            
            $img="";
            if($datas[$i]["img_url"]!=""){
                $img=$datas[$i]["img_url"];
            }else if($datas[$i]['bookImage']!=""){
                $img="data:'.$datas[$i]['imageType'].';base64,'.base64_encode( $datas[$i]['bookImage'] ).'";
            }else{
                $img="https://png.pngtree.com/png-clipart/20210523/original/pngtree-coffee-and-book-in-line-art-png-image_6304989.jpg";
            }
            
            $describeBook=$datas[$i]["describeBook"];
            if($modeNum!=2)
            $return_value=$return_value."<br>第 ".($i+1)." 筆<br> ";
            else{
                if($usejson==0)
                echo '<img width="300px"height="400px"src='.$img.' />';
            }
            $return_value=$return_value."<h3><a href='book.php?search=".$ISBN."'>$bookName</a><br></h3>";
            if(isset($_SESSION['admin'])&&$_SESSION['admin']==true){
                $return_value=$return_value.'<form action="delete.php" method="POST">
                <input type="hidden" name="delete" value="'.$ISBN.'" />
                <input type="submit" value="刪除此書"/>
            </form>';
            }
            $return_value=$return_value."author:$author<br>";
            $return_value=$return_value."ISBN:$ISBN<br>";
            $return_value=$return_value."describeBook:".($modeNum==2?$describeBook:mb_substr($describeBook,0,400))."......<br>";
            
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true&&$modeNum==2){
                $return_value=$return_value. '<form action="sentComment.php" method="POST">
                <input type="text" name="context">
                <input type="hidden" name="username" value='.$_SESSION['username'].'>
                <input type="hidden" name="ISBN" value='.$ISBN.'>
                <input type="submit" value="送出評論">
            </form>';
        }
            $bookdata=new stdClass();
            $bookdata->bookName=$bookName;
            $bookdata->author=$author;
            $bookdata->ISBN=$ISBN;
            $bookdata->img=$img;
            $bookdata->describeBook=$describeBook;
            $bookdata->publisher=$publisher;
            $bookdata->publish_year=$publish_year;
            $bookdata->num=$num;
            if($modeNum==7){
                $bookdata->commentnum=$commentnum;    
            }
            array_push($book,$bookdata);
            $return_value=$return_value."<hr>";
            if($modeNum==4){
                $data=new stdClass();
                $data->bookName=$bookName;
                $data->author=$author;
                echo iconv(mb_detect_encoding(json_encode($data)), "utf-8", json_encode($data));
                 
                
            }
            if($modeNum==5){
                
                $bookdata->img=$datas[$i]["img_url"];
                echo iconv(mb_detect_encoding(json_encode($bookdata)), "utf-8", json_encode($bookdata));
                 
                
            }
        }
       }
     else {
         // 為空表示沒資料
         $return_value="查無資料";
     }
     
    //  echo json_encode($book);
   
    if($usejson==0){
        return $return_value;
    }else if($usejson==1){
        return $book;
    }
    //  return json_encode($book, JSON_UNESCAPED_UNICODE);
    
    }
    
     ?>
     

