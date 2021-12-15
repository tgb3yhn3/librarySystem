<?php // query_API.php
  $conn = require_once("config.php");
  if ($conn->connect_error) die("Fatal Error");

  $query  = "select bookName,ISBN,author FROM user_favorite_book_data where userID=00857039";
  $result = $conn->query($query);
  if (!$result) die("Fatal Error");

  $rows = $result->num_rows;
  
  $arr = array();

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_assoc();
    array_push($arr,$row);
  }
  
  //set encoding
  header("content-Type: application/json; charset=utf-8");

  //convert to json
  echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);

  $result->close();
  $conn->close();
?>
