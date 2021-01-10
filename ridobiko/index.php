<!DOCTYPE html>
<html lang="en">
<head>
<title>Ridobiko Assignment</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<style>
.navbar {
  margin-bottom: 0;
  border-radius: 0;
}


footer {
  background-color: #f2f2f2;
  padding: 25px;
}

.card-text{
  padding-left: 0.7em;
  text-align: left;
}
.active-cyan input.form-control[type=text] {
  border-bottom: 1px solid #4dd0e1;
  box-shadow: 0 1px 0 0 #4dd0e1;
}
.row div{
  padding-top:2%;
  padding-bottom:2%
}
.search input{
  size: 50;
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
<a class="navbar-brand" href="#">Ridobiko</a>
</div>
<div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-nav">
<li class="active"><a href="#myNavbar">Home</a></li>
<li><a href="#">Contact</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="register.html"><span class="glyphicon glyphicon-log-in"></span> Register</a></li>
</ul>
</div>
</div>
</nav>

<div class="jumbotron">
<div class="container text-center">
<h1>Ridobiko Assignment</h1>      
<p>Info System</p>
</div>
</div>

<div class="container-fluid bg-3 text-center">
<form action="getUser.php" method="GET">
<div class="md-form active-cyan-2 mb-3 search">
<input class="form-control" type="text" name ="customer_mobile" placeholder="Search Phone Number" aria-label="Search">
</div>
</form>
<br><br>
<div class="row">
<?php 
$resultSet = getAllUserResultSet();
while($resultArray = $resultSet->fetch_assoc()) {
  echo("<div class='col-sm-3'>
  <div class='card' style='width: 30rem;'>
  <img class='card-img-top' src='./upload/$resultArray[adhar_no]profile.$resultArray[profile_img]' alt='Card image cap'>
  <div class='card-body'>
  <h5 class='card-title'>$resultArray[user_name]</h5>
  <a href='./getUser.php?customer_mobile=$resultArray[user_mobile]' class='btn btn-primary'>View Details</a>
  </div>
  </div>
  </div>");
}
?>

</div>
</div><br>

<br><br>

<footer class="container-fluid text-center">
<p>Footer Text</p>
</footer>
<?php
function getConnection() {
  $user = "id15883152_radha";
  $password = "Intelradha@19";
  $dbName = "id15883152_ridobiko";
  $connection = mysqli_connect('localhost',$user,$password,$dbName);
  if(!$connection) {
    die('could not connect to database');
  }
  return $connection;
}
function getAllUserResultSet() {
  $connection = getConnection();
  $query = "select * from user";
  if($resultSet = mysqli_query($connection, $query)) {
    mysqli_close($connection);
    return $resultSet;
  }
  else {
    die('could not connect to database');
  }
  
}
?>
</body>
</html>

