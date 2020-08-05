<?php

$firstname = $_POST['fn'];
$lastname = $_POST['ln'];
$image = $_POST['image_upload'];
$appName = $_POST['appname'];


//connect to the server
$connect = mysql_connect("will_macomber", "V3ct0rD@v3");

//test connection
if (!$connect)
    {
        die("Could not connect: " . mysql_error());
    }


//connect to the appropriate database
mysql_select_db("niceguys", $connect);

//upload the content
$SQL = "INSER INTO images (image, AppName, firstn, lastn) VALUES ($image, $appName, $firstname, $lastname)";

//error catch
if (!mysql_query($SQL, $connect))
    {
        die("Error: " . mysql_error());
    }

//let the user know their information was uploaded
echo "Your account has been created";

//end the database connection so somebody doesn't backdoor it
mysql_close($connect);

?>