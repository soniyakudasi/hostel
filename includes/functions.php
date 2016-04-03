<?php

  function dump_students(){
    global $conn;
    $result = mysqli_query($conn,"select * from tbl_students");
    while($row=mysqli_fetch_assoc($result))
      echo $row["college_id"]." ".$row["fname"]."<br>";
  }

  function dump_student_by_college_id($college_id){
    global $conn;
    $result = mysqli_query($conn,"select * from tbl_students where college_id='{$college_id}'");
    while($row=mysqli_fetch_assoc($result))
      echo $row["college_id"]." ".$row["fname"]."<br>";
  }

  function print_message(){
    global $green_message;
    global $red_message;
    if(isset($green_message))
      echo "<div class=\"card-panel light-green lighten-2\">{$green_message}</div>";
    if(isset($red_message))
      echo "<div class=\"card-panel red lighten-2\">{$red_message}</div>";
  }

  function set_error($message){
    global $red_message;
    if(isset($red_message))
      $red_message=$red_message."<br>".$message;
    else
      $red_message=$message;
  }

  function set_success($message){
    global $green_message;
    if(isset($green_message))
      $green_message=$green_message."<br>".$message;
    else
      $green_message=$message;
  }

 ?>
