   <!-- ログインページ作ったらこっちやる -->
   <?php 
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "jabank";

      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      $sql = "SELECT * FROM `details`";
      $result = $conn->query($sql);     
    ?>      

        <?php include('sidebar.php') ?>


        <div class="col-md-6" id="middle-block">
          <div class="balance-section">
            <div class="main-title">
              <p>Dashboard</p> 
            </div>
          <div class="alert alert-light" role="alert" id="cr">
            <p><strong>Current balance</strong></p>


              <?php 
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){ 
                 if($_COOKIE['uid'] === $row['uid']){
              ?>

              <h1>$<?php echo $row['balance']; ?>.00</h1>

            <?php
                  }
                }    
               }
             
            ?>

            </div>
          </div>
          <div class="transaction-section">
            <div class="main-title">
              <p>Transaction history</p>
            </div>
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Amount</th>
                  <th scope="col">From</th>
                  <th scope="col">To</th>
                  <th scope="col">Date</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                    <?php
                      $sql1="SELECT * FROM `transactions` WHERE  `uid` = ".$_COOKIE['uid'];//Whereから後ので`uid`をこの時だけに限定するuidがCOOKIE'uid'と同じやつだけechoされるようになる。
                      $result1 = $conn->query($sql1);
                       if($result->num_rows > 0) {
                        while($row = $result1->fetch_assoc()){ 
                         $sql2="INSERT INTO `transactions` (`id`, `uid`, `amount`, `date`) VALUES (NULL, '".$_COOKIE['uid']."', '".$row['amount']."', NOW()))";
                      ?>

                    <th scope="row" class="text-primary">$<?php echo $row['amount']; ?>.00</th>
                     <td><?php echo $_COOKIE['username']; ?></td>

                    <td>
                      <?php 
                          //デバックをしっかしやっていく。一個一個確認しながらやっていく。
                          $sql3="SELECT * FROM `users` WHERE `id` = '".$row['rid']."'";
                          //echo $sql3;
                          $result3=$conn->query($sql3);
                          if($result3->num_rows > 0) {
                            while($row1 = $result3->fetch_assoc()){ 
                               echo $row1['username'];


                             }
                            } 
                      
                      ?>                        
                    </td>
                   
                    <td><?php echo $row['date']; ?></td>
                  </tr>
                 
              <?php 
                      
                 }
                }
              ?>

            </table>
          </div>
        </div>
        <div class="col-md-4" id="right-block">
          <div class="card-title">
            <p>Credit card details</p>
          </div>
          <div class="credit">
            
            <?php 
              $sql3='SELECT * FROM `card_details`';
              $result3 =  $conn->query($sql3);

              if($result3->num_rows > 0) {
                while($row = $result3->fetch_assoc()){ 
                  //print_r($row);//card_details tableの一列の情報が入ってる
                  if($_COOKIE['uid'] === $row['uid']){

            ?>

            <div class="card-detail">
              <h4><?php echo $row['bank']; ?></h4>
              <h4><?php echo $row['cardtype']; ?></h4><br>
              <h5><?php echo $_COOKIE['username']; ?></h5>
              <h5><?php echo $row['cardnumber']; ?></h5>
            </div>
          </div>

          <?php
                }
                }
              }
          ?>

          <div class="invest">
            <h5>Invest your money for better return?</h5>
            <button type="button" class="btn btn-success">Read more</button>
          </div>
        </div>
      </div>

    </div>

   

  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



  </body>
</html>