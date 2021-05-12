<?php
    //Include database configuration file
    include('link.php');
    
    //Get all country data
    $query = "SELECT * FROM paperdata";
    $result = mysqli_query($link, $query);
    
        
    

?>
    <select name="university" id="university" >
        <option value="">Select University</option>
<?php
while($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['uniName'].'">'.$row['uniName'].'</option>';
            }
?>

    </select>
    
    <select name="Course" id="Course">
        <option value="">Select University first</option>
    </select>
    
    <select name="Subject" id="Subject">
        <option value="">Select Course first</option>
    </select>

