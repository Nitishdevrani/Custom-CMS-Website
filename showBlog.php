<?php
session_start();
include("link.php");



$query = "SELECT blogdata.Title,blogdata.Disc,blogdata.Tareek,blogdata.Image,blogdata.blogNo,members.Name
          FROM `blogdata`
          INNER JOIN `members`
          ON members.id = blogdata.userId
          WHERE blogdata.Title='".mysqli_real_escape_string($link,$_GET['Title'])."'";
$row = mysqli_fetch_array(mysqli_query($link, $query));



include("header.php");
include("nav.php");

$comment_error = "";
$comment_success = "";



  if(array_key_exists("sendComment",$_POST)) {

    if($_POST['commenterName'] == '' OR $_POST['commenterEmail'] == '' OR $_POST['message'] == '') {
      $comment_error = "Please fill all required fields.";
    } else {

      $query = "INSERT INTO `Comments`(`blogNo`,`commenterName`,`commenterEmail`,`message`)
                VALUES('$row[blogNo]',
                      '".mysqli_real_escape_string($link,$_POST['commenterName'])."',
                      '".mysqli_real_escape_string($link,$_POST['commenterEmail'])."',
                      '".mysqli_real_escape_string($link,$_POST['message'])."')";

                if(mysqli_query($link,$query)) {
                  $comment_success = "Great! Your comment added successfully.";
                } else {
                  $comment_error = "Ohh! Something went wrong, Please try again.";
                }

    }


  }


?>

<div class="container-fluid">

  <div class="row">
    <div class="col-sm-9" style="background-color:rgb(237, 237, 241);">

      <div class="container bg-light rounded text-info" style="margin-top:50px;padding:50px;box-shadow:8px 8px 13px rgb(47, 48, 48);">
        <h1>
          <?php echo $row['Title']; ?>
        </h1>
        <hr>
        <?php echo "<img src='BlogPics/".$row['Image']."' class='img-fluid' >"; ?><hr>
        <p style="font-size:20px;" ><?php echo $row['Disc']; ?></p>
        <p class="blockquote-footer float-right">
          <?php echo $row['Tareek']; ?>
          <cite title="writer"> <b>By  <?php echo $row['Name']; ?></b></cite>
        </p>
    </div>


<?php include("comments.php"); ?>
    </div>



<?php include("rightside.php"); ?>
  </div>

</div>

<?php include("footer.php"); ?>
