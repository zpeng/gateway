/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function confirmDeletion(){
    var result = false;
    result = confirm ("Do you want to delete this item?");
    return result;
}

function checkCustomerRegisterForm(form){
    if (form.reg_email.value.length == 0) {
        inlineMsg('reg_email','You have to enter the email.',1);
        return false;
    }

    if (!isValidEmail(form.reg_email.value)){
        inlineMsg('reg_email','You have to enter a valid email.',1);
        return false;
    }

    if (form.reg_password.value.length == 0) {
        inlineMsg('reg_password','You have to enter the password.',1);
        return false;
    }

    if (form.reg_password.value.length < 7) {
        inlineMsg('reg_password','You have to enter at least 8 characters.',1);
        return false;
    }

    if (form.reg_password_confirm.value.length == 0) {
        inlineMsg('reg_password_confirm','You have to enter the confirm password.',1);
        return false;
    }

    if (form.reg_password.value != form.reg_password_confirm.value) {
        inlineMsg('reg_password_confirm','The two password do not match.',1);
        return false;
    }

    if (form.firstname.value.length == 0) {
        inlineMsg('firstname','You have to enter the firstname.',1);
        return false;
    }

    if (form.lastname.value.length == 0) {
        inlineMsg('lastname','You have to enter the lastname.',1);
        return false;
    }
    
    return true;
}

function checkCustomerPasswordUpdateForm(form){
    if (form.password.value.length == 0) {
        inlineMsg('password','You have to enter the password.',1);
        return false;
    }

    if (form.password.value.length < 7) {
        inlineMsg('password','You have to enter at least 8 characters.',1);
        return false;
    }
    
    if (form.password_confirm.value.length == 0) {
        inlineMsg('password_confirm','You have to enter the confirm password.',1);
        return false;
    }

    if (form.password.value != form.password_confirm.value) {
        inlineMsg('password_confirm','The two password do not match.',1);
        return false;
    }

    return true;
}

function checkCustomerAddressUpdateForm(form) {
   
    if (form.b_recipients.value.length == 0) {
        inlineMsg('b_recipients','You have to enter the recipients.',1);
        return false;
    }

    if (form.b_street.value.length == 0) {
        inlineMsg('b_street','You have to enter the street.',1);
        return false;
    }

    if (form.b_city.value.length == 0) {
        inlineMsg('b_city','You have to enter the city.',1);
        return false;
    }

    if (form.b_postcode.value.length == 0) {
        inlineMsg('b_postcode','You have to enter the postcode.',1);
        return false;
    }

    if (form.b_country.value.length == 0) {
        inlineMsg('b_country','You have to enter the country.',1);
        return false;
    }

    if (form.d_recipients.value.length == 0) {
        inlineMsg('d_recipients','You have to enter the recipients.',1);
        return false;
    }

    if (form.d_street.value.length == 0) {
        inlineMsg('d_street','You have to enter the street.',1);
        return false;
    }

    if (form.d_city.value.length == 0) {
        inlineMsg('d_city','You have to enter the city.',1);
        return false;
    }

    if (form.d_postcode.value.length == 0) {
        inlineMsg('d_postcode','You have to enter the postcode.',1);
        return false;
    }

    if (form.d_country.value.length == 0) {
        inlineMsg('d_country','You have to enter the country.',1);
        return false;
    }

    return true;
}

function checkCustomerDetailUpdateForm(form) {
    if (form.firstname.value.length == 0) {
        inlineMsg('firstname','You have to enter the firstname.',1);
        return false;
    }

    if (form.lastname.value.length == 0) {
        inlineMsg('lastname','You have to enter the lastname.',1);
        return false;
    }
    return true;
}

function checkCustomerReviwForm(form) {
    if (form.review_text.value.length == 0) {
        inlineMsg('review_text','You have to enter you review.',1);
        return false;
    }
    return true;
}

function checkCustomerLoginForm(form){
    if (form.email.value.length == 0) {
        inlineMsg('email','You have to enter the email.',1);
        return false;
    }

    if (!isValidEmail(form.email.value)){
        inlineMsg('email','You have to enter a valid email.',1);
        return false;
    }

    if (form.password.value.length == 0) {
        inlineMsg('password','You have to enter the password.',1);
        return false;
    }
    return true;
}



function checkCustomerShippingConfirmForm(form) {

    if (form.d_recipients.value.length == 0) {
        inlineMsg('d_recipients','You have to enter the recipients.',1);
        return false;
    }

    if (form.d_street.value.length == 0) {
        inlineMsg('d_street','You have to enter the street.',1);
        return false;
    }

    if (form.d_city.value.length == 0) {
        inlineMsg('d_city','You have to enter the city.',1);
        return false;
    }

    if (form.d_postcode.value.length == 0) {
        inlineMsg('d_postcode','You have to enter the postcode.',1);
        return false;
    }

    if (form.d_country.value.length == 0) {
        inlineMsg('d_country','You have to enter the country.',1);
        return false;
    }

    return true;
}
/* ----------------------------------------------*/


function isNumeric(strString)
//  check for valid numeric strings
{
    var strValidChars = "0123456789.-";
    var strChar;
    var blnResult = true;

    if (strString.length == 0) return false;

    //  test strString consists of valid characters listed above
    for (i = 0; i < strString.length && blnResult == true; i++)
    {
        strChar = strString.charAt(i);
        if (strValidChars.indexOf(strChar) == -1)
        {
            blnResult = false;
        }
    }
    return blnResult;
}

function isValidEmail(strString){  
    with (strString)
    {
        apos=strString.indexOf("@");
        dotpos=strString.lastIndexOf(".");
        if (apos<1||dotpos-apos<2)
        {
            return false;
        }
        else
        {
            return true;
        }
        }
}



// START OF MESSAGE SCRIPT //
var MSGTIMER = 20;
var MSGSPEED = 5;
var MSGOFFSET = 3;
var MSGHIDE = 3;

// build out the divs, set attributes and call the fade function //
function inlineMsg(target,string,autohide) {
    var msg;
    var msgcontent;
    if(!document.getElementById('msg')) {
        msg = document.createElement('div');
        msg.id = 'msg';
        msgcontent = document.createElement('div');
        msgcontent.id = 'msgcontent';
        document.body.appendChild(msg);
        msg.appendChild(msgcontent);
        msg.style.filter = 'alpha(opacity=0)';
        msg.style.opacity = 0;
        msg.alpha = 0;
    } else {
        msg = document.getElementById('msg');
        msgcontent = document.getElementById('msgcontent');
    }
    msgcontent.innerHTML = string;
    msg.style.display = 'block';
    var msgheight = msg.offsetHeight;
    var targetdiv = document.getElementById(target);
    targetdiv.focus();
    var targetheight = targetdiv.offsetHeight;
    var targetwidth = targetdiv.offsetWidth;
    var topposition = topPosition(targetdiv) - ((msgheight - targetheight) / 2);
    var leftposition = leftPosition(targetdiv) + targetwidth + MSGOFFSET;
    msg.style.top = topposition + 'px';
    msg.style.left = leftposition + 'px';
    clearInterval(msg.timer);
    msg.timer = setInterval("fadeMsg(1)", MSGTIMER);
    if(!autohide) {
        autohide = MSGHIDE;
    }
    window.setTimeout("hideMsg()", (autohide * 1000));
}

// hide the form alert //
function hideMsg(msg) {
    var msg = document.getElementById('msg');
    if(!msg.timer) {
        msg.timer = setInterval("fadeMsg(0)", MSGTIMER);
    }
}

// face the message box //
function fadeMsg(flag) {
    if(flag == null) {
        flag = 1;
    }
    var msg = document.getElementById('msg');
    var value;
    if(flag == 1) {
        value = msg.alpha + MSGSPEED;
    } else {
        value = msg.alpha - MSGSPEED;
    }
    msg.alpha = value;
    msg.style.opacity = (value / 100);
    msg.style.filter = 'alpha(opacity=' + value + ')';
    if(value >= 99) {
        clearInterval(msg.timer);
        msg.timer = null;
    } else if(value <= 1) {
        msg.style.display = "none";
        clearInterval(msg.timer);
    }
}

// calculate the position of the element in relation to the left of the browser //
function leftPosition(target) {
    var left = 0;
    if(target.offsetParent) {
        while(1) {
            left += target.offsetLeft;
            if(!target.offsetParent) {
                break;
            }
            target = target.offsetParent;
        }
    } else if(target.x) {
        left += target.x;
    }
    return left;
}

// calculate the position of the element in relation to the top of the browser window //
function topPosition(target) {
    var top = 0;
    if(target.offsetParent) {
        while(1) {
            top += target.offsetTop;
            if(!target.offsetParent) {
                break;
            }
            target = target.offsetParent;
        }
    } else if(target.y) {
        top += target.y;
    }
    return top;
}

// preload the arrow //
if(document.images) {
    arrow = new Image(7,80);
    arrow.src = "images/site/msg_arrow.gif";
}

