
<!--
<?php
$realm = 'Restricted area';

//user => password
$users = array('admin' => 'password');


if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm.
           '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

    die('Text to send if user hits Cancel button');
}


// analyze the PHP_AUTH_DIGEST variable
if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) ||
    !isset($users[$data['username']]))
    die('Wrong Credentials!');


// generate the valid response
$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

if ($data['response'] != $valid_response)
    die('Wrong Credentials!');

// ok, valid username & password
echo 'You are logged in as: ' . $data['username'];


// function to parse the http auth header
function http_digest_parse($txt)
{
    // protect against missing data
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}
?>

--><?php require_once("../../includes/initialize.php"); ?>
<!--
<?php
  $students=null;
  $students=rank_students($_GET['admission_process_id']);
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
    <title>Rank :: GCOEA Hostel</title>
  </head>
  <body>
    <div id="header" class="row">
      <div id="header-col" class="col s12">
        <nav id="main-nav">
          <div class="nav-wrapper">
            <div class="col s12"><a href="#" class="brand-logo">GCOEA Hostels</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="../index.php">Home</a></li>
                <li><a href="home.php">Admin Dashboard</a></li>
                <li><a href="misc.php?action=logout">Logout    </a></li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
      <div id="content-wrapper" class="container">
        <div class="row">
          <div id="content" class="col s8">
            <h4>Admin :: Rank</h4><?php print_message(); ?>
            <table class="striped">
              <thead>
                <tr>
                  <th>Rank</th>
                  <th>College Id</th>
                  <th>Full name</th>
                  <th>Year</th>
                  <th>CGPA CY</th>
                  <th>CGPA PY</th>
                  <th>DOB</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  while($s=mysqli_fetch_assoc($students)){
                    
                    echo "<tr><td>{$s['rank']}</td><td>{$s['college_id']}</td><td>{$s['fname']} {$s['mname']} {$s['lname']}</td><td>{$s['year']}</td><td>{$s['exam_curr']}</td><td>{$s['exam_last']}</td><td>{$s['dob']}</td></tr>";
                  }
                ?>
              </tbody>
            </table>
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