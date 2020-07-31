<?php
//create a variable for the database connection
$connect = mysql_connect("localhost", "password");

//ensure the connection is successful
//display an error if it fails
if (!$connect)
    {
        die("Could not connect: " . mysql_error());
    }

//select the database and table
mysql_select_db("niceguys", $connect);

//create the SQL to inser the firstname and lastname into the database
$SQL = "INSER INTO users (firstname, lastname) VALUES ('$_POST[firstname]', '$_POST[lastname]')";

//create a catch if the SQL and connection fail
if (!mysql_query($SQL, $connect))
    {
        die("Error: " . mysql_error());
    }

//let the user know their information was uploaded
echo "Your account has been created";

//end the database connection so somebody doesn't backdoor it
mysql_close($connect);



?>