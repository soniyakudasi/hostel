<?php require_once("../../includes/initialize.php"); ?>
<!--
<?php
  $result=get_applications($_GET['admission_process_id'],$_GET['token']);
  $result1=approve($_GET['student_id']);
  if(isset($_GET["approve"])
    if($result1==0)
      set_success("Student Approved");
    else
      set_error("Could not approve");
  else 
    if(isset($_GET["cancel"])
      set_error("The application not approved.");
    else 
      if(isset($_GET["edit"])
        set_error("Edit the form.");
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
    <title>View Application :: GCOEA Hostel</title>
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
            <h4>Admin :: View Application</h4><?php print_message(); ?>
            <form action="view_application.php" method="get">
              <div class="row">
                <div class="col s12">
                  <?php
                   $va=mysqli_fetch_assoc($result);
                   ?>
                  <div class="card application-form">
                    <div class="card-content">
                      <p class="card-title"> 
                        <h5 style="color: #222"><?php echo $va['fname']." ".$va['mname']." ".$va['lname']; ?></h5>
                        <hr><br>
                      </p>
                      <div class="row">
                        <div class="col s3"><span class="label">Token Number</span></div>
                        <div class="col s9"><span><?php echo $va['token']; ?></span></div>
                      </div>
                      <div class="row">
                        <div class="col s3"><span class="label">College ID </span></div>
                        <div class="col s3"><span><?php echo $va['college_id']; ?> </span></div>
                        <div class="col s2"><span class="label">Year </span></div>
                        <div class="col s4"><span><?php echo $va['year']; ?></span></div>
                      </div>
                      <div class="row"> 
                        <div class="col s3"><span class="label">Branch </span></div>
                        <div class="col s9"><span><?php echo $va['branch_name']; ?> </span></div>
                      </div>
                      <div class="row">
                        <div class="col s3"><span class="label">Blood Group</span></div>
                        <div class="col s3"><span><?php echo $va['blood_group']; ?></span></div>
                        <div class="col s2"><span class="label">Category</span></div>
                        <div class="col s4"><span><?php echo $va['category_name']; ?></span></div>
                      </div>
                      <div class="row">
                        <div class="col s3"><span class="label">Parent Address</span></div>
                        <div class="col s9"><span><?php echo $va['p_address']; ?></span></div>
                      </div>
                      <div class="row">
                        <div class="col s3"><span class="label">Parent Contact</span></div>
                        <div class="col s9"><span><?php echo $va['p_contact']; ?></span></div>
                      </div>
                      <div class="row">
                        <div class="col s3"><span class="label">Gaurdian Address</span></div>
                        <div class="col s9"><span><?php echo $va['g_address']; ?></span></div>
                      </div>
                      <div class="row">
                        <div class="col s3"><span class="label">Gaurdian Contact</span></div>
                        <div class="col s9"><span><?php echo $va['g_contact']; ?></span></div>
                      </div>
                      <div class="row">
                        <div class="col s3"><span class="label">Gender</span></div>
                        <div class="col s3"><span><?php if($va['gender']==0) echo "Male"; else echo "Female"; ?></span></div>
                        <div class="col s2"><span class="label">PH</span></div>
                        <div class="col s4"><span><?php if($va['ph']==0) echo "No"; else echo "Yes"; ?></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <form action="view_application.php" method="GET">   
              <div class="row">
                <div class="col s4">
                  <button type="submit" name="action" value="approve" class="btn waves-effect waves-light light-green lighten-1">Approve</button>
                </div>
                <div class="col s4">
                  <button type="submit" name="action" value="cancel" class="btn waves-effect waves-light grey">Cancel</button>
                </div>
                <div class="col s4">
                  <button type="submit" name="action" value="edit" class="btn waves-effect waves-light red accent-1">Edit</button>
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