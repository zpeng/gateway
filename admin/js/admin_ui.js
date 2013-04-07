function confirmOperation() {
    var result = false;
    result = confirm("Do you want to process this operation?");
    return result;
}

function confirmDeletion() {
    var result = false;
    result = confirm("Do you want to delete this item?");
    return result;
}


function checkUserPasswordUpdateForm(form) {
    if (form.password.value.length < 8) {
        inlineMsg('password', 'The password should contain at least 8 characters', 3);
        return false;
    }
    return true;
}

function checkUserCreateForm(form) {
    var result = true;

    if (!isValidEmail(form.email.value)) {
        inlineMsg('email', 'You have to enter a valid email.', 1);
        result = false;
    }

    if (form.password.value.length < 8) {
        inlineMsg('password', 'The password should contain at least 8 characters', 1);
        result = false;
    }
    return result;
}


function isValidEmail(strString) {
    if (strString.length === 0) return false;
    with (strString) {
        apos = strString.indexOf("@");
        dotpos = strString.lastIndexOf(".");
        if (apos < 1 || dotpos - apos < 2) {
            return false;
        }
        else {
            return true;
        }
    }
}
