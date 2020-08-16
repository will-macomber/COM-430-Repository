<?php
session_start();


$username = '';
$email = '';
$errors = array();

//connect to db
$db = mysqli_connect('127.0.0.1:8080', 'root', '', 'niceguys');

if (mysquli_connect_errono())
{
    echo "Failed to connect to MySQL: " . mysquli_connect_error();
}

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
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Nice Guys</title>
    <meta name="description" content="Nice Guys - An App to Protect Women">
    <meta name="author" content="Will, Samia, Ben">

    <!--Samia and Ben, when you view this, change the href path to your own-->
    <link rel="stylesheet" href="http://localhost:8080/final_project/CSS/style.css" type="text/css">
    <script type="text/javascript" src="C:\Users\Will_Macomber\Desktop\Project\scripts\signup.js"></script>
</head>

<body>
    <div id="nav">
        <div id="links">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="#">Sign Up</a>
            <a href="#" onclick="document.getElementById('id01').style.display='block'" style="width: auto;">Sign In</a>
        </div><!--end links-->
    </div> <!--end nav div-->

    <div id="header">
        <h3>Nice Guys</h3>
    </div><!--end header-->

    <div id="header2">
        <h2>Sign Up</h2>
    </div><!--end header2-->


    <div id="signup">
        <form method="post">
            <?php  if (count($errors) > 0) : ?>
  <div class="error">
                <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
                <?php endforeach ?>
</div>
            <?php  endif ?>            
            
            <input type="text"  id="firstname" name="firstname" placeholder="First Name" required minlength="3" maxlength="15" method="post"><br>
            <input type="text" id="lastname" name="lastname" placeholder="Last Name" required method="post"><br>
            <input type="text"  id="username" name="username" placeholder="Username" required method="post"><br>
            <input type="email" id="email" name="email" placeholder="Email" required method="post"><br>
            <input type="password"  id="password" name="password" placeholder="Password" required method="post"><br>
            <input type="password"  id="confirm_pass" name="confirm_pass" placeholder="Confirm Password" required method="post"><br>
        </form>

        


    </div><!--end signup-->
   
    <div id="buttons">
        <input type="submit" id="submit2" name="submit2">
        <input type="reset" id="reset" name="reset">
    </div><!--end buttons-->
    <p id="warning"></p>



<div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">x</span>
    <form class="modal-content animate" action="signup_action.php">
    <div class="container">
        <input type="text" placeholder="Email" name="email" required id="signup_email"><br>
        
        <input type="password" placeholder="Password" name="psw" id="signup_password" required><br><br>

        <input type="checkbox" id="check">Remember Me 
        <p class="blurb">By creating an account, you agree to our <a href="#">Terms of Service</a>.</p> 
         
        <div class="clearfix">
            <button type="submit" class="signupbtn">Sign Up</button>
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