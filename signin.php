<?php


$email = $_POST['signup_email'];
$password = $_POST['signup_password'];

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
mysql_select_db("niceguys", $con);

//compare the known values from the database to what was entered
$query = mysql_query("SELECT * FROM users WHERE email='$email', $connect");

if (!$query)
{
    die("Query Failed: " . mysql_error());
}

else 
{
    $row = mysql_fetch_array($query);

    if ($email ==$row['email'])
    {
        if($email == '' || $password == '')
        {
            header("Location:signin.php?id=Some fields are empty");
        }
        else if ($email == $row['email'] && $password == $row['password'])
        {
            header("Location: index.php?id=$email");
        }
        else 
        {
            header("Location:login.php?id=username already taken or your password is incorrect. Please try again.");
        }
    }
    else
    {
        $query_name = mysql_query("INSERT INTO login(user, pass) VALUES ('$email', '$pass')");
        header("Location: index.php?id=$email");
    }
}






?>