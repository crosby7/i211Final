/*
 * This script contains AJAX methods
 */
var xmlHttp;
var numNicknames = 0;  //total number of suggested
var activeNickname = -1;  //account nickname currently being selected
var searchBoxObj, suggestionBoxObj;

//this function creates a XMLHttpRequest object. It should work with most types of browsers.
function createXmlHttpRequestObject() {
    // create a XMLHttpRequest object compatible to most browsers
    if (window.ActiveXObject) {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } else if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    } else {
        alert("Error creating the XMLHttpRequest object.");
        return false;
    }
}

//initial actions to take when the page load
window.onload = function () {
    //create an XMLHttpRequest object by calling the createXmlHttpRequestObject function
    xmlHttp = createXmlHttpRequestObject();

    //DOM objects
    searchBoxObj = document.getElementById('searchtextbox');
    suggestionBoxObj = document.getElementById('suggestionDiv');
};
//hide suggestions when click off
window.onclick = function () {
    suggestionBoxObj.style.display = 'none';
};

//set and send XMLHttp request. The parameter is the search term
function suggest(query) {
    //if the search term is empty, clear the suggestion box.
    if (query === "") {
        suggestionBoxObj.innerHTML = "";
        return;
    }

    //proceed only if the search term isn't empty
    // open an asynchronous request to the server.
    xmlHttp.open("GET", BASE_URL + "/BankAccount/suggest/" + query, true);

    //handle server's responses
    xmlHttp.onreadystatechange = function () {
        // proceed only if the transaction has completed and the transaction completed successfully
        if (xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            // extract the JSON received from the server
            console.log(xmlHttp.responseText)
            var nicknames = JSON.parse(xmlHttp.responseText);
            //console.log(xmlHttp.responseText);
            //display suggested nicknames in a div block
            displayNicknames(nicknames);
        }
    };

    // make the request
    xmlHttp.send(null);
}


/* This function populates the suggestion box with spans containing all the nicknames
 * The parameter of the function is a JSON object
 * */
function displayNicknames(nicknames) {
    numNicknames = nicknames.length;
    //console.log(numNicknames);
    activeNickname = -1;
    if (numNicknames === 0) {
        //hide all suggestions
        suggestionBoxObj.style.display = 'none';
        return false;
    }

    var divContent = "";
    //retrive the nicknames from the JSON doc and create a new span for each nickname
    for (i = 0; i < nicknames.length; i++) {
        divContent += "<span id=s_" + i + " onclick='clickNickname(this)'>" + nicknames[i] + "</span>";
    }
    //display the spans in the div block
    suggestionBoxObj.innerHTML = divContent;
    suggestionBoxObj.style.display = 'block';
}

//This function handles keyup event. The funcion is called for every keystroke.
function handleKeyUp(e) {
    // get the key event for different browsers
    e = (!e) ? window.event : e;

    /* if the keystroke is not up arrow or down arrow key,
     * call the suggest function and pass the content of the search box
     */
    if (e.keyCode !== 38 && e.keyCode !== 40) {
        suggest(e.target.value);
        return;
    }

    //if the up arrow key is pressed
    if (e.keyCode === 38 && activeNickname > 0) {
        //add code here to handle up arrow key. e.g. select the previous item
        activeNicknameObj.style.backgroundColor = "#ffffff";
        activeNickname--;
        activeNicknameObj = document.getElementById("s_" + activeNickname);
        activeNicknameObj.style.backgroundColor = "#8b0000";
        searchBoxObj.value = activeNicknameObj.innerHTML;
        return;
    }

    //if the down arrow key is pressed
    if (e.keyCode === 40 && activeNickname < numNicknames - 1) {
        //add code here to handle down arrow key, e.g. select the next item

        if(typeof(activeNicknameObj) != "undefined") {
            activeNicknameObj.style.backgroundColor = "#FFF";
        }
        activeNickname++;
        activeNicknameObj = document.getElementById("s_" + activeNickname);
        activeNicknameObj.style.backgroundColor = "#8B0000FF";
        searchBoxObj.value = activeNicknameObj.innerHTML;
    }
}



//when a nickname is clicked, fill the search box with the nickname and then hide the suggestion list
function clickNickname(nicknames) {
    //display the nickname in the search box
    searchBoxObj.value = nicknames.innerHTML;

    //hide all suggestions
    suggestionBoxObj.style.display = 'none';
}