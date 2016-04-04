<?php require_once("../includes/initialize.php"); ?>
<!--
<?php
  $ad_process=get_admission_process();
  $students=null;
  if(isset($_GET['admission_process_id']))
    $students=public_result($_GET['admission_process_id']);
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
    <title>Result :: GCOEA Hostel</title>
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
            <h4>Result</h4><?php print_message(); ?>
            <form action="result.php" method="get">
              <div class="row">
                <div class="input-field col s6">
                  <select id="admission_process_id" name="admission_process_id">
                    <option value="" disabled selected>Choose your option</option><?php
                     while($ap=mysqli_fetch_assoc($ad_process))
                       echo "<option value=\"{$ap['id']}\">{$ap['academic_year']}</option>";
                     ?>
                  </select>
                  <label for="admission_process_id">Academic year</label>
                </div>
                <div class="col s6"><br>
                  <button type="submit" name="submit" class="btn waves-effect waves-light">Get result</button>
                </div>
              </div>
            </form><?php
              if((!isset($_GET['admission_process_id']))||$students==NULL||($students!=NULL&&mysqli_num_rows($students)<1)) 
                echo "<h3>Results not available yet!</h3>";
              else{
                echo '<table class="striped"><thead><tr><th>Rank</th><th>College Id</th><th>Full name</th><th>Year</th><th>Alloted</th><th>Quota</th></tr></thead><tbody>';
              while($s=mysqli_fetch_assoc($students)){
                $alloted="<span style=\"color: #800;\">No</span>";
                if($s['is_alloted']==1){
                  $alloted="<span style=\"color: #0a0;\">Yes</span>";
               }
                echo "<tr><td>{$s['rank']}</td><td>{$s['college_id']}</td><td>{$s['fname']} {$s['mname']} {$s['lname']}</td><td>{$s['year']}</td><td>{$alloted}</td><td>{$s['alloted_under_quota']}</td></tr>";
              }
              }
              if(isset($_GET['admission_process_id'])&&($students&&mysqli_num_rows($students)>=1))
                echo "</tbody></table>";
            ?>
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