<?php 
// recommendNewBook.php
$conn = require_once("config.php");
  if ($conn->connect_error) die("Fatal Errorrrr");

  $query  = "SELECT * FROM book  where ISBN<>'' ORDER BY create_time DESC LIMIT 3";
  $result = $conn->query($query);
 
  // echo mysqli_errno($conn);
  if (!$result) die("Fatal Error");

  $rows = $result->num_rows;
  
  $arr = array();

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_assoc();
    $row['bookImage']=base64_encode($row['bookImage']);
    $row['describeBook'] = strip_tags($row['describeBook']);
    array_push($arr,$row);
  }
 
  //set encoding
  header("content-Type: application/json; charset=utf-8");

  //convert to json
  echo json_encode($arr, JSON_UNESCAPED_UNICODE + JSON_PRETTY_PRINT);
  // print_r($arr);
  $result->close();
  $conn->close();
?>