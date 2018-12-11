function validateForm() {
    var username = document.forms["Form"]["username"].value;
    var password = document.forms["Form"]["password"].value;

    if (username == "" && password == "") {
        alert('Username dan password harus di isi!');
        return false;
    } else if (username == "") {
        alert('Username harus di isi!');
        return false;
    } else if (password == "") {
        alert('Password harus di isi!');
        return false
    } else {
        return true;
    }
}

function validateRegisForm() {
    var name = document.forms["regisForm"]["fullname"].value;
    var password = document.forms["regisForm"]["password"].value;
    var password2 = document.forms["regisForm"]["password2"].value;

    if (name == "" && password == "" && password2 == "") {
        alert('Fullname dan password harus di isi!');
        return false;
    } else if (name == "") {
        alert('Fullname harus di isi!');
        return false;
    } else if (password == "") {
        alert('Password harus di isi!');
        return false
    } else if (password2 == "") {
        alert('Password harus di isi!');
        return false
    } else {
        return true;
    }
}