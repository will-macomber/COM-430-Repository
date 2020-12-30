function searchPosts(loadedResults)
{
    var query = document.getElementById("Placeholder").value;
    var resultsContainer = document.getElementById("search_results");

    //clearn the results container if no previous results have been loaded
    if (loadedResults === 0)
    {
        resultsContainer.innerHTML = "";
    }

    //create the XMLHTTPRequest object
    var xmlhttp = new XMLHttpRequest();

    //create function that is called when the request is completed
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200)
        {
            //fetch the response text
            var response = xmlhttp.responseText;
            var outputPosts;

            //parse the response if it is valid JSON

            try {
                outputPosts = JSON.parse(response);
            }//end try
            catch(e){
                return;
            }//end catch
            finally {
                resultsContainer.innerHTML += "<br><button id='load_button' onclick='searchPosts( " + loadedResults + outputResults.length) + " ) '>Load More</button>";
            }//end finally
        }//end if
    };

    //send the request to fetch searchDB.php
    xmlhttp.open("GET", "searchDB.php?search=" + query + "&loaded=" + loadedResults, true);
    xmlhttp.send();
}//end searchPosts()