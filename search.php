<?php
include("link.php");

include("header.php");

include("nav.php");

 ?>


<div class="container-fluid">

  <div class="row">

    <div class="col-sm-9 bg-light">

<?php



if(isset($_GET['Search_for'])) {
  $search = mysqli_real_escape_string($link,$_GET['Search_for']);
  $keys = explode(" ",$search);
  $query = "SELECT * FROM `blogdata` WHERE `Title` LIKE '%$search%' ";



  foreach($keys as $k){
    $query .= " OR `Title` LIKE '%$k%' ";
  }
  $result = mysqli_query($link, $query);


  $count = mysqli_num_rows($result);

  if($count == 0){
    echo "<div class='boxchota alert alert-danger'>
        <h1 class='display-4'>No results found for ".$search."</h1>
        </div>";

  }else{
    echo "<h3 class='boxchota alert alert-success'>".$count." results found related to your search.</h3>";

    while($row = mysqli_fetch_assoc($result))
    {

      echo "<div class='container boxchota jumbotron'>


          <h2 class='display-4'>".$row['Title']."</h2>
          <hr class='my-4'>
          <p class='lead'>".$row['ShortDisc']."</p>
          <a class='btn btn-primary btn-lg' href='/showBlog.php?Title=".urlencode($row['Title'])."' role='button'>Read more</a>
      </div>";

    }

  }
}

 ?>


    </div>

      <?php include("rightside.php"); ?>

  </div>
</div>

<?php include("footer.php"); ?>
