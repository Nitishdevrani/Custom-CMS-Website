<?php


          $query = "SELECT blogdata.Title,blogdata.ShortDisc,blogdata.Tareek,members.Name
                    FROM `blogdata`
                    INNER JOIN `members`
                    ON members.id = blogdata.userId
                    ORDER BY `blogdata`.`blogNo` DESC
                    LIMIT 1";
          $result = mysqli_query($link, $query);



          while($row = mysqli_fetch_assoc($result))
          {

            echo "<div class='container boxchota jumbotron'>


                <h2 class='display-4'>".$row['Title']."<sup><span class='badge badge-pill badge-warning text-small'>Latest</span></sup></h2> 
                <hr class='my-4'>
                <p class='lead'>".$row['ShortDisc']."</p>
                <a class='btn btn-primary btn-lg' href='/showBlog.php?Title=".urlencode($row['Title'])."' role='button'>Read more</a>
                <p class='blockquote-footer float-right'>".$row['Tareek']."
                  <cite title='writer'> <b>By ".$row['Name']."</b></cite>
                </p>


            </div>";

          }

           ?>
