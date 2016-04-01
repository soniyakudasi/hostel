<?php require_once("../../includes/initialize.php"); ?>
<!--
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['academic_year']=="")
      set_error("Academic year cannot be blank");
    else{
    $t_ret=create_admission_process($_POST['academic_year']);
    if($t_ret==0)
      set_success("Academic year saved!");
  }

  }
  
  $aps=get_admission_process();
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
    <title>Create new admission process :: GCOEA Hostel</title>
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
            <h4>Admin :: Create new admission process</h4><?php print_message(); ?>
            <form action="new_admission_process.php" method="post"> 
              <div class="row">
                <div class="input-field col s12">
                  <input placeholder="Eg 2015-2016" id="academic_year" name="academic_year" type="text" class="validate">
                  <label for="academic_year">Academic year</label>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <button type="submit" name="submit" class="btn waves-effect waves-light">Create</button>
                </div>
              </div>
              <div class="row">
                <div class="col s12">
                  <table class="striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Academic year</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if(mysqli_num_rows($aps)==0){
                          echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";  
                       }
                        else{
                          while($a=mysqli_fetch_assoc($aps)){
                           echo "<tr><td>{$a['id']}</td><td>{$a['academic_year']}</td><td>{$a['status']}</td><td><a href=\"new_admission_process.php?id={$a['id']}&action=togglestatus\">Close</a></td></tr>"; 
                        }
                       } 
                      ?>
                    </tbody>
                  </table>
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