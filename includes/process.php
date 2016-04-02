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

function approve($admission_process_id,$token){
  global $conn;
  $student=get_applications($admission_process_id, $token);
  $student=mysqli_fetch_assoc($student);
  //var_dump($student);
  return mysqli_query($conn,"update tbl_students set is_valid=1 where id={$student['student_id']}");
}

function rank_students($admission_process_id){
  global $conn;
  for($i=1;$i<=4;$i++){
    $brank=0;
    $grank=0;
    $arank=0;
    $order_query="select tbl_students.id, token, fname, lname, gender, exam_curr, exam_last, dob, rank, is_alloted from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$admission_process_id} and year={$i} and student_id is not null and is_valid=1 and is_alloted is null order by exam_curr desc, exam_last desc, dob desc";
    $result=mysqli_query($conn,$order_query);
    while($row=mysqli_fetch_assoc($result)){
      if($row['gender']==0){
        $brank+=1;
        $arank=$brank;
      }else{
        $grank+=1;
        $arank=$grank;
      }
      $query="update tbl_students set rank={$arank} where id={$row['id']}";
      mysqli_query($conn,$query);
    }
  }
  $order_query="select tbl_students.id, college_id, token, fname, mname, lname, gender, exam_curr, exam_last, dob, rank, is_alloted, year from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$admission_process_id} and student_id is not null and is_valid=1 and is_alloted is null order by year, gender, rank";
  $result=mysqli_query($conn,$order_query);
  return $result;
}

?>
