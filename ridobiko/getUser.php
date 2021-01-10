*-<?php
function getConnection() {
  // $user = "root";
  // $password = "";
  // $dbName = "ridobiko";
  $user = "id15883152_radha";
  $password = "Intelradha@19";
  $dbName = "id15883152_ridobiko";
  $connection = mysqli_connect('localhost',$user,$password,$dbName);
  if(!$connection) {
      die('could not connect to database');
  }
  return $connection;
}
function getUserResultSet() {
  $mobile = $_REQUEST['customer_mobile'];
  $connection = getConnection();
  $query = "select * from user where user_mobile='$mobile'";
  if($resultSet = mysqli_query($connection, $query)) {
    mysqli_close($connection);
    return $resultSet;
  }
  else {
    die('could not connect to database');
  }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Info</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    .row{
      text-align:center;
    }
    .row div{
      padding: 2% 0%;
    }
    .row p{
      padding-top:1.5em;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="index.html">Ridobiko</a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.html">Home</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="jumbotron">
        <div class="container text-center">
          <h1>Ridobiko Assignment</h1>      
          <p>User Details</p>
        </div>
      </div>
  <?php
  $resultSet = getUserResultSet();
  while($resultArray = $resultSet->fetch_assoc()) {
    echo("<div class='container'>
      <div class='row'>
        <div class='col-md-6'>
          <img height='200' width='200'  src='./upload/$resultArray[adhar_no]profile.$resultArray[profile_img]'>
        </div>
        <div class='col-md-6'>
          <h4>$resultArray[user_name]</h4>
          <p>$resultArray[user_mobile]</p>
          <p>$resultArray[addr]</p>
        </div>
      </div>
      <div class='row'>

        <div class='col-md-6'>
          <img height='200' width='200' src='./upload/$resultArray[adhar_no]adr_front.$resultArray[adhar_front]'>
        </div>
        <div class='col-md-6'>
          <img height='200' width='200' src='./upload/$resultArray[adhar_no]adr_back.$resultArray[adhar_back]'>
        </div>
      </div>
      <div class='row'>
        <div class='col-md-6'>
          <img height='200' width='200' src='./upload/$resultArray[license_no]license.$resultArray[license_img]'>
        </div>
        <div class='col-md-6'>
          <p>License No: $resultArray[license_no]</p>
          <p>Expiry on: $resultArray[license_exp_date]</p>
        </div>
      </div>
    </div>");
    }
    ?>
</body>
</html>