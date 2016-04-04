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
    $order_query="select tbl_students.id, token, fname, lname, gender, exam_curr, exam_last, dob, rank, is_alloted from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$admission_process_id} and year={$i} and student_id is not null and is_valid=1 and is_alloted is null and rank=0 order by exam_curr desc, exam_last desc, dob desc";
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
  $order_query="select tbl_students.id, college_id, token, fname, mname, lname, gender, exam_curr, exam_last, dob, rank, is_alloted, year, alloted_under_quota from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$admission_process_id} and student_id is not null and is_valid=1 order by year, gender, rank";
  $result=mysqli_query($conn,$order_query);
  return $result;
}

function admit_students($admission_process_id){
  global $conn;
  #Check if result is already calculated
  #If yes then return with records and don't calculate again
  $query0="select * from tbl_admission_process where id={$admission_process_id} and result=1";
  $result0=mysqli_query($conn,$query0);
  if(mysqli_num_rows($result0)==1){
    $order_query="select tbl_students.id, college_id, token, fname, mname, lname, gender, exam_curr, exam_last, dob, rank, is_alloted, year, alloted_under_quota from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$admission_process_id} and student_id is not null and is_valid=1 order by year, gender, rank";
    $result=mysqli_query($conn,$order_query);
    return $result;
  }
  #Repeat for all year using below loop
  for($i=1;$i<=4;$i++){
    #Repeat for all branches (This should come from database ideally)
    for($j=1;$j<=7;$j++){
      #Repeate for both genders
      for($k=0;$k<=1;$k++){
        #Get seats for open category and allot them
        $catquery="select * from tbl_categories where category_name='open'";
        $catresult=mysqli_query($conn,$catquery);
        while($cat=mysqli_fetch_assoc($catresult)){
          $query="select * from tbl_allocations where admission_process_id={$admission_process_id} and year={$i} and branch_id={$j} and gender={$k} and category_id={$cat['id']}";
          $result=mysqli_query($conn,$query);
          if(mysqli_num_rows($result)==1){
            $result=mysqli_fetch_assoc($result);
            $seats=$result['seats'];
            $query2="select tbl_students.id, college_id, token, fname, mname, lname, gender, rank, is_alloted, branch_id, year from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$admission_process_id} and branch_id={$j} and gender={$k} and year={$i} and student_id is not null and is_valid=1 and is_alloted is null order by rank limit {$seats}";
            $result2=mysqli_query($conn,$query2);
            while($row=mysqli_fetch_assoc($result2)){
              $query3="update tbl_students set is_alloted=1, alloted_under_quota=\"{$cat['category_name']}\" where id={$row['id']}";
              mysqli_query($conn,$query3);
            }
          }
        }

        #Get seats for other categories and allot them
        $catquery="select * from tbl_categories where category_name<>'OPEN'";
        $catresult=mysqli_query($conn,$catquery);
        while($cat=mysqli_fetch_assoc($catresult)){
          $query="select * from tbl_allocations where admission_process_id={$admission_process_id} and year={$i} and branch_id={$j} and gender={$k} and category_id={$cat['id']}";
          $result=mysqli_query($conn,$query);
          if(mysqli_num_rows($result)==1){
            $result=mysqli_fetch_assoc($result);
            $seats=$result['seats'];
            $query2="select tbl_students.id, college_id, token, fname, mname, lname, gender, rank, is_alloted, branch_id, year from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$admission_process_id} and branch_id={$j} and gender={$k} and year={$i} and category={$cat['id']} and student_id is not null and is_valid=1 and is_alloted is null order by rank limit {$seats}";
            $result2=mysqli_query($conn,$query2);
            while($row=mysqli_fetch_assoc($result2)){
              $query3="update tbl_students set is_alloted=1, alloted_under_quota=\"{$cat['category_name']}\" where id={$row['id']}";
              mysqli_query($conn,$query3);
            }
          }
        }
      }
    }
  }
  $query3="update tbl_admission_process set result=1 where id={$admission_process_id}";
  mysqli_query($conn,$query3);
  $order_query="select tbl_students.id, college_id, token, fname, mname, lname, gender, exam_curr, exam_last, dob, rank, is_alloted, year, alloted_under_quota from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$admission_process_id} and student_id is not null and is_valid=1 order by year, gender, rank";
  $result=mysqli_query($conn,$order_query);
  return $result;
}

function reset_admission($admission_process_id){
  global $conn;
  $query="update tbl_students set is_alloted=NULL, rank=0, alloted_under_quota=NULL";
  $query3="update tbl_admission_process set result=0 where id={$admission_process_id}";
  mysqli_query($conn,$query);
  mysqli_query($conn,$query3);
}

function public_result($admission_process_id){
  global $conn;
  $query0="select * from tbl_admission_process where id={$admission_process_id} and result=0";
  $result0=mysqli_query($conn,$query0);
  if(mysqli_num_rows($result0)==1){
    return false;
  }
  $order_query="select tbl_students.id, college_id, token, fname, mname, lname, gender, exam_curr, exam_last, dob, rank, is_alloted, year, alloted_under_quota from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$admission_process_id} and student_id is not null and is_valid=1 order by year, gender, rank";
  $result=mysqli_query($conn,$order_query);
  return $result;
}
?>
