<?php
      include("link.php");

      include("header.php");

      include("nav.php");
?>

<div class="container-fluid">

  <div class="row">

    <!-- Mid Area starts here-->

            <div class="col-sm-9 middleside">
	<div class="container boxchota">
	<form method="get" action="search_download.php" class="form-inline my-2 my-lg-0">
            <input name="Search_files" class="form-control mr-sm-2" type="search" placeholder="Search Any File" aria-label="Search">
            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
          </form>
	</div>

    <?php
    $loadMore = 10;
      if(array_key_exists("load",$_POST)) {
        $loadMore = $loadMore + 10;
      }

              $query = "SELECT dwddata.Title,dwddata.ShortDisc,dwddata.Tareek,dwddata.Image,members.Name
                        FROM `dwddata`
                        INNER JOIN `members`
                        ON members.id = dwddata.userId
                        ORDER BY `dwddata`.`dwdNo` DESC
                        LIMIT $loadMore";
              $result = mysqli_query($link, $query);

echo "<div class='card-columns'>";
              while($row = mysqli_fetch_assoc($result))
              {

              echo "<div class='card' style='width: 18rem;'>
                     <img class= 'card-img-top' src='dwd/".$row['Image']."' alt='No image available'>
                      <div class='card-body'>
                        <h5 class='card-title'>".$row['Title']."</h5>
                        <p class='card-text'>".$row['ShortDisc']."</p>
                          <a class='btn btn-primary btn-lg' href='/showdwd.php?Title=".urlencode($row['Title'])."' role='button'>Download</a>
                        <p class='blockquote-footer float-right'>".$row['Tareek']."
                          <cite title='writer'> <b>By ".$row['Name']."</b></cite>
                        </p>
                      </div>
                    </div>";

              }
echo "</div>";
               ?>

               <form  method="post" style="margin-top:50px;margin-bottom:50px;text-align:center;">
                 <button class="btn btn-info" type="submit" name="load" style="width:80%;display:inline-block;font-family: 'Josefin Sans','sans-serif';">See More Downloads</button>
               </form>

            </div>
            <!-- middleside ends here-->



    <?php include("rightside.php"); ?>

  </div>

</div>


<?php include("footer.php"); ?>
