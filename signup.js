/*
Designed and programmed by William Macomber, this code is 
designed to be the signup form backend programmign so that
we may save accounts.
*/

//declare the variables that will hold the signup form information
var fname = document.getElementById("firstname");
var lname = document.getElementById("lastname");
var email = document.getElementById("email");
var pass = document.getElementById("password");
var cPass = document.getElementById("confirm_pass");

//verify that password and confirm password match
if (pass != cPass) 
{
    alert("Please make sure your password matches.");
}

//create the initial function for signup 
//we can go into the signup.html code and
//add this function for the onclick.
//onClick="serverSide()"
function ServerSide() 
{
    var xhttp = new XMLHttpRequest();
    


    
}//end serverSide()