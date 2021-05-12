<?php
session_start();
include("link.php");



$query = "SELECT dwddata.Title,dwddata.ShortDisc,dwddata.Tareek,dwddata.Image,dwddata.dwdNo,dwddata.File,members.Name
          FROM `dwddata`
          INNER JOIN `members`
          ON members.id = dwddata.userId
          WHERE dwddata.Title='".mysqli_real_escape_string($link,$_GET['Title'])."'";
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
                VALUES('$row[dwdNo]',
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
        <?php echo "<img src='dwd/".$row['Image']."' class='img-fluid' >"; ?><hr>
        <p style="font-size:20px;" ><?php echo $row['ShortDisc']; ?></p>
        <button type="download" name="download" class="btn btn-light text-white"><a href='dwd/<?php echo $row['File'] ?>' download>Download file</a></button>
        <p class="blockquote-footer float-right">
          <?php echo $row['Tareek']; ?>
          <cite title="writer"> <b>By  <?php echo $row['Name']; ?></b></cite>
        </p>
    </div>


<!-- Comment Section -->
<div class="boxchota">
  <h2>Comments</h2>
<?php

  $query = "SELECT *
            FROM `Comments`
            WHERE `blogNo` = $row[dwdNo]
            ORDER BY Time DESC";
  $result = mysqli_query($link, $query);




  while($row = mysqli_fetch_assoc($result))
  {
    echo "<div class='alert alert-primary' role='alert'>
      <h4>".$row['commenterName']."</h4>
      <form method='post'>
      <button class='btn btn-success' style='float:right;' type='submit' name='".$row['cno']."'>Like ".$row['likes']."</button>
      </form>
      <hr>
      <p>".$row['message']."</p>
      <p>".$row['Time']."</p>
    </div>";

    if(array_key_exists("$row[cno]",$_POST)){
      $query = "UPDATE `Comments` SET likes = ($row[likes]+1) WHERE cno = $row[cno] LIMIT 1";
      if(!mysqli_query($link,$query)){
        echo "nothing happening";
      }
    }
  }


?>
</div>


<form class="boxchota" method="post">

  <h1 class="text-center text-info" >Wanna Comment!</h1>

  <div><?php if ($comment_error != "") {
    echo '<div class="alert alert-warning" role="alert">'.$comment_error.'</div>';
   } ?></div>

   <div><?php if ($comment_success != "") {
     echo '<div class="alert alert-success" role="alert">'.$comment_success.'</div>';
    } ?></div>

  <fieldset class="form-group">
    <label for="commenterName">Name</label>
    <input class="form-control" type="text" name="commenterName">
  </fieldset>
  <fieldset class="form-group">
    <label for="commenterEmail">email</label>
    <input class="form-control" type="email" name="commenterEmail">
  </fieldset>
  <fieldset class="form-group">
    <label for="message">Write your comment here!</label>
    <textarea class="form-control" name="message" rows="8" cols="80"></textarea>
  </fieldset>
  <button class="btn btn-success" type="submit" name="sendComment">Comment</button>
</form>


    </div>



<?php include("rightside.php"); ?>
  </div>

</div>

<?php include("footer.php"); ?>
