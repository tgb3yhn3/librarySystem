<!DOCTYPE html>
<HTML>
<HEAD>
    <link rel="stylesheet" type="text/css" href="../php-book/frontpage.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Search!</title>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img width="50px" height="50px" src="../php-book/ntou_logo.png">
            </a>
            <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-搜尋</span></span>

            <div class="col-md-3 text-end">
            <?php 
          session_start();
          if(isset($_SESSION['username'])){

            // echo ($_SESSION["status"]);
            // echo $_SESSION["admin"];
            echo $_SESSION['username'].'&emsp;你好&emsp;';
            
            echo '<a href="../php-member/logout.php"><button type="button" class="btn btn-primary">登出</button></a>';
          }else{
            echo' <a href="../php-member/login-2.htm"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
            <a href="../php-member/signup-2.htm"><button type="button" class="btn btn-primary">Sign-up</button></a>
         ';
          } ?>
            </div>
        </header>
    </div>
    <span id="tab-1">評分/評論</span>
    <!-- <span id="tab-2">評分</span> -->
        <div id="tab">
            <ul>
                <li><a href="#tab-1">評分/評論</a></li>
                <!-- <li><a href="#tab-2">評分</a></li> -->
            </ul>

            <!-- 頁籤的內容區塊 -->
            <div class="tab-content-1">
                <p>&emsp;</p>
                <form id="usform"action="sentComment.php" method="POST">
                    請輸入評分 :<br><br>
                    <div id="star_rating2">
	                </div>
                    <br>
        請輸入評論 :<br>
         <textarea form="usform" name="context" type="text" maxlength="300" style="border-color:#84C1FF;height:125px;width:100%;"></textarea>
        <input type="hidden" name='username'value='<?php echo  $_SESSION['username'];?>'>
        <input type="hidden" name='ISBN'value='<?php echo  $_GET['book']?>'>
        <input type="hidden" name='num'value='<?php echo  $_GET['num']?>'>
		<input id="Good" type="hidden" name='good'>
        
    
                &emsp;&emsp;&emsp;&emsp;
                <p></p>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" >
                </form>
            </div>
            <!-- <div class="tab-content-2" margin:0 auto>
                <p></p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">一顆星</p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">二顆星</p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">三顆星</p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">四顆星</p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">五顆星</p>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" value="查詢">
            </div> -->
        </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>


            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
    </div>
    <script>
		// create object
		var starRating = ( function() {

			/**
			 * Constructor function
			 *
			 * @param Object args
			 *
			 * @return Object
			 */
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

				if ( self.canRate ) { // do other things if user can rate
					if ( typeof args.onRate !== 'undefined' ) { // bind custom function
						self.onRate = args.onRate;
				    }

					jQuery( '.' + self.starClass ).on( 'mouseover', function() { // mouseover a star
						// determine the percent width on mouseover of any star
						var percentWidth = 20 * jQuery( this ).data( 'stars' );

						// set the percent width  of the star bar to the new mouseover width
						$( '.sr-star-bar' + self.containerId ).css( 'width', percentWidth + '%' );
					});

					jQuery( '.' + self.starClass ).on( 'mouseout', function() { // mouseout of a star
						// return the star rating system percent to its previous percent on mouse out of any star
						jQuery( '.sr-star-bar' + self.containerId ).css( 'width', self.ratingPercent );
					});

					jQuery( '.' + self.starClass ).on( 'click', function() { // click on a star
						// ner rating set to the number of stars the user clicked on
						self.newRating = jQuery( this ).data( 'stars' );

						// determine the percent width based on the stars clicked on
						var percentWidth = 20 * jQuery( this ).data( 'stars' );

						// new rating percent is the number of stars clicked on
						self.ratingPercent = percentWidth + '%';

						// set new star bar percent width
						$( '.sr-star-bar' + self.containerId ).css( 'width', percentWidth + '%' );

						// run the on rate function passed in when the object was created
						self.onRate();
					} );	
				}
			};

			/**
			 * Draw html out to the page
			 *
			 * @param void
			 *
			 * @return void
			 */
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
				ratingPercent: '20%', // percentage star system should start 
				canRate: true, // can the user rate this star system?
				onRate: function() { // this function runs when a star is clicked on
					//alert('You rated ' + rating2.newRating + ' starts' );
					$("#Good").val(rating2.ratingPercent);
				}
			} );
		} );
	</script>
</BODY>
</HTML>