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
    if (form.password.value.length == 0) {
        inlineMsg('password', 'You have to enter the new password.', 3);
        return false;
    }

    if (form.password.value.length < 8) {
        inlineMsg('password', 'The password should contain at least 8 characters', 3);
        return false;
    }
    return true;
}