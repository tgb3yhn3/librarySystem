<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	$request = $_SERVER['REQUEST_URI'];
	echo 'your request'.$request;
	switch ($request) {
		case '/' :
			header("location: /main/index.php");
			break;
		case '' :
			header("location: /main/index.php");
			break;
		
		default:
		echo "search".substr($request,1,strlen($request));
		$host = 'localhost';
		$dbuser ='root';
		$dbpassword = '123456';
		$dbname = 'test';
		$sql="select * from `book` where ISBN=".substr($request,1,strlen($request));
		echo "<br>sql = ".$sql;
		$link = mysqli_connect($host,$dbuser,$dbpassword,$dbname);
		$result = mysqli_query($link,$sql);
		$data=array();
		
		if ($result) {
			echo "<br> in";
			header("location:/main/book.php?ISBN=".substr($request,1,strlen($request)));
		}
			else{//echo $request;
			http_response_code(404);
			require __DIR__ . '/main/404.php';
			}
			break;
	}
	mysqli_close($link);
	exit;
?>
Something is wrong with the XAMPP installation :-(
