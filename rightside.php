<div class="col-sm-3 rightside">

<div class="boxchotaright">

  <div class="card quote">
      <div class="card-header bg-dark text-white">
      Quote
      </div>
      <div class="card-body">
      <blockquote class="blockquote mb-0">
      <p>“Any fool can write code that a computer can understand. Good programmers write code that humans can understand.”</p>
      <footer class="blockquote-footer"><i>Martin Fowler</i></footer>
      </blockquote>
      </div>
    </div>

</div>
<div class="boxchotaright">

  <div class="card text-center">
    <div class="card-header bg-dark text-white">
      Featured
    </div>
    <div class="card-body">
      <h5 class="card-title">Special title treatment</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer text-muted">
      2 days ago
    </div>
  </div>

</div>







<?php

$query = "SELECT blogdata.Title,blogdata.ShortDisc,blogdata.Tareek,members.Name
          FROM `blogdata`
          INNER JOIN `members`
          ON members.id = blogdata.userId
          ORDER BY `blogdata`.`blogNo` DESC
          LIMIT 5";
$result = mysqli_query($link, $query);



while($row = mysqli_fetch_assoc($result))
{
  echo "<a href='/showBlog.php?Title=".urlencode($row['Title'])."'>
  <div class='card text-white bg-light mb-3' style='max-width: 18rem;'>
    <div class='card-header bg-dark test-white'>Latest blog by:- ".$row['Name']."</div>
    <div class='card-body text-dark'>
      <h5 class='card-title'>".$row['Title']."</h5><hr>
      <p class='card-text'>".$row['ShortDisc']."</p>
    </div>
  </div></a>";
}

 ?>


</div>
