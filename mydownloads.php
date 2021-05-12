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

    if(array_key_exists("submitdwd",$_POST)) {

        if(!$_POST["dwdTitle"]) {
          $error .= "Title is empty.<br>";
        }

        if(!$_POST["dwdShortDescription"]) {
          $error .= "Short Description is required.<br>";
        }



        $image = $_FILES['dwdPic']['name'];
        $target = "dwd/".basename($image);

        $upld = $_FILES['dwdFile']['name'];
        $aim = "dwd/".basename($upld);



        if($error != "") {
          $error = "<h2>Oh! you missed something...</h2>".$error;
        } else {

          $query = "INSERT INTO `dwddata`(`userId`,`Title`,`Image`,`ShortDisc`,`File`)
                    VALUES(
                      '".mysqli_real_escape_string($link,$_SESSION['id'])."',
                      '".mysqli_real_escape_string($link,$_POST['dwdTitle'])."',
                      '$image',
                      '".mysqli_real_escape_string($link,$_POST['dwdShortDescription'])."',
                      '$upld'
                    )";

                    if (move_uploaded_file($_FILES['dwdPic']['tmp_name'], $target)) {
                  		$msg = "Image uploaded successfully<br>";
                  	}else{
                  		$error = "Failed to upload image<br>";
                  	}

                    if (move_uploaded_file($_FILES['dwdFile']['tmp_name'], $aim)) {
                  		$msg .= "File uploaded successfully";
                  	}else{
                  		$error .= "Failed to upload File";
                  	}

                if(mysqli_query($link,$query)) {
                  $msg = "<h2>Success! Your FIle is Uploaded</h2>";
                } else {
                  $error = "<h2>Oh! Your File getting some trouble. Please try again</h2>";
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
         <h1><center>UPLOAD SOME DATA ON WEB!</center></h1>

         <div><?php if ($error != "") {
           echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
          } ?></div>

          <div><?php if ($msg != "") {
            echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
           } ?></div>

         <fieldset class="form-group">
           <label for="title">Title</label>
           <input class="form-control" type="text" name="dwdTitle">
         </fieldset>


         <fieldset class="form-group">
            <label for="dwdPic">Add a nice image.</label><br>
            <input type="file" name="dwdPic">
        </fieldset>

        <fieldset class="form-group">
           <label for="dwdFile">Upload Your File</label><br>
           <input type="file" name="dwdFile">
       </fieldset>

         <fieldset class="form-group">
           <label for="Short Discription">Short Description</label>
           <textarea class="form-control" name="dwdShortDescription" rows="2" cols="80"></textarea>
         </fieldset>

         <fieldset>
           <button type="submit" name="submitdwd" class="btn btn-info">Add</button>
         </fieldset>



       </form>





       <!-- dwds area -->


       <table class="table">
                 <thead>

                         <tr class="bg-warning">

                           <th scope="col">Title</th>
                           <th scope="col">View</th>
                           <th scope="col">Edit</th>
                           <th scope="col">Delete</th>

                         </tr>

                 </thead>

                 <tbody>

<?php

                         $query = "SELECT `Title`,`dwdNo` FROM `dwddata` WHERE userId = '$_SESSION[id]'";
                         $result = mysqli_query($link, $query);


//                                                                  ' .urlencode($row['Title']). '


                       while($row = mysqli_fetch_assoc($result))
                       {
                           echo "
                                <tr class='bg-light'>
                                  <td scope='col'>".$row['Title']."</td>


                                  <td scope='col'><button class='btn btn-success' type='button'><a href='/showdwd.php?Title=".urlencode($row['Title'])."'>(o_o)</a></button></td>
                                  <td scope='col'><button class='btn btn-info' type='button'><a href='/editdwd.php?Title=".urlencode($row['Title'])."'> Edit </a></button></td>

                                  <td scope='col'><button class='btn btn-danger' type='button'><a href='/deletedwd.php?Title=".urlencode($row['Title'])."'>Delete</a></button></td>
                                </tr>";
                       }

                          ?>

                 </tbody>
         </table>



     </div>

<?php include("footer.php"); ?>
