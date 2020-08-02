/*
Designed and programmed by William Macomber, this code is 
designed to be the signup form backend programmign so that
we may save accounts.
*/

//declare the variables that will hold the signup form information

function getInputValue() {

    var pass = document.getElementById("password").value;
    var con_pass = document.getElementById("confirm_pass").value;
    var firstName = document.getElementById("firstname").value;
    var lastName = document.getElementById("lastname").value;
    var email = document.getElementById("email").value;


    if (pass != con_pass)
        {
            alert("Passwords must match");
        }

    if (firstName == '')
    {
        alert("Please fill in your first name");
    }

    else if (lastName == '')
    {
        alert("Please fill in your last name");
    }

    else if (email == '')
    {
        alert("Please fill in a valid email address");
    }

    /*
    const btn = document.querySelector("submit");

    function sendData(data) {
        console.log('Sending data');
        const XHR = new XMLHttpRequest();

        let urlEncodedData = "",
            urlEncodedDataPairs = [],
            name;

            //turn the data into an array of url-encoded key/value pairs.
            for (name in data) {
                urlEncodedDataPairs.push(encodeURIComponent(name) + '=' + encodeURIComponent(data[name]));
            }

            //combine the pairs into a single string and replace all %-encode spaces to 
            //the '+' character; matches the behavior of the browser form submissions.
            urlEncodedData = urlEncodedDataPairs.join('&').replace (/%20/g, '+');

            //define what happens if the submission is successful
            XHR.addEventListener('load', function(event){
                alert("Your information has been submitted");
            });

            //define what happens if there is an error
            XHR.addEventListener('error', function(event) {
                alert("Something went wrong");
            });

            //set up our request 
            XHR.open('POST', 'example');

            //add the required http header for form data POST requests
            XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            //send the data
            XHR.send(urlEncodedData);
    }//end sendData
sendData({test: 'Ok'});
}//end get value
*/


