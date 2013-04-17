/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function confirmOperation(){
    var result = false;
    result = confirm ("Do you want to process this operation?");
    return result;
}

function confirmDeletion(){
    var result = false;
    result = confirm ("Do you want to delete this item?");
    return result;
}

function checkAdminAccountCreationForm(form){
    if (form.email.value.length == 0) {
        inlineMsg('email','You have to enter the email.',1);
        return false;
    }

    if (!isValidEmail(form.email.value)){
        inlineMsg('email','You have to enter a valid email.',1);
        return false;
    }

    if (form.password.value.length == 0) {
        inlineMsg('password','You have to enter the new password.',1);
        return false;
    }

    return true;
}

function checkFormAdminPasswordUpdate(form) {
    if (form.password.value.length == 0) {
        inlineMsg('password','You have to enter the new password.',1);
        return false;
    }
    return true;
}

function checkFormCategoryAdd(form) {
    if (form.category_name.value.length == 0) {
        inlineMsg('name','You have to enter the category name.',1);
        return false;
    }

    if (form.category_description.value.length == 0) {
        inlineMsg('category_description','You have to enter the category description.',1);
        return false;
    }

    return true;
}

function checkFormCategoryUpdate(form) {
    if (form.category_name.value.length == 0) {
        inlineMsg('name','You have to enter the category name.',1);
        return false;
    }

    if (form.category_description.value.length == 0) {
        inlineMsg('category_description','You have to enter the category description.',1);
        return false;
    }

    return true;
}

function checkProductAttributeCreationForm(form) {
    if (form.attribute_name.value.length == 0) {
        inlineMsg('attribute_name','You have to enter the attribute name.',1);
        return false;
    }
    return true;
}

function checkFormAttributeUpdate(form) {
    if (form.attribute_name.value.length == 0) {
        inlineMsg('attribute_name','You have to enter the attribute name.',1);
        return false;
    }
    return true;
}


function checkProductAttributeValueCreationForm(form) {
    if (form.attribute_value.value.length == 0) {
        inlineMsg('attribute_value','You have to enter the attribute value.',1);
        return false;
    }
    return true;
}

function checkFormAttributeValueUpdate(form) {
    if (form.attribute_value.value.length == 0) {
        inlineMsg('attribute_value','You have to enter the attribute value.',1);
        return false;
    }
    return true;
}

function checkAdminProductCreationForm(form) {
    if (form.product_sku.value.length == 0) {
        inlineMsg('product_sku','You have to enter the SKU code.',1);
        return false;
    }

    if (form.date_available.value.length == 0) {
        inlineMsg('date_available','You have to enter the available date.',1);
        return false;
    }

    if (form.stock_level.value.length == 0) {
        inlineMsg('stock_level','You have to enter the stock level.',1);
        return false;
    }

    if (!isNumeric(form.stock_level.value)) {
        inlineMsg('stock_level','You have to enter the numeric value.',1);
        return false;
    }
    return true;
}


function checkAdminProductDetailUpdateForm(form) {
    if (form.product_sku.value.length == 0) {
        inlineMsg('product_sku','You have to enter the SKU code.',1);
        return false;
    }
    
    if (form.date_available.value.length == 0) {
        inlineMsg('date_available','You have to enter the available date.',1);
        return false;
    }

    if (form.product_cost.value.length == 0) {
        inlineMsg('product_cost','You have to enter the product cost.',1);
        return false;
    }

    if (!isNumeric(form.product_cost.value)) {
        inlineMsg('product_cost','You have to enter the numeric value.',1);
        return false;
    }

    if (form.product_price.value.length == 0) {
        inlineMsg('product_price','You have to enter the product price.',1);
        return false;
    }

    if (!isNumeric(form.product_price.value)) {
        inlineMsg('product_price','You have to enter the numeric value.',1);
        return false;
    }

    if (form.product_onsale.value == 'Y') {
        if ((form.product_presale_price.value == 0) || (form.product_presale_price.value.length == 0)){
            inlineMsg('product_presale_price','You have to enter the product presale price.',1);
            return false;
        }
        

        if (!isNumeric(form.product_presale_price.value)) {
            inlineMsg('product_presale_price','You have to enter the numeric value.',1);
            return false;
        }
    }

    if (form.product_stock_level.value.length == 0) {
        inlineMsg('product_stock_level','You have to enter the product stock level.',1);
        return false;
    }

    if (!isNumeric(form.product_stock_level.value)) {
        inlineMsg('product_stock_level','You have to enter the numeric value.',1);
        return false;
    }
    
    return true;
}

function checkAdminCustomerDetailUpdateForm(form) {
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

function checkAdminCustomerBillingAddressUpdateForm(form) {
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

    return true;
}

function checkAdminCustomerDeliveryAddressUpdateForm(form) {
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


function checkShippingRegionValueCreationForm(form) {
    if (form.shipping_region.value.length == 0) {
        inlineMsg('shipping_region','You have to enter the shipping region.',1);
        return false;
    }
    return true;
}

function checkShippingRegionUpdate(form) {
    if (form.shipping_region.value.length == 0) {
        inlineMsg('shipping_region','You have to enter the shipping region.',1);
        return false;
    }
    return true;
}

function checkShippingMethodCreationForm(form) {
    if (form.shipping_type.value.length == 0) {
        inlineMsg('shipping_type','You have to enter the shipping type.',1);
        return false;
    }
    if (form.shipping_cost.value.length == 0) {
        inlineMsg('shipping_cost','You have to enter the shipping cost.',1);
        return false;
    }

    if (!isNumeric(form.shipping_cost.value)) {
        inlineMsg('shipping_cost','You have to enter the numeric value.',1);
        return false;
    }
    return true;   
}

function checkShippingMethodUpdate(form) {
    if (form.shipping_type.value.length == 0) {
        inlineMsg('shipping_type','You have to enter the shipping type.',1);
        return false;
    }
    if (form.shipping_cost.value.length == 0) {
        inlineMsg('shipping_cost','You have to enter the shipping cost.',1);
        return false;
    }

    if (!isNumeric(form.shipping_cost.value)) {
        inlineMsg('shipping_cost','You have to enter the numeric value.',1);
        return false;
    }

    return true;
}

function checkPaymentMethodsCreationForm(form) {
    if (form.payment_method_name.value.length == 0) {
        inlineMsg('payment_method_name','You have to enter the payment method name.',1);
        return false;
    }

    if (form.payment_method_include_path.value.length == 0) {
        inlineMsg('payment_method_include_path','You have to enter the include path.',1);
        return false;
    }
    return true;
}

function checkPaymentMethodUpdateForm(form) {
    if (form.payment_method_name.value.length == 0) {
        inlineMsg('payment_method_name','You have to enter the payment method name.',1);
        return false;
    }

    if (form.payment_method_include_path.value.length == 0) {
        inlineMsg('payment_method_include_path','You have to enter the include path.',1);
        return false;
    }
    return true;
}


function checkBrandCreationForm(form) {
    if (form.brand_name.value.length == 0) {
        inlineMsg('brand_name','You have to enter the brand name.',1);
        return false;
    }
    return true;
}

function checkBrandUpdateForm(form) {
    if (form.brand_name.value.length == 0) {
        inlineMsg('brand_name','You have to enter the brand name.',1);
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
    arrow.src = "../images/validation/msg_arrow.gif";
}

