<?php session_start();
include("link.php");
$show = "";

if(array_key_exists("logout", $_GET)) {

  unset($_SESSION['id']);

  setcookie("id","", time() - 60*60);
  $_COOKIE["id"] = "";
} else if((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
  header("Location: profileArea.php");
}


     if(array_key_exists("submit",$_POST)) {

         if(!$_POST['email']) {
           $show .= "email address is required<br>";
         }

         if(!$_POST['password']) {
           $show .= "Password is required<br>";
         }



           if($_POST['signUp'] == '1') {

             if(!$_POST['username']) {
               $show .= "Username is required<br>";
             }

             if(!$_POST['confirmPassword']) {
               $show .= "Confirm your Password<br>";
             }

             if($_POST['confirmPassword'] !== $_POST['password']) {
               $show .= "Password not matched!";
             }

             if($show != "") {
               $show = "<p>There were some errors in your form:</p>".$show;
             }
              else {

               $query = "SELECT id FROM `members` WHERE  email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
               $result = mysqli_query($link, $query);
             if (mysqli_num_rows($result) > 0) {
                         $show = "This email address is already registered";
               } else {
                 $query = "INSERT INTO `members` (`Name`,`Priority`,`email`,`password`)
                           VALUES (
                             '".mysqli_real_escape_string($link,$_POST['username'])."',
                             '".mysqli_real_escape_string($link,$_POST['Priority'])."',
                             '".mysqli_real_escape_string($link,$_POST['email'])."',
                             '".mysqli_real_escape_string($link,$_POST['password'])."'
                           )";
                           if(!mysqli_query($link,$query)) {
                             $show = "Something went wrong!! Please try again.";
                           } else {
                             $query = "UPDATE `members`
                              SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."'

                              WHERE id = ".mysqli_insert_id($link)."
                              LIMIT 1";

                             $id = mysqli_insert_id($link);

                             mysqli_query($link, $query);

                             $_SESSION['id'] = $id;

                             if(isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == "1") {
                               setcookie("id",$id,time() + (86400*90));

                             }

                             header("Location:profileArea.php");
                 }
               }
             }
           }  else {

             if($show != "") {
               $show = "<p>There were some errors in your form:</p>".$show;
             } else {
             $query = "SELECT * FROM `members` WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."' ";
             $row = mysqli_fetch_array(mysqli_query($link,$query));

             if(isset($row)) {
               $hashedPassword = md5(md5($row['id']).$_POST['password']);

               if($hashedPassword == $row['password']) {
                 $_SESSION['id'] = $row['id'];
                 if(isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == "1") {
                   setcookie("id",$row['id'],time() + (86400*90));

                 }
                 header("Location:profileArea.php");
               } else {
                 $show = "Password Incorrect";
               }
             } else {
               $show = "Incorrect EmailId/Password";
             }
           }
         }
       }


?>





<?php include("header.php"); ?>
<?php include("nav.php"); ?>

  <div class="container-fluid">

        <div class="row">

<?php include("leftside.php"); ?>

<?php include("midarea.php"); ?>

<?php include("rightside.php"); ?>



            </div>
          </div>

<?php include("footer.php"); ?>
