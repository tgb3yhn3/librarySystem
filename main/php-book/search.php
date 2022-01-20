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
              FROM   book JOIN comment USING(ISBN)
              where  SUBSTRING_INDEX(book.bookUniqueID, '_', -1) ='0'
              group  by comment.ISBN
              order  by commentnum DESC";
     }else if($modeNum==8){//最多人借閱排行(先抓借閱數>0)
        $sql="SELECT book.*,count(*) as borrownum 
              FROM   book JOIN user_book_history on book.ISBN = SUBSTRING_INDEX(user_book_history.book_unique_ID, '_', 1)
              where  user_book_history.book_status <>'已預約'
              group by book.ISBN
              order by borrownum DESC";
     }else if($modeNum==9){//評分排行(先抓有被評分過的)
        $sql="SELECT book.*,avg(good)/20 as star 
              FROM   book JOIN comment USING(ISBN)
              where  SUBSTRING_INDEX(book.bookUniqueID, '_', -1) ='0'
              group  by comment.ISBN
              order  by star DESC";
     }else if($modeNum==10){//進階搜尋(至少含1個以上搜尋條件,若無勾選任何條件則與「$modeNum==0」時是一樣的搜尋結果)
        $sql="select * from `book` where num<>'0'";
        if(isset($_SESSION["adv_bookname"])){
            $adv_bookname = $_SESSION["adv_bookname"];
            $sql=$sql." and bookName like '%$adv_bookname%'";
        }
        if(isset($_SESSION["adv_author"])){
            $adv_author = $_SESSION["adv_author"];
            $sql=$sql." and author like '%$adv_author%'";
        }
        if(isset($_SESSION["adv_ISBN"])){
            $adv_ISBN = $_SESSION["adv_ISBN"];
            $sql=$sql." and ISBN like '%$adv_ISBN%'";
        }
        if(isset($_SESSION["adv_publisher"])){
            $adv_publisher = $_SESSION["adv_publisher"];
            $sql=$sql." and publisher like '%$adv_publisher%'";
        }
        if(isset($_SESSION["adv_publish_year_s"]) && isset($_SESSION["adv_publish_year_g"])){
            $adv_publish_year_s = $_SESSION["adv_publish_year_s"]." 00:00:00";
            $adv_publish_year_g = $_SESSION["adv_publish_year_g"]." 23:59:59";
            $sql=$sql."and unix_timestamp(publish_year) >= unix_timestamp('$adv_publish_year_s') and unix_timestamp(publish_year) <= unix_timestamp('$adv_publish_year_g')  ";
        }
        else if(isset($_SESSION["adv_publish_year_s"])){
            $adv_publish_year_s = $_SESSION["adv_publish_year_s"]." 00:00:00";
            $sql=$sql." and unix_timestamp(publish_year) >= unix_timestamp('$adv_publish_year_s') ";
        }
        else if(isset($_SESSION["adv_publish_year_g"])){
            $adv_publish_year_g = $_SESSION["adv_publish_year_g"]." 23:59:59";
            $sql=$sql." and unix_timestamp(publish_year) <= unix_timestamp('$adv_publish_year_g') ";
        }
        if(isset($_SESSION["adv_create_time_s"]) && isset($_SESSION["adv_create_time_g"])){
            $adv_create_time_s = $_SESSION["adv_create_time_s"]." 00:00:00";
            $adv_create_time_g = $_SESSION["adv_create_time_g"]." 23:59:59";
            $sql=$sql."and unix_timestamp(create_time) >= unix_timestamp('$adv_create_time_s') and unix_timestamp(create_time) <= unix_timestamp('$adv_create_time_g')  ";
        }
        else if(isset($_SESSION["adv_create_time_s"])){
            $adv_create_time_s = $_SESSION["adv_create_time_s"]." 00:00:00";
            $sql=$sql." and unix_timestamp(create_time) >= unix_timestamp('$adv_create_time_s') ";
        }
        else if(isset($_SESSION["adv_create_time_g"])){
            $adv_create_time_g = $_SESSION["adv_create_time_g"]." 23:59:59";
            $sql=$sql." and unix_timestamp(create_time) <= unix_timestamp('$adv_create_time_g') ";
        }
        if(isset($_SESSION["adv_class"])){
            $adv_class = $_SESSION["adv_class"];
            $sql=$sql." and class = '$adv_class'";
        }
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
         else if($modeNum==8){//最多人借閱排行(再抓借閱數=0)
            $sql2="SELECT book.*,0 as borrownum 
                   FROM   book
                   where  book.ISBN not in (SELECT SUBSTRING_INDEX(user_book_history.book_unique_ID,'_', 1) FROM user_book_history) AND
                          book.ISBN <> ''";
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
         else if($modeNum==9){//評分排行(再抓沒被評分過的)
            $sql2="SELECT book.*,0 as star 
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
            $class=$datas[$i]['class'];
            $sql="SELECT count(status) as num FROM `book` where bookUniqueID like '$ISBN%' and status=0;";
            $num=mysqli_fetch_assoc(mysqli_query($conn,$sql))['num'];
            if($modeNum==7){
                $commentnum = $datas[$i]['commentnum'];    
            }
            if($modeNum==8){
                $borrownum = $datas[$i]['borrownum'];    
            }
            if($modeNum==9){
                $star= $datas[$i]['star'];    
            }
            // $num=$datas[$i]['num'];
            
            $img="";
            if($datas[$i]["img_url"]!=""){
                $img=$datas[$i]["img_url"];
            }else if($datas[$i]['bookImage']!=""){
                $img="data:".$datas[$i]['imageType'].';base64,'.base64_encode( $datas[$i]['bookImage'] );
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
            $bookdata->class=$class;
            if($modeNum==7){
                $bookdata->commentnum=$commentnum;    
            }
            else if($modeNum==8){
                $bookdata->borrownum=$borrownum;    
            }
            else if($modeNum==9){
                $bookdata->star=$star;    
            }
            if(isset($_SESSION['adv_inventory'])){
                $adv_inventory = $_SESSION['adv_inventory'];
                if($adv_inventory=="inventory_in"){//館內有庫存(可借閱)
                    if($bookdata->num != 0){
                        array_push($book,$bookdata);
                    }
                }
                else if($adv_inventory=="inventory_not_in"){//館內無庫存(需預約)
                    if($bookdata->num == 0){
                        array_push($book,$bookdata);
                    }
                }
                else{//全部
                    array_push($book,$bookdata);
                }
            }else{//全部
                array_push($book,$bookdata);
            }
            
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
     

