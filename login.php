  <?php 
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "jabank";
      $error = "";

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      if(isset($_POST['username']) && isset($_POST['pass']) && $_POST['username']!='' && $_POST['pass']!=''){
          $error='Please login';
          $sql = "SELECT * FROM `users`";
          $result = $conn->query($sql);
          //print_r($result);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              if($_POST['username'] === $row['username'] && $_POST['pass'] === $row['password']){
               $error="yay";
               if($error!='Please login'){
                  setcookie('uid',$row['id']);
                  setcookie('username',$row['username']);
                  header('Location:index.php');
                }
                }
              }
          }
        } 
        // else{
        //           $error= "login failed!!";
        //           header('Location:login.php');
        //         }
        
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
        <img src="logo.png" class="img-fluid" id="log_img">
      </div>
      <div class="row">
        <form action="login.php" method="post">
          <div class="form-label">Username :</div>
          <input type="text" name="username" placeholder="Registered name">
          <div class="form-label">Password :</div>
          <input type="password" name="pass" placeholder="password"><br>
          <input type="submit" name="login" value="Login" class="btn btn-info">
          <p>You don't have your account yet? --><a href="register.php">Register</a></p>
          <div class="alert alert-danger" role="alert">
             <?php echo $error; ?>
          </div>
        </form>
      </div>
    
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



  </body>
  </html>