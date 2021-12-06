<?php // insert_API.php

  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die("Fatal Error");

  if (
    isset($_POST['bookName']) &&
    isset($_POST['author']) &&
    isset($_POST['ISBN']) &&
    isset($_POST['describeBook']) &&
    isset($_POST['class']) &&
    isset($_POST['publish_year']) &&
    isset($_POST['publisher']) &&
    isset($_POST['num'])
  ) {
    $author = get_post($conn, 'author');
    $bookName = get_post($conn, 'bookName');
    $ISBN = get_post($conn, 'ISBN');
    $describeBook = get_post($conn, 'describeBook');
    $class = get_post($conn, 'class');
    $publish_year = get_post($conn, 'publish_year');
    $publisher = get_post($conn, 'publisher');
    $num = get_post($conn, 'num');

    $query    = "INSERT INTO test.tt VALUES" .
      "( '$author', '$bookName', '$ISBN', '$describeBook', '$class', '$publish_year', '$publisher', '$num')";
    $result   = $conn->query($query);
    if (!$result) echo "INSERT failed<br><br>";
    else echo "Successful insetion of a new book.";
  }

  $conn->close();

  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }

?>