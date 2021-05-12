<?php
session_start();
include("link.php");

include("header.php");

include("nav.php");


?>


<div class="container-fluid">

  <div class="row">

    <div class="col-sm-3 bg-info">

      <form method="post">
	  <select name="uniSelected" class="form-control">
	  	<option>Select University</option>
		<option value="MDU">MDU</option>
		<option value="DU">DU</option>
		<option value="GU">GU</option>
		<option value="KU">KU</option>
	</select>

	<select name="courseSelected" class="form-control">
	  	<option>Select Course</option>
		<option value="MCA">MCA</option>
		<option value="BCA">BCA</option>
		<option value="BA">BA</option>
		<option value="BBA">BBA</option>
		<option value="BCOM">BCOM</option>
		<option value="BSC">BSC</option>
	</select>

	<select name="semSelected" class="form-control">
	  	<option>Select Semester</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
	</select>
	  <button type="submit" name="optUni" class="btn btn-primary">Submit</button>
	</form>



    </div>

    <div class="col-sm-9 bg-light">
	<!-- Automatic Paper's  Display Area  -->
	<div class="container bg-light rounded text-info"
               style="margin-top:50px;
                      padding:6px;
                      
                      font-family: 'Josefin Sans','sans-serif';">

                <table class="table table-hover">
                      <thead>
                        <tr>
                          
                          <th scope="col">Course</th>
                          
                          <th scope="col">Subject</th>
			  <th scope="col">Download</th>
                        </tr>
                      </thead>
                      <tbody>
<?php

	if(array_key_exists("uniSelected",$_POST) && array_key_exists("courseSelected",$_POST) && array_key_exists("semSelected",$_POST)) {

	
	$query = "SELECT * FROM `paperdata` 
		WHERE uniName = '".$_POST['uniSelected']."'
		AND uniCourse = '".$_POST['courseSelected']."'
		AND uniSem =".$_POST['semSelected'];

          $result = mysqli_query($link, $query);



          while($row = mysqli_fetch_assoc($result))
          {

            echo "
                <tr>
                  
		  <td>".$row['uniName']." ".$row['uniCourse']." ".$row['uniSem']."</td>
                  
                  <td>".$row['uniSub']."</td>
                  <td>
		<button type='download' class='btn btn-light text-white'>
			<a href='Papers/".$row['pprDocu']."' download>Download file</a>
		</button>
		</td>
                </tr>";
          }
	} else {
	$query = "SELECT * FROM `paperdata`";

          $result = mysqli_query($link, $query);



          while($row = mysqli_fetch_assoc($result))
          {

            echo "
                <tr>
                  
		  <td>".$row['uniName']." ".$row['uniCourse']." ".$row['uniSem']."</td>
                  
                  <td>".$row['uniSub']."</td>
                  <td>
		<button type='download' class='btn btn-light text-white'>
			<a href='Papers/".$row['pprDocu']."'  download>Download file</a>
		</button>
		</td>
                </tr>";
          }
}
	
?>

 </tbody>
            </table>
          </div>
  </div>
</div>

</div>


<?php include("footer.php"); ?>
