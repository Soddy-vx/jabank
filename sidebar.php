<?php 
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "jabank";
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Jabank</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2" id="left-block">
          <img src="logo.png" class="logo">
          <div class="user">
            <p>Username :<?php echo $_COOKIE['username']; ?></p>
            <p>User ID : <?php echo $_COOKIE['uid']; ?></p>
          </div>
          <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="transfer.php">Transfer</a></li>
            <li><a href="#">Edit your account</a></li>
            <li><a href="login.php">Logout</a></li>
          </ul>

        </div>
      