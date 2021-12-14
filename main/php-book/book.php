<?php 
//POST 前端 用來檢視所選(詳細顯示所選書籍的資訊)
session_start();
require_once("search.php");//包含config.php了
$search=$_GET["search"];
echo get_search_book($search,2);
?>
     