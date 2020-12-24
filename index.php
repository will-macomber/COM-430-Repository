<?php
//create the db connection
//(hostname, db username, db password, db name)
$db = mysqli_connect("localhost", "root", "", "niceguys");

//initialize the message variable
$msg = "";

//if the upload button is clicked logic
if (isset($_POST['submit']))
{
    //get the image name
    $image = $_FILES['image_upload']['name'];
    

   //get the app name
   $appName = mysqli_real_escape_string($db, $_POST['appname']);
   //get the first name
   $firstname = mysqli_real_escape_string($db, $_POST['fn']);
   //get the last name
   $lastname = mysqli_real_escape_string($db, $_POST['ln']);

   //image file directory 
   $target = "images/".basename($image);

   $sql = "INSERT INTO images (image, firstname, lastname, appname) VALUES ('$image', '$firstname', '$lastname', '$appName')";

   //execute that query up there
   mysqli_query($db, $sql);

   if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
   {
       $msg = "Image uploaded successfully.";
   }
   else 
   {
       $msg = "Failed to upload image";
   }
}

//$result = mysqli_query($db, "SELECT * FROM imges");
?>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Nice Guys</title>
    <meta name="description" content="Nice Guys - An App to Protect Women">
    <meta name="author" content="Will, Samia, Ben">

    <!--Samia and Ben, when you view this, change the href path to your own-->
    <link rel="stylesheet" href="http://localhost/Nice Guys/style.css" type="text/css">


</head>

<body>
    <div id="nav">
        <div id="links">
            <a href="#home">Home</a>
            <a href="about.php">About</a>
            <a href="signup.php">Sign Up</a>
            <a href="#" onclick="document.getElementById('id01').style.display='block'" style="width: auto;">Sign In</a>
        </div><!--end links-->
    </div> <!--end nav div-->

    <div id="header">
        <h3>Nice Guys</h3>
    </div><!--end header-->

    <!--
        This portion of code will be where we display the results of
        searches, but no images have been uploaded, so it throws an error
        because $results is an empty variable, or undefined if I comment
        out its definition.
    -->
    <!--
    <div id="content">
        <?php
            //while ($row = mysqli_fetch_array($result))
            //{
             //   echo "<div id='img_div'>";
             //       echo "<img src='images/".$row['image']."'>";
             //       echo "<p>".$row['appname']."</p>";
             //       echo "<p>".$row['firstname']."</p>";
             //       echo "<p>".$row['lastname']."</p>";
             //   echo "</div><!--end img_div -->";
            //}//end while
        
        ?>
    </div
    -->
    <div id="forms">
       <form method="POST" action="index.php" enctype="multipart/form-data"> 
        <input type="file" id="image_upload" name="image_upload" value="Choose Image"><br>
        <input type="text" placeholder="App Name" name="appname" required id="appname"><br>
        <input type="text" placeholder="First Name" name="fn" required id="fn"><br>
        <input type="text" placeholder="Last Name" name="ln" required id="ln"><br>
        <button type="submit" id="submit" name="submit">Submit</button>
       </form>
    </div><!--end forms div-->

    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">x</span>
        <form class="modal-content animate" action="/action.php">
        <div class="container">
            <input type="text" placeholder="Email" name="email" required id="signup_email"><br>
            
            <input type="password" placeholder="Password" name="psw" id="signup_password" required><br><br>
    
            <input type="checkbox" id="check">Remember Me 
            <p class="blurb">By creating an account, you agree to our <a href="#">Terms of Service</a>.</p> 
             
            <div class="clearfix">
                <button type="submit" class="signupbtn">Sign In</button>
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            </div><!-- end clearfix div -->
        </div><!--end container div-->
        </form>
    </div><!-- end id01 div -->
    <script type="text/javascript">
        var modal = document.getElementById('id01');
        
        window.onclick = function(event) {
            if (event.target == modal) 
            {
                modal.style.display = "none";
            }
        }
        </script>
        


</body>



</html>