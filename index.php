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
    if(isset($_FILES['image']['tmp_name']))
    {
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
        {
            $msg = "Image uploaded successfully.";
        }
        else 
        {
            $msg = "Failed to upload image";
        }
    }//end if for isset()
}

$search = isset($_GET['search_field']);

//number of previously loaded results
$offset = isset($_GET['loaded']);

//remember that we already have a variable for the database connection
//which is $db

$searchSQL = 'SELECT * FROM images WHERE MATCH (appname, firstname, lastname, image) AGAINST ( "' . $search . '" ) LIMIT ' . $offset . ', 10;';

$searchResult = $db->query($searchSQL);

//declade the array variable to store the results
$output = array();


if ($searchResult !== false && $searchResult->num_rows > 0)
{
    while ($row = $result->fetch_assoc() )
    {
        //add row to output array in the form of an associative array 
        $output[] = array ("image" => $row["image"], "firstname" => $row["firstname"], "lastname" => $row["lastname"], "appname" => $row["appname"]);
    }//end while
}//end if

$db->close();

//convert to JSON and output 
echo (json_encode($output));

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
    <script type="text/javascript">
    function searchPosts(loadedResults)
{
    var query = document.getElementById("Placeholder").value;
    var resultsContainer = document.getElementById("search_results");

    //clearn the results container if no previous results have been loaded
    if (loadedResults === 0)
    {
        resultsContainer.innerHTML = "";
    }

    //create the XMLHTTPRequest object
    var xmlhttp = new XMLHttpRequest();

    //create function that is called when the request is completed
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200)
        {
            //fetch the response text
            var response = xmlhttp.responseText;
            var outputPosts;

            //parse the response if it is valid JSON

            try {
                outputPosts = JSON.parse(response);
            }//end try
            catch(e){
                return;
            }//end catch
            finally {
                resultsContainer.innerHTML += "<br><button id='load_button' onclick='searchPosts( " + loadedResults + outputResults.length) + " ) '>Load More</button>";
            }//end finally
        }//end if
    };

    //send the request to fetch searchDB.php
    xmlhttp.open("GET", "searchDB.php?search=" + query + "&loaded=" + loadedResults, true);
    xmlhttp.send();
}//end searchPosts()
    </script>

</head>

<body>
    <div id="nav">
        <div id="links">
            <a href="#home">Home</a>
            <a href="about.php">About</a>
            <a href="signup.php">Sign Up</a>
            <a href="#" onclick="document.getElementById('id01').style.display='block'" style="width: auto;">Sign In</a>
        </div><!--end links-->

        <div id="search">
            <input id="search_field" type="text" placeholder="Search">
            <button id="search_button" onclick="searchPosts(0)">Search</button>
        </div><!--end search div-->
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
        <button type="submit" id="main_submit" name="submit">Submit</button>
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
        
        
        <div id="search_results">

        </div><!--end search_results div-->

</body>



</html>