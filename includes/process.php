<?php

function create_admission_process($academic_year){
  global $conn;
  $stmt = mysqli_prepare($conn,"insert into tbl_admission_process(academic_year) value(?)");
  $t_ret=mysqli_stmt_bind_param($stmt,"s",$academic_year);
  if(!$t_ret){
    set_error("Failed to bind parameter");
    return 1;
  }
  $t_ret=mysqli_stmt_execute($stmt);
  if(!$t_ret){
    set_error("Failed to execute statement");
    return 1;
  }
  return 0;
}

function get_admission_process(){
  global $conn;
  $result = mysqli_query($conn,"select * from tbl_admission_process order by academic_year desc");
  return $result;
}

function get_open_admission_process(){
  global $conn;
  $result = mysqli_query($conn,"select * from tbl_admission_process where status=0 order by academic_year desc limit 1");
  return $result;
}

function generate_save_tokens($admission_process_id,$count){
  global $conn;
  $smt = mysqli_prepare($conn,"insert into tbl_tokens(token,admission_process_id) values(?,?)");
  for($i=1;$i<=$count;$i++){
    $rand = rand(100,1000000000);
    $t_ret=mysqli_stmt_bind_param($smt,"si",$rand,$admission_process_id);
    if(!$t_ret){
      set_error("Failed to bind parameter");
      return 1;
    }
    $t_ret=mysqli_stmt_execute($smt);
    if(!$t_ret){
      set_error("Failed to execute");
      return 1;
    }
  }
  return 0;
}

?>
