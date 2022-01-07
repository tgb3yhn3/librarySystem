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
$isFavorite = false;
if(isset($_SESSION['userID'])){
    if($_SESSION["admin"]!=true){
        $isFavorite=isFavorite($conn,$search,$_SESSION['userID']);//使用者
    }
    else{
        $isFavorite=false;//管理員
    }
}
else{
    $isFavorite=false;//訪客
}
// echo $book;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
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
    .bt_comment_love{
        background-repeat: no-repeat;
        /* background-position: left; */
        background-size: 20px;
        background-position:9px 9px;
        border: none;
        background-color: #FFF2F2;
        color: white;
        font-size: 10px;
        padding: 10px;/*按鈕內邊距離*/
        width: 40px;/*按鈕寬*/
        border-radius: 25px;/*圓角*/
        background-image:url(love.png);
    }
    .bt_sure:hover{
        background-color: #000;
        color: #fff;
    }
    .bt_love:hover{
        background-color: #000;
        color: #fff;
    }
    .comment{
        /* border:2px solid rgb(189, 234, 252); */
        border-bottom: solid rgb(189, 234, 252);
        
    }
    #context{
        word-break: break-all;
        width:100%;
    }
 
    .card {
        margin-right: 10px;
    }
    .scroll{
        max-height: 550px;
        overflow-y: auto;
    }
    .comment_scroll{
        max-height: 300px;
        overflow-y: auto;
    }
    @import url('https://fonts.googleapis.com/css?family=Montserrat:600&display=swap');
    .heart-btn{
    position: absolute;
    top: 50%;
    right:-6%;
    transform: translate(-50%,-50%);
    }
    .content{
    padding: 5px 8px;
    display: flex;
    border: 2px solid #eae2e1;
    border-radius: 5px;
    cursor: pointer;
    }
    .content.heart-active{
    border-color: #f9b9c4;
    background: #fbd0d8;
    }
    .heart{
    position: absolute;
    background: url("img.png") no-repeat;
    background-position: left;
    background-size: 2900%;
    height: 60px;
    width: 60px;
    top: 50%;
    left: 25%;
    transform: translate(-50%,-50%);
    }
    .text{
    font-size: 15px;
    margin-left: 30px;
    color: grey;
    font-family: 'Montserrat',sans-serif;
    }
    .numb:before{
    content: '12';/*點讚數*/
    font-size: 15px;
    margin-left: 7px;
    font-weight: 600;
    color: #9C9496;
    font-family: sans-serif;
    }
    .numb.heart-active:before{
    content: '13';/*點讚數*/
    color: #000;
    }
    .text.heart-active{
    color: #000;
    }
    .heart.heart-active{
    animation: animate .8s steps(28) 1;
    background-position: right;
    }
    @keyframes animate {
    0%{
        background-position: left;
    }
    100%{
        background-position: right;
    }
    }

    @media (max-width: 768px) {
        .bt_sure {
            width: 150px;/*按鈕寬*/
        }
        .bt_love {
            width: 150px;/*按鈕寬*/    
        }
    }
    @media (max-width: 576px) {
        .bt_sure {    
            background-size: 25px;
            background-position:7px 7px;
            width: 130px;/*按鈕寬*/    
        }
        .bt_love {
            background-size: 25px;
            background-position:7px 7px;
            width: 130px;/*按鈕寬*/ 
        }
    }
    </style>
    <script>
            function reserve_post(){
                book.action = "reserve_book.php";
                book.submit();
            }
            
		// create object
		var starRating = ( function() {

			var starRating = function( args ) {
				// give us our self
				var self = this;

				// set global vars for our object
				self.container = jQuery( '#' + args.containerId );
				self.containerId = args.containerId;
				self.starClass = 'sr-star' + args.containerId;
				self.starWidth = args.starWidth;
				self.starHeight = args.starHeight;
				self.containerWidth = args.starWidth * 5;
				self.ratingPercent = args.ratingPercent;
				self.newRating = 0;
				self.canRate = args.canRate;

				// draw the 5 star rating system out to the dom
				self.draw();
			};

			starRating.prototype.draw = function() {
				var self = this;
				var pointerStyle = ( self.canRate ? 'cursor:pointer' : '' );
				var starImg = '<img src="staroutline.png" style="width:' + self.starWidth + 'px" />';
				var html = '<div style="width:' + self.containerWidth + 'px;height:' + self.starHeight + 'px;position:relative;' + pointerStyle + '">';

				// create the progress bar that sits behinde the png star outlines
				html += '<div class="sr-star-bar' + self.containerId + '" style="width:' + self.ratingPercent + ';background:#FFD700;height:100%;position:absolute"></div>';

				for ( var i = 0; i < 5; i++ ) { // add each star to the page
					var currStarStyle = 'position:absolute;margin-left:' + self.starWidth * i + 'px';
					html += '<div class="' + self.starClass + '" data-stars="' + ( i + 1 ) + '" style="' + currStarStyle + '">' + 
						starImg + 
					'</div>';
				}

				html += '</div>';

				// write out to the dom
				self.container.html( html );
			};

			// return it all!
			return starRating;
		} )();

		$( function() {
			var rating2 = new starRating( { // create second star rating system on page load
				containerId: 'star_rating2', // element id in the dom for this star rating system to use
				starWidth: 30, // width of stars
				starHeight: 30, // height of stars
				ratingPercent: '50%', // percentage star system should start 
				canRate: true, // can the user rate this star system?
				onRate: function() { // this function runs when a star is clicked on
					console.log( rating2 );
					alert('You rated ' + rating2.newRating + ' starts' );
				}
			} );
		} );
        //comment_heart
        $(document).ready(function(){
        $('.content').click(function(){
          $('.content').toggleClass("heart-active")
          $('.text').toggleClass("heart-active")
          $('.numb').toggleClass("heart-active")
          $('.heart').toggleClass("heart-active")
        });
      });
	</script>
    
</head>
<body>
<div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img width="50px" height="50px"src="ntou_logo.png">
        </a>
        <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-書籍資訊</span></span>
  
        <div class="col-md-3 text-end">
        <?php 
        //   session_start();
          if(isset($_SESSION['username'])){

            // echo ($_SESSION["status"]);
            // echo $_SESSION["admin"];
            echo $_SESSION['username'].'&emsp;你好&emsp;';
            
            echo '
            <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="../php-member/logout.php" class="text-decoration-none"><button type="button" class="dropdown-item ">登出</button></a>
                <a href="../php-member/change.php" class="text-decoration-none"><button type="button" class="dropdown-item ">修改密碼</button></a>
            </div>
          </div>
          ';
          }else{
            echo' <a href="../php-member/login-2.htm"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
            <a href="../php-member/signup-2.htm"><button type="button" class="btn btn-primary">Sign-up</button></a>
         ';
          } ?>
        </div>
      </header>
    </div>
    <!-- Teset -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-8">
                <div class="card-body">
                    <h3 class="card-title text-center"><?php echo $book[0]->bookName ?></h3>                
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="card col-4 " >
                <img src="<?php echo $book[0]->img ?>" class="card-img">
                <div class="card-body row justify-content-center w-auto" id="star_rating2">
                </div>
                <div class="card-body text-center ">
                    <form name="book" method="POST" >
                        <input type = "hidden" id = "userID" name="userID" value = "<?php if(isset($_SESSION['userID'])){echo $_SESSION['userID'];} ?>"><br>
                        <input type = "hidden" id = "ISBN" name="ISBN" value = "<?php echo $book[0]->ISBN ?>"><br>
                    <?php echo($book[0]->num==0&&isset($_SESSION['username']))?' <input type="button"  class ="btn bt_sure" value="預約租書" onClick="reserve_post()" >':''?>
                    </form>
                </div>
                <div class="card-body text-center">
                    <form action="../php-favorite/favoriteBook_API.php" method="POST">
                        <input type="hidden" name="ISBN"value="<?php echo $search;  ?>"/>
                        <input type="hidden" name="bookName"value="<?php echo $book[0]->bookName;  ?>"/>
                        <?php if(isset($_SESSION['username'])){
                        echo '<input  type ="submit" class="bt_love" value=" '.($isFavorite?'移除':'加入').' 最愛"></input>';}?>
                    </form>  
                </div>
            </div>
            <div class="card col-4 ">
                <div class="card-body scroll" >
                    <p>作者： <?php echo $book[0]->author ?>
                        <br> 
                       出版社：<?php echo $book[0]->publisher ?>
                        <br>  
                       出版日期：<?php echo $book[0]->publish_year ?>
                        <br> 
                       ISBN:    <?php echo $book[0]->ISBN ?>
                        <br>
                       內容:
                        <br>
                        <?php echo $book[0]->describeBook ?>  
            </div>
            <div class="card-footer bg-transparent text-center">剩餘: <?php echo $book[0]->num ?></div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">    
            <div class="card col-8 comment_scroll">
                    <div class="list-group list-group-flush">
                    <?php 
                        for($i=0;$i<count($comment);$i++){
                    echo'
                      <a class="list-group-item">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">'.$comment[$i]->username.'</strong>
                            <div class="heart-btn ">
                                <div class="content">
                                    <span class="heart"></span>
                                    <span class="text">Like</span>
                                    <span class="numb"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 mb-1 small">'.$comment[$i]->context.'</div>
                      </a>
                      ';
                        }
                      ?>
    
    
                    </div>
            </div>
        </div>
    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>


            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
    </div>
    
</body>
     
</html>
