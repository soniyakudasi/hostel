<?php require_once("../includes/initialize.php"); ?><!DOCTYPE html>
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
    <title>Closed :: GCOEA Hostel</title>
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
            <h4>Closed</h4><?php print_message(); ?>
            <p>Admission process has been closed. Thank you!</p>
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