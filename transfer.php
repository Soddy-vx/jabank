      <?php include('sidebar.php') ?>   
      <?php 
          $sql="SELECT * FROM `details`";
          $result = $conn->query($sql);  
          if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()){
                if($_COOKIE['uid'] === $row['uid']){   

        ?>

         <!-- 1.残高から送金金額を引いてAvailable balanceに反映させる.
              2.Typed amountを　引いた残高をloggedIn user の　balanceに反映させる
              3.Typed amountを  RecieverのBalanceに反映させる
              4.-->
            <?php 
                $sql="SELECT * FROM `details` where uid=".$_COOKIE['uid'] ;//detailsテーブルのuid＝ログインユーザーID
                // Whereの後にuidなどをつけることで、ループを限定できる。
                $result= $conn->query($sql);//query details table

                  if ($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()){//detailsの一列＝rowをfetchする

                      $sql2 = "SELECT * FROM `users`";//userテーブルを使いたい

                      $result2 = $conn->query($sql2);//usertable問い合わせ

                      if(isset($_POST['tr-user'])){//tr-userに何か書き込まれる＝trueであれば->

                        if ($result2->num_rows > 0) {

                          while($row2 = $result2->fetch_assoc()) {//print_r($row2); $row2 is user table rowのこと

                              if($_POST['tr-user'] == $row2['username']){//もし、typed nameがrow２（userTableのusername）とイコールなら
                                $rid=$row2['id'];//usertable のID

                                $sql3="SELECT * FROM `details`";//select details table
                                $result3= $conn->query($sql3);//query details table

                                  if ($result3->num_rows > 0) {
                                    while($row3 = $result3->fetch_assoc()){//$row3はdetailsTableの一つ一つのrow

                                      if($rid == $row3['uid']){//userTableのidがdetailsTableのuidと同じなら
                                               
                                        $rbal = $row3['balance'];//$rbal=detailsTableのbalanceとする。
                                      }
                                    }
                                  }
                                      //echo $rid.'   '.$rbal;
                                }     
                            }
                        }
                      }    

                    if(isset($_POST['amount']) && $_POST['amount']!==''){//amountがセットされブランクでもなければ、
                      $b = $row['balance'] - $_POST['amount'];//$bは,detailsテーブルからインプットされた分の値を引く。
                      $sql1 = "UPDATE `details` SET `balance` = '".$b."' WHERE `details`.`id` = '".$row['uid']."';";//$sql1は、detailsに$bをUpdateする。つまり、引かれた後のAmountを$bの変数に入れて使ってる。

                      $result1 = $conn->query($sql1);//$sql1に問い合わせる（実行する）。
                     
                      

                      if(isset($_POST['transfer'])){//transfer Buttonがisset ＝　押された時、

                        $b = $rbal + $_POST['amount'];//$bは、$rbal（=detailsテーブルのbalance）+ typed amountにする。

                        $sql2="UPDATE `details` SET `balance` = '".$b."' WHERE `details`.`id` = '".$rid."';";
                        //detals tableのbalanceを足した後のamountにUpdateする.
                        //場所は、detailsのidのとこ＝（＄rid＝userTableのid）。

                        $result2= $conn->query($sql2);//それを問い合わせる。
                        //echo $sql2;



                       $sql3="INSERT INTO `transactions` (`id`, `uid`, `rid`, `amount`, `date`) VALUES (NULL, '".$_COOKIE['uid']."', '".$rid."', '".$_POST['amount']."', NOW());";
                       //echo $sql3;
                        $result3 = $conn->query($sql3);


                        
                       header('Location:index.php');//headerをつけないとFormがresetされない。


                      
                        //}
                      
                     } 
                    }
                        
                        

              ?>

              


            <div class="col-md-6" id="middle-block">
              <div class="balance-section">
                <div class="alert alert-light" role="alert" id="box">
                      <h2 id="current-balance">
                        <strong>Available balance__________</strong>
                      </h2>

                      <h1 id="amount">$<?php echo $row['balance']; ?>.00</h1>
                  </div>

                  
                   <form action="transfer.php?uid=<?php echo $row['uid']; ?> " method="post"
                      class="<?php 
                        if(isset($_POST['tr-user'])){
                        //ここすごく大事！！クラスネームに条件文を入れることにより条件によってそれを出現させたり消したりできる。CSSを変えれば効果も変わる。
                          echo "hidethis";
                        }

                        ?>"
                   >
                    <p class="text-center">Who do you want to transfer??</p>
                    <input type="text" name="tr-user" style="width: 30%; margin-left:35%;" id="us">
                  </form>

                 <?php
                      
                      
                    }
                    
                  }
                 ?>

            

                <?php 
                  $name='';
                  if(isset($_POST['tr-user'])){
                        $sql="SELECT * FROM `users` WHERE `username` = '".$_POST['tr-user']."'";
                        $result= $conn->query($sql);
                        if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()){
                               $name = $_POST['tr-user']; 

                ?>
                 </div>
                  <div class="row" id="secondRow">

                    <div class="col-md-4 tr">
                      <img src="user.jpg" class="userimg" ><br>
                      Sender:<?php echo $_COOKIE['username']; ?>
                    </div>

                    <div class="col-md-4 tr">
                      <img src="arrow1.png" id="arrowpc">
                      <img src="arrowSp.png" id="arrowsp">
                    </div>

                    <div class="col-md-4 tr">

                      <img src="user.jpg" class="userimg" >
                      <br>
                      <p>Reciever : <?php echo $name; ?> </p>
                    </div>
                  </div>

              <?php if($_POST['tr-user']!== $row['username']){ ?>
               <div class="alert alert-danger" role="alert" id='caution'>
                  <?php echo "Type correct user name!"; ?>
               </div>
              <?php

                     }
                  }
                }
              }

              ?>

              <div class="row">
                  <form action="transfer.php" method="post" class="transfer-form">
                    <input type="hidden" name="tr-user" value='<?php echo $_POST['tr-user'] ?>'>
                    <input type="text" name="amount" placeholder="Type amount..." >
                    <input type="submit" name="transfer" value="transfer" class="btn btn-warning" >
                  </form>
              </div>
            </div>

          <?php 
                }
              }
            }

          ?>


     </body>
     </html>