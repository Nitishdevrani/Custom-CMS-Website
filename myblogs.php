<?php

session_start();
$error = "";
$msg = "";

  if(array_key_exists("id", $_COOKIE) && $_COOKIE['id']) {
    $_SESSION['id'] = $_COOKIE['id'];
  }

  if(array_key_exists("id",$_SESSION)) {
    include("link.php");



    //form of new blog started

    if(array_key_exists("submitBlog",$_POST)) {

        if(!$_POST["blogTitle"]) {
          $error .= "Title is empty.<br>";
        }

        if(!$_POST["blogShortDescription"]) {
          $error .= "Short Description is required.<br>";
        }



        $image = $_FILES['blogPic']['name'];
        $target = "BlogPics/".basename($image);

        if(!$_POST["blogDescription"]) {
          $error .= "Description is mendatory.";
        }

        if($error != "") {
          $error = "<h2>Oh! you missed something...</h2>".$error;
        } else {

          $query = "INSERT INTO `blogdata`(`userId`,`Title`,`Image`,`ShortDisc`,`Disc`)
                    VALUES(
                      '".mysqli_real_escape_string($link,$_SESSION['id'])."',
                      '".mysqli_real_escape_string($link,$_POST['blogTitle'])."',
                      '$image',
                      '".mysqli_real_escape_string($link,$_POST['blogShortDescription'])."',
                      '".mysqli_real_escape_string($link,$_POST['blogDescription'])."'
                    )";

                    if (move_uploaded_file($_FILES['blogPic']['tmp_name'], $target)) {
                  		$msg = "Image uploaded successfully";
                  	}else{
                  		$error = "Failed to upload image";
                  	}

                if(mysqli_query($link,$query)) {
                  $msg = "<h2>Success! Your Blog is Created</h2>";
                } else {
                  $error = "<h2>Oh! Your Blog getting some trouble. Please try again</h2>";
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
         <h1><center>CREATE YOUR BLOG!</center></h1>

         <div><?php if ($error != "") {
           echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
          } ?></div>

          <div><?php if ($msg != "") {
            echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
           } ?></div>

         <fieldset class="form-group">
           <label for="title">Title</label>
           <input class="form-control" type="text" name="blogTitle">
         </fieldset>


         <fieldset class="form-group">
            <label for="blogPic">Add a nice image.</label><br>
            <input type="file" name="blogPic">
        </fieldset>

         <fieldset class="form-group">
           <label for="Short Discription">Short Description</label>
           <textarea class="form-control" name="blogShortDescription" rows="2" cols="80"></textarea>
         </fieldset>

         <fieldset class="form-group">
           <label for="Discription">Description</label>
           <textarea class="form-control" name="blogDescription" rows="8" cols="80"></textarea>
         </fieldset>

         <fieldset>
           <button type="submit" name="submitBlog" class="btn btn-warning">Add</button>
         </fieldset>



       </form>





       <!-- blogs area -->


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

                         $query = "SELECT `Title`,`blogNo` FROM `blogdata` WHERE userId = '$_SESSION[id]'";
                         $result = mysqli_query($link, $query);


//                                                                  ' .urlencode($row['Title']). '


                       while($row = mysqli_fetch_assoc($result))
                       {
                           echo "
                                <tr class='bg-light'>
                                  <td scope='col'>".$row['Title']."</td>


                                  <td scope='col'><button class='btn btn-success' type='button'><a href='/showBlog.php?Title=".urlencode($row['Title'])."'>(o_o)</a></button></td>
                                  <td scope='col'><button class='btn btn-info' type='button'><a href='/editBlog.php?Title=".urlencode($row['Title'])."'> Edit </a></button></td>

                                  <td scope='col'><button class='btn btn-danger' type='button'><a href='/deleteBlog.php?Title=".urlencode($row['Title'])."'>Delete</a></button></td>
                                </tr>";
                       }

                          ?>

                 </tbody>
         </table>



     </div>

<?php include("footer.php"); ?>
