<?php
      include("link.php");

      include("header.php");

      include("nav.php");
?>

<div class="container-fluid">

  <div class="row">

    <!-- Mid Area starts here-->

            <div class="col-sm-9 middleside">

    <?php
    $loadMore = 10;
      if(array_key_exists("load",$_POST)) {
        $loadMore = $loadMore + 10;
      }

              $query = "SELECT solvedPapers.solved_paperId,
				solvedPapers.solved_userId,
				solvedPapers.solved_uniName,
				solvedPapers.solved_uniCourse,
				solvedPapers.solved_uniSem,
				solvedPapers.solved_pprSub,
				solvedPapers.solved_ppr,
				solvedPapers.ppr_price,
				members.Name
                        FROM `solvedPapers`
                        INNER JOIN `members`
                        ON members.id = solvedPapers.solved_userId
                        ORDER BY `solvedPapers`.`solved_paperId` DESC
                        LIMIT $loadMore";
              $result = mysqli_query($link, $query);

echo "<div class='card-columns'>";
              while($row = mysqli_fetch_assoc($result))
              {

              echo "<div class='card' style='width: 18rem;'>
                     
                      <div class='card-body'>
                        <h5 class='card-title'>".$row['solved_uniName']." ".$row['solved_uniCourse']." ".$row['solved_uniSem']." Sem  ".$row['solved_pprSub']."</h5>
                   <a class='btn btn-warning btn-lg' href='/checkout.php?solved_paperId=".urlencode($row['solved_paperId'])."' role='button'>Purchase It for ".$row['ppr_price']."</a>
                        <p class='blockquote-footer float-right'>
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
