<?php

  function save_student_form($student){
    global $conn;
    // var_dump($student);
    // Get token from token table where academic_year is proper and if its student_id is null
    // Otherwise set_error and return 1 coz token is already used
    $student['token']=mysqli_escape_string($conn,$student['token']);
    $student['admission_process_id']=mysqli_escape_string($conn,$student['admission_process_id']);
    $token=mysqli_query($conn,"select * from tbl_tokens where token=\"{$student['token']}\" and admission_process_id=\"{$student['admission_process_id']}\"");
    $token=mysqli_fetch_assoc($token);
    if($token['student_id']!=NULL){
      set_error("Invalid token id or the token is already used.");
      return 1;
    }

    //validate all student data and return error if any invalid data found
    $student['fname']=mysqli_escape_string($conn,$student['fname']);
    $student['ph']=isset($student['ph'])?mysqli_escape_string($conn,$student['ph']):0;
    //save student info in database and get the inserted id
    $stmt=mysqli_prepare($conn,"insert into tbl_students(college_id,fname,mname,lname,blood_group,category,p_address,p_contact,g_address,g_contact,branch_id,year,gender,ph,exam_curr,exam_last,dob) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($stmt,"sssssisisiiiiidds",$student['college_id'],$student['fname'],$student['mname'],$student['lname'],$student['blood_group'],$student['category'],$student['p_address'],$student['p_contact'],$student['g_address'],$student['g_contact'],$student['branch_id'],$student['year'],$student['gender'],$student['ph'],$student['exam_curr'],$student['exam_last'],$student['dob']);
    $result=mysqli_stmt_execute($stmt);
    if(!$result){
      set_error("Some error occured while executing database statement");
      return 1;
    }
    $student_id=mysqli_stmt_insert_id($stmt);
    //update token row with student_id
    $stmt_t=mysqli_prepare($conn,"update tbl_tokens set student_id=? where token=? and admission_process_id=?");
    mysqli_stmt_bind_param($stmt_t,"isi",$student_id,$student['token'],$student['admission_process_id']);
    $res=mysqli_stmt_execute($stmt_t);
    if(!$res){
      set_error("Unable to update token");
      return 1;
    }
    return 0;
    //set success message and return 0
  }

  function get_applications($admission_process_id,$token=null){
    global $conn;
    if($token==null){
      $ay=mysqli_escape_string($conn,$admission_process_id);
      $query="select * from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$ay} and student_id is not null";
    }
    else{
      $ay=mysqli_escape_string($conn,$admission_process_id);
      $to=mysqli_escape_string($conn,$token);
      $query="select * from tbl_tokens inner join tbl_students on tbl_tokens.student_id=tbl_students.id inner join tbl_branches on tbl_branches.id=tbl_students.branch_id inner join tbl_categories on tbl_categories.id=tbl_students.category where admission_process_id={$ay} and student_id is not null and token={$to}";
    }
    $result=mysqli_query($conn,$query);
    return $result;
  }

  function get_application($student_id)
  {
    global $conn;
    $view=mysqli_escape_string($conn,$student_id);
    $query="select * from tbl_students where id={$view}";
    $result=mysqli_query($conn,$query);
    return $result;
  }

 ?>
