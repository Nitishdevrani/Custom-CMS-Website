<?php
session_start();


$error = "";
$msg = "";

  if(array_key_exists("id", $_COOKIE) && $_COOKIE['id']) {
    $_SESSION['id'] = $_COOKIE['id'];
  }

  if(array_key_exists("id",$_SESSION)) {
    include("link.php");

    $query = "SELECT *
              FROM `blogdata`
              WHERE Title = '".mysqli_real_escape_string($link,$_GET['Title'])."'
              LIMIT 1";
    $row = mysqli_fetch_array(mysqli_query($link,$query));



    //form of edit blog started

    if(array_key_exists("updateBlog",$_POST)) {

        if(!$_POST["blogTitle"]) {
          $error .= "Title is empty.<br>";
        }

        if(!$_POST["blogShortDescription"]) {
          $error .= "Short Description is required.<br>";
        }

        if(!$_POST["blogDescription"]) {
          $error .= "Description is mendatory.";
        }

        if($error != "") {
          $error = "<h2>Oh! you missed something...</h2>".$error;
        } else {

          $image = $_FILES['blogPic']['name'];
          $target = "BlogPics/".basename($image);

          $query = "UPDATE `blogdata`
                    SET `Title` = '".mysqli_real_escape_string($link,$_POST['blogTitle'])."',
                        `ShortDisc` = '".mysqli_real_escape_string($link,$_POST['blogShortDescription'])."',
                        `Image` = '$image',
                        `Disc` = '".mysqli_real_escape_string($link,$_POST['blogDescription'])."'
                    WHERE blogdata.Title = '".mysqli_real_escape_string($link,$_GET['Title'])."'
                    LIMIT 1";

                if(mysqli_query($link,$query)) {
                  move_uploaded_file($_FILES['blogPic']['tmp_name'], $target);
                  $msg = "<h2>Success! Your Blog is Updated</h2>";
                  header("Location:userarea.php");
                } else {
                  $error = "<h2>Oh! Your Blog getting some trouble. Please try again Later or Contact us if problem arises repeatedly.</h2>";
                }

        }


    }
// submit area ends here

} // session ends here
   else {
    header("Location:index.php?logout=1");
  }

include("header.php");
include("nav.php");
?>

<div class="container-fluid">

  <div class="row">
    <div class="col-sm-9" style="background-color:rgb(237, 237, 241);">

  <form class="boxchota" method="post" enctype="multipart/form-data">

    <div><?php if ($error != "") {
      echo '<div class="alert alert-warning" role="alert">'.$error.'</div>';
     } ?></div>

     <div><?php if ($msg != "") {
       echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
      } ?></div>

    <fieldset class="form-group">
      <label for="title">Title</label>
      <input class="form-control" type="text" name="blogTitle" value="<?php echo $row['Title']; ?>">
    </fieldset>

    <fieldset class="form-group">
      <label for="Short Discription">Short Description</label>
      <textarea class="form-control" name="blogShortDescription" rows="2" cols="80"><?php echo $row['ShortDisc']; ?></textarea>
    </fieldset>

    <fieldset class="form-group">
      <label for="blogPic">Wanted to change this Image?</label><br>
      <?php echo "<img src='BlogPics/".$row['Image']."' width='100px' height='100px' margin='10px' alt='Image name~".$row['Image']."'"?><br>
      <input class="form-control" type="file" name="blogPic" value="<?php echo $row['Image']; ?>">
    </fieldset>

    <fieldset class="form-group">
      <label for="Discription">Description</label>
      <textarea class="form-control" name="blogDescription" rows="8" cols="80"><?php echo $row['Disc']; ?></textarea>
    </fieldset>

    <fieldset>
      <button type="submit" name="updateBlog" class="btn btn-primary">Update</button>
    </fieldset>

  </form>

</div>
<?php include("rightside.php"); ?>
</div>

</div>

<?php include("footer.php"); ?>
