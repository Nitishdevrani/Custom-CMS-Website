<?php
include("link.php");
$query = "DELETE FROM `blogdata` WHERE `Title`='".mysqli_real_escape_string($link,$_GET['Title'])."'";
if(mysqli_query($link,$query)){
  header("refresh:1; url=index.php");
} else {
  echo "Not Deleted";
}

 ?>
