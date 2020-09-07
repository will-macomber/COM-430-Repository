<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Nice Guys</title>
    <meta name="description" content="Nice Guys - An App to Protect Women">
    <meta name="author" content="Will, Samia, Ben">

    <!--Samia and Ben, when you view this, change the href path to your own-->
    <link rel="stylesheet" href="http://localhost:8080/final_project/CSS/style.css" type="text/css">


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

    <div id="forms">
        <input type="file" id="image_upload" value="Choose Image"><br>
        <input type="text" placeholder="App Name" required id="appname"><br>
        <input type="text" placeholder="First Name" required id="fn"><br>
        <input type="text" placeholder="Lastname" required id="ln"><br>
        <input type="submit" id="submit" value="Submit">
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