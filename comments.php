<div class="boxchota">
  <h2>Comments</h2>
<?php

  $query = "SELECT *
            FROM `Comments`
            WHERE `blogNo` = $row[blogNo]
            OR `blogNo` = $row[dwdNo]
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
