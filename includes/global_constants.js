var SERVER_URL = "http://" + window.location.hostname + "/gateway/";
//var SERVER_URL = "http://www.staging.dealsteal.co/";

var ENVIRONMENT = "debug";
//var ENVIRONMENT = "production";


function ajaxSuccessMsg(msg) {
    jQuery("div#notification").html("<span class='info'>" + msg + "</span>");
}

function ajaxFailMsg(msg) {
    if (ENVIRONMENT == "debug") {
        jQuery("div#notification").html(msg.responseText);
    } else {
        jQuery("div#notification").html("<span class='error'>There was a connection error. Try again please!</span>");
    }
}

//this is used for dropdown value change
function updateParameter(paramName, paramValue) {
    var url = window.location.href;
    if (url.indexOf(paramName + "=") >= 0) {
        var prefix = url.substring(0, url.indexOf(paramName));
        var suffix = url.substring(url.indexOf(paramName)).substring(url.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    }
    else {
        if (url.indexOf("?") < 0)
            url += "?" + paramName + "=" + paramValue;
        else
            url += "&" + paramName + "=" + paramValue;
    }
    return url;
}


// get url parameter value by name
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}