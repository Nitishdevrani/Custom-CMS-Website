<?php
include("link.php");

include("header.php");

include("nav.php");

 ?>


<div class="container-fluid">

  <div class="row">

    <div class="col-sm-9 bg-light">

<?php



if(isset($_GET['Search_files'])) {
  $search = mysqli_real_escape_string($link,$_GET['Search_files']);
  $keys = explode(" ",$search);
  $query = "SELECT * FROM `dwddata` WHERE `Title` LIKE '%$search%' ";



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

      echo "<div class='card' style='width: 18rem;'>
                     <img class= 'card-img-top' src='dwd/".$row['Image']."' alt='No image available'>
                      <div class='card-body'>
                        <h5 class='card-title'>".$row['Title']."</h5>
                        <p class='card-text'>".$row['ShortDisc']."</p>
                          <a class='btn btn-primary btn-lg' href='/showdwd.php?Title=".urlencode($row['Title'])."' role='button'>Download</a>
                        <p class='blockquote-footer float-right'>".$row['Tareek']."
                        </p>
                      </div>
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
