<?php
  $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD);

  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_select_db($conn,DB_NAME);
?>
