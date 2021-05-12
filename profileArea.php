<?php

session_start();


  if(array_key_exists("id", $_COOKIE) && $_COOKIE['id']) {
    $_SESSION['id'] = $_COOKIE['id'];
  }

  if(array_key_exists("id",$_SESSION)) {
    include("link.php");
  } else {
    header("Location:index.php?logout=1");
  }
?>
<?php include("header.php");?>
<?php include("nav.php");?>


        <div class="container-fluid" style="background-color:rgb(177, 222, 218);padding:100px;">

          <div class="pull-xs-right">
            <a href ='index.php?logout=1'>
              <button class="btn btn-outline-danger" type="submit">Logout</button></a>
          </div>

                <div class="card-deck">


            <div class="card" style="box-shadow:-10px -16px 20px rgb(65, 68, 69); margin:30px;">
              <a href="myblogs.php">
                <img class="card-img-top" src="BlogPics/setting.png" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><center>ADD/EDIT BLOG</center></h5>
                </div>
              </a>
              </div>


              <div class="card"style="box-shadow:-10px -16px 20px rgb(65, 68, 69);margin:30px;">
                <a href="myliveProjects.php">
                <img class="card-img-top" src="BlogPics/tv.png" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><center>ADD/EDIT LIVE PROJECT</center></h5>
              </div>
              </a>
              </div>


              <div class="card"style="box-shadow:-10px -16px 20px rgb(65, 68, 69);margin:30px;">
                <a href="myqs.php">
                <img class="card-img-top" src="BlogPics/pause.png" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><center>ADD/EDIT QUESTION PAPER</center></h5>
              </div>
              </a>
              </div>


              </div>

              <div class="card-deck" style="margin-top:100px;">


            <div class="card" style="box-shadow:-10px -16px 20px rgb(65, 68, 69);margin:30px;">
              <a href="mysqp.php">
              <img class="card-img-top" src="BlogPics/trans-mail.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><center>ADD/EDIT SOLVED QUESTION PAPER</center></h5>
              </div>
              </a>
            </div>


            <div class="card"style="box-shadow:-10px -16px 20px rgb(65, 68, 69);margin:30px;">
              <a href="myadmissions.php">
              <img class="card-img-top" src="BlogPics/home.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><center>ADD/EDIT ADMISSION</center></h5>
            </div>
            </a>
            </div>


            <div class="card"style="box-shadow:-10px -16px 20px rgb(65, 68, 69);margin:30px;">
              <a href="myjobs.php">
              <img class="card-img-top" src="BlogPics/coin.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><center>ADD/EDIT JOBS</center></h5>
            </div>
            </a>
            </div>


            </div>

            <div class="card-deck" style="margin-top:100px;">


          <div class="card" style="box-shadow:-10px -16px 20px rgb(65, 68, 69);margin:30px;">
            <a href="mytutorials.php">
            <img class="card-img-top" src="BlogPics/bucket.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><center>ADD/EDIT TUTORIAL</center></h5>
            </div>
            </a>
          </div>


          <div class="card"style="box-shadow:-10px -16px 20px rgb(65, 68, 69);margin:30px;">
            <a href="mydownloads.php">
            <img class="card-img-top" src="BlogPics/dwd.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><center>ADD/EDIT DOWNLOADS</center></h5>
          </div>
          </a>
          </div>


          <div class="card"style="box-shadow:-10px -16px 20px rgb(65, 68, 69);margin:30px;">
            <a href="myservices.php">
            <img class="card-img-top" src="BlogPics/car.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><center>ADD/EDIT SERVICES</center></h5>
          </div>
          </a>
          </div>


          </div>


        </div>




<?php include("footer.php"); ?>
