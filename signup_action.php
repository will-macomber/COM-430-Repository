<?php
session_start();


$username = "";
$email = "";
$errors = array();

//connect to db
$db = mysqli_connect('127.0.0.1', 'root', '', 'niceguys');

//sign user up
if (isset($_POST['submit2']))
{
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $pass = mysqli_real_escape_string($db, $_POST['password']);
    $con_pass = mysqli_real_escape_string($db, $_POST['confirm_pass']);
    $firstname = mysqli_real_escape_string($db, $_POST['firsrtname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);



//form validation
if(empty($username)) { array_push($errors, "Username is required"); }
if(empty($email)) { array_push($errors, "Email is required"); }
if(empty($pass)) { array_push($errors, "Password is required"); }
if(empty($firstname)) { array_push($errors, "First name is required"); }
if(empty($lastname)) { array_push($errors, "Last name is required"); }

if ($password != $con_pass) {
    array_push($errors, "The two passwords don't match");
}

//make sure the user doesn't already exist
$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) 
{
    if ($user['username'] === $username)
    {
        array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email)
    {
        array_push($errors, "email already exists");
    }
}

//register that user please!
if (count($errors) == 0) 
{
    $password = md5($password_1); //encrypt the password before saving it in the db

    $query = "INSERT INTO users (username, email, password, firstname, lastname) VALUES('$username', '$email', '$password', '$firstname', '$lastname')";
    $mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now signed up";
    header('location: signup.php');
}
}
?>