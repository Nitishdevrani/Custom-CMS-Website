<!-- Mid Area starts here-->

        <div class="col-sm-6 middleside">

<?php
$loadMore = 5;
  if(array_key_exists("load",$_POST)) {
    $loadMore = $loadMore + 5;
  }

          $query = "SELECT blogdata.Title,blogdata.ShortDisc,blogdata.Tareek,members.Name
                    FROM `blogdata`
                    INNER JOIN `members`
                    ON members.id = blogdata.userId
                    ORDER BY `blogdata`.`blogNo` DESC
                    LIMIT $loadMore";
          $result = mysqli_query($link, $query);



          while($row = mysqli_fetch_assoc($result))
          {

            echo "<div class='container boxchota jumbotron'>

                <div class='display-4 h_ding'>".$row['Title']."</div>
                <hr class='my-4'>
                <p class='lead'>".$row['ShortDisc']."</p>
                <a class='btn btn-primary btn-lg' href='/showBlog.php?Title=".urlencode($row['Title'])."' role='button'>Read more</a>
                <p class='blockquote-footer float-right'>".$row['Tareek']."
                  <cite title='writer'> <b>By ".$row['Name']."</b></cite>
                </p>


            </div>";

          }

           ?>

           <form  method="post" style="margin-top:50px;margin-bottom:50px;text-align:center;">
             <button class="btn btn-info" type="submit" name="load" style="width:80%;display:inline-block;font-family: 'Josefin Sans','sans-serif';">See More Posts</button>
           </form>

        </div>
        <!-- middleside ends here-->
