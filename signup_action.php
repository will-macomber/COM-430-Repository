<?php

//create variables for values
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$pass = $_POST['password'];
$email = $_POST['email'];


//connection variables
$host="127.0.0.1";
$port=3306;
$socket="";
$user="will_macomber";
$password="";
$dbname="niceguys";


//attempt connection
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();

//select the database and table
mysql_select_db("niceguys", $connect);

//create the SQL to inser the firstname and lastname into the database
$SQL = "INSER INTO users (firstname, lastname, password, email) VALUES ($fname, $lname, $pass, $email)";

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