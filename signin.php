<?php

$email = $_POST['signup_email'];
$password = $_POST['signup_password'];


//create a variable for the database connection
$connect = mysql_connect("will_macomber", "V3ct0rD@v3");

//ensure the connection is successful
//display an error if it fails
if (!$connect)
    {
        die("Could not connect: " . mysql_error());
    }

//select the database and table
mysql_select_db("niceguys", $connect);

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