<?php require_once("../includes/initialize.php"); ?>
<!--
<?php
  $ap = get_open_admission_process();
  if(mysqli_num_rows($ap)==1){
  $ap=mysqli_fetch_assoc($ap);
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ret=save_student_form($_POST);
    if($ret==0){
      header("Location: ".BASE_URL."success.php?token={$_POST['token']}");
    }
  }
  
}
  else
  {
    header("Location: ".BASE_URL."closed.php");
  }
?>
--><!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection">
    <link type="text/css" rel="stylesheet" href="css/main.css" media="screen,projection">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Scripts-->
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply :: GCOEA Hostel</title>
  </head>
  <body>
    <div id="header" class="row">
      <div id="header-col" class="col s12">
        <nav id="main-nav">
          <div class="nav-wrapper">
            <div class="col s12"><a href="#" class="brand-logo">GCOEA Hostels</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php">Home</a></li>
                <li><a href="news_updates.php">News & Updates</a></li>
                <li><a href="admission.php">Admission</a></li>
                <li><a href="apply.php">Apply</a></li>
                <li><a href="result.php">Result</a></li>
                <li><a href="rules.php">Hostel Rules</a></li>
                <li><a href="admin/home.php">Admin Login    </a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
      <div id="content-wrapper" class="container">
        <div class="row">
          <div id="content" class="col s8">
            <h4>Apply</h4><?php print_message(); ?>
            <p>If you do not have token id, please visit co-operative store to get token.</p>
            <form action="apply.php" method="post"> 
              <div class="card">
                <div class="card-content"><span class="card-title">
                    <h6>Admission form for academic year <?php echo "<b>{$ap['academic_year']}</b>"; ?> </h6></span><?php echo "<input type=\"hidden\" value=\"{$ap['id']}\" name=\"admission_process_id\">"; ?>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="token" name="token" type="text" required class="validate">
                      <label for="token">Token ID</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s4">
                      <input id="fname" name="fname" type="text" required class="validate">
                      <label for="fname">First Name</label>
                    </div>
                    <div class="input-field col s4">
                      <input id="mname" name="mname" type="text" required class="validate">
                      <label for="mname">Middle Name</label>
                    </div>
                    <div class="input-field col s4">
                      <input id="lname" name="lname" type="text" required class="validate">
                      <label for="lname">Last Name</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s4">
                      <input id="college_id" name="college_id" type="text" required class="validate">
                      <label for="college_id">College ID</label>
                    </div>
                    <div class="input-field col s4">
                      <select name="branch_id" required> 
                        <option value="1">Civil</option>
                        <option value="2">Mechanical</option>
                        <option value="3">Electrical</option>
                        <option value="4">Electronics</option>
                        <option value="5">Computer Science</option>
                        <option value="6">Instrumentation</option>
                        <option value="7">Information Technology</option>
                      </select>
                      <label for="branch_id">Branch</label>
                    </div>
                    <div class="input-field col s4">
                      <select name="year" required>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                      </select>
                      <label for="year">Year</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col 6">
                      <select name="blood_group" required> 
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                      </select>
                      <label for="blood_group">Blood Group</label>
                    </div>
                    <div class="input-field col 6">
                      <select name="category" required> 
                        <option value="1">Open</option>
                        <option value="2">OBC</option>
                        <option value="3">SC</option>
                        <option value="4">ST</option>
                        <option value="5">VJ</option>
                        <option value="6">NT1</option>
                        <option value="7">NT2</option>
                        <option value="8">NT3</option>
                      </select>
                      <label for="category">Category</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col12">
                      <input name="gender" type="radio" id="gender_male" value="0" required>
                      <label for="gender_male">Male</label>
                      <input name="gender" type="radio" id="gender_female" value="1" required>
                      <label for="gender_female">Female</label>
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="input-field col12">
                      <input name="dob" type="text" id="dob" required>
                      <label for="dob">Date of birth (yyyy-mm-dd)</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col12">
                      <input type="text" name="exam_curr" required class="materialize-textarea">
                      <label for="exam_curr">CGPA: Current year</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col12">
                      <input type="text" name="exam_last" required class="materialize-textarea">
                      <label for="exam_last">CGPA: Last year</label>
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="input-field col12">
                      <textarea id="p_address" name="p_address" required class="materialize-textarea"></textarea>
                      <label for="p_address">Parent Address</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col12">
                      <input id="p_contact" name="p_contact" type="tel" required class="validate">
                      <label for="p_contact">Parent Contact</label>
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="input-field col12">
                      <textarea id="g_address" name="g_address" required class="materialize-textarea"></textarea>
                      <label for="g_address">Gaurdian Address</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col12">
                      <input id="g_contact" name="g_contact" type="tel" required class="validate">
                      <label for="g_contact">Gaurdian Contact</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col12">
                      <div class="file-field input-field">
                        <div class="btn"><span>Photo</span>
                          <input type="file">
                        </div>
                        <div class="file-path-wrapper">
                          <input type="text" class="file-path validate">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col12">
                      <input type="checkbox" id="ph" name="ph" value="1">
                      <label for="ph">Physically challenged</label>
                    </div>
                  </div>
                </div>
              </div><br>
              <button type="submit" name="action" class="btn waves-effect waves-light">Submit</button>
            </form>
          </div>
          <div id="right-sidebar" class="col s4">
            <ul class="collection with-header">
              <li class="collection-header">Hostels</li>
              <li><a href="sahyadri.php" class="collection-item">Sahyadri</a></li>
              <li><a href="satpuda.php" class="collection-item">Satpuda</a></li>
              <li><a href="jijau.php" class="collection-item">Jijau</a></li>
              <li><a href="new_girls_hostel.php" class="collection-item">New girls hostel</a></li>
            </ul>
            <ul class="collection with-header">
              <li class="collection-header">External links</li>
              <li><a href="#!" class="collection-item">College website</a></li>
              <li><a href="#!" class="collection-item">DTE</a></li>
            </ul>
            <div style="background: url('http://gcoea.ac.in/sites/default/files/seal.png'); background-repeat: no-repeat; opacity: 0.2; width:112px; height: 112px; margin-left: auto; margin-right: auto;"></div>
          </div>
        </div>
      </div>
      <div id="footer" class="row">
        <div class="col s8">
          <p><a href="">Developers</a>&nbsp;|&nbsp; <a href="">About Us</a></p>
          <p>2016 | Government College of Engineering, Amravati</p>
        </div>
        <div class="col s4">
          <p><img src="http://gcoea.ac.in/sites/default/files/gcoea_foot_2.png"></p>
        </div>
      </div>
    </div>
  </body>
</html>