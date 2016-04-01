<?php require_once("../../includes/initialize.php"); ?>
<!--
<?php
  $ad_process=get_admission_process();
  if(mysqli_num_rows($ad_process) >= 1){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['count']==""||$_POST['admission_process_id']=="")
      set_error("count or academic year cannot be blank");
    else{
      $tret=generate_save_tokens($_POST['admission_process_id'],$_POST['count']);
      if(tret==0)
        set_success("Tokens generated");
    }
  }
}
  else
    set_error("No admission process found. <a href=\"new_admission_process.php\">Click here</a> to create one.");
?>

--><!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection">
    <link type="text/css" rel="stylesheet" href="../css/main.css" media="screen,projection">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Scripts-->
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate tokens :: GCOEA Hostel</title>
  </head>
  <body>
    <div id="header" class="row">
      <div id="header-col" class="col s12">
        <nav id="main-nav">
          <div class="nav-wrapper">
            <div class="col s12"><a href="#" class="brand-logo">GCOEA Hostels</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="../home.php">Home</a></li>
                <li><a href="home.php">Admin Dashboard</a></li>
                <li><a href="news_updates.php">Logout    </a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
      <div id="content-wrapper" class="container">
        <div class="row">
          <div id="content" class="col s8">
            <h4>Admin :: Generate tokens</h4><?php print_message(); ?>
            <form action="generate_tokens.php" method="post">
              <div class="row">
                <div class="input-field col s12">
                  <select id="admission_process_id" name="admission_process_id">
                    <option value="" disabled selected>Choose your option</option><?php
                     while($ap=mysqli_fetch_assoc($ad_process))
                       echo "<option value=\"{$ap['id']}\">{$ap['academic_year']}</option>";
                     ?>
                  </select>
                  <label for="admission_process_id">Academic year</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Eg 300" id="count" name="count" type="text" class="validate">
                  <label for="count">Count</label>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <button type="submit" name="submit" class="btn waves-effect waves-light">Generate</button>
                </div>
              </div>
            </form>
          </div>
          <div id="right-sidebar" class="col s4">
            <ul class="collection with-header">
              <li class="collection-header">System</li>
              <li><a href="new_admission_process.php" class="collection-item">Admission process</a></li>
              <li><a href="generate_tokens.php" class="collection-item">Tokens</a></li>
              <li><a href="applications.php" class="collection-item">Applications</a></li>
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