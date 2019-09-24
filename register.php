 <?php 
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "jabank";
      $message = "";

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      if(isset($_POST['username']) && isset($_POST['pass']) && $_POST['username']!='' &&  $_POST['pass']!=''){

         $sql ="INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '".$_POST['username']."', '".$_POST['pass']."')";
         $result=$conn->query($sql);
         header('Location:index.php');

        }

         $conn->close();

  ?>

 <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="login.css" />

      <title>jaBank</title>
    </head>
    <body>
      <div class="center">
        <img src="logo.png">
      </div>

      <div class="container-fluid">
      <div class="row">
        <form action="register.php" method="post">
          <h1>Registration</h1>
          <div class="form-label">Username :</div>
          <input type="text" name="username" placeholder="Your name">
          <div class="form-label">Password :</div>
          <input type="password" name="pass" placeholder="Your password"><br>
          <input type="submit" name="login" value="Register your account!" class="btn btn-warning">
          <a href="login.php"><-- Go back</a>
        </form>
      </div>
      </div>
    
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



  </body>
  </html>