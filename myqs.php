<?php

session_start();
$error = "";
$msg = "";

  if(array_key_exists("id", $_COOKIE) && $_COOKIE['id']) {
    $_SESSION['id'] = $_COOKIE['id'];
  }

  if(array_key_exists("id",$_SESSION)) {
    include("link.php");



    //form of new dwd started

    if(array_key_exists("submitqs",$_POST)) {

        if(!$_POST["university"]) {
          $error .= "Please enter University Name.<br>";
        }

        if(!$_POST["Course"]) {
          $error .= "Please Enter the Course.<br>";
        }

	if(!$_POST["qsSub"]) {
          $error .= "Please Enter the Subject.<br>";
        }


        

        $upld = $_FILES['qsFile']['name'];
        $aim = "Papers/".basename($upld);



        if($error != "") {
          $error = "<h2>Oh! you missed something...</h2>".$error;
        } else {

          $query = "INSERT INTO `paperdata`(`userId`,`uniName`,`uniCourse`, `uniSem`, `uniSub`, `pprDocu`)
                    VALUES(
                      '".mysqli_real_escape_string($link,$_SESSION['id'])."',
                      '".mysqli_real_escape_string($link,$_POST['university'])."',
		      '".mysqli_real_escape_string($link,$_POST['Course'])."',
		      '".mysqli_real_escape_string($link,$_POST['qsSem'])."',
		      '".mysqli_real_escape_string($link,$_POST['qsSub'])."',
                      '$upld'
                    )";

                   

                    if (move_uploaded_file($_FILES['qsFile']['tmp_name'], $aim)) {
                  		$msg .= "File uploaded successfully";
                  	}else{
                  		$error .= "Failed to upload File";
                  	}

                if(mysqli_query($link,$query)) {
                  $msg = "<h2>Success! Your Paper is Uploaded</h2>";
                } else {
                  $error = "<h2>Oh! Your Paper getting some trouble. Please try again</h2>";
                }

        }


    }


  } else {
    header("Location:index.php?logout=1");
  }
?>

<?php include("header.php");?>
<?php include("nav.php");?>


 <div class="container-fluid bg-light"  style="padding:100px;">





       <form class="boxchota" style="border-radius:30px;" method="post" enctype="multipart/form-data">
         <h1><center>ADD MORE QUESTION PAPERS!!</center></h1>
		<h2><center>WRITE IN CAPITAL LETTERS ONLY!!</center></h2>

         <div><?php if ($error != "") {
           echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
          } ?></div>

          <div><?php if ($msg != "") {
            echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
           } ?></div>

         <fieldset class="form-group">
           <label for="UNIVERSITY">UNIVERSITY NAME</label>
           <input class="form-control" type="text" name="university">
         </fieldset>

	<fieldset class="form-group">
           <label for="Course">Course</label>
           <input class="form-control" type="text" name="Course">
         </fieldset>

	<fieldset class="form-group">
           <label for="qsSem">Semester</label>
           <input class="form-control" type="number" name="qsSem">
         </fieldset>

	<fieldset class="form-group">
           <label for="Subject">Subject</label>
           <input class="form-control" type="text" name="qsSub">
         </fieldset>

	

        <fieldset class="form-group">
           <label for="qsFile">Upload Your File</label><br>
           <input type="file" name="qsFile">
       </fieldset>

         

         <fieldset>
           <button type="submit" name="submitqs" class="btn btn-info">Add</button>
         </fieldset>



       </form>





       <!-- dwds area -->


       <table class="table">
                 <thead>

                         <tr class="bg-warning">

                           <th scope="col">University</th>
                           <th scope="col">Course</th>
                           <th scope="col">Semester</th>
                           <th scope="col">Subject</th>

                         </tr>

                 </thead>

                 <tbody>

<?php

                         $query = "SELECT `uniName`,`uniCourse`, `uniSem`,`uniSub` FROM `paperdata` WHERE userId = '$_SESSION[id]'";
                         $result = mysqli_query($link, $query);


//                                                                  ' .urlencode($row['Title']). '


                       while($row = mysqli_fetch_assoc($result))
                       {
                           echo "
                                <tr class='bg-light'>
                                <td scope='col'>".$row['uniName']."</td>
				<td scope='col'>".$row['uniCourse']."</td>
				<td scope='col'>".$row['uniSem']."</td>
				<td scope='col'>".$row['uniSub']."</td>
                                </tr>";
                       }

                          ?>

                 </tbody>
         </table>



     </div>

<?php include("footer.php"); ?>
